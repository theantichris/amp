<?php

namespace Tests\Acceptance\MachineProfile;

use AMP\Domain\MachineProfile\MachineProfile;
use Illuminate\Http\Response;
use Tests\AcceptanceTest;

class MachineProfileTest extends AcceptanceTest
{
    private $url = '/api/machine-profiles';

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
    public function it_gets_list_of_machine_profiles()
    {
        $this->actingAs($this->user)
             ->get($this->url)
             ->assertJsonFragment([
                 'type'                    => 'Test Machine',
                 'setup_fee'               => "25.0",
                 'rate'                    => "5.0",
             ])
             ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_gets_a_machine_profile_by_id()
    {
        $this->actingAs($this->user)
             ->get($this->url . '/' . $this->machineProfile->id)
             ->assertJsonFragment([
                 'type'                    => 'Test Machine',
                 'setup_fee'               => "25.0",
                 'rate'                    => "5.0",
                 'time_calculation_method' => 'Volumetric (cc/hr)',
                 'build_rate'              => "10.0",
             ])
             ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_creates_a_new_machineProfile()
    {
        $data = [
            'type'                    => 'New Machine',
            'setup_fee'               => 25,
            'rate'                    => 5,
            'time_calculation_method' => 'Volumetric (cc/hr)',
            'build_rate'              => 10,
        ];

        $this->actingAs($this->user)
             ->json('POST', $this->url, $data)
             ->assertHeader('Location')
             ->assertStatus(Response::HTTP_CREATED);

        $newMachineProfile = MachineProfile::whereType($data['type'])->first();

        $this->assertNotNull($newMachineProfile);
    }

    /** @test */
    public function it_updates_an_existing_machine_profile()
    {
        $data = [
            'type'                    => 'New Machine',
            'setup_fee'               => 25,
            'rate'                    => 5,
            'time_calculation_method' => 'Volumetric (cc/hr)',
            'build_rate'              => 10,
        ];

        $this->actingAs($this->user)
             ->json('PUT', $this->url . '/' . $this->machineProfile->id, $data)
             ->assertStatus(Response::HTTP_NO_CONTENT);

        $machineProfile = MachineProfile::find($this->machineProfile->id);

        $this->assertEquals($data['type'], $machineProfile->getType());
        $this->assertEquals($data['setup_fee'], $machineProfile->getSetupFee());
        $this->assertEquals($data['rate'], $machineProfile->getRate());
        $this->assertEquals($data['time_calculation_method'], $machineProfile->getTimeCalculationMethod());
        $this->assertEquals($data['build_rate'], $machineProfile->getBuildRate());
    }
}
