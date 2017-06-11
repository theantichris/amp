<?php

namespace AMP\Domain\MachineProfile;

use AMP\Domain\BaseModel;
use AMP\Enum\MachineProfile\TimeCalculationMethod;
use InvalidArgumentException;

class MachineProfile extends BaseModel
{
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
}
