<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(AMP\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ? : $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\AMP\Team::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});

$factory->define(\AMP\Domain\Customer\Customer::class, function (Faker\Generator $faker) {
    return [
        'account_number' => $faker->bankAccountNumber,
        'company_name'   => $faker->company,
        'contact_name'   => $faker->name,
        'contact_email'  => $faker->unique()->safeEmail,
    ];
});

$factory->define(\AMP\Domain\MachineProfile\MachineProfile::class, function (Faker\Generator $faker) {
    return [
        'type'                    => $faker->shuffleString(),
        'setup_fee'               => $faker->randomFloat(),
        'rate'                    => $faker->randomFloat(),
        'time_calculation_method' => 'Volumetric (cc/hr)',
        'build_rate'              => $faker->randomFloat(),
    ];
});
