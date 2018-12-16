<?php

use Faker\Generator as Faker;
use App\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(15),
        'body' => $faker->paragraphs(3, true),
        'user_id' => $faker->numberBetween(1, 50)
    ];
});
