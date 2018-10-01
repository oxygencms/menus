<?php

namespace Oxygencms\Menus\Models;

use Oxygencms\Core\Models\Model;
use Oxygencms\Menus\Traits\MenuMutators;

class Menu extends Model
{
    use MenuMutators;

    /**
     * @var array $guarded
     */
    public $guarded = [];

    /**
     * @var array $casts
     */
    public $casts = ['attrs' => 'array'];

    public $appends = ['model_name'];

    /**
     * Links of the menu.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
