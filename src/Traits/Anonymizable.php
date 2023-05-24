<?php

namespace Yormy\AnonymizerLaravel\Traits;

use Yormy\AnonymizerLaravel\Events\ModelsAnonymized;
use Yormy\AnonymizerLaravel\Services\AnonymizeService;

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
        foreach ($this->anonymizable as $columnName => $config) {
            $value = AnonymizeService::get($config, $this);
            $this[$columnName] = $value;
        }

        return $this->saveQuietly();
    }
}
