<?php

use AMP\Domain\Customer\Customer;
use AMP\Team;
use Carbon\Carbon;
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
            'created_at'     => new Carbon(),
        ]);

        Customer::create([
            'account_number' => '987654321',
            'company_name'   => 'Customer Two',
            'contact_name'   => 'Jane Doe',
            'contact_email'  => 'jane@customertwo.com',
            'team_id'        => $additerra->getQueueableId(),
            'created_at'     => new Carbon(),
        ]);
    }
}
