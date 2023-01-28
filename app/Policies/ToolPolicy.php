<?php

namespace App\Policies;

use App\User;
use App\Tool;
use Illuminate\Auth\Access\HandlesAuthorization;

class ToolPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any tools.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the tool.
     *
     * @param  \App\User  $user
     * @param  \App\Tool  $tool
     * @return mixed
     */
    public function view(User $user, Tool $tool)
    {
        //
    }

    /**
     * Determine whether the user can create tools.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->administrator,[1,]) ;
    }

    /**
     * Determine whether the user can update the tool.
     *
     * @param  \App\User  $user
     * @param  \App\Tool  $tool
     * @return mixed
     */
    public function update(User $user, Tool $tool)
    {
        //
        return in_array($user->administrator,[1,]) ;
    }

    /**
     * Determine whether the user can delete the tool.
     *
     * @param  \App\User  $user
     * @param  \App\Tool  $tool
     * @return mixed
     */
    public function delete(User $user, Tool $tool)
    {
        //
    }

    /**
     * Determine whether the user can restore the tool.
     *
     * @param  \App\User  $user
     * @param  \App\Tool  $tool
     * @return mixed
     */
    public function restore(User $user, Tool $tool)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the tool.
     *
     * @param  \App\User  $user
     * @param  \App\Tool  $tool
     * @return mixed
     */
    public function forceDelete(User $user, Tool $tool)
    {
        //
    }
}
