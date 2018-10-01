<?php

namespace Oxygencms\Menus\Models;

use Oxygencms\Core\Models\Model;
use Oxygencms\Menus\Traits\MenuMutators;
use Spatie\Translatable\HasTranslations;
use Oxygencms\Menus\Interfaces\RouteNamePrefixes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model implements RouteNamePrefixes
{
    use HasTranslations, MenuMutators;

    /**
     * @var array $guarded
     */
    public $guarded = [];

    /**
     * @var array $translatable
     */
    public $translatable = ['title', 'text'];

    /**
     * @var array $casts
     */
    public $casts = [
        'params' => 'array',
        'parent_attrs' => 'array',
        'attrs' => 'array',
    ];

    /**
     * Lists the route name prefixes used for routing.
     * Should have the same order as specified in the routes.
     *
     * @var array
     */
    public $route_name_prefixes = ['menu'];

    /**
     * Get the required parameters for each route name prefix.
     *
     * @return array
     */
    public function getRouteParams(): array
    {
        return [
            $this->menu_id, $this->getRouteKey()
        ];
    }

    /**
     * Get the Menu model that owns this link.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the absolute url for the link.
     *
     * @return string
     */
    public function getAbsoluteUrlAttribute(): string
    {
        if ($this->route) {
            return route($this->route, $this->params);
        }

        if ($this->action) {
            return action($this->action, $this->params ?: []);
        }

        return url($this->url, $this->params);
    }
}
