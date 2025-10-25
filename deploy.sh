#!/bin/bash

# Скрипт деплоя HACCPro Laravel на продакшен

echo "🚀 Начинаем деплой HACCPro Laravel..."

# Проверяем наличие .env файла
if [ ! -f .env ]; then
    echo "❌ Файл .env не найден! Создайте его на основе .env.example"
    exit 1
fi

# Создаем необходимые директории
echo "📁 Создаем директории..."
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p bootstrap/cache

# Устанавливаем права доступа
echo "🔐 Устанавливаем права доступа..."
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Генерируем APP_KEY если его нет
if ! grep -q "APP_KEY=" .env || grep -q "APP_KEY=$" .env; then
    echo "🔑 Генерируем APP_KEY..."
    php artisan key:generate
fi

# Создаем внешнюю сеть web если её нет
echo "🌐 Создаем Docker сеть..."
docker network create web 2>/dev/null || echo "Сеть web уже существует"

# Останавливаем старые контейнеры
echo "🛑 Останавливаем старые контейнеры..."
docker compose down || true

# Запускаем новые контейнеры
echo "🚀 Запускаем новые контейнеры..."
docker compose --profile prod up -d --build

# Ждем запуска базы данных
echo "⏳ Ждем запуска базы данных..."
sleep 30

# Проверяем подключение к базе данных
echo "🗄️ Проверяем подключение к базе данных..."
for i in {1..10}; do
    if docker compose exec -T php-fpm php artisan migrate:status >/dev/null 2>&1; then
        echo "✅ База данных доступна"
        break
    else
        echo "⏳ Ожидание базы данных... ($i/10)"
        sleep 10
    fi
done

# Выполняем миграции
echo "🗄️ Выполняем миграции..."
docker compose exec -T php-fpm php artisan migrate --force

# Очищаем и кэшируем конфигурацию
echo "🧹 Очищаем кэш..."
docker compose exec -T php-fpm php artisan config:clear
docker compose exec -T php-fpm php artisan route:clear
docker compose exec -T php-fpm php artisan view:clear

echo "💾 Кэшируем конфигурацию..."
docker compose exec -T php-fpm php artisan config:cache
docker compose exec -T php-fpm php artisan route:cache
docker compose exec -T php-fpm php artisan view:cache

# Показываем статус
echo "📊 Статус контейнеров:"
docker compose ps

echo "✅ Деплой завершен успешно!"
echo "🌐 Сайт: https://haccpro.ru"
echo "🔧 Админка: https://haccpro.ru/admin"
