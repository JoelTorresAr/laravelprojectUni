<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Staff;
use Faker\Generator as Faker;

$factory->define(Staff::class, function (Faker $faker) {
    return [
            'subsidiary_id'   => rand(1,5),
            'workposition_id' => rand(1,5),
            'district_id'      => rand(1,15),            
            'address'     => $faker->streetAddress,
            'address2'    => $faker->secondaryAddress,
            'firstname'       => $faker->firstName,
            'firstlastname'   => $faker->lastName,
            'secondlastname'  => $faker->lastName,
            'phone'           => $faker->phoneNumber,
            'email'           => $faker->email
    ];
});
