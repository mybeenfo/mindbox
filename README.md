# Mindbox service

## Приложение для отправки запросов в сервис mindbox

### Деплой приложения:
1) Клонируем проект (получаем изменения)
2) Выполняем команду: composer install
3) Создаем файл .env.local и копируем переменные из .env и при необходимости настраиваем переменные окружения 
4) Устанавливаем Docker и docker-compose
5) Поднимаем контейнеры docker-compose up -d
6) Накатываем миграции docker exec -it minbox-php php bin/console doctrine:migrations:migrate

#### Список команд:
docker exec -it minbox-php php bin/console rabbitmq:consumer mindbox_export_products - запуск consumer для приёма сообщения ROUTING_KEY = 'product.updated_v2' о изменении товаров(ids)
docker exec -it minbox-php php bin/console rabbitmq:consumer user_registered - запуск consumer для приёма сообщения ROUTING_KEY = 'user.registrated' о создании нового пользователя
docker exec -it minbox-php php bin/console rabbitmq:consumer user_updated - запуск consumer для приёма сообщения ROUTING_KEY = 'user.updated' об изменении пользователя
docker exec -it minbox-php php bin/console rabbitmq:consumer user_logged - запуск consumer для приёма сообщения ROUTING_KEY = 'user.logged_in' об авторизации пользователя
docker exec -it minbox-php php bin/console mindbox:update-products - обновление товаров в сервисе mindbox

## Запуск тестов
php vendor/phpunit/phpunit/phpunit --configuration phpunit.xml.dist
php vendor/phpunit/phpunit/phpunit --configuration phpunit.xml.dist <путь к тесту>

## Функции приложения

### 1. Отправка данных об изменившихся товарах в сервис mindbox
1) Получение сообщения об изменённых товарах(ids) - ROUTING_KEY = 'product.updated_v2' из rabbitMQ, и отправка в таблицу export_products
2) Каждые 5 минут по Cron запускается команда php bin/console mindbox:update-products:
   - Забирает данные(ids) о товарах из таблицы export_products
   - По ids товаров получает данные для отправки в сервис Mindbox из мастер базы cdek
   - Создаёт сообщение в формате .csv src/MindboxMessages/Csv/ExportProductsMessageCsv.php
   - Отправляет методом post через клиент src/Service/MindboxApiClient/MindboxApiClient.php
   - Удаляет обработанные записи из таблицы export_products
   - Логирует в Logstash


## Api
Описание методов API нахожится в папке doc/API
Документация к LPIntegrator.API - https://confluence.example.ru/pages/viewpage.action?pageId=91561712