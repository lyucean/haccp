// Smooth scroll для якорных ссылок
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        // Игнорируем пустые якоря (#) и якоря с onclick
        if (href === '#' || this.hasAttribute('onclick')) {
            return;
        }
        e.preventDefault();
        const target = document.querySelector(href);
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Анимация появления элементов при скролле
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Применяем анимацию к карточкам
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.feature-card, .step-card, .pricing-card, .service-card, .trust-stat');

    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});

// Анимация счётчиков в trust section
function animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16);
    let current = start;

    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = formatNumber(target);
            clearInterval(timer);
        } else {
            element.textContent = formatNumber(Math.floor(current));
        }
    }, 16);
}

function formatNumber(num) {
    if (num >= 1000) {
        return (num / 1000).toFixed(1).replace('.0', '') + 'K';
    }
    return num.toString();
}

// Запуск анимации счётчиков при появлении секции
const trustObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
            entry.target.classList.add('animated');

            const counters = [
                { element: entry.target.querySelector('.trust-stat:nth-child(1) .trust-number'), value: 2000 },
                { element: entry.target.querySelector('.trust-stat:nth-child(2) .trust-number'), value: 15 },
                { element: entry.target.querySelector('.trust-stat:nth-child(4) .trust-number'), value: 99.9 }
            ];

            counters.forEach(counter => {
                if (counter.element) {
                    const originalText = counter.element.textContent;
                    counter.element.textContent = '0';

                    setTimeout(() => {
                        if (counter.value === 2000) {
                            animateCounter(counter.element, counter.value);
                            setTimeout(() => {
                                counter.element.textContent = '2000+';
                            }, 2000);
                        } else if (counter.value === 15) {
                            animateCounter(counter.element, counter.value);
                            setTimeout(() => {
                                counter.element.textContent = '15+';
                            }, 2000);
                        } else if (counter.value === 99.9) {
                            let current = 0;
                            const timer = setInterval(() => {
                                current += 0.5;
                                if (current >= 99.9) {
                                    counter.element.textContent = '99.9%';
                                    clearInterval(timer);
                                } else {
                                    counter.element.textContent = current.toFixed(1) + '%';
                                }
                            }, 20);
                        }
                    }, 200);
                }
            });

            // Для "30 мин" просто показываем текст
            const timeElement = entry.target.querySelector('.trust-stat:nth-child(3) .trust-number');
            if (timeElement) {
                timeElement.style.opacity = '0';
                setTimeout(() => {
                    timeElement.style.transition = 'opacity 0.6s ease';
                    timeElement.style.opacity = '1';
                }, 400);
            }
        }
    });
}, { threshold: 0.3 });

const trustSection = document.querySelector('.trust-stats');
if (trustSection) {
    trustObserver.observe(trustSection);
}

// Параллакс эффект для hero секции
let ticking = false;
let lastScrollY = 0;

function updateParallax() {
    const scrolled = window.pageYOffset;
    const heroVisual = document.querySelector('.hero-visual');
    const heroBg = document.querySelector('.hero::before');

    if (heroVisual) {
        heroVisual.style.transform = `translateY(${scrolled * 0.3}px)`;
    }

    ticking = false;
}

window.addEventListener('scroll', () => {
    lastScrollY = window.pageYOffset;

    if (!ticking) {
        window.requestAnimationFrame(updateParallax);
        ticking = true;
    }
});

// Добавление класса active для header при скролле
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
    } else {
        header.style.boxShadow = 'none';
    }
});

// Анимация для floating badges
document.addEventListener('DOMContentLoaded', () => {
    const badges = document.querySelectorAll('.floating-badge');
    badges.forEach((badge, index) => {
        badge.style.opacity = '0';
        badge.style.transform = 'translateY(20px) scale(0.8)';

        setTimeout(() => {
            badge.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            badge.style.opacity = '1';
            badge.style.transform = 'translateY(0) scale(1)';
        }, 500 + (index * 200));
    });
});

// Интерактивность для pricing cards
document.querySelectorAll('.pricing-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.zIndex = '10';
    });

    card.addEventListener('mouseleave', function() {
        this.style.zIndex = '1';
    });
});

// Клики по кнопкам (можно добавить отправку в аналитику)
document.querySelectorAll('.btn-primary, .btn-secondary, .btn-white, .plan-button, .service-button').forEach(button => {
    button.addEventListener('click', function(e) {
        // Эффект ripple
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(255, 255, 255, 0.5)';
        ripple.style.transform = 'scale(0)';
        ripple.style.animation = 'ripple 0.6s ease-out';
        ripple.style.pointerEvents = 'none';

        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);

        // Здесь можно добавить отправку события в аналитику
        console.log('Button clicked:', this.textContent.trim());
    });
});

// CSS для ripple анимации (добавляем динамически)
const style = document.createElement('style');
style.textContent = `
  @keyframes ripple {
    to {
      transform: scale(4);
      opacity: 0;
    }
  }
`;
document.head.appendChild(style);

// Мобильное меню (если нужно)
const createMobileMenu = () => {
    const header = document.querySelector('header');
    const nav = document.querySelector('.nav-links');

    if (window.innerWidth <= 768 && !document.querySelector('.mobile-menu-btn')) {
        const menuBtn = document.createElement('button');
        menuBtn.className = 'mobile-menu-btn';
        menuBtn.innerHTML = '<i class="fas fa-bars"></i>';
        menuBtn.style.cssText = `
      display: block;
      background: none;
      border: none;
      font-size: 1.8rem;
      cursor: pointer;
      color: var(--text);
      padding: 0.5rem;
    `;

        const headerContent = document.querySelector('.header-content');
        headerContent.appendChild(menuBtn);

        menuBtn.addEventListener('click', () => {
            nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
            nav.style.flexDirection = 'column';
            nav.style.position = 'absolute';
            nav.style.top = '100%';
            nav.style.left = '0';
            nav.style.right = '0';
            nav.style.background = 'white';
            nav.style.padding = '2rem';
            nav.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
        });

        // Добавляем обработчики для всех пунктов меню, чтобы закрывать меню при клике
        const navLinks = nav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    nav.style.display = 'none';
                }
            });
        });
    }
};

window.addEventListener('resize', createMobileMenu);
createMobileMenu();

// Lazy loading для SVG (оптимизация)
if ('IntersectionObserver' in window) {
    const svgObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const svg = entry.target;
                svg.style.opacity = '1';
                svgObserver.unobserve(svg);
            }
        });
    });

    document.querySelectorAll('svg').forEach(svg => {
        svg.style.opacity = '0';
        svg.style.transition = 'opacity 0.3s ease';
        svgObserver.observe(svg);
    });
}

// Добавляем пульсацию к главной CTA кнопке
const heroCTA = document.querySelector('.hero-cta .btn-primary');
if (heroCTA) {
    setInterval(() => {
        heroCTA.style.animation = 'pulse 0.5s ease';
        setTimeout(() => {
            heroCTA.style.animation = '';
        }, 500);
    }, 5000);
}

const pulseStyle = document.createElement('style');
pulseStyle.textContent = `
  @keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
  }
`;
document.head.appendChild(pulseStyle);

// Отслеживание времени на странице (для аналитики)
let timeOnPage = 0;
setInterval(() => {
    timeOnPage++;
    if (timeOnPage % 30 === 0) {
        console.log(`User on page for ${timeOnPage} seconds`);
        // Здесь можно отправить данные в аналитику
    }
}, 1000);

// Показываем уведомление о cookies (GDPR compliance)
setTimeout(() => {
    const cookieNotice = document.createElement('div');
    cookieNotice.style.cssText = `
    position: fixed;
    bottom: 20px;
    left: 20px;
    right: 20px;
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
    z-index: 10000;
    display: flex;
    gap: 1rem;
    align-items: center;
    justify-content: space-between;
    max-width: 600px;
    margin: 0 auto;
    animation: slideUp 0.5s ease;
  `;

    cookieNotice.innerHTML = `
    <p style="margin: 0; font-size: 0.9rem; color: var(--text-light);">
      Мы используем cookies для улучшения работы сайта. Продолжая использование сайта, вы соглашаетесь с этим.
    </p>
    <button style="
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.6rem 1.5rem;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      white-space: nowrap;
    ">Понятно</button>
  `;

    const slideUpStyle = document.createElement('style');
    slideUpStyle.textContent = `
    @keyframes slideUp {
      from {
        transform: translateY(100px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }
  `;
    document.head.appendChild(slideUpStyle);

    if (!localStorage.getItem('cookiesAccepted')) {
        document.body.appendChild(cookieNotice);

        cookieNotice.querySelector('button').addEventListener('click', () => {
            localStorage.setItem('cookiesAccepted', 'true');
            cookieNotice.style.animation = 'slideDown 0.5s ease';
            setTimeout(() => cookieNotice.remove(), 500);
        });
    }
}, 2000);

const slideDownStyle = document.createElement('style');
slideDownStyle.textContent = `
  @keyframes slideDown {
    from {
      transform: translateY(0);
      opacity: 1;
    }
    to {
      transform: translateY(100px);
      opacity: 0;
    }
  }
`;
document.head.appendChild(slideDownStyle);

// Модальное окно регистрации - обновленная версия
const registerModal = document.getElementById('registerModal');
const modalClose = document.querySelector('.modal-close');
const registerForm = document.getElementById('registerForm');
const formSuccess = document.querySelector('.form-success');
const formLoading = document.querySelector('.form-loading');
const sourceInput = document.createElement('input'); // Создаем скрытое поле для источника

// Настраиваем скрытое поле для источника
sourceInput.type = 'hidden';
sourceInput.name = 'source';
sourceInput.id = 'source';
if (registerForm) {
    registerForm.appendChild(sourceInput);
}

// Функция для открытия модального окна с указанием источника
function openModalWithSource(source) {
    if (registerModal) {
        // ВАЖНО: Закрываем все другие модальные окна перед открытием формы регистрации
        const allModals = document.querySelectorAll('.modal');
        allModals.forEach(modal => {
            if (modal.id !== 'registerModal') {
                modal.classList.remove('show');
            }
        });
        
        // Устанавливаем источник в скрытое поле
        document.getElementById('source').value = source;

        document.body.style.overflow = 'hidden'; // Запрещаем прокрутку страницы
        registerModal.classList.add('show');
    }
}

// Функция закрытия модального окна
function closeModal() {
    if (registerModal) {
        registerModal.classList.remove('show');
        setTimeout(() => {
            document.body.style.overflow = ''; // Возвращаем прокрутку страницы
        }, 300);
    }
}

// Подключаем все кнопки на странице к модальному окну
document.addEventListener('DOMContentLoaded', () => {
    // Кнопки в шапке
    const headerCta = document.querySelector('.header-cta');
    if (headerCta) {
        headerCta.addEventListener('click', function(e) {
            e.preventDefault();
            openModalWithSource('header_button');
        });
    }

    // Кнопки в hero секции
    const heroButtons = document.querySelectorAll('.hero-cta .btn-primary');
    heroButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            openModalWithSource('hero_button');
        });
    });

    // Кнопки в тарифах
    const planButtons = document.querySelectorAll('.plan-button');
    planButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            // Получаем название тарифа из ближайшего заголовка
            const planName = this.closest('.pricing-card').querySelector('.plan-name').textContent;
            openModalWithSource('pricing_' + planName.toLowerCase().replace(/\s+/g, '_'));
        });
    });

    // Кнопка в CTA секции
    const ctaButton = document.querySelector('.cta-section .btn-white');
    if (ctaButton) {
        ctaButton.addEventListener('click', function(e) {
            e.preventDefault();
            openModalWithSource('bottom_cta');
        });
    }

    // Кнопки в секции услуг
    const serviceButtons = document.querySelectorAll('.service-button');
    serviceButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            // Получаем название услуги из ближайшего заголовка
            const serviceName = this.closest('.service-card').querySelector('h3').textContent;
            openModalWithSource('service_' + serviceName.toLowerCase().replace(/\s+/g, '_'));
        });
    });

    // Закрытие модального окна при клике на крестик
    if (modalClose) {
        modalClose.addEventListener('click', function() {
            closeModal();
        });
    }

    // Закрытие модального окна при клике вне его
    window.addEventListener('click', function(e) {
        if (e.target === registerModal) {
            closeModal();
        }
    });
});

// Обновленная обработка отправки формы
console.log('Looking for register form...');
if (registerForm) {
    console.log('Register form found, adding event listener');
    registerForm.addEventListener('submit', function(e) {
        console.log('Form submit event triggered');
        e.preventDefault();

        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const passwordInput = document.getElementById('password');
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const emailError = document.getElementById('emailError');
        const phoneError = document.getElementById('phoneError');
        const passwordError = document.getElementById('passwordError');
        const passwordConfirmationError = document.getElementById('passwordConfirmationError');

        let isValid = true;

        // Скрываем ошибки
        emailError.style.display = 'none';
        phoneError.style.display = 'none';
        passwordError.style.display = 'none';
        passwordConfirmationError.style.display = 'none';

        // Проверяем, что хотя бы одно из полей email или телефон заполнено
        if (!emailInput.value && !phoneInput.value) {
            emailError.textContent = 'Введите email или телефон';
            emailError.style.display = 'block';
            isValid = false;
        }

        // Проверяем формат email, если он заполнен
        if (emailInput.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) {
            emailError.textContent = 'Проверь формат email';
            emailError.style.display = 'block';
            isValid = false;
        }

        // Проверяем формат телефона, если он заполнен
        if (phoneInput.value && !/^[+]?[0-9]{10,15}$/.test(phoneInput.value.replace(/\D/g, ''))) {
            phoneError.textContent = 'Проверь формат телефона';
            phoneError.style.display = 'block';
            isValid = false;
        }

        // Проверяем пароль
        if (passwordInput.value && passwordInput.value.length < 6) {
            passwordError.textContent = 'Пароль должен содержать минимум 6 символов';
            passwordError.style.display = 'block';
            isValid = false;
        }

        // Проверяем подтверждение пароля
        if (passwordInput.value && passwordConfirmationInput.value && passwordInput.value !== passwordConfirmationInput.value) {
            passwordConfirmationError.textContent = 'Пароли не совпадают';
            passwordConfirmationError.style.display = 'block';
            isValid = false;
        }

        if (isValid) {
            // Показываем индикатор загрузки
            formLoading.style.display = 'block';

            // Собираем данные формы
            const formData = new FormData(registerForm);
            
            // Добавляем информацию о текущей странице
            formData.append('page_url', window.location.href);
            formData.append('page_title', document.title);
            
            // Устанавливаем источник, если он не задан
            const sourceValue = document.getElementById('source')?.value || 'unknown';
            formData.append('source', sourceValue);
 
            // Отправляем данные на Laravel API
            fetch('/api/leads', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
                .then(response => response.json())
                .then(data => {
                    formLoading.style.display = 'none';

                    if (data.success) {
                        // Показываем сообщение об успехе
                        registerForm.style.display = 'none';
                        formSuccess.style.display = 'block';

                        // Если указан редирект, перенаправляем через 2 секунды
                        if (data.redirect) {
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 2000);
                        } else {
                            // Закрываем модальное окно через 3 секунды
                            setTimeout(() => {
                                closeModal();
                                // Сбрасываем форму
                                setTimeout(() => {
                                    registerForm.reset();
                                    registerForm.style.display = 'block';
                                    formSuccess.style.display = 'none';
                                }, 300);
                            }, 3000);
                        }
                    } else {
                        // Показываем ошибку
                        alert(data.message || 'Произошла ошибка при отправке формы');
                    }
                })
                .catch(error => {
                    formLoading.style.display = 'none';
                    console.error('Error:', error);
                    alert('Произошла ошибка при отправке формы. Пожалуйста, попробуйте позже.');
                });
        }
    });
}

// Модальное окно для разработчиков
const developerModal = document.getElementById('developerModal');
const authRequired = document.getElementById('authRequired');
const developerTools = document.getElementById('developerTools');

// Функция для проверки авторизации (заглушка - в реальном проекте здесь будет проверка токена)
function checkAuth() {
    // В реальном проекте здесь будет проверка JWT токена или сессии
    // Для демонстрации используем localStorage
    const authToken = localStorage.getItem('haccpro_auth_token');
    return authToken !== null && authToken !== '';
}

// Функция для открытия модального окна разработчиков
function openDeveloperModal() {
    if (developerModal) {
        document.body.style.overflow = 'hidden';
        developerModal.classList.add('show');
        
        // Проверяем авторизацию и показываем соответствующий контент
        if (checkAuth()) {
            authRequired.style.display = 'none';
            developerTools.style.display = 'block';
        } else {
            authRequired.style.display = 'block';
            developerTools.style.display = 'none';
        }
    }
}

// Функция для закрытия модального окна разработчиков
function closeDeveloperModal() {
    if (developerModal) {
        developerModal.classList.remove('show');
        setTimeout(() => {
            document.body.style.overflow = '';
        }, 300);
    }
}

// Добавляем обработчики для модального окна разработчиков
document.addEventListener('DOMContentLoaded', () => {
    // Находим ссылку "Для разработчиков" по тексту
    const footerLinks = document.querySelectorAll('.footer-section a');
    footerLinks.forEach(link => {
        if (link.textContent.includes('Для разработчиков')) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                openDeveloperModal();
            });
        }
    });

    // Закрытие модального окна разработчиков при клике на крестик
    const developerModalClose = developerModal?.querySelector('.modal-close');
    if (developerModalClose) {
        developerModalClose.addEventListener('click', function() {
            closeDeveloperModal();
        });
    }

    // Закрытие модального окна разработчиков при клике вне его
    if (developerModal) {
        window.addEventListener('click', function(e) {
            if (e.target === developerModal) {
                closeDeveloperModal();
            }
        });
    }

    // Обработчики для кнопок в модальном окне разработчиков
    const toolButtons = document.querySelectorAll('.tool-button');
    toolButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const toolName = this.closest('.tool-card').querySelector('h4').textContent;
            console.log(`Developer tool clicked: ${toolName}`);
            // Здесь можно добавить логику для каждого инструмента
        });
    });

    // Обработчик для кнопки авторизации в модальном окне разработчиков
    const authButton = document.querySelector('.auth-button');
    if (authButton) {
        authButton.addEventListener('click', function(e) {
            e.preventDefault();
            closeDeveloperModal();
            // Открываем модальное окно регистрации с источником "developer_auth"
            setTimeout(() => {
                openModalWithSource('developer_auth');
            }, 300);
        });
    }
});

// Функция для симуляции авторизации (для демонстрации)
function simulateAuth() {
    localStorage.setItem('haccpro_auth_token', 'demo_token_' + Date.now());
    // Обновляем контент модального окна, если оно открыто
    if (developerModal && developerModal.classList.contains('show')) {
        authRequired.style.display = 'none';
        developerTools.style.display = 'block';
    }
}

// Функции для открытия модальных окон
function openKnowledgeBaseModal() {
    openAuthModal('knowledgeBaseModal', 'knowledgeBaseAuth', 'knowledgeContent');
}

function openBlogModal() {
    openAuthModal('blogModal', 'blogAuth', 'blogContent');
}

function openStoriesModal() {
    openAuthModal('storiesModal', 'storiesAuth', 'storiesContent');
}

function openDocumentationModal() {
    openAuthModal('documentationModal', 'documentationAuth', 'documentationContent');
}

// Универсальная функция для открытия модальных окон с авторизацией
function openAuthModal(modalId, authElementId, contentElementId) {
    const modal = document.getElementById(modalId);
    const authElement = document.getElementById(authElementId);
    const contentElement = document.getElementById(contentElementId);
    
    if (modal) {
        document.body.style.overflow = 'hidden';
        modal.classList.add('show');
        
        // Проверяем авторизацию и показываем соответствующий контент
        if (checkAuth()) {
            authElement.style.display = 'none';
            contentElement.style.display = 'block';
        } else {
            authElement.style.display = 'block';
            contentElement.style.display = 'none';
        }
    }
}

// Функция для закрытия всех модальных окон
function closeAllModals() {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.classList.remove('show');
    });
    document.body.style.overflow = '';
}

// Добавляем обработчики для новых модальных окон
document.addEventListener('DOMContentLoaded', () => {
    // Закрытие модальных окон при клике на крестик
    document.querySelectorAll('.modal .modal-close').forEach(closeBtn => {
        closeBtn.addEventListener('click', function() {
            const modal = this.closest('.modal');
            modal.classList.remove('show');
            setTimeout(() => {
                document.body.style.overflow = '';
            }, 300);
        });
    });

    // Закрытие модальных окон при клике вне их
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
                setTimeout(() => {
                    document.body.style.overflow = '';
                }, 300);
            }
        });
    });

    // Обработчики для кнопок авторизации во всех модальных окнах
    document.querySelectorAll('.auth-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const modal = this.closest('.modal');
            modal.classList.remove('show');
            // Открываем модальное окно регистрации с источником из onclick
            setTimeout(() => {
                const source = this.getAttribute('onclick');
                if (source && source.includes('openModalWithSource')) {
                    // Извлекаем источник из onclick
                    const sourceMatch = source.match(/openModalWithSource\('([^']+)'\)/);
                    if (sourceMatch) {
                        openModalWithSource(sourceMatch[1]);
                    }
                }
            }, 300);
        });
    });
});

// Добавляем функцию симуляции авторизации в глобальную область (для демонстрации)
window.simulateAuth = simulateAuth;

console.log('🐙 HACCPro loaded successfully!');

// Простые маски для форм на чистом JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Маска для телефона
    const phoneInputs = document.querySelectorAll('input[name="phone"]');
    phoneInputs.forEach(function(input) {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Убираем все не-цифры
            
            if (value.length > 0) {
                if (value[0] === '8') {
                    value = '7' + value.slice(1);
                }
                if (value[0] === '7' || value[0] === '8') {
                    if (value.length <= 1) {
                        value = '+7';
                    } else if (value.length <= 4) {
                        value = '+7 (' + value.slice(1);
                    } else if (value.length <= 7) {
                        value = '+7 (' + value.slice(1, 4) + ') ' + value.slice(4);
                    } else if (value.length <= 9) {
                        value = '+7 (' + value.slice(1, 4) + ') ' + value.slice(4, 7) + '-' + value.slice(7);
                    } else {
                        value = '+7 (' + value.slice(1, 4) + ') ' + value.slice(4, 7) + '-' + value.slice(7, 9) + '-' + value.slice(9, 11);
                    }
                }
            }
            
            e.target.value = value;
        });
        
        // Устанавливаем плейсхолдер
        input.placeholder = '+7 (___) ___-__-__';
    });
    
    // Валидация email
    const emailInputs = document.querySelectorAll('input[name="email"]');
    emailInputs.forEach(function(input) {
        input.addEventListener('input', function(e) {
            let value = e.target.value;
            // Простая валидация email
            if (value && !value.includes('@')) {
                e.target.classList.add('invalid-email');
            } else {
                e.target.classList.remove('invalid-email');
            }
        });
    });
});