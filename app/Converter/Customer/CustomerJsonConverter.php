<?php

namespace AMP\Converter\Customer;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Customer\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerJsonConverter implements JsonConverterInterface
{
    public function convert(Model $model, string $json): Model
    {
        $data = json_decode($json);

        /** @var Customer $model */
        $model->setAccountNumber($data->account_number)
              ->setCompanyName($data->company_name)
              ->setContactName($data->contact_name)
              ->setContactEmail($data->contact_email);

        if (isset($data->contact_phone)) {
            $model->setContactPhone($data->contact_phone);
        }

        if (isset($data->address1)) {
            $model->setAddress1($data->address1);
        }

        if (isset($data->address2)) {
            $model->setAddress2($data->address2);
        }

        if (isset($data->city)) {
            $model->setCity($data->city);
        }

        if (isset($data->state) && !empty($data->state)) {
            $model->setState($data->state);
        }

        if (isset($data->zip)) {
            $model->setZip($data->zip);
        }

        if (isset($data->shipping_account_provider)) {
            $model->setShippingAccountProvider($data->shipping_account_provider);
        }

        if (isset($data->shipping_account_number)) {
            $model->setShippingAccountNumber($data->shipping_account_number);
        }

        return $model;
    }
}