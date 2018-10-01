<?php

namespace Oxygencms\Menus;

use Oxygencms\Menus\Models\Link;
use Oxygencms\Menus\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Oxygencms\Menus\Services\MenuLoader;
use Oxygencms\Menus\Observers\LinkObserver;
use Oxygencms\Menus\Observers\MenuObserver;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'oxygencms');

        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/oxygencms'),
        ], 'views');

        Menu::observe(MenuObserver::class);

        Link::observe(LinkObserver::class);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/../database/factories');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('menus', MenuLoader::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }
}
