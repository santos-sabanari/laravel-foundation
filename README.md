# Laravel Foundation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/santos-sabanari/laravel-foundation.svg?style=flat-square)](https://packagist.org/packages/santos-sabanari/laravel-foundation)
[![Build Status](https://img.shields.io/travis/santos-sabanari/laravel-foundation/master.svg?style=flat-square)](https://travis-ci.org/santos-sabanari/laravel-foundation)
[![Quality Score](https://img.shields.io/scrutinizer/g/santos-sabanari/laravel-foundation.svg?style=flat-square)](https://scrutinizer-ci.com/g/santos-sabanari/laravel-foundation)
[![Total Downloads](https://img.shields.io/packagist/dt/santos-sabanari/laravel-foundation.svg?style=flat-square)](https://packagist.org/packages/santos-sabanari/laravel-foundation)

A minimalist admin panel using coreui.

## Installation

First, you have to install laravel fortify

```bash
composer require laravel/fortify

php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
``` 

Install laravel permission by spatie
```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Install laravel datatable package
```bash
composer require santos-sabanari/laravel-datatables
```

Install the package via composer:

```bash
composer require santos-sabanari/laravel-foundation
```

Publish package files

```bash
php artisan laravel-foundation:install
```

Add this code to boot function in FortifyServiceProvider.

``` php
// Load class
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Http\Requests\LoginRequest;
use SantosSabanari\LaravelFoundation\Events\UserLoggedIn;

// boot function
Fortify::createUsersUsing(CreateNewUser::class);
Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

Fortify::loginView(function () {
    return view('laravel-foundation::auth.login');
});

Fortify::authenticateUsing(function (LoginRequest $request) {
    $user = User::where('email', $request->username)->first();
    if (! $user) {
        $user = User::where('username', $request->username)->first();
    }

    if ($user &&
        Hash::check($request->password, $user->password)) {
        event(new UserLoggedIn($user));

        return $user;
    }
});
```

change to this code array in config/fortify.php

``` php
'username' => 'username',
``` 

Add this code to "Package Service Providers" in config/app.php

``` php
SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider::class,
SantosSabanari\LaravelDatatables\LaravelDatatablesServiceProvider::class,
App\Providers\FortifyServiceProvider::class,
```

Add this code to $middlewareGroups in Http/Kernel.php

``` php
'admin' => [
    'auth',
    'is_admin',
],
```

Add this code to $routeMiddleware in Http/Kernel.php
 
``` php
'is_admin' => \SantosSabanari\LaravelFoundation\Http\Middleware\AdminCheck::class,
'is_super_admin' => \SantosSabanari\LaravelFoundation\Http\Middleware\SuperAdminCheck::class,
'is_user' => \SantosSabanari\LaravelFoundation\Http\Middleware\UserCheck::class,
'type' => \SantosSabanari\LaravelFoundation\Http\Middleware\UserTypeCheck::class,
'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
```

Add this code to App/Provider/EventServiceProvider

``` php
protected $subscribe = [
    RoleEventListener::class,
    UserEventListener::class,
];
```

Finaly, migrate the database

```bash
php artisan migrate
```

### Usage

To create master, use this command
```bash
php artisan laravel-foundation:master master field1 field2 field3
```

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email sabanari.santos@gmail.com instead of using the issue tracker.

## Credits

- [Santos Sabanari](https://github.com/santos-sabanari)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
