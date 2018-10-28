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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role_id' => $faker->numberBetween(1,3),
    ];
});

$factory->define(App\Post::class,function(\Faker\Generator $faker){
    return [
        'category_id' => $faker->numberBetween(1,10),
        'photo_id' => 1,
        'title' => $faker->sentence(7,11),
        'body' => $faker->paragraphs(rand(10,15),true),
        'slug' => $faker->slug()
    ];
});

$factory->define(App\Role::class,function(\Faker\Generator $faker){
    return [
        'name' => $faker->randomElement(['administrator','subscriber','author'])
    ];
});

$factory->define(App\Category::class,function(\Faker\Generator $faker){
    return [
        'name' => $faker->randomElement(['Php','Laravel','Java','Javascript'])
    ];
});

$factory->define(App\Photo::class,function(\Faker\Generator $faker){
    return [
        'file'  => 'placeholder.jpg'
    ];
});

$factory->define(\App\Comment::class,function(\Faker\Generator $faker){
    return [
        'post_id' => $faker->numberBetween(1,5),
        'is_active' => 1,
        'author' => $faker->name,
        'email' => $faker->safeEmail,
        'photo' => 'placeholder.jpg',
        'body' => $faker->paragraphs(1,true)
    ];
});

$factory->define(App\Reply::class,function(\Faker\Generator $faker){
    return [
        'is_active' => 1,
        'author' => $faker->name,
        'email' => $faker->safeEmail,
        'body' => $faker->paragraphs(1,true),
        'photo' => 'placeholder.jpg'
    ];
});