<?php

namespace Tests\Acceptance\User;

use AMP\Team;
use AMP\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\AcceptanceTest;

class UserTest extends AcceptanceTest
{
    use WithoutMiddleware;

    private $url = '/api/users';

    private $user;

    public function setUp()
    {
        parent::setUp();

        factory(User::class)->create([
            'name'  => 'Christopher Lamm',
            'email' => 'chrislamm@additerra.com',
        ]);

        $this->user = User::whereEmail('chrislamm@additerra.com')->first();

        factory(Team::class)->create([
            'name'     => 'Test Company',
            'owner_id' => $this->user->getId(),
        ]);

        $team = Team::whereName('Test Company')->first();

        $team->users()->attach($this->user->getId(),
            ['role' => 'owner']);
    }

    /** @test */
    public function it_gets_list_of_users()
    {
        $this->actingAs($this->user)
             ->get($this->url)
             ->assertJsonFragment([
                 'email' => 'chrislamm@additerra.com',
             ])
             ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_gets_a_users_details_by_id()
    {
        $this->actingAs($this->user)
             ->get($this->url . '/' . $this->user->getQueueableId())
             ->assertJsonFragment([
                 'email' => 'chrislamm@additerra.com',
             ])
             ->assertStatus(Response::HTTP_OK);
    }
}
