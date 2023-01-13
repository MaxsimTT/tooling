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

        foreach ($role->users as $user) {
            echo $user->name . '<br/>';
        }

        foreach ($user->roles as $role) {
            echo $role->name . '<br/>';
        }

        return view('add_post', ['title' => 'Создать запись', 'user_id' => $user_id]);
    }

    public function store(Request $request) {

        if ($request->isMethod('POST')) {

            $rules = [
                'name'    => 'required|max:10',
                'user_id' => 'required',
                'text'    => 'required',
            ];

            $this->validate($request, $rules/*, $messages*/);

            $data = $request->input();

            $post = new Post;

            $post->name = $data['name'];
            $post->user_id = $data['user_id'];
            $post->description   = $data['text'];

            $post->save();

            return redirect()->route('post_show', ['post' => $post->id]);
        }
    }

    public function show(Request $request, $id) {

        $user_id = Auth::id();
        $post = Post::find($id);r

        return view('view_post', ['title' => 'Пост', 'user_id' => $user_id, 'post_id' => $id, 'post' => $post]);
    }

    public function update(Request $request, $post_id) {
        
        if ($request->isMethod('POST')) {
            
            $data = $request->input();
            $post = Post::find($post_id);
            $post->name = $data['name'];
            $post->description = $data['text'];

            $post->save();

            return redirect()->back();
        }
    }
}
