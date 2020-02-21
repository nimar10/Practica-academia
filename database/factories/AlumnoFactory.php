<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Alumno;
use Faker\Generator as Faker;




$factory->define(Alumno::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->firstName($gender= 'male'|'female'),
        'apellidos'=>$faker->lastName,
        'mail'=>$faker->unique()->email
    ];
});
