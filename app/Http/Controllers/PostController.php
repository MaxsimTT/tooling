<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Auth\Access\Gate as G;
use App\Models\User;
use App\Models\Post;
use App\Models\Role;
use Gate;
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
        // echo '<pre>';
        // print_r(get_class_methods(G::class));
        // echo '</pre>';

        $user_id = Auth::id();
        $user = User::find($user_id);
        dump($user_id);

        foreach ($user->roles as $role) {
            echo $role->name . "<br/>";
        }

        return view('add_post', ['title' => 'Создать запись', 'user_id' => $user_id]);
    }

    public function store(Request $request) {

        if ($request->isMethod('POST')) {

            $user = Auth::user();
            $post = new Post;

            try {
                $this->authorizeForUser($user, 'add', $post);
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

                return redirect()->route('post_show', ['post' => $post->id])->with(['message' => 'Added post']);
            } catch (\HttpException $e) {
                return redirect()->back()->withErrors(['message' => 'You don\'t have permissions']);
            }

            // if (Gate::denies('add', $post)) {
            //     return redirect()->back()->withErrors(['message' => 'You don\'t have permissions']);
            // }

            // if ($request->user()->cannot('add', $post)) {
            //     return redirect()->back()->withErrors(['message' => 'You don\'t have permissions']);
            // }

            // $rules = [
            //     'name'    => 'required|max:10',
            //     'user_id' => 'required',
            //     'text'    => 'required',
            // ];

            // $this->validate($request, $rules/*, $messages*/);

            // $data = $request->input();

            // $post = new Post;

            // $post->name = $data['name'];
            // $post->user_id = $data['user_id'];
            // $post->description   = $data['text'];

            // $post->save();

            // return redirect()->route('post_show', ['post' => $post->id])->with(['message' => 'Added post']);
        }
    }

    public function show(Request $request, $id) {

        $user_id = Auth::id();
        $post = Post::find($id);

        // dump($post->user->roles);
        foreach ($post->user->roles as $role) {
            echo $role->name;
        }

        return view('view_post', ['title' => 'Пост', 'user_id' => $user_id, 'post_id' => $id, 'post' => $post, 'message' => 'Full permissions']);
    }

    public function update(Request $request, $post_id) {
        
        if ($request->isMethod('POST')) {
            
            $data = $request->input();
            $post = Post::find($post_id);
            // $user = User::find(2);

            // if (Gate::/*forUser($user)->*/allows('update', $post)) {
            if ($request->user()->can('update', $post)) {

                $post->name = $data['name'];
                $post->description = $data['text'];

                $post->save();

                return redirect()->back()->with(['message' => 'Post updated']);
            }

            return redirect()->back()->withErrors(['message' => 'Post didn\'t updated']);
        }
    }
}
