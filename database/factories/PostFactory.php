<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => 2,
        'category_id' => 16,
        'title' => $faker->name,
        'description' => $faker->text,
    ];
});
