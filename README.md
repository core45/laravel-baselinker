# Baselinker API integration for Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

## Installation

Install the package with composer:
```bash
composer require core45/laravel-baselinker
```

Optionally ublish the package files:
```
php artisan vendor:publish --provider="Core45\LaravelBaselinker\BaselinkerServiceProvider"
```


The package should be auto-discovered by Laravel.
After installation add `BASELINKER_TOKEN={your-token}` to your `.env` file.

## Usage

Baselinker API is devided into 4 main parts:
- Product catalog
- External storages
- Orders
- Courier shipments
- Products storage [OBSOLETE] - not implemented in this package

To access any of the methods use `Baselinker` facade and use one of the main shortcut methods followed by the API method name.
- Baselinker::catalog()->someMethod('someParameters')
- Baselinker::externalStorage()->...
- Baselinker::order()->...
- Baselinker::shipment()->...

#### Examples:

```php
use Core45\LaravelBaselinker\Facades\Baselinker;

$categories = Baselinker::categories()->getCategories();
```

```php
use Core45\LaravelBaselinker\Facades\Baselinker;

$catalog = Baselinker::catalog();
$result = $catalog->addInventoryPriceGroup('For Spain', 'Price group for Spain', 'EUR');
```

### All of the available methods you can find in Baselinker API docs:

https://api.baselinker.com

If you find any errors or would like to help with improving and maintaining the package please live the comment.
