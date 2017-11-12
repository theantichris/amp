<?php

use AMP\Team;
use AMP\User;
use Illuminate\Database\Seeder;

class TeamsUsersSeeder extends Seeder
{
    public function run()
    {
        $christopher = User::create([
            'name'           => 'Christopher Lamm',
            'email'          => 'chrislamm@additerra.com',
            'password'       => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        $will = User::create([
            'name'           => 'Will Sames',
            'email'          => 'willsames@additerra.com',
            'password'       => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        $bill = User::create([
            'name'           => 'Bill Sames',
            'email'          => 'bill@@additerra.com',
            'password'       => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        $additerra = Team::create([
            'name'    => 'Additerra, Inc.',
            'owner_id' => $christopher->getQueueableId(),
        ]);

        $additerra->users()->attach($christopher, ['role' => 'owner']);
        $additerra->users()->attach($will, ['role' => 'member']);
        $additerra->users()->attach($bill, ['role' => 'member']);
    }
}
