<?php

namespace AMP\Converter\Project;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Project\Part;
use Illuminate\Database\Eloquent\Model;

class PartJsonConverter implements JsonConverterInterface
{
    public function convert(Model $model, string $json): Model
    {
        $data = json_decode($json);

        /** @var Part $model */
        $model->setName($data->name)
              ->setQuantity($data->quantity)
              ->setRequirements($data->requirements);

        $model->material()->associate($data->material);

        return $model;
    }
}