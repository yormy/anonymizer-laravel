<?php

namespace Yormy\AnonymizerLaravel\Actions;

use Yormy\AnonymizerLaravel\Services\AnonymizeService;
use Illuminate\Support\Facades\DB;

class AnonymizeWithoutModel
{
    public static function exec()
    {
        $withoutModels = (array)config('anonymizer.withoutModel');

        foreach ($withoutModels as $table => $tableConfig) {

            $primaryKeyName = $tableConfig['primaryKey'];
            $fields = $tableConfig['fields'];

            // todo, update per record multiple fields
            foreach ($fields as $field => $faker) {

                $rawIds = DB::select("Select $primaryKeyName as ID from $table");
                $primaryKeys = [];
                foreach ($rawIds as $object) {
                    $primaryKeys[] = $object->ID;
                }

                foreach ($primaryKeys as $primaryKeyValue) {
                    $value = AnonymizeService::get($faker);
                    DB::statement("UPDATE $table SET $field = '$value' where $primaryKeyName=$primaryKeyValue");
                }
            }
        }
    }
}
