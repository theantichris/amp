<?php

namespace Tests\Acceptance\User;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\AcceptanceTest;

class UserTest extends AcceptanceTest
{
    private $url = '/api/users';

    public function setUp()
    {
        parent::setUp();
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
             ->get($this->url . '/' . $this->user->id)
             ->assertJsonFragment([
                 'email' => 'chrislamm@additerra.com',
             ])
             ->assertStatus(Response::HTTP_OK);
    }
}
