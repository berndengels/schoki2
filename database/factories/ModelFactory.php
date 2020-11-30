<?php

/** @var  Factory $factory */

use Illuminate\Database\Eloquent\Factory;

$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'last_login_at' => $faker->dateTime,

    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Category::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'slug' => $faker->unique()->slug,
        'icon' => $faker->sentence,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Theme::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'slug' => $faker->unique()->slug,
        'icon' => $faker->sentence,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Page::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'slug' => $faker->unique()->slug,
        'icon' => $faker->sentence,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Event::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'slug' => $faker->unique()->slug,
        'icon' => $faker->sentence,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\EventPeriodic::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'slug' => $faker->unique()->slug,
        'icon' => $faker->sentence,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\EventTemplate::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'slug' => $faker->unique()->slug,
        'icon' => $faker->sentence,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\EventTemplate::class, static function (Faker\Generator $faker) {
    return [
        'theme_id' => $faker->randomNumber(5),
        'category_id' => $faker->randomNumber(5),
        'created_by' => $faker->randomNumber(5),
        'updated_by' => $faker->randomNumber(5),
        'title' => $faker->sentence,
        'subtitle' => $faker->sentence,
        'description' => $faker->text(),
        'links' => $faker->text(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\EventPeriodic::class, static function (Faker\Generator $faker) {
    return [
        'theme_id' => $faker->randomNumber(5),
        'category_id' => $faker->randomNumber(5),
        'periodic_position' => $faker->sentence,
        'periodic_weekday' => $faker->sentence,
        'created_by' => $faker->randomNumber(5),
        'updated_by' => $faker->randomNumber(5),
        'title' => $faker->sentence,
        'subtitle' => $faker->sentence,
        'description' => $faker->text(),
        'links' => $faker->text(),
        'event_date' => $faker->date(),
        'event_time' => $faker->time(),
        'price' => $faker->randomNumber(5),
        'is_published' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Page::class, static function (Faker\Generator $faker) {
    return [
        'created_by' => $faker->randomNumber(5),
        'updated_by' => $faker->randomNumber(5),
        'title' => $faker->sentence,
        'slug' => $faker->unique()->slug,
        'body' => $faker->text(),
        'is_published' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Event::class, static function (Faker\Generator $faker) {
    return [
        'theme_id' => $faker->randomNumber(5),
        'category_id' => $faker->randomNumber(5),
        'created_by' => $faker->randomNumber(5),
        'updated_by' => $faker->randomNumber(5),
        'title' => $faker->sentence,
        'subtitle' => $faker->sentence,
        'description' => $faker->text(),
        'links' => $faker->text(),
        'event_date' => $faker->date(),
        'event_time' => $faker->time(),
        'price' => $faker->randomNumber(5),
        'is_published' => $faker->boolean(),
        'is_periodic' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Role::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'guard_name' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Permission::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'guard_name' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
