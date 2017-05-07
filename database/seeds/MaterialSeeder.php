<?php

use AMP\Team;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        /** @var Team $additerra */
        /** @noinspection PhpUndefinedMethodInspection */
        $additerra = Team::where('name', '=', 'Additerra, Inc.')->first();

        DB::table('materials')->insert([
            'name'    => 'Material One',
            'cost'    => 1.00,
            'team_id' => $additerra->getQueueableId(),
        ]);

        DB::table('materials')->insert([
            'name'    => 'Material Two',
            'cost'    => 2.00,
            'team_id' => $additerra->getQueueableId(),
        ]);

        DB::table('materials')->insert([
            'name'    => 'Material Three',
            'cost'    => 3.00,
            'team_id' => $additerra->getQueueableId(),
        ]);
    }
}
