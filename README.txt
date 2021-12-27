1) Установить PHP (версию по ссылке или доступную стабильную, но не выше 8)

Переместить папку php в корневую директорию диска.

Найти в папке php файл php.ini и активировать необходимые модули
extension=gd2

2) Установить composer

Затем запустить cmd, перейти в папку "\tests\desktop" и выполнить composer install.

3) Установить java

После скачать selenium server https://www.selenium.dev/downloads/ и положить его в папку "\PhpstormProjects". Запустить можно через консоль либо просто кликнув 2 раза.

4) Скачать chromedriver

Версия должна соответствовать вашей версии google chrome, после положить его в папку "\PhpstormProjects".

5) Настройка проекта

Открыть cmd, перейти в папку "\tests\desktop\"  и запустить команду "vendor\bin\codecept build"

6) Запуск тестов из консоли осуществляется командой из папки "\tests\desktop\" командой vendor\bin\codecept run --steps --debug "название папки с тестом" "название теста"

