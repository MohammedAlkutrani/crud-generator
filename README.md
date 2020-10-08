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
![migration](https://user-images.githubusercontent.com/24508555/95490591-b3229880-0998-11eb-9c3f-3664a39918fd.png)
![model](https://user-images.githubusercontent.com/24508555/95490661-d1889400-0998-11eb-994a-ba122ba266d5.png)
![request](https://user-images.githubusercontent.com/24508555/95490815-0bf23100-0999-11eb-9b01-24cb081145c6.png)
![carbon](https://user-images.githubusercontent.com/24508555/95490851-1f9d9780-0999-11eb-9640-aead5198e7b6.png)
![controller](https://user-images.githubusercontent.com/24508555/95490947-42c84700-0999-11eb-8e9e-3e988f424703.png)





## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
