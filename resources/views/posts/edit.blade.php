@extends('layouts.app')

@section('content')
<form method="POST" action="{{route('posts.update', ['post' => $post['id']])}}">
    @csrf
    @method('PUT')
    <div class="container mt-5">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">
                {{$post->description}}
            </textarea>
        </div>
        <select name="post_creator" class="form-select" aria-label="Default select example">Post Creator
            @foreach($users as $user)
                <option value="{{$user->id}}" {{$post->user_id == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
            @endforeach
        </select>
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>
@endsection