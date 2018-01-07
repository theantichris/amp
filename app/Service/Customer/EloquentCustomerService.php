<?php

namespace AMP\Service\Customer;

use AMP\Domain\Customer\Customer;
use AMP\Team;

class EloquentCustomerService implements CustomerServiceInterface
{
    public function createFromJson(string $json, Team $team): Customer
    {
        /** @var Customer $customer */
        $customer = new Customer();
        $customer->team()->associate($team);

        $data = json_decode($json, true);
        $customer->fill($data)->save();

        return $customer;
    }

    public function updateFromJson(string $json, int $id): Customer
    {
        $customer = Customer::find($id);
        $data     = json_decode($json, true);
        $customer->update($data);

        return $customer;
    }
}