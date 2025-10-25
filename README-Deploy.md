# 🚀 HACCPro Laravel Deployment

## Автоматический деплой через GitHub Actions

### Настройка секретов

В настройках репозитория GitHub добавьте следующие секреты:

#### SSH подключение к серверу:
- `HOST` - IP адрес сервера
- `USERNAME` - имя пользователя SSH
- `PASSWORD` - пароль пользователя SSH
- `PORT` - порт SSH (обычно 22)

#### Telegram уведомления:
- `TELEGRAM_BOT_TOKEN` - токен бота для уведомлений
- `TELEGRAM_CHAT_ID` - ID чата для уведомлений
- `TELEGRAM_ALERT_BOT_TOKEN` - токен бота для алертов
- `TELEGRAM_ALERT_CHAT_ID` - ID чата для алертов

### Процесс деплоя

1. **deploy** - Копирование файлов на сервер
2. **setup** - Настройка Laravel приложения
3. **publish** - Запуск Docker контейнеров
4. **test** - Проверка работоспособности
5. **alert** - Отправка уведомлений

## Ручной деплой

### Подготовка сервера

```bash
# Создаем директорию проекта
mkdir -p /var/www/haccpro.ru
cd /var/www/haccpro.ru

# Клонируем репозиторий
git clone https://github.com/your-username/haccp-laravel.git .

# Копируем .env файл
cp .env.example .env
```

### Настройка .env для продакшена

```env
APP_NAME="HACCPro Laravel"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://haccpro.ru

# Database
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=haccp_laravel
DB_USERNAME=haccp_user
DB_PASSWORD=haccp_password

# Cache
CACHE_DRIVER=redis
SESSION_DRIVER=redis
REDIS_HOST=redis
REDIS_PORT=6379

# Mail
MAIL_FROM_ADDRESS="hello@haccpro.ru"
MAIL_FROM_NAME="${APP_NAME}"
```

### Запуск деплоя

```bash
# Автоматический деплой
./deploy.sh

# Или через Makefile
make up-prod
```

### Команды управления

```bash
# Статус контейнеров
docker compose ps

# Логи
docker compose logs -f

# Войти в контейнер
docker compose exec php-fpm bash

# Выполнить миграции
docker compose exec php-fpm php artisan migrate

# Очистить кэш
docker compose exec php-fpm php artisan cache:clear
```

## Откат деплоя

```bash
# Автоматический откат
./rollback.sh

# Или вручную
docker compose down
```

## Мониторинг

### Проверка работоспособности

```bash
# Проверка сайта
curl -I https://haccpro.ru

# Проверка админки
curl -I https://haccpro.ru/admin

# Проверка API
curl -I https://haccpro.ru/api/leads
```

### Логи

```bash
# Логи приложения
docker compose logs -f php-fpm

# Логи Nginx
docker compose logs -f nginx-haccpro

# Логи базы данных
docker compose logs -f mysql
```

## Безопасность

### SSL сертификаты

Для продакшена замените самоподписанные сертификаты:

```bash
# Копируем реальные сертификаты
cp /path/to/real/cert.pem docker/nginx/ssl/cert.pem
cp /path/to/real/key.pem docker/nginx/ssl/key.pem
```

### Firewall

```bash
# Открываем только необходимые порты
ufw allow 22    # SSH
ufw allow 80    # HTTP
ufw allow 443   # HTTPS
ufw enable
```

## Troubleshooting

### Проблемы с правами доступа

```bash
# Исправляем права
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Проблемы с базой данных

```bash
# Проверяем подключение
docker compose exec php-fpm php artisan migrate:status

# Пересоздаем базу
docker compose exec php-fpm php artisan migrate:fresh
```

### Проблемы с кэшем

```bash
# Очищаем весь кэш
docker compose exec php-fpm php artisan cache:clear
docker compose exec php-fpm php artisan config:clear
docker compose exec php-fpm php artisan route:clear
docker compose exec php-fpm php artisan view:clear
```

## Производительность

### Оптимизация для продакшена

```bash
# Кэшируем конфигурацию
docker compose exec php-fpm php artisan config:cache
docker compose exec php-fpm php artisan route:cache
docker compose exec php-fpm php artisan view:cache

# Оптимизируем автозагрузку
docker compose exec php-fpm composer install --optimize-autoloader --no-dev
```

### Мониторинг ресурсов

```bash
# Использование ресурсов
docker stats

# Логи производительности
docker compose logs --tail=100 nginx-haccpro
```
