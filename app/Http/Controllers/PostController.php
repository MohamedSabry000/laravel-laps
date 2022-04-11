<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public $posts = [
        ['id' => 1, 'title' => 'first post', 'desc' => 'Description 1', 'posted_by' => 'ahmed', 'created_at' => '2022-04-11'],
        ['id' => 2, 'title' => 'second post', 'desc' => 'Description 2', 'posted_by' => 'mohamed', 'created_at' => '2022-04-11'],
        ['id' => 3, 'title' => 'third post', 'desc' => 'Description 2', 'posted_by' => 'mohamed', 'created_at' => '2022-04-11'],
        ['id' => 4, 'title' => 'fourth post', 'desc' => 'Description 2', 'posted_by' => 'mohamed', 'created_at' => '2022-04-11'],
    ];

    public function index()
    {
        // $posts = [
        //     ['id' => 1, 'title' => 'first post', 'posted_by' => 'ahmed', 'created_at' => '2022-04-11'],
        //     ['id' => 2, 'title' => 'second post', 'posted_by' => 'mohamed', 'created_at' => '2022-04-11'],
        // ];

        // dd($posts); //stop execution and dump the variable
        return view('posts.index', [
            'allPosts' => $this->posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        //some logic to store data in db
        //redirect to /posts
        array_push($this->posts, [
            'id' => count($this->posts) + 1,
            'title' => request('title'),
            'desc' => request('desc'),
            'posted_by' => request('posted_by'),
            'created_at' => date('Y-m-d'),
        ]);
        // dd($this->posts);
        // return redirect()->route('posts.index');
        return view('posts.index', ['allPosts' => $this->posts]);
    }

    public function show($post)
    {
        // dd($post);
        if (isset($post) && is_numeric($post) && $post <= count($this->posts)) {
            $key = array_search($post, array_column($this->posts, 'id'));
            if ($key !== false) {
                return view('posts.show', [
                    'post' => $this->posts[$key],
                ]);
            }
        }
        return view('posts.error');
    }

    // TOOD:: CREATE EDIT, UPDATE, DELETE
    public function edit($post)
    {
        if (isset($post) && is_numeric($post) && $post <= count($this->posts)) {
            $key = array_search($post, array_column($this->posts, 'id'));
            if ($key !== false) {
                return view('posts.edit', [
                    'post' => $this->posts[$key],
                ]);
            }
        }
        
        return view('posts.error');
    }
    public function update()
    {
        return view('posts.index');
    }

    public function destroy($post)
    {
        if (isset($post) && is_numeric($post) && $post <= count($this->posts)) {
            $key = array_search($post, array_column($this->posts, 'id'));
            if ($key !== false) {
                // dd($this->posts[$key]);
                unset($this->posts[$key]);
                return view('posts.index', ['allPosts' => $this->posts]);
            }
        }
        
        return view('posts.error');
    }
    public function error()
    {
        return view('posts.error');
    }
}
