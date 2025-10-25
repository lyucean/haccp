<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HACCPro - ХАССП под ключ за 30 минут | Профессионально. Быстро. Надёжно.')</title>

    <meta name="title" content="@yield('meta_title', 'HACCPro - ХАССП под ключ за 30 минут | Профессионально. Быстро. Надёжно.')">
    <meta name="description" content="@yield('meta_description', 'Профессиональная система для создания документов ХАССП за 30 минут. Экономьте до 50 000₽ на консультантах. Готовые документы, которые проходят проверки Роспотребнадзора.')">
    <meta name="keywords" content="@yield('meta_keywords', 'ХАССП, документы, контроль, Роспотребнадзор, бизнес, производство, HACCP, безопасность, AI, автоматизация')">
    <meta name="author" content="HACCPro">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#0066FF">
    <meta name="msapplication-TileColor" content="#0066FF">
    <meta name="application-name" content="HACCPro">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta name="yandex-verification" content="6aa096090c686877" />

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', 'HACCPro - ХАССП под ключ за 30 минут | Профессионально. Быстро. Надёжно.')">
    <meta property="og:description" content="@yield('og_description', 'Профессиональная система для создания документов ХАССП за 30 минут. Экономьте до 50 000₽ на консультантах. Готовые документы, которые проходят проверки Роспотребнадзора.')">
    <meta property="og:image" content="@yield('og_image', 'https://haccpro.ru/img/social-banner.png')">
    <meta property="og:url" content="@yield('og_url', 'https://haccpro.ru/')">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ru_RU">

    <!-- Twitter -->
    <meta name="twitter:title" content="@yield('twitter_title', 'HACCPro - ХАССП под ключ за 30 минут | Профессионально. Быстро. Надёжно.')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Профессиональная система для создания документов ХАССП за 30 минут. Экономьте до 50 000₽ на консультантах. Готовые документы, которые проходят проверки Роспотребнадзора.')">
    <meta name="twitter:image" content="@yield('twitter_image', 'https://haccpro.ru/img/social-banner.png')">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('img/site.webmanifest') }}?v=2" />

    <link type='text/css' rel='stylesheet' href='{{ asset('css/style.css') }}?v=12' />
    <!-- Добавляем Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .invalid-email {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
    </style>
    <!-- Input Mask Library - временно отключено для диагностики -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script> -->
    <script type='text/javascript' src='{{ asset('js/script.js') }}' defer='defer'></script>
</head>
<body>
    @yield('content')
</body>
</html>
