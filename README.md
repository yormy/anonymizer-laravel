# Anonymizer Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/yormy/anonymizer-laravel.svg?style=flat-square)](https://packagist.org/packages/yormy/anonymizer-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/yormy/anonymizer-laravel.svg?style=flat-square)](https://packagist.org/packages/yormy/anonymizer-laravel)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/facade/ignition/run-php-tests?label=Tests)
![Alt text](./coverage.svg)

# Goal
This package allows you to anonymize your database easily. This allows people to work with the data without exposing sensitive information.
Especially useful for when developers have to work with production data. In that case simply run the anonymizer and developers have all the data they need without the sensitive parts

# Setup
```
composer require yormy/anonymizer-laravel
```

#temp composer

        {
            "type": "path",
            "url": "./packages/anonymizer-laravel"
        }

    "require": {
        "yormy/anonymizer-laravel" : "dev-main",


# Models
Update the models you want to be able to anonymize

## Add trait
```
use Yormy\AnonymizerLaravel\Traits\Anonimizable;

Class Example 
{
    ...
    use Anonimizable;
    
```

## Add anonymizer fields
and specify how they shoul be anonymized
```
    protected $anonimizable = [
        'email' => [
            'faker' => ['provider' => 'safeEmail'],
        ],
    ];
```

### Common faker functions
firstName
lastName
userName                // 'wade55'
company

locale        // en_UK
countryCode   // UK
languageCode  // en
currencyCode  // EUR

safeEmail
ipv4                   // '109.133.32.252'
userAgent              // 'Mozilla/5.0 (Windows CE) AppleWebKit/5350 (KHTML, like Gecko) Chrome/13.0.888.0 Safari/5350'

uuid                   // '7e57d004-2b97-0e7a-b45f-5387367791cd'
e164PhoneNumber     // '+27113456789'

city                                // 'West Judge'
streetName                          // 'Keegan Trail'
streetAddress                       // '439 Karley Loaf Suite 897'
postcode                            // '17916'
address                             // '8888 Cummings Vista Apt. 101, Susanbury, NY 95473'
country                             // 'Falkland Islands (Malvinas)'

iban($countryCode)      // 'IT31A8497112740YZ575DJ28BP4'
swiftBicNumber          // 'RZTIAT22263'

// Image generation provided by LoremPixel (http://lorempixel.com/)
imageUrl($width = 640, $height = 480) // 'http://lorempixel.com/640/480/'
imageUrl($width, $height, 'cats')     // 'http://lorempixel.com/800/600/cats/'
imageUrl($width, $height, 'cats', true, 'Faker') // 'http://lorempixel.com/800/400/cats/Faker'
imageUrl($width, $height, 'cats', true, 'Faker', true) // 'http://lorempixel.com/gray/800/400/cats/Faker/' Monochrome image
image($dir = '/tmp', $width = 640, $height = 480) // '/tmp/13b73edae8443990be1aa8f1a483bc27.jpg'
image($dir, $width, $height, 'cats')  // 'tmp/13b73edae8443990be1aa8f1a483bc27.jpg' it's a cat!
image($dir, $width, $height, 'cats', false) // '13b73edae8443990be1aa8f1a483bc27.jpg' it's a filename without path
image($dir, $width, $height, 'cats', true, false) // it's a no randomize images (default: `true`)
image($dir, $width, $height, 'cats', true, true, 'Faker') // 'tmp/13b73edae8443990be1aa8f1a483bc27.jpg' it's a cat with 'Faker' text. Default, `null`.


# Optional: specify which records need to be anonymized
if you do not specify which records needs to be anonymized all records will be anonymized
```
    public function anonymizable(): Builder
    {
        return static::where('created_at', '>', now()->subMonth());
    }
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Yormy](https://gitlab.com/yormy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
