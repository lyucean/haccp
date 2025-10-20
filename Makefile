.PHONY: help dev prod stop restart clean logs ps

# Переменные
COMPOSE = docker-compose
PROJECT = haccpro

help: ## Показать справку по командам
	@echo "Использование:"
	@echo "  make [команда]"
	@echo ""
	@echo "Команды:"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}'

dev: ## Запустить проект в режиме разработки
	$(COMPOSE) --profile dev up -d

prod: ## Запустить проект в продакшн режиме
	$(COMPOSE) --profile prod up -d

stop: ## Остановить все контейнеры
	$(COMPOSE) stop

restart: ## Перезапустить все контейнеры
	$(COMPOSE) restart

clean: ## Остановить и удалить все контейнеры
	$(COMPOSE) down

logs: ## Показать логи всех контейнеров
	$(COMPOSE) logs -f

ps: ## Показать статус контейнеров
	$(COMPOSE) ps

dev-build: ## Собрать и запустить контейнеры для разработки
	$(COMPOSE) --profile dev up -d --build

prod-build: ## Собрать и запустить контейнеры для продакшена
	$(COMPOSE) --profile prod up -d --build

nginx-logs: ## Показать логи Nginx
	docker logs haccpro-nginx || docker logs haccpro-nginx-dev

php-logs: ## Показать логи PHP
	docker logs haccpro-php

shell-nginx: ## Войти в контейнер Nginx
	docker exec -it $$(docker ps -q -f name=haccpro-nginx -f name=haccpro-nginx-dev) /bin/bash

shell-php: ## Войти в контейнер PHP
	docker exec -it haccpro-php /bin/bash