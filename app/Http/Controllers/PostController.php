<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Role;
use Auth;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function create(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        dump($user_id);

        $role = Role::where('name', 'admin')->first();

        // dump($role->users);
        foreach ($role->users as $user) {
            echo $user->name . '<br/>';
        }

        foreach ($user->roles as $role) {
            echo $role->name . '<br/>';
        }
        // dump($user->posts);
        // $post = Post::where('id', 2)->first();

        return view('add_post', ['title' => 'Создать запись', 'user_id' => $user_id]);
    }

    public function store(Request $request) {
        dump($request->input());
    }
}
