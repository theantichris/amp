<?php

namespace Tests\Acceptance\Material;

use AMP\Domain\Project\Material\Material;
use AMP\Enum\Density;
use AMP\Enum\Weight;
use Illuminate\Http\Response;
use Tests\AcceptanceTest;

class MaterialTest extends AcceptanceTest
{
    private $url = '/api/projects/materials';

    /** @var Material */
    private $material;

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

        $this->material = Material::whereName('Test Material')->first();
    }

    /** @test */
    public function it_gets_list_of_materials()
    {
        $this->actingAs($this->user)
             ->get($this->url)
             ->assertJsonFragment([
                 'name'         => 'Test Material',
                 'cost'         => "25.0",
                 'weight_unit'  => Weight::POUND,
                 'density'      => "10.0",
                 'density_unit' => Density::GRAM_PER_CUBIC_CENTIMETER,
             ])
             ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_gets_a_material_by_id()
    {
        $this->actingAs($this->user)
             ->get($this->url . '/' . $this->material->id)
             ->assertJsonFragment([
                 'name'         => 'Test Material',
                 'cost'         => "25.0",
                 'weight_unit'  => Weight::POUND,
                 'density'      => "10.0",
                 'density_unit' => Density::GRAM_PER_CUBIC_CENTIMETER,
             ])
             ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_creates_a_new_material()
    {
        $data = [
            'name'         => 'New Material',
            'cost'         => 25,
            'weight_unit'  => Weight::POUND,
            'density'      => 10,
            'density_unit' => Density::GRAM_PER_CUBIC_CENTIMETER,
        ];

        $this->actingAs($this->user)
             ->json('POST', $this->url, $data)
             ->assertHeader('Location')
             ->assertStatus(Response::HTTP_CREATED);

        $newMaterial = Material::whereName($data['name'])->first();

        $this->assertNotNull($newMaterial);
    }

    /** @test */
    public function it_updates_an_existing_material()
    {
        $data = [
            'name'         => 'New Material',
            'cost'         => 25,
            'weight_unit'  => Weight::POUND,
            'density'      => 10,
            'density_unit' => Density::GRAM_PER_CUBIC_CENTIMETER,
        ];

        $this->actingAs($this->user)
             ->json('PUT', $this->url . '/' . $this->material->id, $data)
             ->assertStatus(Response::HTTP_NO_CONTENT);

        $material = Material::find($this->material->id);

        $this->assertEquals($data['name'], $material->getName());
        $this->assertEquals($data['cost'], $material->getCost());
        $this->assertEquals($data['weight_unit'], $material->getWeightUnit());
        $this->assertEquals($data['density'], $material->getDensity());
        $this->assertEquals($data['density_unit'], $material->getDensityUnit());
    }
}
