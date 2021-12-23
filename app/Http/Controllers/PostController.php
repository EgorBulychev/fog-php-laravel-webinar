<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request) {
        if ($request->get('query')) {
            $posts = Post::search($request->get('query'))->paginate(5);
        } else {
            $posts = Post::take(10)->paginate(5);
        }

        return view('post.index', [
            'posts' => $posts,
            'query' => $request->get('query')
        ]);
    }

    public function edit(Request $request) {
        $id = $request->get('id');
        return view("post.edit", ['post' => Post::where(['id' => $id])->first()]);
    }

    public function save(Request $request) {
        $post = Post::where(['id' => $request->id])->first();

        $post->name = $request->name;
        $post->post = $request->post;
        $post->save();

        return redirect()->back();
    }
}
