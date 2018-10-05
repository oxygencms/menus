<?php

namespace Oxygencms\Menus;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::middleware(['web', 'admin'])
            ->prefix('admin')
            ->namespace('Oxygencms\Menus\Controllers')
            ->group(function () {
                Route::resource('menu', 'MenuController', ['except' => 'show']);
                Route::resource('menu.link', 'LinkController', ['except' => ['index', 'show']]);
            });
    }
}
