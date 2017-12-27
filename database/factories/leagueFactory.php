<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\League::class, function (Faker\Generator $faker) {

    $state = $faker->randomElement(['Andalucía','Murcia']);
    if($state == 'Andalucía')
        $province = $faker->randomElement(['Cádiz','Sevilla']);
    else
        $province = 'Murcia';
    return [
        'name' =>$faker->name,
        'state' => $state,
        'province' => $province,
        'category' => $faker->randomElement('Pre-Benjamin','Benjamin','Alevin','Infantil','Cadete','Juvenil')
    ];
});