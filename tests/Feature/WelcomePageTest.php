<?php

namespace Feature;

use TestCase;

class WelcomePageTest extends TestCase
{
    public function test_welcome_page()
    {
        $this->visit('/')
             ->see('Login')
             ->see('Register');
    }

    public function test_register_link()
    {
        $this->visit('/')
             ->click('Register')
             ->seePageIs('/register');
    }

    public function test_login_link()
    {
        $this->visit('/')
             ->click('Login')
             ->seePageIs('/login');
    }
}