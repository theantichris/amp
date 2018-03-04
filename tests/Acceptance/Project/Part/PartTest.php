<?php

namespace Tests\Acceptance\Project\Part;

use AMP\Domain\Project\Material\Material;
use AMP\Domain\Project\Part\Part;
use AMP\Domain\Project\Project;
use AMP\Enum\Density;
use AMP\Enum\Project\Status;
use AMP\Enum\Weight;
use Illuminate\Http\Response;
use Tests\AcceptanceTest;

class PartTest extends AcceptanceTest
{
    /** @var string */
    private $url;

    /** @var Material */
    private $material;

    /** @var Part */
    private $part;

    /** @var Project */
    private $project;

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

        factory(Part::class)->create([
            'name'         => 'Test Part',
            'quantity'     => 10,
            'requirements' => 'Just need a few',
            'description'  => 'It does some things',
            'team_id'      => $this->team->id,
            'material_id'  => $this->material->id,
        ]);

        $this->part = Part::whereName('Test Part')->first();

        factory(Project::class)->create([
            'name'    => 'Test Project',
            'status'  => Status::NEW_PROJECT,
            'team_id' => $this->team->id,
        ]);

        $this->project = Project::whereName('Test Project')->first();
        $this->project->manager()->associate($this->user);
        $this->project->parts()->save($this->part);

        $this->url = '/api/projects/' . $this->project->id . '/parts';
    }

    /** @test */
    public function it_gets_list_of_parts()
    {
        $this->actingAs($this->user)
             ->get($this->url)
             ->assertJsonFragment([
                 'name'         => 'Test Part',
                 'quantity'     => '10',
                 'requirements' => 'Just need a few',
                 'description'  => 'It does some things',
             ])
             ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_gets_a_part_by_id()
    {
        $this->actingAs($this->user)
             ->get($this->url . '/' . $this->part->id)
             ->assertJsonFragment([
                 'name'         => 'Test Part',
                 'quantity'     => '10',
                 'requirements' => 'Just need a few',
                 'description'  => 'It does some things',
             ])
             ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_creates_a_new_part()
    {
        $data = [
            'name'         => 'New Part',
            'quantity'     => 10,
            'requirements' => 'Just need a few',
            'description'  => 'It does some things',
            'material'     => [
                'id'           => $this->material->id,
                'name'         => 'Test Material',
                'cost'         => 25,
                'weight_unit'  => Weight::POUND,
                'density'      => 10,
                'density_unit' => Density::GRAM_PER_CUBIC_CENTIMETER,
                'team_id'      => $this->team->id,
            ],
        ];

        $this->actingAs($this->user)
             ->json('POST', $this->url, $data)
             ->assertHeader('Location')
             ->assertStatus(Response::HTTP_CREATED);

        $newPart = Part::whereName($data['name'])->first();

        $this->assertNotNull($newPart);
    }

    /** @test */
    public function it_updates_an_existing_part()
    {
        $data = [
            'name'         => 'New Part',
            'quantity'     => 20,
            'requirements' => 'Just need a few more',
            'description'  => 'It does some things and then some stuff',
        ];

        $this->actingAs($this->user)
             ->json('PUT', $this->url . '/' . $this->part->id, $data)
             ->assertStatus(Response::HTTP_NO_CONTENT);

        $part = Part::find($this->part->id);

        $this->assertEquals($data['name'], $part->name);
        $this->assertEquals($data['quantity'], $part->quantity);
        $this->assertEquals($data['requirements'], $part->requirements);
        $this->assertEquals($data['description'], $part->description);
    }
}
