<?php

namespace Oxygencms\Menus\Policies;

use Oxygencms\Users\Models\User;
use Oxygencms\Core\Policies\BasePolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkPolicy extends BasePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        if ($user->can('see_links') || $user->can('manage_links')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create links.
     *
     * @param  \Oxygencms\Users\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('create_link') || $user->can('manage_links')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the link.
     *
     * @param  \Oxygencms\Users\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        if ($user->can('update_link') || $user->can('manage_links')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the link.
     *
     * @param  \Oxygencms\Users\Models\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        if ($user->can('delete_link') || $user->can('manage_links')) {
            return true;
        }

        return false;
    }
}
