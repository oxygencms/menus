<?php

namespace Oxygencms\Menus\Observers;

use Oxygencms\Menus\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuObserver
{
    /**
     * Handle to the menu "created" event.
     *
     * @param Menu $menu
     * @return void
     */
    public function created(Menu $menu)
    {
        Cache::forget('models.menu');
    }

    /**
     * Handle the menu "updated" event.
     *
     * @param Menu $menu
     * @return void
     */
    public function updated(Menu $menu)
    {
        Cache::forget('models.menu');
    }

    /**
     * Handle the menu "deleted" event.
     *
     * @param Menu $menu
     * @return void
     */
    public function deleted(Menu $menu)
    {
        Cache::forget('models.menu');
    }
}
