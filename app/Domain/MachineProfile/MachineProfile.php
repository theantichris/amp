<?php

namespace AMP\Domain\MachineProfile;

use AMP\Domain\BaseModel;
use AMP\Enum\MachineProfile\TimeCalculationMethod;
use InvalidArgumentException;

class MachineProfile extends BaseModel
{
    protected $fillable = [
        'type',
        'setup_fee',
        'rate',
        'time_calculation_method',
        'build_rate',
    ];

    public function getType(): string
    {
        return $this->attributes['type'];
    }

    public function getSetupFee(): float
    {
        return $this->attributes['setup_fee'];
    }

    public function getRate(): float
    {
        return $this->attributes['rate'];
    }

    public function getTimeCalculationMethod(): string
    {
        return $this->attributes['time_calculation_method'];
    }

    // TODO: Need to enforce rule.

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
}
