<?php

use Illuminate\Database\Seeder;
use Oxygencms\Menus\Models\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [                                      # Valid JSON format: '{"foo":{},"bar":true,"baz":"string"}'
            [                                   # Menu
                'name' => 'main-navigation',            # menu model name
                'attrs' => ['role' => 'navigation'],    # ul - attributes - json string / array
                'class' => 'nav navbar-nav navbar-right',                # ul - class - string
                'children_class' => '',         # ul > li - class - string
                'links' => [                    # Children
                    [                               # Link
                        'route' => 'home',              # route.name - name of an existing route
                        'url' => null,                  # http:://url.to - valid URL
                        'action' => null,               # Controller@action - callable method on controller class
                        'params' => null,               #  - json string / array
                        'text' => ['en' => ''],     # a - text (translatable)
                        #'title' => ['en' => 'home'],    # a - title (translatable)
                        'class' => 'fa fa-home',          # a - class - string
                        'attrs' => null,                # a - attributes - json string / array
                        'parent_attrs' => null,         # li - attrs (parent) - json string / array
                        'parent_class' => null,         # li - class (parent) - string
                    ],
                    [
                        'text' => ['en' => 'Help'],
                        'url' => url('help'),
                    ],
                ],
            ],

            [   # Footer menu
                'name' => 'footer',
                'attrs' => ['role' => 'navigation'],
                'class' => 'navbar-nav',
                'children_class' => 'nav-item',
                'links' => [
                    [
                        'text' => ['en' => 'About us',],
                        'action' => 'page.show',
                        'params' => ['page_slug' => 'about-us'],
                        'class' => 'nav-link',
                    ],

                    [
                        'text' => ['en' => 'Contacts',],
                        'action' => 'PageController@show',
                        'params' => ['page_slug' => 'contact-us'],
                        'class' => 'nav-link',
                    ],
                ],
            ],
        ];

        // create the menus and their links
        foreach ($menus as $menu) {
            Menu::create(array_except($menu, 'links'))
                ->links()->createMany($menu['links']);
        }

        // seed some test menus with links
        if (env('DB_TEST_DATA')) {
            factory(Menu::class, 23)->create()->each(function ($menu) {
                $menu->links()->saveMany(factory('Oxygencms\Menus\Models\Link', 3)->make());
            });
        }
    }
}
