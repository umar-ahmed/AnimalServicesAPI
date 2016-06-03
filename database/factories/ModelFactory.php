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

$factory->define(App\Dog::class, function (Faker\Generator $faker) {
    return [
        'reference_num' => $faker->randomNumber($nbDigits = 6),
        'name' => $faker->firstName($gender = null),
        'age' => $faker->randomDigit,
        'size' => $faker->randomElement($array = array ('small','medium','large')),
        'gender' => $faker->randomElement($array = array ('male','female')),
        'breed' => $faker->text($maxNbChars = 15),
        'color' => $faker->colorName,
        'declawed' => true,
        'neutered' => true,
        'location' => array('name' => 'City of Toronto Animal Services South Region', 'lat' => '43.6346687', 'long' => '-79.6967789'),
        'intake_date' => $faker->unixTime($max = 'now'),
        'noise_level' => $faker->numberBetween($min = 0, $max = 9),
        'activity_level' => $faker->numberBetween($min = 0, $max = 9),
        'friend_level' => $faker->numberBetween($min = 0, $max = 9),
        'train_level' => $faker->numberBetween($min = 0, $max = 9),
        'health_level' => $faker->numberBetween($min = 0, $max = 9),
        'description' => $faker->text($maxNbChars = 200),
        'excerpt' => $faker->text($maxNbChars = 200),
        'special_needs' => $faker->text($maxNbChars = 200),
    ];
});
