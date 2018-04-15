<?php

namespace Tests\Integration\MachineProfile;

use AMP\Domain\MachineProfile\MachineProfile;
use AMP\Enum\MachineProfile\TimeCalculationMethod;
use InvalidArgumentException;
use Tests\IntegrationTest;

class MachineProfileTest extends IntegrationTest
{
    /** @var MachineProfile */
    private $machineProfile;

    public function setUp()
    {
        parent::setUp();

        factory(MachineProfile::class)->create([
            'type'                    => 'Test Machine',
            'setup_fee'               => 25,
            'rate'                    => 5,
            'time_calculation_method' => 'Volumetric (cc/hr)',
            'build_rate'              => 10,
            'team_id'                 => $this->team->id,
        ]);

        $this->machineProfile = MachineProfile::whereType('Test Machine')->first();
    }

    /** @test */
    public function it_sets_type()
    {
        $type = 'New Type';
        $this->machineProfile->update([
            'type' => $type,
        ]);

        $this->assertEquals($type, MachineProfile::find($this->machineProfile->id)->getType());
    }

    /** @test */
    public function it_sets_setup_fee()
    {
        $setupFee = 25;
        $this->machineProfile->update([
            'setup_fee' => $setupFee,
        ]);

        $this->assertEquals($setupFee, MachineProfile::find($this->machineProfile->id)->getSetupFee());
    }

    /** @test */
    public function it_sets_rate()
    {
        $rate = 25;
        $this->machineProfile->update([
            'rate' => $rate,
        ]);

        $this->assertEquals($rate, MachineProfile::find($this->machineProfile->id)->getRate());
    }

    /** @test */
    public function it_sets_time_calculation_method()
    {
        $method = TimeCalculationMethod::VOLUMETRIC;
        $this->machineProfile->setTimeCalculationMethod($method);

        $this->assertEquals($method, MachineProfile::find($this->machineProfile->id)->getTimeCalculationMethod());
    }

    /** @test */
    public function it_rejects_invalid_time_calculation_method()
    {
        $method = 'Butts';
        $this->expectException(InvalidArgumentException::class);
        $this->machineProfile->setTimeCalculationMethod($method);
    }

    /** @test */
    public function it_sets_build_rate()
    {
        $buildRate = 25;
        $this->machineProfile->update([
            'build_rate' => $buildRate,
        ]);

        $this->assertEquals($buildRate, MachineProfile::find($this->machineProfile->id)->getBuildRate());
    }
}
