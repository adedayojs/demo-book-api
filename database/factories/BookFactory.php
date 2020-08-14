<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
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

$factory->define(Book::class, function (Faker $faker) {
    return [

        "name" => $faker->name,
        "isbn" => $faker->isbn10,
        "authors" => $faker->rgbColorAsArray,
        "country" => $faker->country,
        "number_of_pages" => $faker->randomNumber(4),
        "publisher" => $faker->name(),
        "release_date" => $faker->date('Y-m-d')
    ];
});
