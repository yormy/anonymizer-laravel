<?php

namespace Yormy\AnonymizerLaravel\Actions;

use Illuminate\Support\Facades\DB;
use Yormy\AnonymizerLaravel\Events\ModelsAnonymized;
use Yormy\AnonymizerLaravel\Services\AnonymizeService;

class AnonymizeWithoutModel
{
    public static function exec()
    {
        $withoutModels = (array) config('anonymizer.withoutModel');

        foreach ($withoutModels as $table => $tableConfig) {

            $startTime = microtime(true);

            $primaryKeyName = $tableConfig['primaryKey'];
            $fields = $tableConfig['fields'];
            $primaryKeys = self::getPrimaryKeys($table, $primaryKeyName);

            $updateFields = [];
            foreach ($fields as $field => $faker) {
                $value = AnonymizeService::get($faker);
                $updateFields[] = "$field = '$value'";
            }

            $count = 0;
            foreach ($primaryKeys as $primaryKeyValue) {
                $newFieldValues = implode(',', $updateFields);
                DB::statement("UPDATE $table SET $newFieldValues where $primaryKeyName=$primaryKeyValue");
                $count++;
            }

            $durationInSeconds = round(microtime(true) - $startTime, 0);
            event(new ModelsAnonymized("{$table}", $count, $durationInSeconds));

        }
    }

    private static function getPrimaryKeys(string $table, string $primaryKeyName): array
    {
        $rawIds = DB::select("Select $primaryKeyName as ID from $table");
        $primaryKeys = [];
        foreach ($rawIds as $object) {
            $primaryKeys[] = $object->ID;
        }

        return $primaryKeys;
    }
}
