# 🔍 Диагностика проблем развертывания

## Проверка 1: Состояние контейнеров
```bash
cd /var/www/haccpro.ru
docker compose ps
```

**Ожидаемый результат**: 
- Все контейнеры должны быть в статусе `Up`
- Контейнер `haccpro-nginx` должен быть запущен

## Проверка 2: Логи контейнеров
```bash
# Логи Nginx
docker compose logs nginx-haccpro

# Логи PHP-FPM
docker compose logs php-fpm

# Логи MySQL (если есть)
docker compose logs mysql
```

**Проверьте на наличие ошибок**:
- Ошибки монтирования volumes
- Проблемы с сетями
- Ошибки конфигурации

## Проверка 3: Проверка сетей Docker
```bash
# Проверить существование сети web
docker network ls | grep web

# Если сети нет, создать её
docker network create web
```

## Проверка 4: Проверка volumes
```bash
# Проверить монтирование
docker compose config

# Проверить существование файлов
ls -la /var/www/haccpro.ru/docker/nginx/sites/haccp.conf
ls -la /var/www/haccpro.ru/public
```

## Проверка 5: Проверка Traefik labels
```bash
# Проверить labels контейнера
docker inspect haccpro-nginx | grep -A 20 Labels

# Должны быть:
# - traefik.enable=true
# - traefik.http.routers.nginx-haccpro.rule=Host(`haccpro.ru`)
```

## Проверка 6: Ручной запуск
```bash
cd /var/www/haccpro.ru

# Остановить контейнеры
docker compose --profile prod down

# Очистить старые образы (опционально)
docker compose down --rmi all

# Запустить заново
docker compose --profile prod up -d --build

# Посмотреть логи
docker compose logs -f
```

## Проверка 7: Проверка портов
```bash
# Проверить какие порты слушают контейнеры
docker port haccpro-nginx

# Проверить доступность изнутри контейнера
docker exec haccpro-nginx curl -I http://localhost
```

## Проверка 8: Проверка Traefik
```bash
# Проверить что Traefik видит сервис
curl http://localhost:8080/api/rawdata

# Или через dashboard
open https://traefik.lyucean.com/dashboard/#/http/routers
```

## Возможные проблемы:

### 1. Контейнер не стартует
**Причина**: Проблемы с volumes или сетью
**Решение**: 
```bash
docker compose down -v
docker network create web
docker compose --profile prod up -d --build
```

### 2. Traefik не видит контейнер
**Причина**: Контейнер не в сети `web`
**Решение**: Убедитесь что в docker-compose.yml указано `networks: - web`

### 3. 404 ошибка
**Причина**: Неправильный root в Nginx
**Решение**: Проверьте что `root /usr/share/nginx/html/public;` указывает на правильную папку

### 4. PHP не работает
**Причина**: PHP-FPM недоступен
**Решение**: 
```bash
docker exec haccpro-php ps aux | grep php-fpm
```
