<?php

namespace Tests\Integration\Project\Part;

use AMP\Domain\Project\Part\Part;
use Tests\IntegrationTest;

class PartTest extends IntegrationTest
{
    /** @var Part */
    private $uut;

    public function setUp()
    {
        parent::setUp();

        factory(Part::class)->create([
            'name'         => 'Test Part',
            'quantity'     => 10,
            'requirements' => 'Just need a few',
            'description'  => 'It does some things',
            'team_id'      => $this->team->id,
        ]);

        $this->uut = Part::whereName('Test Part')->first();
    }

    /** @test */
    public function it_sets_name()
    {
        $name = 'New Name';
        $this->uut->update([
            'name' => $name,
        ]);

        $this->assertEquals($name, Part::find($this->uut->id)->name);
    }

    /** @test */
    public function it_sets_quantity()
    {
        $quantity = 20;
        $this->uut->update([
            'quantity' => $quantity,
        ]);

        $this->assertEquals($quantity, Part::find($this->uut->id)->quantity);
    }

    /** @test */
    public function it_sets_requirements()
    {
        $requirements = 'New requirements';
        $this->uut->update([
            'requirements' => $requirements,
        ]);

        $this->assertEquals($requirements, Part::find($this->uut->id)->requirements);
    }

    /** @test */
    public function it_sets_description()
    {
        $description = 'New description';
        $this->uut->update([
            'description' => $description,
        ]);

        $this->assertEquals($description, Part::find($this->uut->id)->description);
    }
}
