<?php

namespace AMP\Http\Resources\Customer;

use AMP\Domain\Customer\Customer;
use Illuminate\Http\Resources\Json\Resource;

class CustomerResource extends Resource
{
    public function toArray($request)
    {
        /** @var Customer $this */

        return [
            'id'                        => $this->id,
            'account_number'            => $this->account_number,
            'company_name'              => $this->company_name,
            'contact_name'              => $this->contact_name,
            'contact_email'             => $this->contact_email,
            'contact_phone'             => $this->contact_phone,
            'address1'                  => $this->address1,
            'address2'                  => $this->address2,
            'city'                      => $this->city,
            'state'                     => $this->state,
            'zip'                       => $this->zip,
            'shipping_account_provider' => $this->shipping_account_provider,
            'shipping_account_number'   => $this->shipping_account_number,
            'created_at'                => $this->created_at->toDateTimeString(),
            'deleted_at'                => $this->deleted_at ? $this->deleted_at->toDateTimeString() : null,
            'updated_at'                => $this->updated_at->toDateTimeString(),
            'team_id'                   => $this->team_id,
        ];
    }
}