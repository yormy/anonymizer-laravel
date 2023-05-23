<?php

namespace Yormy\AnonymizerLaravel\Events;

class ModelsAnonymized
{
    /**
     * The class name of the model that was anonymized.
     *
     * @var string
     */
    public $model;

    /**
     * The number of anonymized records.
     *
     * @var int
     */
    public $count;

    /**
     * Create a new event instance.
     *
     * @param  string  $model
     * @param  int  $count
     * @return void
     */
    public function __construct($model, $count)
    {
        $this->model = $model;
        $this->count = $count;
    }
}
