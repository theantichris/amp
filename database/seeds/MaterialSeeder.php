<?php

use AMP\Enum\Density;
use AMP\Enum\Weight;
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
            'name'         => 'ABS',
            'cost'         => 25.00,
            'weight_unit'  => Weight::KILOGRAM,
            'density'      => 1.05,
            'density_unit' => Density::GRAM_PER_CUBIC_CENTIMETER,
            'team_id'      => $additerra->getQueueableId(),
        ]);

        DB::table('materials')->insert([
            'name'         => 'Aluminum 6061 Powder',
            'cost'         => 10.00,
            'weight_unit'  => Weight::KILOGRAM,
            'density'      => 2.7,
            'density_unit' => Density::GRAM_PER_CUBIC_CENTIMETER,
            'team_id'      => $additerra->getQueueableId(),
        ]);

        DB::table('materials')->insert([
            'name'         => 'PLA',
            'cost'         => 25.00,
            'weight_unit'  => Weight::KILOGRAM,
            'density'      => 1.25,
            'density_unit' => Density::GRAM_PER_CUBIC_CENTIMETER,
            'team_id'      => $additerra->getQueueableId(),
        ]);
    }
}
