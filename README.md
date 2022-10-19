
# LinkedIn all in one for Laravel

## Installation

You can install the package via composer:

```bash
composer require alimehraei/linkedin-v2
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="linkedin-v2-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="linkedin-v2-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="linkedin-v2-views"
```

## Usage

```php
$linkedinAllInOne = new alimehraei\LinkedInAllInOne();
echo $linkedinAllInOne->echoPhrase('Hello, alimehraei!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Ali Mehraei](https://github.com/alimehraei)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
