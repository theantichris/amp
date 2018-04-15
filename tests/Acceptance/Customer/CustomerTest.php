<?php

namespace Tests\Acceptance\Customer;

use AMP\Domain\Customer\Customer;
use Illuminate\Http\Response;
use Tests\AcceptanceTest;

class CustomerTest extends AcceptanceTest
{
    private $url = '/api/customers';

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
    public function it_gets_list_of_customers()
    {
        $this->actingAs($this->user)
             ->get($this->url)
             ->assertJsonFragment([
                 'account_number' => '123456',
                 'company_name'   => 'Test Company',
                 'contact_name'   => 'Mister Test',
                 'contact_email'  => 'mtest@testcompany.com',
             ])
             ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_gets_a_customer_by_id()
    {
        $this->actingAs($this->user)
             ->get($this->url . '/' . $this->customer->id)
             ->assertJsonFragment([
                 'account_number' => '123456',
                 'company_name'   => 'Test Company',
                 'contact_name'   => 'Mister Test',
                 'contact_email'  => 'mtest@testcompany.com',
             ])
             ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_creates_a_new_customer()
    {
        $data = [
            'account_number' => '654321',
            'company_name'   => 'New Company',
            'contact_name'   => 'Mister New',
            'contact_email'  => 'mnew@newcompany.com',
        ];

        $this->actingAs($this->user)
             ->json('POST', $this->url, $data)
             ->assertHeader('Location')
             ->assertStatus(Response::HTTP_CREATED);

        $newCustomer = Customer::whereAccountNumber($data['account_number'])->first();

        $this->assertNotNull($newCustomer);
    }

    /** @test */
    public function it_updates_an_existing_customer()
    {
        $data = [
            'account_number' => '654321',
            'company_name'   => 'New Company',
            'contact_name'   => 'Mister New',
            'contact_email'  => 'mnew@newcompany.com',
        ];

        $this->actingAs($this->user)
             ->json('PUT', $this->url . '/' . $this->customer->id, $data)
             ->assertStatus(Response::HTTP_NO_CONTENT);

        $customer = Customer::find($this->customer->id);

        $this->assertEquals($data['account_number'], $customer->getAccountNumber());
        $this->assertEquals($data['company_name'], $customer->getCompanyName());
        $this->assertEquals($data['contact_name'], $customer->getContactName());
        $this->assertEquals($data['contact_email'], $customer->getContactEmail());
    }
}
