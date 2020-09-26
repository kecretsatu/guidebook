How to setup the advanced template in YII2
==========================================

## Step1: Init configuration ##

Open a terminal and go to the YII project folder, then run

    php init

on Linux/Mac or following command on Windows

    init.bat

Choose the development enviornment and finish the steps.

## Step2: Configure the database ##

### Configure the database using phpmyadmin in XAMPP ###

XAMPP is a popular PHP development enviornment and can run on Linux/Mac/Windows. It provides a easy
to install package containing Apache + MariaDB + PHP + Perl. Visit the home page at
https://www.apachefriends.org/index.html for downloads.

To visit phpmyadmin after installation, start the Apache and MySQL server in XAMPP control panel,
and open http://localhost/phpmyadmin/ at the webbrowser. The default root password for MySQL connection
is empty. You can change the password in the phpmyadmin.

### Configure the database using mysql ###

mysql is a command line tool for making connection to the MySQL server and execute MySQL commands. Below
gives basic mysql commands for creating a new database:

Connect to the MySQL server

    mysql -h localhost -P 3306 -u root

Show available database

    MySQL> show databases;

Create new database

    MySQL> create database yii2advanced

### Configure database settings in YII2 ###

After creating database, configure the settings in common/config/main-local.php:

    <?php
    return [
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
            'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                'viewPath' => '@common/mail',
                // send all mails to a file by default. You have to set
                // 'useFileTransport' to false and configure a transport
                // for the mailer to send real emails.
                'useFileTransport' => true,
            ],
        ],
    ];

## Step3: Run Database Migration ##

Run following command to create new country table and populate its data

    php yii migrate

on Linux/Mac or following command on Windows

    yii.bat migrate
