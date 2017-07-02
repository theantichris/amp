<?php

namespace AMP\Domain\Project;

use AMP\Domain\BaseModel;
use AMP\Enum\Density;
use AMP\Enum\Weight;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use InvalidArgumentException;

class Material extends BaseModel
{
    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): Material
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    public function getCost(): float
    {
        return $this->attributes['cost'];
    }

    public function setCost(float $cost): Material
    {
        $this->attributes['cost'] = $cost;

        return $this;
    }

    public function getWeightUnit(): string
    {
        return $this->attributes['weight_unit'];
    }

    public function setWeightUnit(string $weightUnit): Material
    {
        if (!Weight::isValidValue($weightUnit)) {
            throw new InvalidArgumentException($weightUnit . ' is not a valid weight unit.');
        }

        $this->attributes['weight_unit'] = $weightUnit;

        return $this;
    }

    public function getDensity(): float
    {
        return $this->attributes['density'];
    }

    public function setDensity(float $density): Material
    {
        $this->attributes['density'] = $density;

        return $this;
    }

    public function getDensityUnit(): string
    {
        return $this->attributes['density_unit'];
    }

    public function setDensityUnit(string $densityUnit): Material
    {
        if (!Density::isValidValue($densityUnit)) {
            throw new InvalidArgumentException($densityUnit . ' is not a valid density unit.');
        }

        $this->attributes['density_unit'] = $densityUnit;

        return $this;
    }

    public function parts(): BelongsToMany
    {
        return $this->belongsToMany(Part::class);
    }
}