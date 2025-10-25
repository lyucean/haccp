#!/bin/bash

# Скрипт быстрого исправления для сервера
echo "🔧 Быстрое исправление HACCPro"

cd /var/www/haccpro.ru || exit 1

# 1. Останавливаем и удаляем старый контейнер PHP
echo "1️⃣ Останавливаю старый контейнер PHP..."
docker compose --profile prod stop php-fpm
docker compose --profile prod rm -f php-fpm

# 2. Пересобираем контейнер PHP-FPM с новым Dockerfile
echo "2️⃣ Пересобираю контейнер PHP-FPM..."
docker compose --profile prod build --no-cache php-fpm

# 3. Запускаем новый контейнер
echo "3️⃣ Запускаю новый контейнер..."
docker compose --profile prod up -d php-fpm

# 4. Ждем запуска
echo "4️⃣ Жду 5 секунд..."
sleep 5

# 5. Генерируем APP_KEY
echo "5️⃣ Генерирую APP_KEY..."
docker compose --profile prod exec -T php-fpm php artisan key:generate --force

# 6. Очищаем кэш
echo "6️⃣ Очищаю кэш..."
docker compose --profile prod exec -T php-fpm php artisan config:clear
docker compose --profile prod exec -T php-fpm php artisan cache:clear
docker compose --profile prod exec -T php-fpm php artisan route:clear
docker compose --profile prod exec -T php-fpm php artisan view:clear

# 7. Проверяем статус
echo "7️⃣ Проверяю статус..."
docker compose --profile prod ps

echo ""
echo "✅ Готово! Проверьте сайт: https://haccpro.ru"
