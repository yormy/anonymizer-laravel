<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Allowed Environments
    |--------------------------------------------------------------------------
    |
    | The anonymizer is a critical function that destroys data
    | it should only be allowed to run on test data.
    | Specify the name of the environment where it is allowed
    | Example:
    |    'environments' => [
    |      'local',
    }      'test',
    |    ],
    */
    'environments' => [
        'local',
        'test',
    ],

    /*
    |--------------------------------------------------------------------------
    | Faker locale
    |--------------------------------------------------------------------------
    |
    | The language that is used for faker
    | Example:
    | 'faker' => [
    |    'locale' => 'en_US'
    | ],
    |
    */
    'faker' => [
        'locale' => 'en_US',
    ],

    /*
    |--------------------------------------------------------------------------
    | Truncate
    |--------------------------------------------------------------------------
    |
    | Specify the tables that need/can be truncated
    | Sometimes you do not have control over the models to implement the anonymizer.
    | In that case you can truncate the entire table to get rid of sensitive data
    | This could be log data that is maintained by a package for example
    |
    | Example:
    | 'truncate' => [
    |     'audits'
    |  ],
    |
    */
    'truncate' => [
        'audits',
    ],

    /*
    |--------------------------------------------------------------------------
    | Ignore paths
    |--------------------------------------------------------------------------
    |
    | Paths to ignore searching for models
    | Example:
    |   'ignore' => [
    |       'App\Helpers',
    |       'App\Services'
    |   ],
    |
    */
    'ignore' => [
        'App\Helpers',
        'App\Services',
    ],
];
