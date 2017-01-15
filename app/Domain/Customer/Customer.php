<?php

namespace AMP\Domain\Customer;

use AMP\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $contactName;

    /**
     * @var string
     */
    private $contactPhone;

    /**
     * @var string
     */
    private $address1;

    /**
     * @var string
     */
    private $address2;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $shippingAccountProvider;

    /**
     * @var string
     */
    private $shippingAccountNumber;

    /**
     * @var Carbon
     */
    private $createdAt;

    /**
     * @var Carbon
     */
    private $updatedAt;

    /**
     * @var Carbon
     */
    private $deletedAt;

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    public function setAccountNumber(string $accountNumber): Customer
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): Customer
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getContactName(): string
    {
        return $this->contactName;
    }

    public function setContactName(string $contactName): Customer
    {
        $this->contactName = $contactName;

        return $this;
    }

    public function getContactPhone(): string
    {
        return $this->contactPhone;
    }

    public function setContactPhone(string $contactPhone): Customer
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    public function getAddress1(): string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): Customer
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): string
    {
        return $this->address2;
    }

    public function setAddress2(string $address2): Customer
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): Customer
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): Customer
    {
        $this->state = $state;

        return $this;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): Customer
    {
        $this->zip = $zip;

        return $this;
    }

    public function getShippingAccountProvider(): string
    {
        return $this->shippingAccountProvider;
    }

    public function setShippingAccountProvider(string $shippingAccountProvider): Customer
    {
        $this->shippingAccountProvider = $shippingAccountProvider;

        return $this;
    }

    public function getShippingAccountNumber(): string
    {
        return $this->shippingAccountNumber;
    }

    public function setShippingAccountNumber(string $shippingAccountNumber): Customer
    {
        $this->shippingAccountNumber = $shippingAccountNumber;

        return $this;
    }

    public function getDeletedAt(): Carbon
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(Carbon $deletedAt): Customer
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): Customer
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt): Customer
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
