<?php

use AMP\Domain\Customer\Customer;
use AMP\Team;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    public function run()
    {
        /** @var Team $additerra */
        /** @noinspection PhpUndefinedMethodInspection */
        $additerra = Team::where('name', '=', 'Additerra, Inc.')->first();

        /** @var Customer $customer */
        factory(Customer::class, 10)->create(['team_id' => $additerra->getQueueableId()])->each(function ($customer) {

        });
    }
}
