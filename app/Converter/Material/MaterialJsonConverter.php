<?php

namespace AMP\Converter\Material;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Material\Material;
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