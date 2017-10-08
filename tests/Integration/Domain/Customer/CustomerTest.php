<?php

namespace Tests\Integration\Domain\Customer;

use AMP\Domain\Customer\Customer;
use AMP\Team;
use AMP\User;
use Tests\IntegrationTest;

class CustomerTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();

        factory(User::class)->create();
        factory(Team::class)->create(['owner_id' => User::first()->getQueueableId()]);
    }

    /** @test */
    public function it_fetches_account_number()
    {
        // Given
        factory(Customer::class)->create([
            'team_id' => Team::first()->getQueueableId(),
        ]);

        // When
        $customers = Customer::all();

        // Then
        $this->assertNotNull($customers->first()->getAccountNumber());
    }
}
