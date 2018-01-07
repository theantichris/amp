<?php

namespace AMP\Http\Resources\Customer;

use AMP\Domain\Customer\Customer;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        /** @var Customer $this */

        return [
            'data' => $this->collection->transform(function (Customer $customer) {
                return [
                    'id'             => $customer->id,
                    'account_number' => $customer->account_number,
                    'company_name'   => $customer->company_name,
                    'contact_name'   => $customer->contact_name,
                    'contact_email'  => $customer->contact_email,
                ];
            }),
        ];
    }
}
