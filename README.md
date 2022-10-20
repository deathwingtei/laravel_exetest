require php version > 8.0

How to run

1. copy .env.example to .env for edit environment (DB)

2. run composer install (Install composer to machine first)

3. Database

3.1. use migrate

    3.1.1. create database on dbms (such as phpmyadmin) name test_add_edit_delete or any name in .env DB_DATABASE

    3.1.2. change database usename password in .env

    3.1.3. run : "php artisan migrate" on git bash or any terminal

3.2. import database from folder DB to dbms by create database name like .env DB_DATABASE

4. Run 

run php artisan serve for watch result

**if keytgen wrong let create new