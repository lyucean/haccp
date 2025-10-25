#!/bin/bash

echo "🔍 Диагностика HACCPro"
echo "======================"
echo ""

# Проверка 1: Состояние контейнеров
echo "1️⃣ Проверка контейнеров:"
docker compose ps
echo ""

# Проверка 2: Проверка сети web
echo "2️⃣ Проверка сети web:"
if docker network ls | grep -q "web"; then
    echo "✅ Сеть web существует"
else
    echo "❌ Сеть web НЕ существует!"
    echo "Создаю сеть..."
    docker network create web
fi
echo ""

# Проверка 3: Проверка файлов
echo "3️⃣ Проверка файлов:"
if [ -f "docker/nginx/sites/haccp.conf" ]; then
    echo "✅ Nginx конфиг существует"
else
    echo "❌ Nginx конфиг НЕ найден!"
fi

if [ -d "public" ]; then
    echo "✅ Папка public существует"
else
    echo "❌ Папка public НЕ найдена!"
fi
echo ""

# Проверка 4: Логи Nginx
echo "4️⃣ Последние 20 строк логов Nginx:"
docker compose logs --tail=20 nginx-haccpro 2>&1 || echo "Контейнер nginx-haccpro не найден"
echo ""

# Проверка 5: Логи PHP-FPM
echo "5️⃣ Последние 20 строк логов PHP-FPM:"
docker compose logs --tail=20 php-fpm 2>&1 || echo "Контейнер php-fpm не найден"
echo ""

# Проверка 6: Traefik labels
echo "6️⃣ Проверка Traefik labels:"
if docker ps | grep -q "haccpro-nginx"; then
    echo "Traefik labels контейнера:"
    docker inspect haccpro-nginx 2>/dev/null | grep -A 5 "traefik" || echo "Traefik labels не найдены"
else
    echo "❌ Контейнер haccpro-nginx не запущен"
fi
echo ""

# Проверка 7: Проверка портов
echo "7️⃣ Проверка портов:"
docker port haccpro-nginx 2>/dev/null || echo "Контейнер haccpro-nginx не запущен"
echo ""

echo "======================"
echo "✅ Диагностика завершена"
