<?php

namespace AMP\Domain;

use AMP\Enum\MachineProfile\TimeCalculationMethod;
use AMP\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;

class MachineProfile extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getCreatedAt(): Carbon
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->attributes['updated_at'];
    }

    public function getDeletedAt(): Carbon
    {
        return $this->attributes['deleted_at'];
    }

    public function getType(): string
    {
        return $this->attributes['type'];
    }

    public function setType(string $type): MachineProfile
    {
        $this->attributes['type'] = $type;

        return $this;
    }

    public function getSetupFee(): float
    {
        return $this->attributes['setup_fee'];
    }

    public function setSetupFee(float $setupFee): MachineProfile
    {
        $this->attributes['setup_fee'] = $setupFee;

        return $this;
    }

    public function getRate(): float
    {
        return $this->attributes['rate'];
    }

    public function setRate(float $rate): MachineProfile
    {
        $this->attributes['rate'] = $rate;

        return $this;
    }

    // TODO: Extract to model. Materials are part of the quote process.
    public function getMaterial(): string
    {
        return $this->attributes['material'];
    }

    public function setMaterial(string $material): MachineProfile
    {
        $this->attributes['material'] = $material;

        return $this;
    }

    public function getMaterialCost(): float
    {
        return $this->attributes['material_cost'];
    }

    public function setMaterialCost(float $materialCost): MachineProfile
    {
        $this->attributes['material_cost'] = $materialCost;

        return $this;
    }

    public function getMarkup(): float
    {
        return $this->attributes['markup'];
    }

    public function setMarkup(float $markup): MachineProfile
    {
        $this->attributes['markup'] = $markup;

        return $this;
    }

    public function getTimeCalculationMethod(): string
    {
        return $this->attributes['time_calculation_method'];
    }

    public function setTimeCalculationMethod(string $timeCalculationMethod): MachineProfile
    {
        if (!TimeCalculationMethod::isValidValue($timeCalculationMethod)) {
            throw new InvalidArgumentException($timeCalculationMethod . ' is not a valid time calculation method.');
        }

        $this->attributes['time_calculation_method'] = $timeCalculationMethod;

        return $this;
    }

    public function getBuildRate(): float
    {
        return $this->attributes['build_rate'];
    }

    public function setBuildRate(float $buildRate): MachineProfile
    {
        $this->attributes['build_rate'] = $buildRate;

        return $this;
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getTeamId(): int
    {
        return $this->attributes['team_id'];
    }
}
