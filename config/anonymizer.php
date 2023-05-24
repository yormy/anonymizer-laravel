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
    | Scan path
    |--------------------------------------------------------------------------
    |
    | The following path will be scanned for anonymizable models
    | All models somewhere in that path that use the Anonymizable trait will be processed
    |
    */
    'scan_path' => 'Console/Commands',

    /*
    |--------------------------------------------------------------------------
    | Without Model
    |--------------------------------------------------------------------------
    |
    | When we have no access to the model we can still anonymize the data in the following way
    | We need to specify the table and its primary key.
    | then in the rest of the config it is the same settings as if it were a model
    | however the copy from fields is not available on a 'Without Model Anonymizer
    |
    | 'withoutModel' => [
    |     'customers' => [
    |         'primaryKey' => 'id',
    |         'fields' => [
    |             'email' => [
    |                 'faker' => ['provider' => 'safeEmail'],
    |            ],
    |             'username' => [
    |                 'faker' => ['provider' => 'safeEmail'],
    |             ],
    |         ]
    |     ]
    | ],
    |
    */
    'withoutModel' => [
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
