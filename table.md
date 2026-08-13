1. Модуль OpenWeather

Таблица locations (Города для мониторинга)
id (BigIncrements)
name (String) — название города (например, «Челябинск»)
latitude (Decimal, 10, 8) — широта. Используем decimal вместо float для защиты от проблем с округлением дробных чисел в GPS.
longitude (Decimal, 11, 8) — долгота.
is_active (Boolean, default: true) — флаг для временного отключения опроса города.
timestamps (created_at, updated_at)

Таблица weather_records (История замеров погоды)
id (BigIncrements)
location_id (Foreign ID, constrained, cascade on delete) — связь с таблицей locations.
temp (Decimal, 5, 2) — текущая температура.
feels_like (Decimal, 5, 2) — ощущаемая температура.
pressure (Unsigned Integer) — давление.
humidity (Unsigned Integer) — влажность в %.
wind_speed (Decimal, 5, 2) — скорость ветра.
description (String) — краткое описание (например, few clouds).
icon (String) — код иконки от OpenWeather (например, 02n) для отрисовки на фронте.
recorded_at (Timestamp) — время замера из API (поле dt). Важно хранить именно время фактического замера на метеостанции, а не время записи в нашу БД.
timestamps

2. Модуль GitHub
Поскольку ты хочешь отслеживать конкретные технологии (PHP, Laravel, Go, JS), мы будем запрашивать данные по конкретным репозиториям этих экосистем (например: laravel/framework, golang/go, php/php-src, facebook/react).
Таблица github_repositories (Отслеживаемые репозитории)
id (BigIncrements)
owner (String) — владелец (например, laravel)
repo (String) — имя репозитория (например, framework)
primary_language (String) — язык/категория (для фильтрации на дашборде).
is_active (Boolean, default: true)
timestamps
Индекс: Уникальный составной индекс на ['owner', 'repo'], чтобы избежать дублирования.
Таблица github_repo_stats (История изменения метрик)
id (BigIncrements)
github_repository_id (Foreign ID, constrained, cascade on delete)
stars_count (Unsigned Integer)
forks_count (Unsigned Integer)
open_issues_count (Unsigned Integer)
recorded_at (Timestamp) — время снятия метрики.
timestamps
3. Модуль NASA Images
Таблица nasa_topics (Поисковые запросы/темы)
id (BigIncrements)
query_text (String, unique) — поисковый запрос (например, black hole).
is_active (Boolean, default: true)
timestamps
Таблица nasa_images (Сохраненные медиа-файлы)
id (BigIncrements)
nasa_topic_id (Foreign ID, constrained, cascade on delete)
nasa_id (String, unique) — уникальный идентификатор от NASA (behemoth-black-hole...). Позволит не записывать одну и ту же картинку повторно при периодических запросах.
title (String) — заголовок.
description (Text) — подробное описание.
image_url (String) — ссылка на изображение (будем брать medium.jpg или small.jpg из массива links).
date_created (DateTime) — дата создания кадра от NASA.
timestamps