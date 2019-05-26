<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Post::class, function (Faker $faker) {
    return [
        'link_id' => $faker->unique()->numberBetween(3000000, 4000000),
        'title' => $faker->realText(100),
        'status' => $faker->randomElement(['published', 'queued']),
        'votes' => $faker->numberBetween(0, 10000),
        'karma' => $faker->numberBetween(-10000, 10000),
        'comments' => $faker->numberBetween(0, 10000),
        'order' => $faker->numberBetween(0, 10000),
    ];
});


$factory->state(\App\Models\Post::class, 'published', function ($faker) {
    return [
        'status' => 'published',
    ];
});

$factory->state(\App\Models\Post::class, 'queued', function ($faker) {
    return [
        'status' => 'queued',
    ];
});
