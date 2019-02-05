<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the modelsPolicy.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $modelsPolicy
     * @return mixed
     */
    public function view(User $user, Comment $modelsPolicy)
    {
        //
    }

    /**
     * Determine whether the user can create modelsPolicies.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the modelsPolicy.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment   $modelsPolicy
     * @return mixed
     */
    public function update(User $user, Comment $modelsPolicy)
    {
        //
        return $user->id == $modelsPolicy->usre_id;
    }

    /**
     * Determine whether the user can delete the modelsPolicy.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment   $modelsPolicy
     * @return mixed
     */
    public function delete(User $user, Comment $modelsPolicy)
    {

        return $user->id===$modelsPolicy->user_id;
    }
}
