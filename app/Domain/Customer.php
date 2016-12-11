<?php

namespace AMP\Domain;

use AMP\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 *
 * @package AMP\Domain
 */
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

    /**
     * @return BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     *
     * @return Customer
     */
    public function setAccountNumber(string $accountNumber): Customer
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     *
     * @return Customer
     */
    public function setCompanyName(string $companyName): Customer
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactName(): string
    {
        return $this->contactName;
    }

    /**
     * @param string $contactName
     *
     * @return Customer
     */
    public function setContactName(string $contactName): Customer
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactPhone(): string
    {
        return $this->contactPhone;
    }

    /**
     * @param string $contactPhone
     *
     * @return Customer
     */
    public function setContactPhone(string $contactPhone): Customer
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     *
     * @return Customer
     */
    public function setAddress1(string $address1): Customer
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     *
     * @return Customer
     */
    public function setAddress2(string $address2): Customer
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return Customer
     */
    public function setCity(string $city): Customer
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
     * @return Customer
     */
    public function setState(string $state): Customer
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     *
     * @return Customer
     */
    public function setZip(string $zip): Customer
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @return string
     */
    public function getShippingAccountProvider(): string
    {
        return $this->shippingAccountProvider;
    }

    /**
     * @param string $shippingAccountProvider
     *
     * @return Customer
     */
    public function setShippingAccountProvider(string $shippingAccountProvider): Customer
    {
        $this->shippingAccountProvider = $shippingAccountProvider;

        return $this;
    }

    /**
     * @return string
     */
    public function getShippingAccountNumber(): string
    {
        return $this->shippingAccountNumber;
    }

    /**
     * @param string $shippingAccountNumber
     *
     * @return Customer
     */
    public function setShippingAccountNumber(string $shippingAccountNumber): Customer
    {
        $this->shippingAccountNumber = $shippingAccountNumber;

        return $this;
    }

    /**
     * @return Carbon
     */
    public function getDeletedAt(): Carbon
    {
        return $this->deletedAt;
    }

    /**
     * @param Carbon $deletedAt
     *
     * @return Customer
     */
    public function setDeletedAt(Carbon $deletedAt): Customer
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     *
     * @return Customer
     */
    public function setCreatedAt($createdAt): Customer
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     *
     * @return Customer
     */
    public function setUpdatedAt($updatedAt): Customer
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
