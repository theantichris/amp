<?php

namespace AMP\Converter\MachineProfile;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\MachineProfile;
use Illuminate\Database\Eloquent\Model;

class MachineProfileJsonConverter implements JsonConverterInterface
{
    public function convert(Model $model, string $json): Model
    {
        $data = json_decode($json);

        /** @var MachineProfile $model */
        $model->setType($data->type)
              ->setSetupFee($data->setupFee)
              ->setRate($data->setRate)
              ->setMarkup($data->markup)
              ->setTimeCalculationMethod($data->time_calculation_method)
              ->setBuildRate($data->build_rate);

        return $model;
    }
}