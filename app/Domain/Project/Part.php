<?php

namespace AMP\Domain\Project;

use AMP\Domain\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Part extends BaseModel
{
    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): Part
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): Part
    {
        $this->attributes['quantity'] = $quantity;

        return $this;
    }

    public function getRequirements(): ?string
    {
        return $this->attributes['requirements'];
    }

    public function setRequirements(string $requirements): Part
    {
        $this->attributes['requirements'] = $requirements;

        return $this;
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}