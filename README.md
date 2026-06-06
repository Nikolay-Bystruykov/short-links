# Short-links

Сервис коротких ссылок на Laravel.

## Требования

- PHP 8+
- Composer

## Запуск

```
# Клонировать репозиторий
git clone git@github.com:Nikolay-Bystruykov/short-links.git
cd short-links

# Установить зависимости
composer install

# Настроить окружение
cp .env.example .env
php artisan key:generate

# Создать файл базы данных
touch database/database.sqlite

# Выполнить миграции
php artisan migrate

# Запустить сервер
php artisan serve
```

Сервер запустится на `http://localhost:8000`

## API

```
POST - /api/links - Создать короткую ссылку
GET - /{code} - Редирект на оригинальный URL
GET - /api/links/{code}/stats - Статистика переходов
```

### Создать ссылку
```
POST /api/links
```


```json
{
    "url": "https://google.com"
}
```

Ответ:

```json
{
    "code": "NGD4tg",
    "short_url": "http://localhost:8000/NGD4tg"
}
```

### Статистика
```
GET /api/links/NGD4tg/stats
```

Ответ:

```json
{
    "url": "https://google.com",
    "code": "NGD4tg",
    "clicks": 2,
    "created_at": "2026-06-06T12:34:56.000000Z"
}
```

