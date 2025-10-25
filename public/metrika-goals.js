document.addEventListener('DOMContentLoaded', function() {
    // Функция для отслеживания целей Яндекс.Метрики
    function trackYandexMetrikaGoal(goalName) {
        if (typeof ym !== 'undefined') {
            ym(104658034, 'reachGoal', goalName);
            console.log('Метрика: цель ' + goalName + ' отправлена');
        } else {
            console.log('Яндекс.Метрика не инициализирована');
        }
    }

    // Отслеживание кликов по кнопкам "Попробовать бесплатно" в хедере
    document.querySelectorAll('.header-cta').forEach(function(button) {
        button.addEventListener('click', function() {
            trackYandexMetrikaGoal('header_cta_click');
        });
    });

    // Отслеживание кликов по кнопкам в hero секции
    document.querySelector('.btn-primary').addEventListener('click', function() {
        trackYandexMetrikaGoal('hero_primary_button_click');
    });

    document.querySelector('.btn-secondary').addEventListener('click', function() {
        trackYandexMetrikaGoal('hero_secondary_button_click');
    });

    // Отслеживание кликов по кнопкам тарифов
    document.querySelectorAll('.pricing-card .plan-button').forEach(function(button, index) {
        button.addEventListener('click', function() {
            let planNames = ['free_plan', 'basic_plan', 'pro_plan', 'corporate_plan'];
            trackYandexMetrikaGoal(planNames[index] + '_click');
        });
    });

    // Отслеживание кликов по кнопкам услуг
    document.querySelectorAll('.service-card .service-button').forEach(function(button, index) {
        button.addEventListener('click', function() {
            let serviceName = this.closest('.service-card').querySelector('h3').textContent.toLowerCase().replace(/\s+/g, '_');
            trackYandexMetrikaGoal('service_' + serviceName + '_click');
        });
    });

    // Отслеживание клика по CTA кнопке в нижней части
    document.querySelector('.cta-buttons .btn-white').addEventListener('click', function() {
        trackYandexMetrikaGoal('bottom_cta_click');
    });

    // Отслеживание отправки формы
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        trackYandexMetrikaGoal('form_submit');
    });

    // Отслеживание кликов по ссылкам в меню
    document.querySelectorAll('.nav-links a').forEach(function(link) {
        link.addEventListener('click', function() {
            let href = this.getAttribute('href');
            if (href.startsWith('#')) {
                let section = href.substring(1);
                trackYandexMetrikaGoal('menu_' + section + '_click');
            }
        });
    });

    // Отслеживание кликов по ссылкам в футере
    document.querySelectorAll('.footer-section a').forEach(function(link) {
        link.addEventListener('click', function() {
            let linkText = this.textContent.toLowerCase().replace(/\s+/g, '_');
            trackYandexMetrikaGoal('footer_' + linkText + '_click');
        });
    });
});