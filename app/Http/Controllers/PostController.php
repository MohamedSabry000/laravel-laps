<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\File;

// use Illuminate\Http\File;

// use File;

// use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    //
    
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
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
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|unique:posts|min:3',
            'description' => 'required|min:10',
            'post_creator' => 'required|exists:users,id',
        ]);

        //some logic to store data in db
        $data = request()->all();
        //insert into database

        // dd($request);
        if ($request->hasFile('avatar')) {
            $filename = time() . $request->avatar->getClientOriginalName();
            // dd($filename);
            $request->avatar->storeAs('images', $filename, 'public');
        }
        Post::create(
            [
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],
                'avatar'=>$filename,
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

    public function update($post, Request $request, StorePostRequest $req)
    {
        // request()->validate([
        //     'title' => 'required|unique:posts,title,{{$post}}|min:3',
        //     'description' => 'required|min:10',
        //     'post_creator' => 'required|exists:users,id',
        // ]);

        $post = Post::findOrFail($post);
        // if ($post->title != request('title')) {
        //     request()->validate([
        //         'title' => 'required|unique:posts|min:3',
        //     ]);
        // }
        
        $data = request()->all();

        // dd($request);
        if ($request->hasFile('avatar')) {
            $filename = time() . $request->avatar->getClientOriginalName();
            // dd($filename);
            $request->avatar->storeAs('images', $filename, 'public');
        }

        $post->title = $data['title'];
        $post->description = $data['description'];
        isset($filename) && $post->avatar = $filename;
        $post['user_id'] = $data['post_creator'];
        
        $post->update();
        return to_route('posts.index');
    }

    public function destroy($id)
    {
        // unset($this->posts[$id]);
        // return view('posts.index', ['allPosts' => $this->posts]);
        $singlePost = Post::findOrFail($id);
        
        if (file_exists(public_path('storage/images/'. $singlePost->avatar))) {
            unlink(public_path('storage/images/'. $singlePost->avatar));
        }

        $singlePost->comments()->delete();
        // $singlePost->delete();
        $singlePost->delete();
        return redirect()->route('posts.index');
    }
}
