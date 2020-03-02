<?php

namespace Oxygencms\Menus;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * todo: map models and policies from config
     *
     * @var array
     */
    protected $policies = [
        \Oxygencms\Menus\Models\Menu::class => \Oxygencms\Menus\Policies\MenuPolicy::class,
        \Oxygencms\Menus\Models\Link::class => \Oxygencms\Menus\Policies\LinkPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
