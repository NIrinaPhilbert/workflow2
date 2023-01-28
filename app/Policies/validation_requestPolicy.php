<?php

namespace App\Policies;

use App\User;
use App\validation_request;
use Illuminate\Auth\Access\HandlesAuthorization;

class validation_requestPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any validation_requests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the validation_request.
     *
     * @param  \App\User  $user
     * @param  \App\validation_request  $validationRequest
     * @return mixed
     */
    public function view(User $user, validation_request $validationRequest)
    {
        //
    }

    /**
     * Determine whether the user can create validation_requests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->administrator,[1,]) ;
    }

    /**
     * Determine whether the user can update the validation_request.
     *
     * @param  \App\User  $user
     * @param  \App\validation_request  $validationRequest
     * @return mixed
     */
    public function update(User $user, validation_request $validationRequest)
    {
        //
    }

    /**
     * Determine whether the user can delete the validation_request.
     *
     * @param  \App\User  $user
     * @param  \App\validation_request  $validationRequest
     * @return mixed
     */
    public function delete(User $user, validation_request $validationRequest)
    {
        //
    }

    /**
     * Determine whether the user can restore the validation_request.
     *
     * @param  \App\User  $user
     * @param  \App\validation_request  $validationRequest
     * @return mixed
     */
    public function restore(User $user, validation_request $validationRequest)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the validation_request.
     *
     * @param  \App\User  $user
     * @param  \App\validation_request  $validationRequest
     * @return mixed
     */
    public function forceDelete(User $user, validation_request $validationRequest)
    {
        //
    }
}
