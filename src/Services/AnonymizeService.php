<?php

namespace Yormy\AnonymizerLaravel\Services;

use Faker\Factory;
use InvalidArgumentException;

class AnonymizeService
{
    public static function get(array $config): string
    {
        $faker = Factory::create(config('anonymizer.faker.locale'));

        $provider = $config['faker']['provider'] ?? null;
        if (! $provider) {
            throw new InvalidArgumentException('The column name must specify how to anonymize the data');
        }
        $params = $config['faker']['params'] ?? null;

        if ($provider === 'database') {
            $field = $config['faker']['params']['copyField'] ?? null;
            if (!$field) {
                throw new InvalidArgumentException('The field name must specify how to anonymize the data');
            }

            $prefix = $config['faker']['params']['prefix'] ?? '';

            //$anonymizedValue = $prefix. $this[$field];
        } else {
            $anonymizedValue = call_user_func([$faker, $provider], $params);
        }


        return $anonymizedValue;
    }
}
