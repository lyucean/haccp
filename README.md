# HACCPro - Система управления HACCP

<p align="center">
<img src="public/img/logo.svg" width="200" alt="HACCPro Logo">
</p>

## 📋 О проекте

**HACCPro** - это веб-приложение для управления системой HACCP (Hazard Analysis and Critical Control Points) - анализ опасностей и критические контрольные точки. Система построена на Laravel 12 с использованием Filament 4.1 для админ-панели.

### 🛠 Технологический стек
- **Backend:** Laravel 12, PHP 8.3
- **Admin Panel:** Filament 4.1
- **Database:** MySQL 8.0
- **Cache:** Redis
- **Frontend:** Livewire, Alpine.js
- **Deployment:** Docker, GitHub Actions

---

## 📁 Структура проекта

### 🏗 Основные директории

```
haccp/
├── app/                    # Основной код приложения
├── config/                 # Конфигурационные файлы
├── database/               # Миграции, сидеры, фабрики
├── public/                 # Публичные файлы (CSS, JS, изображения)
├── resources/              # Шаблоны, стили, скрипты
├── routes/                 # Маршруты приложения
├── storage/                # Логи, кэш, загруженные файлы
├── tests/                  # Тесты
├── vendor/                 # Зависимости Composer
├── docker-compose.yml      # Конфигурация Docker
├── Dockerfile             # Образ для PHP-FPM
└── Makefile               # Команды для разработки
```

---

## 🎯 Ключевые компоненты

### 📊 Модели данных (`app/Models/`)

#### `User.php` - Пользователи системы
```php
// Основные поля:
- id: уникальный идентификатор
- name: имя пользователя
- email: email адрес
- password: хешированный пароль
- email_verified_at: дата подтверждения email

// Методы:
- canAccessPanel(): проверка доступа к админ-панели
```

#### `Lead.php` - Лиды (потенциальные клиенты)
```php
// Основные поля:
- id: уникальный идентификатор
- name: имя лида
- email: email адрес
- phone: телефон
- company: компания
- status: статус лида
- comment: комментарий
- created_at: дата создания
```

### 🎨 Админ-панель (`app/Filament/`)

#### `Resources/` - Ресурсы для управления данными

**`Leads/LeadResource.php`** - Управление лидами
- Список всех лидов
- Создание новых лидов
- Редактирование существующих
- Фильтрация по статусам
- Поиск по имени, email, компании

**`Users/UserResource.php`** - Управление пользователями
- Список всех пользователей
- Создание новых пользователей
- Изменение паролей
- Подтверждение email

#### `Widgets/` - Виджеты для дашборда

**`LeadsStatsWidget.php`** - Статистика по лидам
- Общее количество лидов
- Лиды по статусам
- График активности

**`LeadsStatusWidget.php`** - Статусы лидов
- Распределение по статусам
- Процентное соотношение

#### `Providers/AdminPanelProvider.php` - Конфигурация админ-панели
```php
// Настройки:
- brandName: 'HACCPro'
- brandLogo: логотип осьминога
- favicon: иконка сайта
- colors: цветовая схема (Amber)
- widgets: виджеты на дашборде
- middleware: промежуточное ПО
```

### 🗄 База данных (`database/`)

#### Миграции (`migrations/`)
- `create_users_table.php` - таблица пользователей
- `create_leads_table.php` - таблица лидов
- `add_status_and_comment_to_leads_table.php` - дополнительные поля

#### Сидеры (`seeders/`)
- `DatabaseSeeder.php` - заполнение базы тестовыми данными

### 🌐 Маршруты (`routes/`)

#### `web.php` - Веб-маршруты
```php
// Основные маршруты:
Route::get('/', [HomeController::class, 'index']);  // Главная страница
Route::post('/api/leads', [LeadController::class, 'store']);  // API для лидов
```

### ⚙️ Конфигурация (`config/`)

#### `app.php` - Основные настройки приложения
```php
'name' => 'HACCPro',  // Название приложения
'env' => 'production', // Окружение
'debug' => false,     // Режим отладки
'url' => 'https://haccpro.ru', // URL сайта
```

#### `database.php` - Настройки базы данных
```php
'default' => 'mysql',  // Основная БД
'connections' => [
    'mysql' => [
        'host' => 'mysql',     // Хост БД
        'database' => 'haccp_laravel',  // Имя БД
        'username' => 'haccp_user',     // Пользователь
        'password' => 'haccp_password', // Пароль
    ]
]
```

---

## 🐳 Docker и развертывание

### Контейнеры (`docker-compose.yml`)

```yaml
services:
  php-fpm:      # PHP-FPM контейнер (основное приложение)
  nginx:        # Веб-сервер
  mysql:        # База данных MySQL
  redis:        # Кэш и сессии
  phpmyadmin:   # Веб-интерфейс для MySQL (только для dev)
```

### Профили запуска
- **`dev`** - для разработки (включает phpMyAdmin)
- **`prod`** - для продакшена (оптимизирован)

### Команды разработки (`Makefile`)

```bash
make up          # Запуск всех контейнеров
make down        # Остановка контейнеров
make build       # Пересборка контейнеров
make migrate     # Применение миграций
make admin       # Создание админ-пользователя
make logs        # Просмотр логов
make shell       # Вход в PHP контейнер
```

---

## 🚀 Автоматическое развертывание

### GitHub Actions (`.github/workflows/deploy-prod.yml`)

**Процесс деплоя:**
1. **Checkout** - получение кода из репозитория
2. **Create .env** - создание файла окружения
3. **Copy files** - копирование файлов на сервер
4. **Deploy** - сборка и запуск контейнеров
5. **Test** - проверка работоспособности
6. **Alert** - уведомление в Telegram

**Секреты GitHub:**
- `HOST` - IP адрес сервера
- `USERNAME` - имя пользователя
- `PASSWORD` - пароль
- `PORT` - порт SSH
- `TELEGRAM_BOT_TOKEN` - токен бота
- `TELEGRAM_CHAT_ID` - ID чата

---

## 🔧 Разработка

### Локальная разработка

1. **Клонирование репозитория:**
```bash
git clone https://github.com/lyucean/haccp.git
cd haccp
```

2. **Запуск контейнеров:**
```bash
make up
```

3. **Применение миграций:**
```bash
make migrate
```

4. **Создание админ-пользователя:**
```bash
make admin
```

5. **Доступ к приложению:**
- Сайт: http://localhost:8080
- Админка: http://localhost:8080/admin
- phpMyAdmin: http://localhost:8081

### Структура URL

```
http://localhost:8080/           # Главная страница
http://localhost:8080/admin/      # Админ-панель
http://localhost:8080/admin/leads # Управление лидами
http://localhost:8080/admin/users # Управление пользователями
```

---

## 📝 Работа с данными

### Создание нового лида

**Через админку:**
1. Зайти в раздел "Лиды"
2. Нажать "Создать"
3. Заполнить форму
4. Сохранить

**Через API:**
```bash
curl -X POST http://localhost:8080/api/leads \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Иван Иванов",
    "email": "ivan@example.com",
    "phone": "+7-999-123-45-67",
    "company": "ООО Ромашка"
  }'
```

### Управление пользователями

**Создание пользователя:**
1. Зайти в раздел "Пользователи"
2. Нажать "Создать"
3. Заполнить данные
4. Установить пароль
5. Сохранить

**Изменение пароля:**
1. Найти пользователя в списке
2. Нажать "Редактировать"
3. Ввести новый пароль
4. Сохранить

---

## 🔍 Отладка и логи

### Просмотр логов

```bash
# Логи PHP-FPM
make logs

# Логи Laravel
docker compose exec php-fpm tail -f storage/logs/laravel.log

# Логи всех контейнеров
docker compose logs -f
```

### Частые проблемы

**500 ошибка:**
1. Проверить логи: `make logs`
2. Очистить кэш: `docker compose exec php-fpm php artisan cache:clear`
3. Пересобрать контейнер: `make build`

**Проблемы с базой данных:**
1. Проверить подключение: `docker compose exec php-fpm php artisan tinker`
2. Применить миграции: `make migrate`
3. Проверить права доступа к файлам

---

## 📚 Полезные команды

### Artisan команды

```bash
# Очистка кэша
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Работа с базой данных
php artisan migrate          # Применить миграции
php artisan migrate:rollback # Откатить миграции
php artisan db:seed          # Заполнить БД тестовыми данными

# Создание файлов
php artisan make:model ModelName
php artisan make:controller ControllerName
php artisan make:migration create_table_name

# Filament команды
php artisan make:filament-resource ResourceName
php artisan make:filament-widget WidgetName
php artisan filament:upgrade
```

### Docker команды

```bash
# Управление контейнерами
docker compose up -d         # Запуск в фоне
docker compose down          # Остановка
docker compose restart       # Перезапуск
docker compose ps            # Статус контейнеров

# Вход в контейнер
docker compose exec php-fpm bash
docker compose exec mysql mysql -u root -p

# Просмотр логов
docker compose logs php-fpm
docker compose logs nginx
docker compose logs mysql
```

---

## 🎨 Кастомизация

### Изменение логотипа

1. Заменить файл `public/img/logo.svg`
2. Обновить `AdminPanelProvider.php`:
```php
->brandLogo(asset('img/logo.svg'))
```

### Изменение цветовой схемы

В `AdminPanelProvider.php`:
```php
->colors([
    'primary' => Color::Blue,  // Изменить цвет
])
```

### Добавление новых полей

1. Создать миграцию:
```bash
php artisan make:migration add_field_to_table
```

2. Обновить модель и ресурс Filament

---

## 🔐 Безопасность

### Настройки продакшена

- `APP_DEBUG=false` - отключить отладку
- `APP_ENV=production` - режим продакшена
- Настроить HTTPS
- Использовать сильные пароли
- Регулярно обновлять зависимости

### Файл `.env`

**НЕ КОММИТИТЬ** файл `.env` в репозиторий!
Используйте `.env.example` как шаблон.

---

## 📞 Поддержка

При возникновении проблем:

1. Проверить логи: `make logs`
2. Проверить статус контейнеров: `docker compose ps`
3. Перезапустить контейнеры: `make restart`
4. Очистить кэш: `docker compose exec php-fpm php artisan cache:clear`

---

## 🎯 Следующие шаги

1. **Изучить Laravel документацию:** https://laravel.com/docs
2. **Изучить Filament документацию:** https://filamentphp.com/docs
3. **Практиковаться с созданием новых ресурсов**
4. **Изучить работу с базой данных**
5. **Настроить мониторинг и логирование**

---

*Этот проект создан для изучения Laravel и Filament. Удачи в разработке! 🚀*