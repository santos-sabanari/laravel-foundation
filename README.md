
![](https://banners.beyondco.de/Laravel%20Foundation.png?theme=light&packageManager=composer+require&packageName=santos-sabanari%2Flaravel-foundation&pattern=texture&style=style_1&description=A+minimalist+admin+panel+using+coreui&md=1&showWatermark=0&fontSize=100px&images=code)

## Installation

Install the package via composer:

```bash
composer require santos-sabanari/laravel-foundation
php artisan laravel-foundation:install
```

Change to this code array in config/fortify.php

``` php
'username' => 'username',
``` 

Add this code to in Http/Kernel.php

``` php
// $middlewareGroups
'admin' => [
    'auth',
    'is_admin',
],

// $routeMiddleware
'is_admin' => \SantosSabanari\LaravelFoundation\Http\Middleware\AdminCheck::class,
'is_super_admin' => \SantosSabanari\LaravelFoundation\Http\Middleware\SuperAdminCheck::class,
'is_user' => \SantosSabanari\LaravelFoundation\Http\Middleware\UserCheck::class,
'type' => \SantosSabanari\LaravelFoundation\Http\Middleware\UserTypeCheck::class,
'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
```

Add this code to App/Provider/EventServiceProvider

``` php
// load class
use SantosSabanari\LaravelFoundation\Listeners\RoleEventListener;
use SantosSabanari\LaravelFoundation\Listeners\UserEventListener;

// below $listen
protected $subscribe = [
    RoleEventListener::class,
    UserEventListener::class,
];
```

Finaly, migrate the database

```bash
php artisan migrate
```

Don't forget to set schedule for backup server (app\Console\Kernel.php -> on 'schedule' function)

```php
$schedule->command('backup:run')->daily()->at('02:00');
```

Set cron job for running every minute

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```


### Usage
To publish package
```bash
php artisan vendor:publish --provider=SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider --tag=config
php artisan vendor:publish --provider=SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider --tag=public
php artisan vendor:publish --provider=SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider --tag=views
php artisan vendor:publish --provider=SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider --tag=database
```

To update published assets (delete old resources/views/vendor, public/vendor, and then copy the new one)
```bash
php artisan laravel-foundation:update
```

To create & delete master, use this command
```bash
php artisan laravel-foundation:master title-of-master field_1 field_2 field_3
php artisan laravel-foundation:delete-master title-of-master
```

To create & delete table (without controller, livewire, and view), use this command
```bash
php artisan laravel-foundation:table title-of-table field_1 field_2 field_3
php artisan laravel-foundation:delete-table title-of-table
```

To create & delete report (without model, migration), use this command
```bash
php artisan laravel-foundation:report title-of-report
php artisan laravel-foundation:delete-report title-of-report
```

## Require Package
The require packages below has automatically installed when installing laravel foundation.
1. [Laravel Fortify](https://github.com/laravel/fortify)
2. [Log Viewer](https://github.com/ARCANEDEV/LogViewer/blob/master/_docs/1.Installation-and-Setup.md) by Arcanedev
3. [Laravel Activitylog](https://spatie.be/docs/laravel-activitylog) by Spatie
4. [Laravel Permission](https://spatie.be/docs/laravel-permission) by Spatie

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email sabanari.santos@gmail.com instead of using the issue tracker.

## Credits

- [Santos Sabanari](https://github.com/santos-sabanari)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
