<?php

namespace Yormy\AnonymizerLaravel\Traits;

use Faker\Factory;
use InvalidArgumentException;
use Yormy\AnonymizerLaravel\Events\ModelsAnonymized;

trait Anonimizable
{
    public function anonimizeAll(int $chunkSize = 1000): int
    {
        $total = 0;

        if (method_exists($this, 'anonymizable')) {
            $item = $this->anonymizable();
        } else {
            $item = $this;
        }

        $item->chunkById($chunkSize, function ($models) use (&$total) {
            $models->each->anonymize();

            $total += $models->count();

            event(new ModelsAnonymized(static::class, $total));
        });

        return $total;
    }

    /**
     * Anonymize the model in the database.
     */
    public function anonymize(): bool|null
    {
        $faker = Factory::create(config('anonymizer.faker.locale'));

        foreach ($this->anonimizable as $columnName => $config) {
            $provider = $config['faker']['provider'] ?? null;
            if (! $provider) {
                throw new InvalidArgumentException('The column name must specify how to anonymize the data');
            }
            $params = $config['faker']['params'] ?? null;

            $anonymizedValue = call_user_func([$faker, $provider], $params);

            $this[$columnName] = $anonymizedValue;
        }

        return $this->saveQuietly();
    }
}
