<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Goal;
use App\User;
use Faker\Generator as Faker;

$factory->define(Goal::class, function (Faker $faker) {
    return [
        'user_id' => fn () => factory(User::class)->create()->id,
        'title' => $faker->sentence,
        'type' => $faker->word,
        'fulfill_until' => $faker->dateTime,
        'start_at' => $faker->dateTime,
    ];
});
