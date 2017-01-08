<?php

namespace AMP\Repository;

use AMP\Domain\Customer;

class CustomerRepository extends Repository
{
    function model(): string
    {
        return Customer::class;
    }
}