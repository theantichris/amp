<?php

namespace Domain\Project;

use AMP\Domain\BaseModel;
use AMP\Domain\Customer\Customer;
use AMP\Enum\Project\Status;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function getManager(): string
    {
        return $this->attributes['manager'];
    }

    public function setManager(string $manager): Project
    {
        $this->attributes['manager'] = $manager;

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

    public function customers(): HasOne
    {
        return $this->hasOne(Customer::class);
    }
}