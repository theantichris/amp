<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\IntegrationTest;

class AuthenticationTest extends IntegrationTest
{
    use DatabaseMigrations;

    function setUp()
    {
        parent::setUp();

        $this->seed();
    }

    public function test_login()
    {
        $this->visit('/login')
             ->type('chrislamm@additerra.com', 'email')
             ->type('secret', 'password')
             ->press('Login')
             ->seePageIs('/home');
    }
}