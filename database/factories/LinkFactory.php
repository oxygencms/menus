<?php

use Faker\Generator as Faker;

$factory->define(Oxygencms\Menus\Models\Link::class, function (Faker $faker) {

    $types = [
        ['action', 'PageController@show'],
        ['route', 'page.show'],
        ['url', $faker->url],
    ];

    [$attribute, $value] = array_random($types);

    $data = [
        'text' => [
            'en' => $faker->unique()->words(2, true)
        ],
        $attribute => $value,
    ];

    if ( ! isset($data['url'])) {
        $data['params'] = ['page_slug' => $faker->slug];
    };

//    dd($data);

    return $data;
});