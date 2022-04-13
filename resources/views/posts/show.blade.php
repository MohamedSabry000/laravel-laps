@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<div class="card my-4">
    <div class="card-header fw-bold fs-1">
        Post info
    </div>
    <div class="card-body ">
        <h5 class="card-title fs-4">
            <span class="fw-bold">Title:</span>
            <p class="d-inline-block card-text text-muted">
                {{$posts['title']}}
            </p>
        </h5>
        <div class="fs-4">
            <span class="fw-bold ">Description:</span>
            <p class="card-text d-inline-block text-muted ">
                {{$posts['description']}}
            </p>
        </div>
    </div>
</div>
<!-- post creator info -->
<div class="card my-4">
    <div class="card-header fw-bold fs-1">
        Post Creator info
    </div>
    <div class="card-body ">
        <h5 class="card-title fs-4">
            <span class="fw-bold">Name:</span>
            <p class="d-inline-block card-text text-muted">
                {{$posts->user ? $posts->user->name : 'Not Found'}}
            </p>
        </h5>
        <h5 class="card-title fs-4">
            <span class="fw-bold">Email:</span>
            <p class="d-inline-block card-text text-muted">
                {{$posts->user ? $posts->user->email : 'Not Found'}}
            </p>
        </h5>
        <h5 class="card-title fs-4">
            <span class="fw-bold">Created At:</span>
            <p class="d-inline-block card-text text-muted">
                {{$posts['created_at']}}
            </p>
        </h5>

            <h5 class="card-title fs-4">
                <span class="fw-bold">Slug:</span>
                <p class="d-inline-block card-text text-muted">
                    {{$posts->slug}}
                </p>
            </h5>

    </div>
</div>
<!-- Comments -->
<div class="card my-4">
    <div class="card-header fw-bold fs-1">
        Comments
    </div>
    <div class="card-body ">
        @if(isset($posts->comments) && count($posts->comments) > 0)
            @foreach ($posts->comments as $comment)
                <div class='my-4 border p-4 rounded-lg'>
                    <h2 class='text-lg fw-bold'>{{$comment->user->name}}</h2>
                    <p class='text-lg my-2 fs-2'>{{$comment->body}}</p>
                    <span class='text-sm'>Last Updated At: {{$comment->updated_at->toDayDateTimeString()}}</span>
                    <div class="mt-4  flex">
                        <form class="text-center d-inline" method='POST' action={{route('comments.delete', ['postId' => $posts['id'], 'commentId' => $comment->id])}}>
                            @csrf
                            @method('DELETE')
                            <button type="sumbit" class='btn btn-lg btn-primary'>Delete</button>
                        </form>
                        <a class='btn btn-lg btn-success ml-4' href={{route('comments.view', ['postId' => $posts['id'], 'commentId' => $comment->id])}}>
                            Edit
                        </a>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>

<div class="d-flex justify-content-center " style="width: 100%">
    <form action="{{route('comments.create',['postId' => $posts['id']])}}" method="POST" style="width: 100%">
        <input type="text" name="comment" class="form-control mr-2" placeholder="Add comment" style="margin: 10px 0;">

        @csrf
        <button type="submit" class="btn btn-success">Add Comment</button>
    </form>
</div>

@endsection