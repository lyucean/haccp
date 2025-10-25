#!/bin/bash

# Скрипт полной переустановки HACCPro Laravel
# ⚠️  ВНИМАНИЕ: Этот скрипт удалит весь проект и установит его заново

set -e

PROJECT_DIR="/var/www/haccpro.ru"
BACKUP_DIR="/var/www/haccpro_backup_$(date +%Y%m%d_%H%M%S)"

echo "⚠️  ВНИМАНИЕ: Этот скрипт удалит текущий проект!"
echo "💾 Создам резервную копию в: $BACKUP_DIR"
read -p "Продолжить? (yes/no): " confirm

if [ "$confirm" != "yes" ]; then
    echo "❌ Отменено"
    exit 1
fi

cd "$PROJECT_DIR" || exit 1

# 1. Останавливаем контейнеры
echo "1️⃣ Останавливаем контейнеры..."
docker compose down || true

# 2. Создаем резервную копию
echo "2️⃣ Создаем резервную копию..."
mkdir -p "$BACKUP_DIR"
cp -r "$PROJECT_DIR"/* "$BACKUP_DIR/" 2>/dev/null || true
echo "✅ Резервная копия создана в $BACKUP_DIR"

# 3. Удаляем старые данные (кроме .git и важных файлов)
echo "3️⃣ Очищаем директорию..."
cd "$PROJECT_DIR"
rm -rf vendor storage/*.log bootstrap/cache/* app public/index.html public/script.js public/style.css

# 4. Очищаем Docker образы и контейнеры
echo "4️⃣ Очищаем Docker..."
docker compose down -v --rmi all || true
docker system prune -f

# 5. Запускаем контейнеры заново
echo "5️⃣ Запускаем контейнеры..."
docker compose --profile prod up -d --build

# 6. Ждем запуска MySQL
echo "6️⃣ Ждем запуска MySQL..."
sleep 30

# 7. Устанавливаем зависимости
echo "7️⃣ Устанавливаем зависимости..."
docker compose exec -T php-fpm bash -c "cd /usr/share/nginx/html && composer install --no-dev --optimize-autoloader"

# 8. Создаем .env если его нет
echo "8️⃣ Проверяем .env..."
if [ ! -f .env ]; then
    echo "Создаем .env..."
    cat > .env << 'EOF'
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://haccpro.ru

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=haccp_laravel
DB_USERNAME=haccp_user
DB_PASSWORD=haccp_password

BROADCAST_DRIVER=log
CACHE_DRIVER=redis
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
EOF
fi

# 9. Генерируем APP_KEY
echo "9️⃣ Генерируем APP_KEY..."
docker compose exec -T php-fpm bash -c "cd /usr/share/nginx/html && php artisan key:generate --force"

# 10. Настраиваем права доступа
echo "🔟 Настраиваем права доступа..."
docker compose exec -T php-fpm bash -c "cd /usr/share/nginx/html && chmod -R 755 storage bootstrap/cache"
docker compose exec -T php-fpm bash -c "cd /usr/share/nginx/html && chown -R www-data:www-data storage bootstrap/cache"

# 11. Выполняем миграции
echo "1️⃣1️⃣ Выполняем миграции..."
docker compose exec -T php-fpm bash -c "cd /usr/share/nginx/html && php artisan migrate --force"

# 12. Кэшируем конфигурацию
echo "1️⃣2️⃣ Кэшируем конфигурацию..."
docker compose exec -T php-fpm bash -c "cd /usr/share/nginx/html && php artisan config:cache"
docker compose exec -T php-fpm bash -c "cd /usr/share/nginx/html && php artisan route:cache"
docker compose exec -T php-fpm bash -c "cd /usr/share/nginx/html && php artisan view:cache"

# 13. Проверяем статус
echo "1️⃣3️⃣ Проверяем статус..."
docker compose ps

echo ""
echo "✅ Переустановка завершена!"
echo "🌐 Сайт: https://haccpro.ru"
echo "🔧 Админка: https://haccpro.ru/admin"
echo "💾 Резервная копия: $BACKUP_DIR"
