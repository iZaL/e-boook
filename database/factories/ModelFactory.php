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

$factory->define('App\Src\User\User', function($faker) {
    return [
        'name_en' => 'usama',
        'name_ar' => 'افضل',
        'email' => 'uusa35@gmail.com'.$faker->randomDigit,
        'password' => bcrypt('admin'),
        'bank_number' => $faker->creditCardNumber,
        'bank_name' => $faker->company,
        'remember_token' => str_random(10),
        'active' => 1
    ];
});

$factory->define('App\Src\Book\Book', function($faker) {
    return [
        'user_id' => 1,
        'cover_en' => '',
        'cover_ar' => '',
        'views' => '',
        'category_id' => 1,
        'title_en' => $faker->word,
        'title_ar' => $faker->word,
        'cover_en' => 'book.png',
        'cover_ar' => 'book_ar.jpg',
        'description_ar' => 'تفاصيل الموضوع تفاصيل الموضوع',
        'description_en' => $faker->paragraph(2),
        'body' => $faker->text,
        'status' => 'published',
        'url' => 'test.pdf',
        'free' => 0,
    ];
});

$factory->define('App\Src\Contactus\Contactus', function ($faker) {
    return [
        'company' => $faker->company,
        'mobile' => $faker->phoneNumber,
        'phone'  => $faker->phoneNumber,
        'address' => $faker->address,
        'zipcode' => $faker->phoneNumber,
        'country' => $faker->country,
        'youtube' => $faker->country,
        'instagram' => $faker->country,
        'twitter' => $faker->country,
    ];
});

$factory->define('App\Src\Category\Category', function ($faker) {
    return [
        'name_en' => $faker->name,
        'name_ar' => 'تصنيف'.$faker->phoneNumber,
    ];
});


$factory->define('App\Src\Book\BookMeta', function ($faker) {
    return [
        'book_id' => $faker->numberBetween(1,10),
        'total_pages' => $faker->randomDigit,
        'price' => $faker->randomDigit
    ];
});

$factory->define('App\Src\Role\Role', function ($faker) {
    return [
        'name' => 'Admin'
    ];
});
