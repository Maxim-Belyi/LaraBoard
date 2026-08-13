SAIL := ./vendor/bin/sail

.PHONY: up down restart shell migrate fresh logs npm dev build help

default: help

help:
	@echo "Доступные команды:"
	@echo "  make up       - Запустить проект"
	@echo "  make down     - Остановить проект"
	@echo "  make restart  - Перезапустить проект"
	@echo "  make shell    - Войти в bash-контейнер приложения"
	@echo "  make migrate  - Запустить миграции БД"
	@echo "  make fresh    - Пересоздать БД и запустить сиды (удалит все данные!)"
	@echo "  make logs     - Посмотреть логи контейнеров"
	@echo "  make dev      - Запустить Vite для сборки фронтенда в режиме разработки"
	@echo "  make build    - Собрать фронтенд для продакшена"
	@echo "  make seed     - Запустить сиды"

up:
	$(SAIL) up -d && make dev

down:
	$(SAIL) down

restart: down up

shell:
	$(SAIL) shell

logs:
	$(SAIL) logs -f

migrate:
	$(SAIL) artisan migrate

fresh:
	$(SAIL) artisan migrate:fresh --seed

dev:
	$(SAIL) npm run dev

build:
	$(SAIL) npm run build

seed:
	$(SAIL) artisan db:seed