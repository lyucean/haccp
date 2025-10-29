@extends('layouts.app')

@section('content')
<!-- Header -->
<header>
    <div class="header-content">
        <a href="/" class="logo">
            <div class="logo-mascot">
                <img src="{{ asset('octopus.svg') }}">
            </div>
            <span>HACCPro</span>
        </a>
        <nav>
            <ul class="nav-links">
                <li><a href="#features">Возможности</a></li>
                <li><a href="#how">Как работает</a></li>
                <li><a href="#pricing">Тарифы</a></li>
                <li><a href="#services">Услуги</a></li>
                <li><a href="/client" class="header-cta">Войти</a></li>
                <li><a href="/client/register" class="header-cta">Регистрация</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>ХАССП <span class="highlight">под ключ</span> за 30 минут</h1>
            <p class="subtitle">Профессиональные документы без консультантов и юристов. Экономьте до 50 000₽ и получите готовую систему ХАССП уже сегодня!</p>

            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-check"></i></div>
                    <span class="stat-text">2000+ довольных клиентов</span>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-check"></i></div>
                    <span class="stat-text">Без юристов</span>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-check"></i></div>
                    <span class="stat-text">Готово сегодня</span>
                </div>
            </div>

            <div class="hero-cta">
                <a href="#" class="btn-primary">Получить документы ХАССП <i class="fas fa-arrow-right"></i></a>
                <a href="#pricing" class="btn-secondary">Посмотреть тарифы</a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="expert-container">
                <!-- Фото эксперта -->
                <div class="expert-photo">
                    <img src="{{ asset('img/expert2.png') }}" alt="Владислав Батичков - эксперт по ХАССП">

                    <!-- Плавающие бейджи поверх фото -->
                    <div class="floating-badge badge-1">
                        <span class="badge-icon"><i class="fas fa-file-alt"></i></span>
                        <span class="badge-text">15+ документов</span>
                    </div>
                    <div class="floating-badge badge-2">
                        <span class="badge-icon"><i class="fas fa-bolt"></i></span>
                        <span class="badge-text">За 30 минут</span>
                    </div>
                    <div class="floating-badge badge-3">
                        <span class="badge-icon"><i class="fas fa-shield-alt"></i></span>
                        <span class="badge-text">Проходит проверки</span>
                    </div>
                </div>

                <!-- Цитата эксперта НИЖЕ фото -->
                <div class="expert-quote">
                    <div class="quote-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <p class="quote-text">Я помог более 50 компаниям внедрить ХАССП. Теперь вы можете получить все документы за 30 минут - без переплат консультантам.</p>
                    <div class="expert-info">
                        <p class="expert-name">
                            Владислав Батичков
                            <i class="fas fa-check-circle verified-icon"></i>
                        </p>
                        <p class="expert-title">Эксперт по ХАССП</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trust Section -->
<section class="trust-section">
    <div class="trust-content">
        <p class="trust-text">Тысячи предприятий по всей России уже забыли, что такое проблемы с ХАССП</p>
        <div class="trust-stats">
            <div class="trust-stat">
                <div class="trust-number">2000+</div>
                <div class="trust-label">Счастливых клиентов</div>
            </div>
            <div class="trust-stat">
                <div class="trust-number">15+</div>
                <div class="trust-label">Документов в комплекте</div>
            </div>
            <div class="trust-stat">
                <div class="trust-number">30 мин</div>
                <div class="trust-label">И документы готовы</div>
            </div>
            <div class="trust-stat">
                <div class="trust-number">99.9%</div>
                <div class="trust-label">Работаем без сбоев</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features" id="features">
    <div class="features-content">
        <div class="section-header">
            <span class="section-badge"><i class="fas fa-sparkles"></i> Что умеем</span>
            <h2 class="section-title">Всё, что нужно для ХАССП. Без лишнего.</h2>
            <p class="section-subtitle">Мы сделали систему, которая реально работает и экономит ваше время и деньги</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-robot"></i></div>
                <h3>Умный AI делает документы</h3>
                <p>Никаких шаблонов. Наш искусственный интеллект создаёт документы под ваше производство. Как будто их делал дорогой консультант.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-clipboard-list"></i></div>
                <h3>Полный комплект документов</h3>
                <p>Программа контроля, рабочие листы, инструкции, журналы - всё, что нужно для проверок. Ничего не забудете.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-balance-scale"></i></div>
                <h3>Проходит любые проверки</h3>
                <p>Документы соответствуют всем требованиям закона. Проверено на реальных проверках Роспотребнадзора.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                <h3>Быстро - значит быстро</h3>
                <p>30 минут от начала до готовых документов. Не надо ждать неделями, пока консультант соизволит ответить.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-save"></i></div>
                <h3>Скачивай и пользуйся</h3>
                <p>Получите документы в PDF или Word. Хоть на принтер, хоть на флешку, хоть инспектору на почту.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-sync-alt"></i></div>
                <h3>Обновляй когда хочешь</h3>
                <p>Поменяли рецепт или оборудование? Обновите документы за пару минут. Никаких доплат.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-building"></i></div>
                <h3>Для любого производства</h3>
                <p>Пекарня, мясной цех, кондитерка, ресторан, кафе - система работает для всех, кто делает еду.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-mobile-alt"></i></div>
                <h3>Работает на всём</h3>
                <p>Хоть с компьютера, хоть с телефона. Никаких приложений и программ устанавливать не нужно.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-lock"></i></div>
                <h3>Данные под защитой</h3>
                <p>Ваши секретные рецепты и данные никуда не утекут. Всё хранится на защищенных серверах в России.</p>
            </div>
        </div>
    </div>
</section>

<!-- How it works -->
<section class="how-it-works" id="how">
    <div class="how-content">
        <div class="section-header">
            <span class="section-badge"><i class="fas fa-rocket"></i> Процесс</span>
            <h2 class="section-title">Как это работает?</h2>
            <p class="section-subtitle">Всего три шага до готовой системы ХАССП</p>
        </div>

        <div class="steps-container">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3>Отвечаешь на вопросы</h3>
                <p>Рассказываешь о своём производстве: что готовишь, как и на чём. Простые вопросы, понятные ответы. 15-20 минут и готово.</p>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <h3>AI делает документы</h3>
                <p>Наш искусственный интеллект анализирует твои ответы и за 5 минут создаёт все нужные документы. Магия? Нет, технологии!</p>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <h3>Скачиваешь и пользуешься</h3>
                <p>Получаешь готовые документы в PDF или Word. Распечатал, подписал - и система ХАССП готова. Проверяющие будут в шоке.</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing -->
<section class="pricing" id="pricing">
    <div class="pricing-content">
        <div class="section-header">
            <span class="section-badge"><i class="fas fa-coins"></i> Тарифы</span>
            <h2 class="section-title">Прозрачные цены без скрытых платежей</h2>
            <p class="section-subtitle">Выберите тариф под ваши задачи. Экономьте до 50 000₽ на консультантах</p>
        </div>

        <div class="pricing-grid">
            <!-- STARTER -->
            <div class="pricing-card">
                <h3 class="plan-name">СТАРТ</h3>
                <div class="plan-price">2 990 ₽</div>
                <div class="plan-period">единоразово</div>
                <ul class="plan-features">
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Полный комплект документов</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> 1 производство</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> PDF + Word файлы</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Готово за 30 минут</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Техподдержка 30 дней</li>
                </ul>
                <button class="plan-button">Начать работу</button>
            </div>

            <!-- BASIC -->
            <div class="pricing-card featured">
                <div class="pricing-badge">Популярный</div>
                <h3 class="plan-name">БИЗНЕС</h3>
                <div class="plan-price">4 990 ₽</div>
                <div class="plan-period">в месяц</div>
                <ul class="plan-features">
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Всё из тарифа Старт</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> До 3 производств</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Неограниченные обновления</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> История изменений</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Приоритетная поддержка</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Консультации эксперта</li>
                </ul>
                <button class="plan-button">Выбрать тариф</button>
            </div>

            <!-- PRO -->
            <div class="pricing-card">
                <h3 class="plan-name">ПРОФИ</h3>
                <div class="plan-price">9 990 ₽</div>
                <div class="plan-period">в месяц</div>
                <ul class="plan-features">
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Всё из тарифа Бизнес</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> До 10 производств</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Персональный дизайн</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> AI-помощник 24/7</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Интеграции с 1С и CRM</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Выделенный менеджер</li>
                </ul>
                <button class="plan-button">Подключить</button>
            </div>

            <!-- ENTERPRISE -->
            <div class="pricing-card">
                <h3 class="plan-name">КОРПОРАТ</h3>
                <div class="plan-price">от 19 990 ₽</div>
                <div class="plan-period">в месяц</div>
                <ul class="plan-features">
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Всё из тарифа Профи</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Неограниченно производств</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> API для разработчиков</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> White Label решение</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> SLA 99.9%</li>
                    <li><span class="check-icon"><i class="fas fa-check"></i></span> Персональный аккаунт-менеджер</li>
                </ul>
                <button class="plan-button">Обсудить условия</button>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section class="services" id="services">
    <div class="services-content">
        <div class="section-header">
            <span class="section-badge"><i class="fas fa-tools"></i> Помощь</span>
            <h2 class="section-title">Нужна поддержка экспертов?</h2>
            <p class="section-subtitle">Мы поможем разобраться с ХАССП и подготовиться к проверкам</p>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-phone"></i></div>
                <h3>1-2 часа звонок</h3>
                <div class="service-price">5 000 ₽</div>
                <p>Детальная консультация по телефону или видеозвонку. Разбор ваших документов, ответы на все вопросы. Готовим к проверкам и помогаем исправить ошибки.</p>
                <a href="#" class="service-button">Заказать звонок</a>
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-clipboard-check"></i></div>
                <h3>Выезд эксперта</h3>
                <div class="service-price">39 900 ₽</div>
                <p>Эксперт приедет к вам, проверит всё на месте и поможет исправить. Идеально перед настоящей проверкой. Гарантия результата.</p>
                <a href="#" class="service-button">Вызвать эксперта</a>
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-graduation-cap"></i></div>
                <h3>Обучение персонала</h3>
                <div class="service-price">от 10 000 ₽</div>
                <p>Научим вашу команду работать с ХАССП. Онлайн или вживую. Простым языком о сложном. С сертификатами и проверкой знаний.</p>
                <a href="#" class="service-button">Узнать детали</a>
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <h3>Спасение от проверки</h3>
                <div class="service-price">49 900 ₽</div>
                <p>Проверка на носу, а документов нет? Соберем всё за 48 часов. Поможем подготовиться и будем на связи во время проверки.</p>
                <a href="#" class="service-button">SOS! Помогите!</a>
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-cogs"></i></div>
                <h3>Нестандартные случаи</h3>
                <div class="service-price">Индивидуально</div>
                <p>Крафтовая пивоварня? Производство альтернативного мяса? Экзотические продукты? Разработаем ХАССП для любых технологий.</p>
                <a href="#" class="service-button">Обсудить задачу</a> 
            </div>

            <div class="service-card">
                <div class="service-icon"><i class="fas fa-handshake"></i></div>
                <h3>Сопровождение</h3>
                <div class="service-price">50 000 ₽/мес</div>
                <p>Мы на вашей стороне. Регулярные проверки, обновления документов, консультации 24/7. Как личный юрист, только по ХАССП.</p>
                <a href="#" class="service-button">Хочу спать спокойно</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-content">
        <h2>Готовы получить профессиональную систему ХАССП?</h2>
        <p>Начните прямо сейчас и получите готовые документы за 30 минут</p>
        <div class="cta-buttons">
            <a href="#" class="btn-white">Получить документы ХАССП <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-brand">
            <div class="footer-logo">
                <img src="{{ asset('octopus.svg') }}" style="color: #fff" width="40" height="40" >
                <span>HACCPro</span>
            </div>
            <p>Делаем ХАССП простым и понятным. Автоматизируем бумажную работу, чтобы вы могли заниматься любимым делом, а не бороться с документами.</p>
        </div>

        <div class="footer-section"> 
            <h4>Продукт</h4>
            <ul>
                <li><a href="#services">Помощь экспертов</a></li>
                <li><a href="#" onclick="openDeveloperModal()">Для разработчиков</a></li>
                <li><a href="/admin">Для партнеров</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Полезное</h4>
            <ul>
                <li><a href="#" onclick="openKnowledgeBaseModal()">База знаний</a></li>
                <li><a href="#" onclick="openBlogModal()">Блог о ХАССП</a></li>
                <li><a href="#" onclick="openStoriesModal()">Истории клиентов</a></li>
                <li><a href="#" onclick="openDocumentationModal()">Документация</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Контакты</h4>
            <ul>
                <li><i class="fas fa-envelope"></i> batichkovv@gmail.com</li>
                <li><i class="fas fa-phone"></i> +7 (916) 239-63-83</li>
                <li><i class="fab fa-telegram"></i> Telegram: @Vladislav_Batichkov</li>
                <li><i class="fas fa-building"></i> Москва, Россия</li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="footer-bottom-content">
            <p>&copy; 2025 HACCPro. Все права защищены. Сделано с <i class="fas fa-heart"></i> для тех, кто делает вкусную еду</p>
            <a href="https://lyucean.com" target="_blank" rel="noopener noreferrer" class="dev-link">
                <i class="fas fa-code"></i>
                <span>Разработано lyucean.com</span>
            </a>
        </div>
    </div>
</footer>

<!-- Модальные окна -->
@include('partials.modals')

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function(m,e,t,r,i,k,a){
        m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
    })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=104658034', 'ym');

    ym(104658034, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", accurateTrackBounce:true, trackLinks:true});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/104658034" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Подключаем файл с целями Яндекс.Метрики -->
<script type='text/javascript' src='{{ asset('js/metrika-goals.js') }}' defer='defer'></script>
@endsection
