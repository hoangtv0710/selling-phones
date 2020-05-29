<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function before(User $user)
    {
        if($user->role == 1){
            return true;
        }
    }

    public function view(User $user)
    {
        return $user->role == 2;
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 2;
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->role == 2;
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->role == 2;
    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->role == 2;
    }

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->role == 2;
    }
}
