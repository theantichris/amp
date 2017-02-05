<?php

namespace Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthenticationTest extends \TestCase
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