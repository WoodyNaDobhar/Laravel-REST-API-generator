[![Codacy Badge](https://api.codacy.com/project/badge/Grade/bdc684fc4dc84708a4cd201ae70499a6)](https://www.codacy.com/app/YanDatsyuk/Laravel-REST-API-generator?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=YanDatsyuk/Laravel-REST-API-generator&amp;utm_campaign=Badge_Grade)
<a href="https://packagist.org/packages/tmphp/rest-api-generators"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>

Laravel REST API Generator
==========================

Code scaffolding for REST API project by database schema. 
This package is available also on [packagist](https://packagist.org/packages/tmphp/rest-api-generators). And installation via packagist is preferred way.

## Examples

There are two open source REST API projects on GitHub, developed using this generator:
* [Social network](https://github.com/YanDatsyuk/social-network-rest-api-backend)
* [Appartment rentals](https://github.com/YanDatsyuk/apartment-rentals-rest-api-backend)

## Installation

### Package installation

* add `"tmphp/rest-api-generators": "dev-master"` to your composer.json (node `"require"`)
* set `"minimum-stability": "dev"` in your composer.json
* run `composer update`

### Configuration

Open your `config/app.php` and add this line in `providers` section
```php
WoodyNaDobhar\Dingo2Generators\GeneratorsServiceProviders::class,
Dingo\Api\Provider\LaravelServiceProvider::class,
Way\Generators\GeneratorsServiceProvider::class,
Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class,
Tymon\JWTAuth\Providers\JWTAuthServiceProvider::class,
L5Swagger\L5SwaggerServiceProvider::class,
Abhijitghogre\LaravelDbClearCommand\LaravelDbClearCommandServiceProvider::class,
Felixkiss\UniqueWithValidator\ServiceProvider::class,
```

### Publishing configuration files

Execute command
```php
php artisan vendor:publish
```

Open your `config/jwt.php` and change line with a user's model namespace.
```php
'user' => 'App\REST\User',
```

### Configurating .env file

- set proper connection to the database
- add configuration for dingo/api package. See [detailed docs here](https://github.com/dingo/api/wiki/Configuration)
- required configuration string is `API_DOMAIN=yourdomain.dev`

### Register middleware

Add middleware to App/Http/Kernel.php to the $routeMiddleware array.

```php
'check.role.access' => \WoodyNaDobhar\Dingo2Generators\Middleware\CheckAccess::class,
```

### Swagger configuration

Add '/routes' path in 'config/l5-swagger.php', annotation path.
```php
'annotations' => [base_path('app'), base_path('routes')],
```

### Database schema

Make sure, that you have created database schema. 
For generating relations you should have FOREIGN KEY Constraints.

# Generating code for REST API project

* Run artisan command for code scaffolding.

```php
php artisan make:rest-api-project
```

* Generate swagger documentation.

```php
php artisan l5-swagger:generate
```

* Execute command

```php
composer dump-autoload
```

* :elephant: :boom: :+1: :+1: