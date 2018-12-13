<?php

namespace Oxygencms\Menus\Services;

use Exception;
use Spatie\Menu\Laravel\Link;
use Oxygencms\Menus\Models\Menu;
use Illuminate\Support\Facades\Cache;
use Spatie\Menu\Laravel\Facades\Menu as SpatieMenu;

class MenuLoader
{
    protected $menu;

    protected $models;

    /**
     * @param string $menu_name
     *
     * @return string
     * @throws Exception
     */
    public function render(string $menu_name)
    {
        try {
            $menu = $this->cache()->findOrFail($menu_name)->build()->render();
        } catch (Exception $e) {
//            $menu = "<h1>{$e->getMessage()}</h1>";
            $menu = null;
        }

        return $menu;
    }

    /**
     * Cache the menus and use observers to bust the cache when needed.
     *
     * @return MenuLoader
     */
    protected function cache(): MenuLoader
    {
        $this->models = Cache::rememberForever('models.menu', function () {
            return Menu::with('links')->get();
        });

        return $this;
    }

    /**
     * Find the first menu by name or fail with exception.
     *
     * @param $menu_name
     *
     * @return MenuLoader
     * @throws Exception
     */
    protected function findOrFail($menu_name)
    {
        $this->menu = $this->models->firstWhere('name', $menu_name);

        if ( ! $this->menu) {
            throw new Exception("Menu '$menu_name' does not exist!");
        }

        return $this;
    }

    /**
     * Build the menu from it's links collection (iterates over each link).
     *
     * @return SpatieMenu
     */
    private function build()
    {
        $menu = SpatieMenu::build($this->menu->links, function ($spatie_menu, $link) {
            $spatie_menu->add(
                Link::to($link->absolute_url, $link->text)
                    ->setParentAttributes($link->parent_attrs ?: [])
                    ->setAttributes($link->attrs ?: [])
                    ->addParentClass($link->parent_class ?: '')
                    ->addClass($link->class ?: '')
            );
        });

        return $menu->setAttributes($this->menu->attrs ?: [])
                    ->addClass($this->menu->class)
                    ->setActive(request()->fullUrl());
    }
}