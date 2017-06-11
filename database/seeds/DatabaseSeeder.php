<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(TeamsUsersSeeder::class);
        $this->call(CustomersSeeder::class);
        $this->call(MaterialSeeder::class);
    }
}
