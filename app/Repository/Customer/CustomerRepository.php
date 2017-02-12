<?php

namespace AMP\Repository\Customer;

use AMP\Domain\Customer\Customer;
use AMP\Repository\Repository;

class CustomerRepository extends Repository
{
    function model(): string
    {
        return Customer::class;
    }
}