## Project name
Xebin web app

## Prerequisites
- PHP >=7
- Composer
- Laravel CLI

## Install
Clone this git repository on your computer

After cloning the application, you need to install it's dependencies. Go to root folder.
```
$ composer install
```

## Setup
When you are done with installation, copy the .env.example file to .env
```
$ cp .env.example .env
```

Generate the application key
```
$ php artisan key:generate
```

Generate JWT secret
```
php artisan jwt:secret
```

DATABASE

If use sqlite
Create sqlite file
```
touch database/database.sqlite

or windows: new-item 'database/database.sqlite' -itemtype file
```
If setup on windows enviroment, open php.ini file then set dlls avalable
extension=php_pdo_sqlite.dll

If use Mysql
If setup on windows enviroment, open php.ini file then set dlls avalable
```
extension=php_mbstring.dll
extension=php_mysqli.dll
extension=php_pdo_mysql.dll
```

Migrate the application
```
$ php artisan migrate
``` 

Run the application
```
$ php artisan serve
```

