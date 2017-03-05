<?php

namespace AMP\Converter\Customer;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Customer\Customer;
use AMP\Team;
use Illuminate\Database\Eloquent\Model;

class CustomerJsonConverter implements JsonConverterInterface
{
    public function convert(string $json, Team $team): Model
    {
        $data = json_decode($json);

        $customer = new Customer();
        $customer->setAccountNumber($data->accountNumber)
                 ->setCompanyName($data->companyName)
                 ->setContactName($data->contactName)
                 ->setContactEmail($data->contactEmail)
                 ->team()->associate($team);

        return $customer;
    }
}