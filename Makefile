# Makefile для удобной работы с Docker

.PHONY: help up down restart logs shell wp db-backup db-restore clean

help: ## Показать эту справку
	@echo "Доступные команды:"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}'

up: ## Запустить Docker окружение
	docker-compose up -d
	@echo "WordPress доступен на http://localhost:8080"
	@echo "phpMyAdmin доступен на http://localhost:8081"

down: ## Остановить Docker окружение
	docker-compose down

restart: ## Перезапустить Docker окружение
	docker-compose restart

logs: ## Показать логи контейнеров
	docker-compose logs -f

shell: ## Войти в контейнер WordPress
	docker-compose exec wordpress bash

wp: ## Выполнить WP-CLI команду (использование: make wp CMD="plugin list")
	docker-compose exec wordpress wp $(CMD)

db-backup: ## Создать резервную копию БД
	docker-compose exec wordpress wp db export backup-$$(date +%Y%m%d-%H%M%S).sql
	@echo "Резервная копия создана"

db-restore: ## Восстановить БД из файла (использование: make db-restore FILE=backup.sql)
	docker-compose exec wordpress wp db import $(FILE)

clean: ## Остановить и удалить все контейнеры и volumes
	docker-compose down -v
	@echo "Все данные удалены"

status: ## Показать статус контейнеров
	docker-compose ps

install: ## Установить WordPress (первый запуск)
	@echo "Установка WordPress..."
	@echo "Подожди 15 секунд, пока БД инициализируется..."
	@sleep 15
	docker-compose exec -T wordpress wp core install \
		--url=http://localhost:8080 \
		--title="ГоЦИСС" \
		--admin_user=admin \
		--admin_password=admin \
		--admin_email=admin@gociss.local \
		--skip-email
	@echo "WordPress установлен!"
	@echo "Логин: admin"
	@echo "Пароль: admin"
	@echo "URL: http://localhost:8080/wp-admin"



