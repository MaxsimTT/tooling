<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\Post;
use App\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('add-post', MainCotroller@func);
        // Gate::define('add-post', function (User $user) {

        //     foreach ($user->roles as $role) {
        //         if ($role->name == 'admin') {
        //             return true;
        //         }
        //     }

        //     return false;
        // });

        // Gate::define('update-post', function (User $user, $post) {

        //     foreach ($user->roles as $role) {
        //         if ($role->name == 'admin') {
        //             if ($user->id == $post->user_id) {
        //                 return true;
        //             }
        //         }
        //     }

        //     return false;
        // });
    }
}
