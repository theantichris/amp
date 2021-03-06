<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(AMP\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\AMP\Domain\Customer\Customer::class, function (Faker\Generator $faker) {
    return [
        'account_number' => $faker->bankAccountNumber,
        'company_name'   => $faker->company,
        'contact_name'   => $faker->name,
        'contact_email'  => $faker->unique()->safeEmail,
    ];
});
