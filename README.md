Учебный проект "Интернет-магазин" на PHP 8.2, Laravel 9, MySQL 8.0, Laravel Sail

В проекте реализовано:
1. Вывод товаров с торговыми предложениями
2. Корзина
3. Оформление заказа
4. Фильтр товаров по цене, атрибутам "Хит", "Новинка", "Рекомендуем"
5. Поиск товаров по названию
6. Личный кабинет покупателя с просмотром списка заказов, состава заказа
7. Панель администрирования

В панели администрирования реализовано:
1. Просмотр всех заказов
2. Просмотр состава заказа
3. Ретактирование/добавление/удаление категорий
4. Ретактирование/добавление/удаление товаров
5. Ретактирование/добавление/удаление свойств товаров

При разворачивании проекта происходит добавление категорий и товаров, создание пользователя и администратора.
Учетные данные пользователя: логин user@mail.ru пароль 12345678
Учетные данные администратора: логин admin@mail.ru пароль 12345678

Установка:
1. Клонировать git-репозиторий: git clone https://github.com/fredbobjim/online_shop.git app-folder
2. Перейти в папку с проектом: cd app-folder
3. Установить зависимости: composer install
4. Скопировать содержимое файла .env.example в файл .env: cp .env.example .env
5. Произвести необходимые настройки переменных окружения
6. Сгенерировать ключ приложения: php artisan key:generate
7. Запустить контейнеры docker ./vendor/bin/sail up -d
8. Запустить миграции и заполнить таблицы данными: ./vendor/bin/sail artisan migrate:fresh --seed
9. По умолчанию приложение запускается по адресу http://localhost:8080/

Можно сосоздать пседоним для более короткого ввода команд sail, например alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'.
Тогда команда запуска приложения будет sail up -d
