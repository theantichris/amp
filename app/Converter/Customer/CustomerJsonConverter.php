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

        if (isset($data->contactPhone)) {
            $customer->setContactPhone($data->contactPhone);
        }

        if (isset($data->address1)) {
            $customer->setAddress1($data->address1);
        }

        if (isset($data->address2)) {
            $customer->setAddress2($data->address2);
        }

        if (isset($data->city)) {
            $customer->setCity($data->city);
        }

        if (isset($data->state)) {
            $customer->setState($data->state);
        }

        if (isset($data->zip)) {
            $customer->setZip($data->zip);
        }

        if (isset($data->shippingAccountProvider)) {
            $customer->setShippingAccountProvider($data->shippingAccountProvider);
        }

        if (isset($data->shippingAccountNumber)) {
            $customer->setShippingAccountNumber($data->shippingAccountNumber);
        }

        return $customer;
    }
}