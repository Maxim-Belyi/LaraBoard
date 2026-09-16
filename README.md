# 🚀 LaraBoard: Мультисервисный дашборд на Laravel


Веб-приложение для фонового сбора, агрегации и визуализации данных из внешних источников (NASA, GitHub, OpenWeatherMap) в режиме реального времени. <br>
Демонстрирует работу с фоновыми очередями (Queues), планировщиком задач (Task Scheduler), интеграцию сторонних API через HTTP-клиент Laravel и создание интерфейсов с помощью Blade и SCSS.

## 🚀 О проекте

Приложение опрашивает три разных внешних API с помощью планировщика (Cron/Scheduler), который каждые 5 минут ставит задачи на парсинг в асинхронную очередь. Воркеры обрабатывают эти задачи, сохраняют актуальные метрики в базу данных PostgreSQL через Eloquent ORM. 

Основные компоненты:
1. **API Controllers:** Обрабатывают входящие REST запросы для получения метрик и управляют логикой.
2. **Services (Data Fetchers):** Изолированные сервисные классы (`GithubService`, `NasaService`, `OpenWeatherService`) для инкапсуляции работы с HTTP-клиентом и внешними API.
3. **Jobs & Scheduler:** Асинхронная задача `FetchModelDataJob`, которая обрабатывается фоновыми воркерами, не блокируя работу основного приложения.
4. **Dashboard View:** Blade-шаблон с использованием Vite для сборки frontend-ассетов (SCSS + JS), обеспечивающий мгновенную загрузку и отзывчивость.

## 🛠️ Стек технологий

# Backend, Frontend & Infrastructure
<div> 
<img src="https://img.shields.io/badge/Laravel_13-FF2D20?style=flat&logo=laravel&logoColor=white" alt="Laravel"/> 
<img src="https://img.shields.io/badge/PHP_8.3+-777BB4?style=flat&logo=php&logoColor=white" alt="PHP"/>
<img src="https://img.shields.io/badge/PostgreSQL-336791?style=flat&logo=postgresql&logoColor=white" alt="PostgreSQL"/> 
<img src="https://img.shields.io/badge/Redis-DC382D?style=flat&logo=redis&logoColor=white" alt="Redis"/>
<img src="https://img.shields.io/badge/Sass-CC6699?style=flat&logo=sass&logoColor=white" alt="Sass"/>
<img src="https://img.shields.io/badge/Vite-646CFF?style=flat&logo=vite&logoColor=white" alt="Vite"/>
<img src="https://img.shields.io/badge/Docker_Sail-2496ED?style=flat&logo=docker&logoColor=white" alt="Docker"/> 
</div>

## ⚙️ Как запустить локально

### Необходимые компоненты
* [PHP](https://www.php.net/downloads) (версия 8.2+) и Composer
* [Docker и Docker Compose](https://www.docker.com/) (для работы Laravel Sail)
* Node.js и NPM (для сборки ассетов)

### 1. Клонируйте репозиторий и установите зависимости

```sh
git clone https://github.com/Maxim-Belyi/LaraBoard.git
cd LaraBoard
composer install
npm install
```

### 2. Подготовьте окружение и запустите контейнеры

Скопируйте файл конфигурации и поднимите инфраструктуру (убедитесь, что Docker запущен):

```sh
cp .env.example .env
make up
./vendor/bin/sail artisan key:generate
make migrate
```
*(Команда `make up` автоматически поднимет контейнеры в фоне и запустит сборку фронтенда `npm run dev`)*

### 3. Запуск фоновых задач

Для того чтобы дашборд начал получать данные, запустите планировщик и обработчик очередей в отдельных вкладках терминала с помощью удобных make-команд:

```sh
# Запуск планировщика (отправляет задачи каждые 5 минут)
make schedule

# Запуск обработчика очередей (выполняет задачи)
make queue
```

> **Важно:** Чтобы форсировать первую загрузку данных без ожидания таймера планировщика, вы можете вручную выполнить `make schedule-run`.

Дашборд будет доступен по адресу: **http://localhost**

Для просмотра всех доступных команд просто введите `make` или `make help` в корне проекта.

## 🌐 Архитектура и паттерны

```text
[Cron / Schedule] ──► [FetchModelDataJob] ──► [Queue (Redis/DB)]
                                                    │
                                                    ▼ (Worker)
[Внешние API (NASA, GitHub...)] ◄──(HTTP)─── [Services / Fetchers]
                                                    │
                                                    ▼ (Eloquent ORM)
[Пользователь (Браузер)] ◄──(Blade + SCSS)── [PostgreSQL]
```

