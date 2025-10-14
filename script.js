// Smooth scroll для якорных ссылок
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
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
        menuBtn.innerHTML = '☰';
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

console.log('🐙 HACCPro loaded successfully!');
