# Laravel Web Application

<p align="center">
<img src="public/img/logo.svg" width="200" alt="Application Logo">
</p>

## 📋 О проекте

Веб-приложение на Laravel 12 с админ-панелью Filament 4.1 для управления данными и пользователями.

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
project/
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

### 📂 Подробное описание файлов

#### 🏠 Основные файлы:
- **`resources/views/home.blade.php`** - главная страница сайта (HTML шаблон)
- **`resources/views/layouts/app.blade.php`** - основной макет страниц (header, footer, подключение CSS/JS)
- **`public/js/script.js`** - основной JavaScript код (анимации, формы, модальные окна)
- **`public/css/style.css`** - основные стили сайта (цвета, шрифты, расположение элементов)
- **`public/octopus.svg`** - логотип приложения (векторное изображение)
- **`public/favicon.ico`** - иконка сайта во вкладке браузера

#### 🏗 Laravel файлы:
- **`app/Models/User.php`** - модель пользователя (структура данных пользователей)
- **`app/Models/Lead.php`** - модель лидов (структура данных потенциальных клиентов)
- **`app/Http/Controllers/`** - контроллеры (обработка запросов от пользователей)
  - `HomeController.php` - обработка главной страницы
  - `Api/LeadController.php` - API для работы с лидами
- **`app/Filament/`** - админ панель (управление данными через веб-интерфейс)
  - `Resources/` - страницы управления данными
  - `Widgets/` - виджеты на главной странице админки
  - `Providers/AdminPanelProvider.php` - настройки админ-панели
- **`database/migrations/`** - миграции (создание и изменение таблиц в базе данных)
- **`database/factories/UserFactory.php`** - фабрика пользователей (создание тестовых данных)

#### 🐳 Docker файлы:
- **`docker-compose.yml`** - основная конфигурация всех контейнеров
- **`Dockerfile`** - образ PHP-FPM (настройка PHP для работы приложения)
- **`docker/nginx/`** - конфигурация веб-сервера Nginx
  - `sites/haccp.conf` - настройки для продакшена
  - `sites/haccp-dev.conf` - настройки для разработки
- **`docker/mysql/`** - конфигурация базы данных MySQL
- **`docker/php/`** - конфигурация PHP (настройки производительности)

#### ⚙️ Конфигурация:
- **`config/`** - все конфигурационные файлы
  - `app.php` - основные настройки приложения
  - `database.php` - настройки базы данных
  - `auth.php` - настройки авторизации
  - `mail.php` - настройки отправки email
- **`routes/web.php`** - маршруты (какие URL ведут на какие страницы)
- **`composer.json`** - PHP зависимости (какие библиотеки использует проект)
- **`phpunit.xml`** - конфигурация тестов

---

## 🌐 Маршруты (`routes/`)

#### `web.php` - Веб-маршруты
```php
// Основные маршруты:
Route::get('/', [HomeController::class, 'index']);  // Главная страница
Route::post('/api/leads', [LeadController::class, 'store']);  // API для лидов
```

---

## 📝 Работа с данными

### API для тестирования

**Создание лида через API:**
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

## 📚 Artisan команды

### Основные команды

```bash
# Очистка кэша
php artisan cache:clear          # Очистить кэш приложения
php artisan config:clear         # Очистить кэш конфигурации
php artisan route:clear          # Очистить кэш маршрутов
php artisan view:clear           # Очистить кэш шаблонов
php artisan optimize:clear       # Очистить весь кэш

# Работа с базой данных
php artisan migrate              # Применить все миграции
php artisan migrate:rollback     # Откатить последнюю миграцию
php artisan migrate:reset        # Откатить все миграции
php artisan migrate:refresh      # Откатить и применить заново
php artisan migrate:status       # Показать статус миграций
php artisan db:seed              # Заполнить БД тестовыми данными
php artisan db:wipe              # Очистить всю базу данных

# Создание файлов
php artisan make:model ModelName                    # Создать модель
php artisan make:controller ControllerName          # Создать контроллер
php artisan make:controller Api/ControllerName      # Создать API контроллер
php artisan make:migration create_table_name        # Создать миграцию
php artisan make:migration add_field_to_table       # Добавить поле в таблицу
php artisan make:seeder SeederName                  # Создать сидер
php artisan make:factory FactoryName                # Создать фабрику
php artisan make:middleware MiddlewareName          # Создать middleware
php artisan make:request RequestName                # Создать request класс

# Filament команды
php artisan make:filament-resource ResourceName     # Создать ресурс Filament
php artisan make:filament-widget WidgetName         # Создать виджет Filament
php artisan make:filament-page PageName             # Создать страницу Filament
php artisan make:filament-user                      # Создать пользователя админки
php artisan filament:upgrade                        # Обновить Filament

# Работа с приложением
php artisan key:generate           # Сгенерировать APP_KEY
php artisan config:cache           # Кэшировать конфигурацию
php artisan route:cache            # Кэшировать маршруты
php artisan view:cache             # Кэшировать шаблоны
php artisan optimize               # Оптимизировать приложение
php artisan serve                  # Запустить встроенный сервер
php artisan tinker                 # Открыть интерактивную консоль

# Полезные команды
php artisan list                   # Показать все доступные команды
php artisan help command_name      # Помощь по конкретной команде
php artisan route:list             # Показать все маршруты
php artisan queue:work             # Запустить обработку очередей
php artisan schedule:run           # Запустить планировщик задач
```

### Команды для разработки

```bash
# Создание полного CRUD ресурса
php artisan make:model Post -mcr   # Создать модель, миграцию, контроллер и ресурс

# Создание API ресурса
php artisan make:model User -mcr --api  # Создать API ресурс

# Создание с фабрикой и сидером
php artisan make:model Category -mfs   # Создать модель, миграцию, фабрику и сидер

# Полезные сокращения
php artisan make:model -a         # Создать все файлы для модели
php artisan make:controller -r    # Создать ресурсный контроллер
php artisan make:controller -i    # Создать контроллер с инъекцией зависимостей
```

---

*Этот проект создан для изучения Laravel и Filament. Удачи в разработке! 🚀*