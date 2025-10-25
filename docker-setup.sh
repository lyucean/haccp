#!/bin/bash

# Скрипт настройки Docker для HACCPro Laravel

echo "🐙 Настройка Docker для HACCPro Laravel..."

# Создаем .env файл для Docker
if [ ! -f .env ]; then
    echo "Создаем .env файл..."
    cp .env.example .env
fi

# Генерируем APP_KEY
echo "Генерируем APP_KEY..."
php artisan key:generate

# Устанавливаем права доступа
echo "Устанавливаем права доступа..."
chmod -R 755 storage bootstrap/cache

# Создаем директории для SSL
echo "Создаем SSL директории..."
mkdir -p docker/nginx/ssl

# Создаем самоподписанный SSL сертификат для разработки
echo "Создаем SSL сертификат для разработки..."
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout docker/nginx/ssl/key.pem \
    -out docker/nginx/ssl/cert.pem \
    -subj "/C=RU/ST=Moscow/L=Moscow/O=HACCPro/CN=localhost"

echo "✅ Настройка завершена!"
echo ""
echo "Для запуска используйте:"
echo "docker-compose up -d"
echo ""
echo "Для остановки:"
echo "docker-compose down"
echo ""
echo "Для просмотра логов:"
echo "docker-compose logs -f"
