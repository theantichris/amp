<?php

namespace AMP\Converter\Project;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Project\Material\Material;
use Illuminate\Database\Eloquent\Model;

class MaterialJsonConverter implements JsonConverterInterface
{
    public function convert(Model $model, string $json): Model
    {
        $data = json_decode($json);

        /** @var Material $model */
        $model->setName($data->name)
              ->setCost($data->cost)
              ->setWeightUnit($data->weight_unit)
              ->setDensity($data->density)
              ->setDensityUnit($data->density_unit);

        return $model;
    }
}