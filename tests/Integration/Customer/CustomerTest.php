<?php

namespace Tests\Integration\Customer;

use AMP\Domain\Customer\Customer;
use Tests\IntegrationTest;

class CustomerTest extends IntegrationTest
{
    private $customer;

    public function setUp()
    {
        parent::setUp();

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
    public function it_sets_contact_phone()
    {
        $contactPhone = '555-555-5555';
        $this->customer->update([
            'contact_phone' => $contactPhone,
        ]);

        $this->assertEquals($contactPhone, Customer::find($this->customer->id)->getContactPhone());
    }

    /** @test */
    public function it_sets_address1()
    {
        $address1 = '123 Road St';
        $this->customer->update([
            'address1' => $address1,
        ]);

        $this->assertEquals($address1, Customer::find($this->customer->id)->getAddress1());
    }

    /** @test */
    public function it_sets_address2()
    {
        $address2 = 'Suite 100';
        $this->customer->update([
            'address2' => $address2,
        ]);

        $this->assertEquals($address2, Customer::find($this->customer->id)->getAddress2());
    }

    /** @test */
    public function it_sets_city()
    {
        $city = 'Knoxville';
        $this->customer->update([
            'city' => $city,
        ]);

        $this->assertEquals($city, Customer::find($this->customer->id)->getCity());
    }

    /** @test */
    public function it_sets_state()
    {
        $state = 'TN';
        $this->customer->update([
            'state' => $state,
        ]);

        $this->assertEquals($state, Customer::find($this->customer->id)->getState());
    }

    /** @test */
    public function it_sets_zip()
    {
        $zip = '37918';
        $this->customer->update([
            'zip' => $zip,
        ]);

        $this->assertEquals($zip, Customer::find($this->customer->id)->getZip());
    }

    /** @test */
    public function it_sets_shipping_account_provider()
    {
        $shippingAccountProvider = 'UPS';
        $this->customer->update([
            'shipping_account_provider' => $shippingAccountProvider,
        ]);

        $this->assertEquals($shippingAccountProvider, Customer::find($this->customer->id)->getShippingAccountProvider());
    }

    /** @test */
    public function it_sets_shipping_account_number()
    {
        $shippingAccountNumber = 'abc123';
        $this->customer->update([
            'shipping_account_number' => $shippingAccountNumber,
        ]);

        $this->assertEquals($shippingAccountNumber, Customer::find($this->customer->id)->getShippingAccountNumber());
    }
}
