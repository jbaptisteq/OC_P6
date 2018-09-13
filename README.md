# OpenClassroom - PHP/Symphony Developer
# Project 6 _ Community website SnowTricks

## Link of the Path
 ```
 https://openclassrooms.com/paths/59-developpeur-dapplication-php-symfony
 ```

## Languages used :
  html 5, CSS 3, Javascript, jQuery, PHP, MySQL

## Frameworks :
  symfony 3.4.15

## Getting Started :
   These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## Prerequisites :
   For Windows you need a web development environment, like wampServer.
   Link and installation instructions available here
   ```
   http://www.wampserver.com/en/
   ```

## Installing :
  Download and unzip on your folder choice this repository
  ```
  https://github.com/jbaptisteq/OC_P6/archive/master.zip
  ```

  Execute Composer for Download Requirements
  ```
  php ../composer.phar update
  ```

  Execute First line for checking database creation.
  Execute second line for create database
  ```
  php bin/console doctrine:schema:update  --dump-sql
  php bin/console doctrine:schema:update  --force
  ```

  Adding first data with Fixtures bundle
  ```
  php bin/console doctrine:fixtures:load
  Careful, database will be purged. Do you want to continue Y/N ?y
  ```

  You can also execute phpmyadmin and create a new database, import ocp6_jbq.sql on your database for install with a demo-version dataset.

  Open file app/config/parameters.yml and use your own access
  ```
  # This file is auto-generated during the composer install
  parameters:
      database_host: your host
      database_port: null
      database_name: yourname
      database_user: youruser
      database_password: null or yourpassword
      mailer_transport: smtp
      mailer_host: your host
      mailer_user: email for password recovery send
      mailer_password: yourpassword
      secret: **********
  ```

  You can now open website by running :
  ```
  localhost/your_folder_in_www_folder_from_wamp/web/app_dev.php/
  ```


  This dataset have an admin account for test, you can create others accounts.
  ```
  Administrator
   login : admin
   password : admin
  ```

 ## Built with
 * [ATOM](https://atom.io/) - Code
 * [WAMP](http://www.wampserver.com/en/) - Database management
