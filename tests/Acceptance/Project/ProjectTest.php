<?php

namespace Tests\Acceptance\Project;

use AMP\Domain\Customer\Customer;
use AMP\Domain\Project\Project;
use AMP\Enum\Project\Status;
use Illuminate\Http\Response;
use Tests\AcceptanceTest;

class ProjectTest extends AcceptanceTest
{
    private $url = '/api/projects';

    /** @var Project */
    private $project;

    /** @var Customer */
    private $customer;

    public function setUp()
    {
        parent::setUp();

        factory(Project::class)->create([
            'name'    => 'Test Project',
            'status'  => Status::NEW_PROJECT,
            'team_id' => $this->team->id,
        ]);

        $this->project = Project::whereName('Test Project')->first();
        $this->project->manager()->associate($this->user);

        factory(Customer::class)->create([
            'account_number' => '123456',
            'company_name'   => 'Test Company',
            'contact_name'   => 'Mister Test',
            'contact_email'  => 'mtest@testcompany.com',
            'team_id'        => $this->team->id,
        ]);

        $this->customer = Customer::whereAccountNumber('123456')->first();
    }

    /** @test */
    public function it_gets_list_of_projects()
    {
        $this->actingAs($this->user)
             ->get($this->url)
             ->assertJsonFragment([
                 'name'   => 'Test Project',
                 'status' => Status::NEW_PROJECT,
             ])
             ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_gets_a_project_by_id()
    {
        $this->actingAs($this->user)
             ->get($this->url . '/' . $this->project->id)
             ->assertJsonFragment([
                 'name'   => 'Test Project',
                 'status' => Status::NEW_PROJECT,
             ])
             ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_creates_a_new_project_with_no_customer()
    {
        $data = [
            'name'    => 'New Project',
            'status'  => Status::NEW_PROJECT,
            'manager' => $this->user,
        ];

        $this->actingAs($this->user)
             ->json('POST', $this->url, $data)
             ->assertHeader('Location')
             ->assertStatus(Response::HTTP_CREATED);

        $newProject = Project::whereName($data['name'])->first();

        $this->assertNotNull($newProject);
    }

    /** @test */
    public function it_creates_a_new_project_with_customer()
    {
        $data = [
            'name'     => 'New Project',
            'status'   => Status::NEW_PROJECT,
            'manager'  => $this->user,
            'customer' => $this->customer,
        ];

        $this->actingAs($this->user)
             ->json('POST', $this->url, $data)
             ->assertHeader('Location')
             ->assertStatus(Response::HTTP_CREATED);

        $newProject = Project::whereName($data['name'])->first();

        $this->assertNotNull($newProject);
    }

    /** @test */
    public function it_updates_an_existing_project_with_no_customer()
    {
        $data = [
            'name'    => 'Updated Project',
            'status'  => Status::NEW_PROJECT,
            'manager' => $this->user,
        ];

        $this->actingAs($this->user)
             ->json('PUT', $this->url . '/' . $this->project->id, $data)
             ->assertStatus(Response::HTTP_NO_CONTENT);

        $project = Project::find($this->project->id);

        $this->assertEquals($data['name'], $project->name);
        $this->assertEquals($data['status'], $project->status);
        $this->assertEquals($this->user->name, $project->manager->name);
    }

    /** @test */
    public function it_updates_an_existing_project_with_customer()
    {
        $data = [
            'name'     => 'Updated Project',
            'status'   => Status::NEW_PROJECT,
            'manager'  => $this->user,
            'customer' => $this->customer,
        ];

        $this->actingAs($this->user)
             ->json('PUT', $this->url . '/' . $this->project->id, $data)
             ->assertStatus(Response::HTTP_NO_CONTENT);

        $project = Project::find($this->project->id);

        $this->assertEquals($data['name'], $project->name);
        $this->assertEquals($data['status'], $project->status);
        $this->assertEquals($this->user->name, $project->manager->name);
        $this->assertEquals($this->customer->company_name, $project->customer->company_name);
    }
}
