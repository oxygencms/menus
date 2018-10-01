<?php

namespace Oxygencms\Menus;

use Validator;
use Oxygencms\Core\Rules\ClassExists;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Oxygencms\Menus\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindModelName();

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
            ->namespace($this->namespace)
            ->group(function () {
                Route::resource('menu', 'AdminMenuController', ['except' => 'show']);
                Route::resource('menu.link', 'AdminLinkController', ['except' => ['index', 'show']]);
            });
    }

    /**
     * Bind the {model_name} to retrieve a model instance.
     *
     * @return void
     */
    protected function bindModelName(): void
    {
        Route::bind('model_name', function ($model_name) {

            // todo: fix name spacing issue
            $class = app()->getNamespace() . 'Models\\' . $model_name;

            Validator::make(['class' => $class], [
                'class' => ['required', 'string', new ClassExists()],
            ])->validate();

            return new $class;
        });
    }
}
