<?php

namespace Oxygencms\Menus\Observers;

use Oxygencms\Menus\Models\Link;
use Illuminate\Support\Facades\Cache;

class LinkObserver
{
    /**
     * Handle to the link "created" event.
     *
     * @param Link $link
     * @return void
     */
    public function created(Link $link)
    {
        Cache::forget('models.menu');
    }

    /**
     * Handle the link "updated" event.
     *
     * @param Link $link
     * @return void
     */
    public function updated(Link $link)
    {
        Cache::forget('models.menu');
    }

    /**
     * Handle the link "deleted" event.
     *
     * @param Link $link
     * @return void
     */
    public function deleted(Link $link)
    {
        Cache::forget('models.menu');
    }
}
