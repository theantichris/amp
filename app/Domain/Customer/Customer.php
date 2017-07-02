<?php

namespace AMP\Domain\Customer;

use AMP\Domain\BaseModel;
use AMP\Enum\StateAbbreviation;
use InvalidArgumentException;

class Customer extends BaseModel
{
    public function getAccountNumber(): string
    {
        return $this->attributes['account_number'];
    }

    public function setAccountNumber(string $accountNumber): Customer
    {
        $this->attributes['account_number'] = $accountNumber;

        return $this;
    }

    public function getCompanyName(): string
    {
        return $this->attributes['company_name'];
    }

    public function setCompanyName(string $companyName): Customer
    {
        $this->attributes['company_name'] = $companyName;

        return $this;
    }

    public function getContactName(): string
    {
        return $this->attributes['contact_name'];
    }

    public function setContactName(string $contactName): Customer
    {
        $this->attributes['contact_name'] = $contactName;

        return $this;
    }

    public function getContactEmail(): string
    {
        return $this->attributes['contact_email'];
    }

    public function setContactEmail(string $contactEmail): Customer
    {
        if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException($contactEmail . ' is not a valid email address.');
        }

        $this->attributes['contact_email'] = $contactEmail;

        return $this;
    }

    public function getContactPhone(): ?string
    {
        return $this->attributes['contact_phone'];
    }

    public function setContactPhone(string $contactPhone): Customer
    {
        $this->attributes['contact_phone'] = $contactPhone;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->attributes['address1'];
    }

    public function setAddress1(string $address1): Customer
    {
        $this->attributes['address1'] = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->attributes['address2'];
    }

    public function setAddress2(string $address2): Customer
    {
        $this->attributes['address2'] = $address2;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->attributes['city'];
    }

    public function setCity(string $city): Customer
    {
        $this->attributes['city'] = $city;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->attributes['state'];
    }

    public function setState(string $state): Customer
    {
        if (!StateAbbreviation::isValidValue($state)) {
            throw new InvalidArgumentException($state . ' is not a valid state.');
        }

        $this->attributes['state'] = $state;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->attributes['zip'];
    }

    public function setZip(string $zip): Customer
    {
        $this->attributes['zip'] = $zip;

        return $this;
    }

    public function getShippingAccountProvider(): ?string
    {
        return $this->attributes['shipping_account_provider'];
    }

    public function setShippingAccountProvider(string $shippingAccountProvider): Customer
    {
        $this->attributes['shipping_account_provider'] = $shippingAccountProvider;

        return $this;
    }

    public function getShippingAccountNumber(): ?string
    {
        return $this->attributes['shipping_account_number'];
    }

    public function setShippingAccountNumber(string $shippingAccountNumber): Customer
    {
        $this->attributes['shipping_account_number'] = $shippingAccountNumber;

        return $this;
    }
}
