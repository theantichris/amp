<?php

namespace Tests\Integration\Material;

use AMP\Domain\Project\Material\Material;
use AMP\Enum\Density;
use AMP\Enum\Weight;
use InvalidArgumentException;
use Tests\IntegrationTest;

class MaterialTest extends IntegrationTest
{
    /** @var Material */
    private $uut;

    public function setUp()
    {
        parent::setUp();

        factory(Material::class)->create([
            'name'         => 'Test Material',
            'cost'         => 25,
            'weight_unit'  => Weight::POUND,
            'density'      => 10,
            'density_unit' => Density::GRAM_PER_CUBIC_CENTIMETER,
            'team_id'      => $this->team->id,
        ]);

        $this->uut = Material::whereName('Test Material')->first();
    }

    /** @test */
    public function it_sets_name()
    {
        $name = 'New Name';
        $this->uut->update([
            'name' => $name,
        ]);

        $this->assertEquals($name, Material::find($this->uut->id)->getName());
    }

    /** @test */
    public function it_sets_cost()
    {
        $cost = 25;
        $this->uut->update([
            'cost' => $cost,
        ]);

        $this->assertEquals($cost, Material::find($this->uut->id)->getCost());
    }

    /** @test */
    public function it_sets_weight_unit()
    {
        $weightUnit = Weight::POUND;
        $this->uut->update([
            'weight_unit' => $weightUnit,
        ]);

        $this->assertEquals($weightUnit, Material::find($this->uut->id)->getWeightUnit());
    }

    /** @test */
    public function it_rejects_invalid_weight_unit()
    {
        $weightUnit = 'Butts';
        $this->expectException(InvalidArgumentException::class);
        $this->uut->setWeightUnit($weightUnit);
    }

    /** @test */
    public function it_set_density()
    {
        $density = 25;
        $this->uut->update([
            'density' => $density,
        ]);

        $this->assertEquals($density, Material::find($this->uut->id)->getDensity());
    }

    /** @test */
    public function it_sets_density_unit()
    {
        $densityUnit = Density::GRAM_PER_CUBIC_CENTIMETER;
        $this->uut->setDensityUnit($densityUnit);

        $this->assertEquals($densityUnit, $this->uut->getDensityUnit());
    }

    /** @test */
    public function it_rejects_invalid_density_unit()
    {
        $densityUnit = 'Butts';
        $this->expectException(InvalidArgumentException::class);
        $this->uut->setDensityUnit($densityUnit);
    }
}
