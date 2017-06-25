<?php

namespace AMP\Domain\Project;

use AMP\Domain\BaseModel;
use AMP\Enum\Density;
use AMP\Enum\Weight;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use InvalidArgumentException;

/**
 * AMP\Domain\Project\Material
 *
 * @property int                                                                      $id
 * @property string                                                                   $name
 * @property float                                                                    $cost
 * @property string                                                                   $weight_unit
 * @property float                                                                    $density
 * @property string                                                                   $density_unit
 * @property int                                                                      $team_id
 * @property \Carbon\Carbon|null                                                      $deleted_at
 * @property \Carbon\Carbon|null                                                      $created_at
 * @property \Carbon\Carbon|null                                                      $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\AMP\Domain\Project\Part[] $parts
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Material whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Material whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Material whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Material whereDensity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Material whereDensityUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Material whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Material whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Material whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Material whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Material whereWeightUnit($value)
 * @mixin \Eloquent
 */
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