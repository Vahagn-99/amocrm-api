# Интеграция AmoCRM API для Laravel

Этот проект представляет собой приложение на Laravel, которое интегрируется с API AmoCRM. Оно предоставляет конечные точки для работы с AmoCRM, включая управление сделками, контактами, задачами и другим.

## Содержание
- [Установка](#установка)
- [Конфигурация](#конфигурация)
- [Использование](#использование)
- [Конечные точки API](#конечные-точки-api)

## Установка

1. Клонируйте репозиторий:
    ```bash
    git clone https://github.com/вашпользователь/ваш-репозиторий.git
    cd ваш-репозиторий
    ```

2. Запустите Sail:
    ```bash
    ./vendor/bin/sail up
    ```

3. Скопируйте файл `.env.example` в `.env`:
    ```bash
    cp .env.example .env
    ```

4. Сгенерируйте ключ приложения:
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

5. Установите зависимости:
    ```bash
    ./vendor/bin/sail composer install
    ```

## Конфигурация

1. Настройте подключение к базе данных в файле `.env`:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ваша_база_данных
    DB_USERNAME=ваш_пользователь
    DB_PASSWORD=ваш_пароль
    ```

2. Настройте параметры интеграции с AmoCRM:
    ```env
    AMOCRM_BASE_URL=https://yourdomain.amocrm.com
    AMOCRM_CLIENT_ID=ваш_клиент_id
    AMOCRM_CLIENT_SECRET=ваш_клиент_secret
    AMOCRM_REDIRECT_URI=https://yourdomain.com/callback
    ```

## Использование

1. Запустите сервер разработки:
    ```bash
    ./vendor/bin/sail up
    ```

2. Теперь вы можете использовать конечные точки API для взаимодействия с AmoCRM.

## Конечные точки API

- **Обмен кода на токен авторизации**
    - `POST /api/amocrm/auth/callback`
    - Используйте этот эндпоинт для обмена кода авторизации на токен. Необходимо передать `code` в теле запроса.
    - пример зопроса ```
    curl /api/amocrm/auth/callback POST body {
        "referrer": "mydomain.amocrm.ru",
        "code": "code from widget keys settings (works only 20 min)",
        "platform": 1,
        "client_id": "id from widget keys settings",
        "from_widget": 1
    }
    ```

- **Получение списка сделок**
    - `GET /api/amocrm/leads`
    - Получите список сделок из AmoCRM. Можете добавить параметры для фильтрации, если это поддерживается.

- **Получение информации о сделке**
    - `GET /api/amocrm/leads/{id}`
    - Получите детали конкретной сделки по её `id`.

- **Создание новой сделки**
    - `POST /api/amocrm/leads`
    - Создайте новую сделку. Передайте данные сделки в теле запроса.

- **Обновление сделки**
    - `PUT /api/amocrm/leads/{id}`
    - Обновите информацию о сделке по её `id`. Передайте обновлённые данные в теле запроса.

- **Удаление сделки**
    - `DELETE /api/amocrm/leads/{id}`
    - Удалите сделку по её `id`.

Для подробной информации о конечных точках API и их параметрах, смотрите [документацию](https://www.amocrm.ru/developers/content/crm_platform/api-reference).
# amocrm-api
