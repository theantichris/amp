<?php

namespace AMP\Domain\Customer;

use AMP\Domain\BaseModel;
use AMP\Domain\Project\Project;
use AMP\Enum\StateAbbreviation;
use Illuminate\Database\Eloquent\Relations\HasMany;
use InvalidArgumentException;

class Customer extends BaseModel
{
    protected $fillable = [
        'account_number',
        'company_name',
        'contact_name',
        'contact_email',
        'contact_phone',
        'address1',
        'address2,',
        'city',
        'state',
        'zip',
        'shipping_account_provider',
        'shipping_account_number',
    ];

    public function getAccountNumber(): string
    {
        return $this->attributes['account_number'];
    }

    public function getCompanyName(): string
    {
        return $this->attributes['company_name'];
    }

    public function getContactName(): string
    {
        return $this->attributes['contact_name'];
    }

    public function getContactEmail(): string
    {
        return $this->attributes['contact_email'];
    }

    public function getContactPhone(): ?string
    {
        return $this->attributes['contact_phone'];
    }

    public function getAddress1(): ?string
    {
        return $this->attributes['address1'];
    }

    public function getAddress2(): ?string
    {
        return $this->attributes['address2'];
    }

    public function getCity(): ?string
    {
        return $this->attributes['city'];
    }

    public function getState(): ?string
    {
        return $this->attributes['state'];
    }

    public function getZip(): ?string
    {
        return $this->attributes['zip'];
    }

    public function getShippingAccountProvider(): ?string
    {
        return $this->attributes['shipping_account_provider'];
    }

    public function getShippingAccountNumber(): ?string
    {
        return $this->attributes['shipping_account_number'];
    }

    /**
     * @return HasMany|Project[]
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
