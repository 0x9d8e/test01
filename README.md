# test01
Выполненное тестовое задание

**Задание**

Нужно собирать данные рейтинга с кинопоиска, схоранять оригинальное название фильма, рейтинг, год, позицию и количество проголосовавших. При этом нужно сохранять и дату для выборки топ-10 за указанную дату.

Кроме того нужно создать страницу, на которой выводить топ-10 фильмов за указанную дату. При выборке данных и СУБД нужно использовать кеширующий слой. 

**Что мне не нравится**

*   Структура проекта не соответствует PSR; 
*   Не использовался composer (даже для установки сторонней библиотеки);
*   Данные подключения к mysql захардкожены;
*   Кеш не оптимален (но легко заменяем);
*   Прктически нет никаких проверок, исключений и их обработки;

Перед запуском необходимо поправить данные подключения к mysql (см Core/Db.php) и запустить migrate.php (рассчитан на запуск из под консоли). Он создаст в базе данных нужные таблицы. 
Кроме того нужно настроить http-сервер на каталог web. 

Данные в бд обновляются с помощью kinopoisk_update.php.
Страница с топ-10 фильмов выводится с web/index.php.  