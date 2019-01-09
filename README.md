# Laravel Auth Boiler plate

## Installation
**First clone the ripo**

1. Install the package via composer:
```shell
composer install
```

2. Run the migration
```shell
php artisan migrate
```

3. Create a admin and user role 
```shell
php artisan permission:create-role user
php artisan permission:create-role admin
```
4. Now create a user with role admin
```shell
  php artisan create:admin
```
