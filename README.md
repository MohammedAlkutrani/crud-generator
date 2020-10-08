# CRUD Generator
A simple crud generator for Laravel Framework

## Installation
You can install the package via composer:

```bash
composer require ion/crud-generator
```
## Usage
You can create :
- Migration with its columns.
- Model with fillable attributes.
- RequestForm with validation.
- Resource with a transformation layer.
- Api resource routes.
- Controller CRUD.

Via this command
```bash
php artisan make:crud example --f="titile:string, is_visible:boolean"
```
the `id` and `timestaps` will be generated in migraion file by default.

for other types of columns you can find them in 
[Laravel Docs](https://laravel.com/docs/8.x/migrations#creating-columns)

### The Generation Resualt



## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
