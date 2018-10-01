<?php

use Faker\Generator as Faker;

$factory->define(Oxygencms\Menus\Models\Menu::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->slug(3),
    ];
});
