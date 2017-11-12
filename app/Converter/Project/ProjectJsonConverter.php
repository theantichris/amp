<?php

namespace AMP\Converter\Project;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Project\Project;
use Illuminate\Database\Eloquent\Model;

class ProjectJsonConverter implements JsonConverterInterface
{
    public function convert(Model $model, string $json): Model
    {
        $data = json_decode($json);

        /** @var Project $model */
        $model->setName($data->name)
              ->setStatus($data->status);

        return $model;
    }
}