<?php

namespace Yormy\AnonymizerLaravel\Traits;

use Faker\Factory;
use InvalidArgumentException;
use Yormy\AnonymizerLaravel\Events\ModelsAnonymized;

trait Anonymizable
{
    public function anonymizeAll(int $chunkSize = 1000): int
    {
        $total = 0;
        $startTime = microtime(true);

        if (method_exists($this, 'anonymizable')) {
            $item = $this->anonymizable();
        } else {
            $item = $this;
        }

        $item->chunkById($chunkSize, function ($models) use (&$total, $startTime) {
            $models->each->anonymize();

            $total += $models->count();

            $durationInSeconds = round(microtime(true) - $startTime, 0);
            event(new ModelsAnonymized(static::class, $total, $durationInSeconds));
        });

        return $total;
    }

    /**
     * Anonymize the model in the database.
     */
    public function anonymize(): bool|null
    {
        $faker = Factory::create(config('anonymizer.faker.locale'));

        foreach ($this->anonymizable as $columnName => $config) {
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

                $anonymizedValue = $prefix. $this[$field];
            } else {
                $anonymizedValue = call_user_func([$faker, $provider], $params);
            }


            $this[$columnName] = $anonymizedValue;
        }

        return $this->saveQuietly();
    }
}
