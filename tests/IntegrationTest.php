<?php

namespace Tests;

use AMP\Team;
use AMP\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class IntegrationTest extends \TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    protected $user;
    protected $team;

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

        $this->team = Team::whereName('Test Company')->first();

        $this->team->users()->attach($this->user->getId(),
            ['role' => 'owner']);
    }
}