#!/bin/bash

# Скрипт автоматического создания начальной инфраструктуры 
# для проекта на Symfony2
# Укажите имя пользователя и пароль для базы данных MySQL

AUTHOR=Rottenwood
DBUSER=petr
DBPASS=password

####

case $1 in
'')
    echo -e "Применение:\033[1;33m mysymfony \033[0m[new|link|db|www]"
;;

'link')
    if [ $2 ]; then
        if [ -d /var/www/$2_data ] || [ -d /var/www/$2 ]; then
            echo "Директория с именем '$2' уже существует"
            exit
        fi
        
        echo "Создаю символическую ссылку для апача"
        ln -s /var/www/$2_data/web /var/www/$2
    else
        echo "Введите название директории для доступа из веба: /var/www/DIRNAME"
        echo "mysymfony link DIRNAME"
    fi
;;
'db')
    if [ $2 ]; then
        echo "Создаю новую базу данных"
        echo "create database $2" | mysql -u $DBUSER -p$DBPASS
    else
        echo "Введите название для создания новой БД"
        echo "mysymfony db DATABASENAME"
    fi
;;
'www')
    setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX app/cache app/logs
    setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
;;
'new')
    if [ $2 ]; then

        if [ -d /var/www/$2_data ] || [ -d /var/www/$2 ]; then
            echo "Директория с именем '$2' уже существует"
            exit
        fi

        echo "Создаю новый Symfony проект \"$2\""
        git clone git@github.com:Rottenwood/MySymfony.git /var/www/$2_data
        
        echo "Создание файла конфигурации"
        cp /var/www/$2_data/app/config/parameters.yml.dist  /var/www/$2_data/app/config/parameters.yml
        $0 link $2
        if [ $3 ]; then
            $0 db $3
            DBOFNEWPROJECTNAME=$3
        else
            $0 db $2
            DBOFNEWPROJECTNAME=$2
        fi
        cd /var/www/$2_data

        echo "Обновление композера"
        php composer.phar self-update
        echo "Установка зависимостей"
        php composer.phar install
        
        echo "Выставление прав доступа для апача"
        $0 www
        
        echo "Создание бандла"
        php app/console generate:bundle --namespace=$AUTHOR/${2^}Bundle --dir=$(pwd)/src --format=yml --structure --no-interaction
        
        echo "Удаление лишних файлов и создание нужных"
        rm -rf $(pwd)/.git
        mkdir $(pwd)/src/$AUTHOR/${2^}Bundle/{Entity,Repository,Service}
        cp $(pwd)/app/Resources/views/Default/index.html.twig $(pwd)/src/$AUTHOR/${2^}Bundle/Resources/views/Default/
        cp $(pwd)/app/Resources/views/Default/layout.html.twig $(pwd)/src/$AUTHOR/${2^}Bundle/Resources/views/Default/
        mv mysymfony.sh bin/

        echo "Обновление роутинга"
        sed -i "s/${AUTHOR,,}_$2_homepage/index/g" $(pwd)/src/$AUTHOR/${2^}Bundle/Resources/config/routing.yml
        sed -i "s/\/hello\/{name}/\//g" $(pwd)/src/$AUTHOR/${2^}Bundle/Resources/config/routing.yml
        
        echo "Обновление вида"
        sed -i "s/Default/$AUTHOR${2^}Bundle:Default/g" $(pwd)/src/$AUTHOR/${2^}Bundle/Resources/views/Default/index.html.twig
        
        echo "Обновление контроллера"
        sed -i 's/($name)/()/g' $(pwd)/src/$AUTHOR/${2^}Bundle/Controller/DefaultController.php
        sed -i "s/', array('name' => \$name)/'/g" $(pwd)/src/$AUTHOR/${2^}Bundle/Controller/DefaultController.php
        
        echo "Обновление конфигурационного файла"
        sed -i "s/THISISMYDBNAME/$DBOFNEWPROJECTNAME/g" $(pwd)/app/config/parameters.yml
        sed -i "s/THISISMYDBUSER/$DBUSER/g" $(pwd)/app/config/parameters.yml
        sed -i "s/THISISMYDBPASS/$DBPASS/g" $(pwd)/app/config/parameters.yml
        sed -i "s/THISISMYSECRET/SuperSecretLandOfMetal$RANDOM/g" $(pwd)/app/config/parameters.yml
        
        echo "GITирование проекта"
        git init && git add . && git commit -am "Создание проекта \"$2\""
    else
        echo "Введите название проекта"
        echo "mysymfony new [PROJECTNAME] (DATABASENAME)"
    fi
;;
*)
    echo "Команда не найдена."
    $0
;;
esac
