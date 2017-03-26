<?php

namespace AMP\Converter\Customer;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Customer\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerJsonConverter implements JsonConverterInterface
{
    public function convert(Model $customer, string $json): Model
    {
        $data = json_decode($json);

        /** @var Customer $customer */
        $customer->setAccountNumber($data->account_number)
                 ->setCompanyName($data->company_name)
                 ->setContactName($data->contact_name)
                 ->setContactEmail($data->contact_email);

        if (isset($data->contact_phone)) {
            $customer->setContactPhone($data->contact_phone);
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

        if (isset($data->shipping_account_provider)) {
            $customer->setShippingAccountProvider($data->shipping_account_provider);
        }

        if (isset($data->shipping_account_number)) {
            $customer->setShippingAccountNumber($data->shipping_account_number);
        }

        return $customer;
    }
}