<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [

        "name" => "sevsdsdfenth",
        "isbn" => "dsdd7",
        "authors" => ["dsgdg", "dafs"],
        "country" => "Nigeria",
        "number_of_pages" => 345,
        "publisher" => "Adedayojs",
        "release_date" => "2009-03-05"

    ];
});
