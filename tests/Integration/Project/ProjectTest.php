<?php

namespace Tests\Integration\Project;

use AMP\Domain\Project\Project;
use AMP\Enum\Project\Status;
use Tests\IntegrationTest;

class ProjectTest extends IntegrationTest
{
    /** @var Project */
    private $uut;

    public function setUp()
    {
        parent::setUp();

        factory(Project::class)->create([
            'name'    => 'Test Project',
            'status'  => Status::NEW_PROJECT,
            'team_id' => $this->team->id,
        ]);

        $this->uut = Project::whereName('Test Project')->first();
        $this->uut->manager()->associate($this->user);
    }

    /** @test */
    public function it_sets_name()
    {
        $name = 'New Name';
        $this->uut->update([
            'name' => $name,
        ]);

        $this->assertEquals($name, Project::find($this->uut->id)->name);
    }

    /** @test */
    public function it_sets_status()
    {
        $status = Status::COMPLETE;
        $this->uut->update([
            'status' => $status,
        ]);

        $this->assertEquals($status, Project::find($this->uut->id)->status);
    }
}
