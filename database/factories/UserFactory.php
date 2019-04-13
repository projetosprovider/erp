<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
/*
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
*/

$factory->define(App\Models\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
    ];
});

$factory->define(App\Models\Client\Address::class, function (Faker $faker) {
    return [
        'client_id' => factory('App\Models\Client')->create()->id,

        'description' => $faker->companySuffix,
        'zip' => $faker->postcode,
        'street' => $faker->streetName,

        'number' => $faker->buildingNumber,
        'district' => $faker->stateAbbr,
        'complement' => $faker->streetAddress,
        'reference' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,

        'long' => $faker->longitude($min = -180, $max = 180),
        'building_type' => 'Predio',
        'user_id' => 1,
        'is_default' => true,
        'lat' => $faker->latitude($min = -90, $max = 90) ,
    ];
});
