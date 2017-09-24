<?php

namespace Tests\Unit\Domain\MachineProfile;

use AMP\Domain\MachineProfile\MachineProfile;
use AMP\Enum\MachineProfile\TimeCalculationMethod;
use InvalidArgumentException;

class MachineProfileTest extends \TestCase
{
    /** @var  MachineProfile */
    private $uut;

    public function setUp()
    {
        $this->uut = new MachineProfile();
    }

    /** @test */
    public function has_type()
    {
        $type = 'Machine A';

        $this->uut->setType($type);

        $this->assertEquals($type, $this->uut->getType());
    }

    /** @test */
    public function has_setup_fee()
    {
        $setupFee = 150;

        $this->uut->setSetupFee($setupFee);

        $this->assertEquals($setupFee, $this->uut->getSetupFee());
    }

    /** @test */
    public function has_rate()
    {
        $rate = 150;

        $this->uut->setRate($rate);

        $this->assertEquals($rate, $this->uut->getRate());
    }

    /** @test */
    public function has_time_calculation_method()
    {
        $timeCalculationMethod = TimeCalculationMethod::VOLUMETRIC;

        $this->uut->setTimeCalculationMethod($timeCalculationMethod);

        $this->assertEquals($timeCalculationMethod, $this->uut->getTimeCalculationMethod());
    }

    /** @test */
    public function rejects_invalid_time_calculation_method()
    {
        $timeCalculationMethod = 'Butts';

        $this->expectException(InvalidArgumentException::class);

        $this->uut->setTimeCalculationMethod($timeCalculationMethod);
    }

    /** @test */
    public function has_build_rate()
    {
        $buildRate = 150;

        $this->uut->setBuildRate($buildRate);

        $this->assertEquals($buildRate, $this->uut->getBuildRate());
    }
}
