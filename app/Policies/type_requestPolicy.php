<?php

namespace App\Policies;

use App\User;
use App\type_request;
use Illuminate\Auth\Access\HandlesAuthorization;

class type_requestPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any type_requests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the type_request.
     *
     * @param  \App\User  $user
     * @param  \App\type_request  $typeRequest
     * @return mixed
     */
    public function view(User $user, type_request $typeRequest)
    {
        //
    }

    /**
     * Determine whether the user can create type_requests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->administrator,[1,]) ;
    }

    /**
     * Determine whether the user can update the type_request.
     *
     * @param  \App\User  $user
     * @param  \App\type_request  $typeRequest
     * @return mixed
     */
    public function update(User $user, type_request $typeRequest)
    {
        //
    }

    /**
     * Determine whether the user can delete the type_request.
     *
     * @param  \App\User  $user
     * @param  \App\type_request  $typeRequest
     * @return mixed
     */
    public function delete(User $user, type_request $typeRequest)
    {
        //
    }

    /**
     * Determine whether the user can restore the type_request.
     *
     * @param  \App\User  $user
     * @param  \App\type_request  $typeRequest
     * @return mixed
     */
    public function restore(User $user, type_request $typeRequest)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the type_request.
     *
     * @param  \App\User  $user
     * @param  \App\type_request  $typeRequest
     * @return mixed
     */
    public function forceDelete(User $user, type_request $typeRequest)
    {
        //
    }
}
