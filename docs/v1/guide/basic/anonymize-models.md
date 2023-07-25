# Anonymize your models

## Override your application model
* Override the model you want to anonymize with the same name
* add the 'Anonymizable' trait
```
class User extends \App\User
{
    use Anonymizable;
```

### Use alternative naming
* Override the model you want to anonymize with the different name
* Add the table name
* add the 'Anonymizable' trait
```php
class MyUser extends \App\User
{
    use Anonymizable;
    
    protected $table = 'users'

```

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



## Add anonimizable definition

```php
    protected array $anonymizable = [
        'email' => [
            'faker' => ['provider' => 'safeEmail'],
        ],
        'name' => [
            'faker' => ['provider' => 'name'],
        ],
        'password' => [
            'faker' => ['provider' => 'randomElement', 'params' => ['the-password']],
        ],
    ];
```

# Faker options

## Hardcoded value
```php
    'fieldname' => [
        'faker' => ['provider' => 'hardcoded-value'],
    ],
```

## Random element from set
```php
    'gender' => [
        'faker' => ['provider' => 'randomElement', 'params'=> ['male', 'female', 'other']],
    ],
```

## Date
```php
    'date_of_birth' => [
        'faker' => ['provider' => 'date', 'params' => 'Y-m-d'],
    ],
```

## Email address
```php
    'email' => [
        'faker' => ['provider' => 'safeEmail'],
    ],
```

## Company
```php
    'name' => [
        'faker' => ['provider' => 'company'],
    ],
```

## Names
```php
    'name' => [
        'faker' => ['provider' => 'name'],
    ],
    'first_name' => [
        'faker' => ['provider' => 'firstName'],
    ],
    'last_name' => [
        'faker' => ['provider' => 'lastName'],
    ],
```

## Bank
```php
    'bank_number' => [
        'faker' => ['provider' => 'iban'],
    ],
```

## Phone
```php
    'phone' => [
        'faker' => ['provider' => 'e164PhoneNumber'],
    ],
```

## IP Address
```php
    'ip_address' => [
        'faker' => ['provider' => 'ipv4'],
    ],
```

## Sentence
```php
    'forward_subject' => [
        'faker' => ['provider' => 'sentence'],
    ],
```

## Address
```php
    'postal_code' => [
        'faker' => ['provider' => 'postcode'],
    ],
    'house_number' => [
        'faker' => ['provider' => 'buildingNumber'],
    ],
    'street' => [
        'faker' => ['provider' => 'streetName'],
    ],
    'city' => [
        'faker' => ['provider' => 'city'],
    ],
```

## Advanced: Use fields from record
* set provider to `database`
* specify the field to copy from
* optionally set the prefix that will be used in the anonymized data

Create a username that based on the actual id column of the database 
This will create for user with id =8 and sets the anonymized username to 'user-8'

```php
    'username' => [
        'faker' => ['provider' => 'database',
            'params' => [
                'prefix' => 'user-',
                'copyField' => 'id'
            ]
        ],
    ],
```

## Advanced: Anonymize without having a model

```php
    'withoutModel' => [
        'users' => [
            'primaryKey' => 'id',
            'fields' => [
                'email' => [
                    'faker' => ['provider' => 'safeEmail'],
               ],
                'username' => [
                    'faker' => ['provider' => 'safeEmail'],
                ],
            ]
        ]
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


## More options
check out : https://github.com/fzaninotto/Faker
