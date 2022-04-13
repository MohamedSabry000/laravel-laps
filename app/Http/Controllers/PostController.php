<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
// use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('posts.index', [
            'allPosts' => $posts,
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', [
            'users' => $users,
        ]);
    }
    //to create a new post
    public function store()
    {
        request()->validate([
            'title' => 'required|unique:posts|min:3',
            'description' => 'required|min:10',
            'post_creator' => 'required|exists:users,id',
        ]);

        //some logic to store data in db
        $data = request()->all();
        //insert into database

        Post::create(
            [
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],
            ]
        );
        return to_route('posts.index');
    }
    // to show a single post
    public function show($post)
    {
        $post = Post::find($post);
        // dd($post);
        return view('posts.show', [
            'posts' => $post,
        ]);
    }

    public function edit($postId)
    {
        $post = Post::find($postId);
        return view('posts.edit', [
            'post' => $post,
            'users' => User::all(),
        ]);
    }

    public function update($post)
    {
        request()->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'post_creator' => 'required|exists:users,id',
        ]);

        $post = Post::findOrFail($post);
        if ($post->title != request('title')) {
            request()->validate([
                'title' => 'required|unique:posts|min:3',
            ]);
        }
        
        $data = request()->all();

        $post->title = $data['title'];
        $post->description = $data['description'];
        $post['user_id'] = $data['post_creator'];
        
        $post->update();
        return to_route('posts.index');
    }

    public function destroy($id)
    {
        // unset($this->posts[$id]);
        // return view('posts.index', ['allPosts' => $this->posts]);
        $singlePost = Post::findOrFail($id);
        // $singlePost->delete();
        $singlePost->delete()->comments()->delete();
        return redirect()->route('posts.index');
    }
}
