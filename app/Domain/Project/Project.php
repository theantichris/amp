<?php

namespace AMP\Domain\Project;

use AMP\Domain\BaseModel;
use AMP\Domain\Customer\Customer;
use AMP\Enum\Project\Status;
use AMP\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use InvalidArgumentException;

class Project extends BaseModel
{
    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): Project
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): Project
    {
        if (!Status::isValidValue($status)) {
            throw new InvalidArgumentException($status . ' is not a valid project status.');
        }

        $this->attributes['status'] = $status;

        return $this;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function getManager(): ?User
    {
        return $this->manager;
    }

    /**
     * @return BelongsTo|Customer
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo|User
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}