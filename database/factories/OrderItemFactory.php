<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'product_title' => $faker->text(10),
        'price'         => $faker->numberBetween(10, 100),
        'quantity'      => $faker->numberBetween(1, 5)
    ];
});
