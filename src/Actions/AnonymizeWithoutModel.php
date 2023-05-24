<?php

namespace Yormy\AnonymizerLaravel\Actions;

use Yormy\AnonymizerLaravel\Events\ModelsAnonymized;
use Yormy\AnonymizerLaravel\Services\AnonymizeService;
use Illuminate\Support\Facades\DB;

class AnonymizeWithoutModel
{
    public static function exec()
    {
        $withoutModels = (array)config('anonymizer.withoutModel');

        foreach ($withoutModels as $table => $tableConfig) {

            $startTime = microtime(true);

            $primaryKeyName = $tableConfig['primaryKey'];
            $fields = $tableConfig['fields'];

            // todo, update per record multiple fields
            foreach ($fields as $field => $faker) {

                $rawIds = DB::select("Select $primaryKeyName as ID from $table");
                $primaryKeys = [];
                foreach ($rawIds as $object) {
                    $primaryKeys[] = $object->ID;
                }

                $count = 0;
                foreach ($primaryKeys as $primaryKeyValue) {
                    $value = AnonymizeService::get($faker);
                    DB::statement("UPDATE $table SET $field = '$value' where $primaryKeyName=$primaryKeyValue");
                    $count++;
                }

                $durationInSeconds = round(microtime(true) - $startTime, 0);
                event(new ModelsAnonymized("{$table}", $count, $durationInSeconds));
            }
        }
    }
}
