<?php

use AMP\Domain\Customer;
use AMP\Team;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    public function run()
    {
        /** @var Team $additerra */
        $additerra = Team::where('name', '=', 'Additerra, Inc.')->first();

        Customer::create([
            'account_number' => '123456789',
            'company_name'   => 'Customer One',
            'contact_name'   => 'John Doe',
            'contact_email'  => 'john@customerone.com',
            'team_id'        => $additerra->getQueueableId(),
        ]);
    }
}
