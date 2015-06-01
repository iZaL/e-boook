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

$factory->define('App\User', function($faker) {
    return [
        'name' => 'zal',
        'email' => 'z4ls@live.com',
        'password' => bcrypt('admin'),
        'remember_token' => str_random(10),
        'active' => 1
    ];
});

$factory->define('App\Book', function($faker) {
    return [
        'user_id' => 1,
        'cover_en' => '',
        'cover_ar' => '',
        'views' => '',
        'category_id' => 1,
        'title_en' => $faker->word,
        'title_ar' => $faker->word,
        'body' => $faker->text,
        'url' => 'test.pdf',
        'free' => 0,
    ];
});

$factory->define('App\Contactus', function ($faker) {
    return [
        'company' => $faker->company,
        'mobile' => $faker->phoneNumber,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'zipcode' => $faker->phoneNumber,
        'country' => $faker->country,
    ];
});