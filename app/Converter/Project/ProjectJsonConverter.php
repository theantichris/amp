<?php

namespace AMP\Converter\Project;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Customer\Customer;
use AMP\Domain\Project\Project;
use AMP\User;
use Illuminate\Database\Eloquent\Model;

class ProjectJsonConverter implements JsonConverterInterface
{
    public function convert(Model $model, string $json): Model
    {
        /** @var Project $model */

        $data = json_decode($json, true);

        $model->fill($data);

        if ($data['customer']) {
            $customer = Customer::find($data['customer']['id']);
            $model->customer()->associate($customer);
        }

        $manager = User::find($data['manager']['id']);
        $model->manager()->associate($manager);

        return $model;
    }
}