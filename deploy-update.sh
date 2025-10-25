#!/bin/bash

echo "🔄 Обновление PHP контейнера до версии 8.3"
echo "=========================================="
echo ""

# Путь к проекту
cd /var/www/haccpro.ru

# Остановить старый контейнер PHP
echo "1️⃣ Останавливаю старый контейнер PHP..."
docker compose stop php-fpm

# Удалить старый контейнер
echo "2️⃣ Удаляю старый контейнер PHP..."
docker compose rm -f php-fpm

# Запустить новый контейнер с PHP 8.3
echo "3️⃣ Запускаю новый контейнер с PHP 8.3..."
docker compose --profile prod up -d php-fpm

# Проверить статус
echo "4️⃣ Проверяю статус..."
docker compose ps php-fpm

# Проверить версию PHP
echo "5️⃣ Проверяю версию PHP..."
docker exec haccpro-php php -v

echo ""
echo "✅ Обновление завершено!"
