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
/** @var  Factory $factory */
$factory->define(App\Models\Customer::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->email,
        'email_verified_at' => $faker->dateTime,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'stripe_id' => $faker->sentence,
        'card_brand' => $faker->sentence,
        'card_last_four' => $faker->sentence,
        'trial_ends_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\AddressCategory::class, static function (Faker\Generator $faker) {
    return [


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Address::class, static function (Faker\Generator $faker) {
    return [
        'address_category_id' => $faker->randomNumber(5),
        'email' => $faker->email,
        'token' => $faker->sentence,
        'info_on_changes' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\MusicStyle::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'slug' => $faker->unique()->slug,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Message::class, static function (Faker\Generator $faker) {
    return [
        'music_style_id' => $faker->randomNumber(5),
        'email' => $faker->email,
        'name' => $faker->firstName,
        'message' => $faker->text(),
        'created_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\News::class, static function (Faker\Generator $faker) {
    return [
        'end_date' => $faker->date(),
        'title' => $faker->sentence,
        'text' => $faker->text(),
        'created_by' => $faker->randomNumber(5),
        'updated_by' => $faker->randomNumber(5),
        'show_item' => $faker->boolean(),
        'is_published' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Menu::class, static function (Faker\Generator $faker) {
    return [
        'parent_id' => $faker->randomNumber(5),
        'menu_item_type_id' => $faker->randomNumber(5),
        'name' => $faker->firstName,
        'icon' => $faker->sentence,
        'fa_icon' => $faker->sentence,
        'url' => $faker->sentence,
        'lft' => $faker->randomNumber(5),
        'rgt' => $faker->randomNumber(5),
        'lvl' => $faker->randomNumber(5),
        'api_enabled' => $faker->boolean(),
        'is_published' => $faker->boolean(),


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\NewsletterStatus::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Newsletter::class, static function (Faker\Generator $faker) {
    return [
        'tag_id' => $faker->randomNumber(5),
        'created_by' => $faker->randomNumber(5),
        'updated_by' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Product::class, static function (Faker\Generator $faker) {
    return [


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Order::class, static function (Faker\Generator $faker) {
    return [


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Product::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->text(),
        'price' => $faker->randomNumber(5),
        'is_published' => $faker->boolean(),
        'is_available' => $faker->boolean(),
        'created_by' => $faker->randomNumber(5),
        'updated_by' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Order::class, static function (Faker\Generator $faker) {
    return [
        'shoppingcart_id' => $faker->sentence,
        'instance' => $faker->sentence,
        'content' => $faker->text(),
        'price_total' => $faker->randomNumber(5),
        'created_by' => $faker->randomNumber(5),
        'updated_by' => $faker->randomNumber(5),
        'delivered' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\AddressCategory::class, static function (Faker\Generator $faker) {
    return [
        'tag_id' => $faker->randomNumber(5),
        'name' => $faker->firstName,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Shipping::class, static function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomNumber(5),
        'postcode' => $faker->sentence,
        'city' => $faker->sentence,
        'street' => $faker->sentence,
        'is_default' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\Country::class, static function (Faker\Generator $faker) {
    return [
        'code' => $faker->sentence,
        'en' => $faker->sentence,
        'de' => $faker->sentence,
        'es' => $faker->sentence,
        'fr' => $faker->sentence,
        'it' => $faker->sentence,
        'ru' => $faker->sentence,


    ];
});
/** @var  Factory $factory */
$factory->define(App\Models\ProductStock::class, static function (Faker\Generator $faker) {
    return [
        'product_id' => $faker->randomNumber(5),
        'product_size_id' => $faker->randomNumber(5),
        'stock' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
