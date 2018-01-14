<?php

namespace AMP\Domain\Project\Material;

use AMP\Domain\BaseModel;
use AMP\Enum\Density;
use AMP\Enum\Weight;
use InvalidArgumentException;

class Material extends BaseModel
{
    protected $fillable = [
        'name',
        'cost',
        'weight_unit',
        'density',
        'density_unit',
    ];

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getCost(): float
    {
        return $this->attributes['cost'];
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
}