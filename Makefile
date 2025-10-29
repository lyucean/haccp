# HACCPro Laravel Docker Makefile

.PHONY: help build up down restart logs shell migrate seed fresh install setup

# Показать справку
help:
	@echo "🐙 HACCPro Laravel Docker Commands:"
	@echo ""
	@echo "  make setup     - Первоначальная настройка"
	@echo "  make build     - Собрать Docker образы"
	@echo "  make up        - Запустить контейнеры для разработки"
	@echo "  make up-prod   - Запустить контейнеры для продакшена"
	@echo "  make down      - Остановить контейнеры"
	@echo "  make restart   - Перезапустить контейнеры"
	@echo "  make logs      - Показать логи"
	@echo "  make shell     - Войти в контейнер приложения"
	@echo "  make migrate   - Выполнить миграции"
	@echo "  make seed      - Заполнить базу тестовыми данными"
	@echo "  make fresh     - Пересоздать базу данных"
	@echo "  make install   - Установить зависимости"
	@echo "  make clear     - Очистить кэш"
	@echo "  make admin     - Создать пользователя админки"
	@echo ""
	@echo "📊 Мониторинг команды:"
	@echo "  make status    - Проверка статуса"
	@echo "  make monitor   - Мониторинг логов"
	@echo ""
	@echo "🚀 Деплой:"
	@echo "  Деплой на продакшен происходит автоматически через GitHub Actions"
	@echo "  при пуше в main ветку. Никаких дополнительных команд не требуется."
	@echo ""

# Первоначальная настройка
setup:
	@echo "🐙 Настройка HACCPro Laravel..."
	@echo "Создаем .env файл..."
	@if [ ! -f .env ]; then cp .env.example .env; fi
	@echo "Создаем SSL директории..."
	@mkdir -p docker/nginx/ssl
	@echo "Создаем SSL сертификат для разработки..."
	@openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
		-keyout docker/nginx/ssl/key.pem \
		-out docker/nginx/ssl/cert.pem \
		-subj "/C=RU/ST=Moscow/L=Moscow/O=HACCPro/CN=localhost" 2>/dev/null || true
	@make permissions
	@make build
	@make up
	@make install
	@make migrate
	@echo "✅ Настройка завершена! Откройте http://localhost:8080"

# Собрать образы
build:
	@echo "🔨 Сборка Docker образов..."
	@docker compose build

# Запустить контейнеры для разработки
up:
	@echo "🚀 Запуск контейнеров для разработки..."
	@docker compose --profile dev up -d

# Запустить контейнеры для продакшена
up-prod:
	@echo "🚀 Запуск контейнеров для продакшена..."
	@docker compose --profile prod up -d

# Остановить контейнеры
down:
	@echo "🛑 Остановка контейнеров..."
	@docker compose down

# Перезапустить контейнеры
restart:
	@echo "🔄 Перезапуск контейнеров..."
	@docker compose restart

# Показать логи
logs:
	@echo "📋 Логи контейнеров..."
	@docker compose logs -f

# Войти в контейнер приложения
shell:
	@echo "🐚 Вход в контейнер приложения..."
	@docker compose exec php-fpm bash

# Выполнить миграции
migrate:
	@echo "🗄️ Выполнение миграций..."
	@docker compose exec php-fpm php artisan migrate --force

# Заполнить базу тестовыми данными
seed:
	@echo "🌱 Заполнение базы тестовыми данными..."
	@docker compose exec php-fpm php artisan db:seed

# Пересоздать базу данных
fresh:
	@echo "🔄 Пересоздание базы данных..."
	@docker compose exec php-fpm php artisan migrate:fresh --seed

# Установить зависимости
install:
	@echo "📦 Установка зависимостей..."
	@docker compose exec php-fpm composer install --no-dev --optimize-autoloader
	@docker compose exec php-fpm php artisan config:cache
	@docker compose exec php-fpm php artisan route:cache
	@docker compose exec php-fpm php artisan view:cache

# Очистить кэш
clear:
	@echo "🧹 Очистка кэша..."
	@docker compose exec php-fpm php artisan cache:clear
	@docker compose exec php-fpm php artisan config:clear
	@docker compose exec php-fpm php artisan route:clear
	@docker compose exec php-fpm php artisan view:clear

# Установить права доступа
permissions:
	@echo "🔐 Установка прав доступа..."
	@chmod -R 755 storage bootstrap/cache
	@echo "✅ Права доступа установлены"

# Создать пользователя админки
admin:
	@echo "👤 Создание пользователя админки..."
	@docker compose exec php-fpm php artisan make:filament-user

# Деплой на продакшен (автоматический через GitHub Actions)
# deploy:
# 	@echo "🚀 Деплой на продакшен..."
# 	@echo "Деплой происходит автоматически через GitHub Actions при пуше в main"

# Проверка статуса
status:
	@echo "📊 Статус контейнеров..."
	@docker compose ps

# Мониторинг логов
monitor:
	@echo "📋 Мониторинг логов..."
	@docker compose logs -f
