<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Admin::class, function (Faker $faker) {
    $username = $faker->unique()->jobTitle;
    return [
        'staff_id'       => $faker->unique()->numberBetween(1,15),
        'name'           => $username,
        'username'          => Str::slug($username),
        'password'       => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'description'    => $faker->text(120),
        'remember_token' => Str::random(10),
    ];
});
