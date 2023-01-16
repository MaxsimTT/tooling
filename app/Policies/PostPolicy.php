<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function add(User $user) {
        foreach ($user->roles as $role) {
            if ($role->name == 'admin') {
                return true;
            }
        }

        return false;
    }

    public function update(User $user, Post $post) {
        foreach ($user->roles as $role) {
            if ($role->name == 'admin') {
                if ($user->id == $post->user_id) {
                    return true;
                }
            }
        }

        return false;
    }

    // public function before(User $user) {
    //     foreach ($user->roles as $role) {
    //         if ($role->name == 'admin') {
    //             return true;
    //         }
    //     }

    //     return false;
    // }
}
