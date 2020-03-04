Тестовое задание "Камень, ножницы, бумага"
============



Перед запуском тестов, нужно выполнить следующие шаги в корне проекта:
-------------
Требуются установленные пакеты: ``` docker docker-compose ```

1. ``` docker volume create --name=rock_paper_scissors-composer ```
2. ``` docker-compose run --rm rock_paper_scissors-php /bin/bash -c "composer install" ```

Запуск unit тестов:
-------------
``` docker-compose run --rm rock_paper_scissors-php /bin/bash -c "./vendor/bin/phpunit --testdox tests" ```

Запуск игры через консоль
-------------
``` docker-compose run --rm rock_paper_scissors-php /bin/bash -c "./bin/console game:run-game" ```

Шаги без запуска docker контейнера:
-------------
Требуемая версия php 7.4
1. В корне проекта выполнить ``` composer install ```
2. Запустить unit тесты``` ./vendor/bin/phpunit --testdox tests ```
3. Запуск консольного скрипта ``` ./bin/console game:run-game ```
