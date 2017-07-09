<?php

namespace AMP\Domain\Project;

use AMP\Domain\BaseModel;
use AMP\Enum\Project\Status;
use AMP\Enum\Project\Type;
use AMP\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): Project
    {
        if (!Status::isValidValue($status)) {
            throw new InvalidArgumentException($status . ' is not a valid status.');
        }

        $this->attributes['status'] = $status;

        return $this;
    }

    public function getType(): string
    {
        return $this->attributes['type'];
    }

    public function setType(string $type): Project
    {
        if (!Type::isValidValue($type)) {
            throw new InvalidArgumentException($type . ' is not a valid type.');
        }

        $this->attributes['type'] = $type;

        return $this;
    }

    public function getDueDate(): ?Carbon
    {
        return $this->attributes['due_date'];
    }

    public function setDueDate(Carbon $dueDate): Project
    {
        $this->attributes['due_date'] = $dueDate;

        return $this;
    }

    public function parts(): HasMany
    {
        return $this->hasMany(Part::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function projectManager(): HasOne
    {
        return $this->hasOne(User::class);
    }
}