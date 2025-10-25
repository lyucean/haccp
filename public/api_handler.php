<?php

// Устанавливаем заголовок для JSON-ответа
header('Content-Type: application/json');

// Загружаем переменные окружения из .env файла
$env = parse_ini_file(__DIR__ . '/.env');
$telegramToken = $env['TELEGRAM_ALERT_BOT_TOKEN'] ?? '';
$telegramChatId = $env['TELEGRAM_ALERT_CHAT_ID'] ?? '';

// Проверяем наличие токена и chat ID
if (empty($telegramToken) || empty($telegramChatId)) {
    error_log('Ошибка: Не настроены переменные TELEGRAM_BOT_TOKEN или TELEGRAM_CHAT_ID в .env файле');
    echo json_encode(['success' => false, 'message' => 'Ошибка конфигурации сервера']);
    exit;
}

// Проверяем метод запроса
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
    exit;
}

// Получаем данные из запроса
$postData = $_POST;
$action = $postData['action'] ?? '';
$email = filter_var($postData['email'] ?? '', FILTER_SANITIZE_EMAIL);
$phone = preg_replace('/[^0-9+]/', '', $postData['phone'] ?? ''); // Очищаем телефон от всего, кроме цифр и +
$source = htmlspecialchars($postData['source'] ?? 'unknown'); // Источник клика
$pageUrl = htmlspecialchars($postData['page_url'] ?? ''); // Полный URL страницы
$pageTitle = htmlspecialchars($postData['page_title'] ?? ''); // Заголовок страницы

// Проверяем наличие email или телефона
if (empty($email) && empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Email или телефон обязателен для заполнения']);
    exit;
}

// Проверяем корректность email, если он указан
if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Некорректный формат email']);
    exit;
}

// Проверяем корректность телефона, если он указан
if (!empty($phone) && strlen($phone) < 10) {
    echo json_encode(['success' => false, 'message' => 'Некорректный формат телефона']);
    exit;
}

// Формируем сообщение для Telegram в зависимости от формы
$messageText = '';
$formSource = '';

switch ($action) {
    case 'login':
        $formSource = 'Форма входа';
        $messageText = "🔐 Новый вход";
        if (!empty($email)) $messageText .= "\nEmail: $email";
        if (!empty($phone)) $messageText .= "\nТелефон: $phone";
        break;

    case 'signup':
        $formSource = 'Форма регистрации';
        $companyName = htmlspecialchars($postData['company_name'] ?? '');
        $name = htmlspecialchars($postData['name'] ?? '');

        $messageText = "📝 Новая регистрация";
        if (!empty($name)) $messageText .= "\nИмя: $name";
        if (!empty($email)) $messageText .= "\nEmail: $email";
        if (!empty($phone)) $messageText .= "\nТелефон: $phone";
        if (!empty($companyName)) $messageText .= "\nКомпания: $companyName";
        break;

    case 'newsletter':
        $formSource = 'Форма подписки внизу страницы';
        $messageText = "📰 Новый потенциальный клиент";
        if (!empty($email)) $messageText .= "\nEmail: $email";
        if (!empty($phone)) $messageText .= "\nТелефон: $phone";
        break;

    case 'contact':
        $formSource = 'Контактная форма';
        $name = htmlspecialchars($postData['name'] ?? '');
        $message = htmlspecialchars($postData['message'] ?? '');

        $messageText = "📞 Новое сообщение из контактной формы";
        if (!empty($name)) $messageText .= "\nИмя: $name";
        if (!empty($email)) $messageText .= "\nEmail: $email";
        if (!empty($phone)) $messageText .= "\nТелефон: $phone";
        if (!empty($message)) $messageText .= "\nСообщение: $message";
        break;

    case 'demo':
        $formSource = 'Запрос демо';
        $messageText = "🎮 Новый запрос на демо";
        if (!empty($email)) $messageText .= "\nEmail: $email";
        if (!empty($phone)) $messageText .= "\nТелефон: $phone";
        break;

    case 'register':
        $formSource = 'Модальная форма регистрации';
        $name = htmlspecialchars($postData['name'] ?? '');
        $companyName = htmlspecialchars($postData['company_name'] ?? '');

        $messageText = "🔔 Новая заявка с сайта";
        if (!empty($name)) $messageText .= "\nИмя: $name";
        if (!empty($email)) $messageText .= "\nEmail: $email";
        if (!empty($phone)) $messageText .= "\nТелефон: $phone";
        if (!empty($companyName)) $messageText .= "\nКомпания: $companyName";
        break;

    default:
        $formSource = 'Неизвестная форма';
        $messageText = "❓ Новая форма отправлена";
        if (!empty($email)) $messageText .= "\nEmail: $email";
        if (!empty($phone)) $messageText .= "\nТелефон: $phone";

        // Добавляем все остальные поля
        foreach ($postData as $key => $value) {
            if (!in_array($key, ['email', 'phone', 'action', 'source'])) {
                $messageText .= "\n" . htmlspecialchars($key) . ": " . htmlspecialchars($value);
            }
        }
}

// Добавляем информацию об источнике клика
$clickSource = "Неизвестный источник";

// Расшифровываем источник клика
if (strpos($source, 'header_') !== false) {
    $clickSource = "Кнопка в шапке сайта";
} elseif (strpos($source, 'hero_') !== false) {
    $clickSource = "Кнопка в главном блоке";
} elseif (strpos($source, 'pricing_') !== false) {
    // Извлекаем название тарифа
    $planName = str_replace('pricing_', '', $source);
    $planName = ucfirst(str_replace('_', ' ', $planName));
    $clickSource = "Тариф: $planName";
} elseif (strpos($source, 'service_') !== false) {
    // Извлекаем название услуги
    $serviceName = str_replace('service_', '', $source);
    $serviceName = ucfirst(str_replace('_', ' ', $serviceName));
    $clickSource = "Услуга: $serviceName";
} elseif ($source == 'bottom_cta') {
    $clickSource = "Кнопка в нижнем блоке призыва к действию";
} else {
    $clickSource = "Источник: $source";
}

// Добавляем дополнительную информацию
$messageText .= "\n\n📊 Форма: $formSource";
$messageText .= "\n🔍 Источник клика: $clickSource";

// Добавляем информацию о странице откуда пришла форма
if (!empty($pageUrl)) {
    $messageText .= "\n\n🌐 ОТКУДА ПРИШЛА ФОРМА:";
    if (!empty($pageTitle)) {
        $messageText .= "\n📰 Заголовок: " . $pageTitle;
    }
}

$messageText .= "\n\n🕒 Дата: " . date('Y-m-d H:i:s');
$messageText .= "\n🌐 IP: " . $_SERVER['REMOTE_ADDR'];
$messageText .= "\n🔍 User-Agent: " . $_SERVER['HTTP_USER_AGENT'];

// Отправляем сообщение в Telegram
$telegramUrl = "https://api.telegram.org/bot$telegramToken/sendMessage";
$telegramData = [
    'chat_id' => $telegramChatId,
    'text' => $messageText,
    'parse_mode' => 'HTML'
];

// Используем cURL для отправки запроса в Telegram
$ch = curl_init($telegramUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $telegramData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$telegramResponse = curl_exec($ch);
$telegramError = curl_error($ch);
curl_close($ch);

// Проверяем результат отправки в Telegram
if ($telegramError) {
    error_log("Ошибка отправки в Telegram: $telegramError");
    // Но пользователю не сообщаем об ошибке отправки в Telegram
}

// Возвращаем успешный ответ пользователю
echo json_encode([
    'success' => true,
    'message' => 'Спасибо! Твоя заявка принята. Мы свяжемся с тобой в ближайшее время.',
    'redirect' => $action === 'signup' || $action === 'register' ? '/' : null
]);
