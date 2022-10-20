require php version > 8.0

How to run

1. Database

1.1. use migrate

    1.1.1. create database on dbms (such as phpmyadmin) name test_add_edit_delete or any name in .env DB_DATABASE

    1.1.2. change database usename password in .env

    1.1.3. run : "php artisan migrate" on git bash or any terminal

1.2. import database from folder DB to dbms by create database name like .env DB_DATABASE

2. Run 

run php artisan serve for watch result

**if keytgen wrong let create new