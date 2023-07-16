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

# Publishing config
```
php artisan vendor:publish --provider="Yormy\AnonymizerLaravel\AnonymizerServiceProvider"
```


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
        'middle_name' => [
            'faker' => ['provider' => 'randomElement', 'params' => ['', '','', '', 'van','van der']],
        ],        
    ];
```

## Copy data from another field to anonymize
* set provider to `database`
* specify the field to copy from
* optionally set the prefix that will be used in the anonymized data

```
        'first_name' => [
            'faker' => ['provider' => 'database',
                'params' => [
                    'prefix' => 'user-',
                    'copyField' => 'id'
                ]
            ],
        ],
```

## Password
Password can be set, laravel will take care of the bcrypt hash storage
```
        'password' => [
            'faker' => ['provider' => 'randomElement', 'params' => ['welcome']],
        ],
```

## Nested JSON data
encapsulate the settings within the ```jsonfaker``` 
```
        'receiver_info' => [
            'jsonfaker' => [
                'name' => [
                    'faker' => ['provider' => 'name'],
                ],
                'contact' => [
                    'faker' => ['provider' => 'safeEmail'],
                ]
            ],
        ],
```

# Dry run
you can run the anonymizer without performing actions to give you a clue about what is going to happen.
```
php artisan db:anonymize --pretend
```

### Common faker functions
https://github.com/fzaninotto/Faker

firstName
lastName
userName                // 'wade55'
company

lexify('Hello ???') // 'Hello wgt' useful for fixed data set
bothify('Hello ##??') // 'Hello 42jz'
asciify('Hello ***') // 'Hello R6+'
randomElements($array = array ('a','b','c'), $count = 1) // array('c')
randomElement($array = array ('a','b','c')) // 'b'


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
buildingNumber                      // '484'
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


unixTime($max = 'now')                // 58781813
dateTime($max = 'now', $timezone = null) // DateTime('2008-04-25 08:37:17', 'UTC')
dateTimeAD($max = 'now', $timezone = null) // DateTime('1800-04-29 20:38:49', 'Europe/Paris')
iso8601($max = 'now')                 // '1978-12-09T10:10:29+0000'
date($format = 'Y-m-d', $max = 'now') // '1979-06-09'
time($format = 'H:i:s', $max = 'now') // '20:49:42'
dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null) // DateTime('2003-03-15 02:00:49', 'Africa/Lagos')
dateTimeInInterval($startDate = '-30 years', $interval = '+ 5 days', $timezone = null) // DateTime('2003-03-15 02:00:49', 'Antartica/Vostok')
dateTimeThisCentury($max = 'now', $timezone = null)     // DateTime('1915-05-30 19:28:21', 'UTC')
dateTimeThisDecade($max = 'now', $timezone = null)      // DateTime('2007-05-29 22:30:48', 'Europe/Paris')
dateTimeThisYear($max = 'now', $timezone = null)        // DateTime('2011-02-27 20:52:14', 'Africa/Lagos')
dateTimeThisMonth($max = 'now', $timezone = null)       // DateTime('2011-10-23 13:46:23', 'Antarctica/Vostok')
amPm($max = 'now')                    // 'pm'
dayOfMonth($max = 'now')              // '04'
dayOfWeek($max = 'now')               // 'Friday'
month($max = 'now')                   // '06'
monthName($max = 'now')               // 'January'
year($max = 'now')                    // '1993'
century                               // 'VI'
timezone                              // 'Europe/Paris'


# Optional: specify which records need to be anonymized
if you do not specify which records needs to be anonymized all records will be anonymized when you run the command.
So in the following case when you run anonymizer all records with an id > 10 will be anonymized, records with id 10 or lower will be untouched
The use case is sometimes you want to exclude certain records from being anonymized
```
    public function anonymizable(): Builder
    {
        return static::where('id', '>', 10);
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
