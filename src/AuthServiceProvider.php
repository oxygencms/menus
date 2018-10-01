<?php

namespace Oxygencms\Menus;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Oxygencms\Menus\Models\Menu' => 'Oxygencms\Menus\Policies\MenuPolicy',
        'Oxygencms\Menus\Models\Link' => 'Oxygencms\Menus\Policies\LinkPolicy'
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
