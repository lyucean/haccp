# 🐙 HACCPro Laravel Docker Setup

## Быстрый старт

### 1. Первоначальная настройка
```bash
make setup
```

### 2. Запуск проекта
```bash
# Для разработки
make up

# Для продакшена
make up-prod
```

### 3. Открыть в браузере
- **Сайт**: http://localhost:8080 (dev) или http://haccpro.ru (prod)
- **Админка**: http://localhost:8080/admin (dev) или http://haccpro.ru/admin (prod)
- **phpMyAdmin**: http://localhost:8081 (только dev)

## Команды управления

### Основные команды
```bash
make up        # Запустить контейнеры для разработки
make up-prod   # Запустить контейнеры для продакшена
make down      # Остановить контейнеры
make restart   # Перезапустить контейнеры
make logs      # Показать логи
make shell     # Войти в контейнер приложения
```

### Работа с базой данных
```bash
make migrate   # Выполнить миграции
make seed      # Заполнить тестовыми данными
make fresh     # Пересоздать базу данных
```

### Управление кэшем
```bash
make clear     # Очистить весь кэш
make install   # Установить зависимости и кэш
```

## Структура проекта

```
haccp-laravel/
├── docker/
│   ├── apache/          # Конфигурация Apache
│   ├── nginx/           # Конфигурация Nginx
│   │   ├── sites/       # Конфигурации сайтов
│   │   └── ssl/         # SSL сертификаты
│   ├── php/             # Конфигурация PHP
│   └── mysql/           # Конфигурация MySQL
├── docker-compose.yml   # Docker Compose конфигурация
├── Dockerfile           # Docker образ приложения
├── Makefile            # Команды управления
└── docker-setup.sh     # Скрипт первоначальной настройки
```

## Сервисы

### 🚀 App (Laravel)
- **Порт**: 80 (внутренний)
- **Образ**: PHP 8.2 + Apache
- **Рабочая директория**: `/var/www/html`

### 🌐 Nginx
- **Порт**: 80, 443
- **Функции**: Прокси, SSL, кэширование
- **Конфигурация**: `docker/nginx/sites/haccp.conf`

### 🗄️ MySQL
- **Порт**: 3306
- **База данных**: `haccp_laravel`
- **Пользователь**: `haccp_user`
- **Пароль**: `haccp_password`

### 🔴 Redis
- **Порт**: 6379
- **Функции**: Кэш, сессии, очереди

### 📊 phpMyAdmin
- **Порт**: 8080
- **URL**: http://localhost:8080

## Переменные окружения

Создайте файл `.env` на основе `.env.example`:

```env
APP_NAME="HACCPro Laravel"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=haccp_laravel
DB_USERNAME=haccp_user
DB_PASSWORD=haccp_password

# Redis
REDIS_HOST=redis
REDIS_PORT=6379
```

## SSL сертификаты

Для разработки создается самоподписанный сертификат:
- **Файл**: `docker/nginx/ssl/cert.pem`
- **Ключ**: `docker/nginx/ssl/key.pem`

Для продакшена замените на реальные сертификаты.

## Логи

```bash
# Все логи
make logs

# Логи конкретного сервиса
docker-compose logs -f app
docker-compose logs -f nginx
docker-compose logs -f mysql
```

## Отладка

### Войти в контейнер
```bash
make shell
```

### Проверить статус
```bash
docker-compose ps
```

### Пересобрать образы
```bash
make build
```

## Производственное развертывание

1. Обновите переменные окружения в `.env`
2. Замените SSL сертификаты в `docker/nginx/ssl/`
3. Обновите домены в `docker/nginx/sites/haccp.conf`
4. Запустите: `make up`

## Безопасность

- Отключен `expose_php`
- Настроены security headers
- Ограничен доступ к системным файлам
- Настроен SSL/TLS
- Используется Redis для сессий
