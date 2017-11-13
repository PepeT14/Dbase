<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Player::class, function(Faker\Generator $faker){
     static $password;

     $pos=array(
         'Portero',
         'Defensa',
         'Medio',
         'Delantero');
     $photos=array(
         'assets/playersAvatar/01.jpeg',
         'assets/playersAvatar/02.jpeg',
         'assets/playersAvatar/03.jpeg',
         'assets/playersAvatar/04.jpeg',
         'assets/playersAvatar/05.jpeg',
         'assets/playersAvatar/06.jpeg'
     );
     return [
         'name' => $faker->name,
         'email' => $faker->unique()->safeEmail,
         'password' => $password ?: $password = bcrypt('dbase'),
         'number' => rand(1,23),
         'photo' => $faker->randomElement($photos),
         'birthday' => $faker->date($format='d-m-Y',$max='now'),
         'position' => $faker->randomElement($pos),
         'team_id' => rand(1,15)
     ];
});