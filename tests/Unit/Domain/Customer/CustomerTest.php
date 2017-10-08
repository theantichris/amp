<?php

namespace Tests\Unit\Domain\Customer;

use AMP\Domain\Customer\Customer;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /** @var  Customer */
    private $uut;

    public function setUp()
    {
        parent::setUp();

        $this->uut = new Customer();
    }

    /** @test */
    public function contact_email_does_not_accept_invalid_email_addresses()
    {
        $emailAddress = 'butts';

        $this->expectException(InvalidArgumentException::class);

        $this->uut->setContactEmail($emailAddress);
    }

    /** @test */
    public function state_does_not_accept_invalid_state_abbreviations()
    {
        $state = 'BV';

        $this->expectException(InvalidArgumentException::class);

        $this->uut->setState($state);
    }
}
