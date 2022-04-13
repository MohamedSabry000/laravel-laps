@extends('layouts.app')

@section('title')

@endsection

@section('content')
<div class="d-flex justify-content-end">
    <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success">Create Post</a>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if (count($allPosts) > 0)
            @foreach ( $allPosts as $post)
            <tr>
                <td>{{$post['id']}}</th>
                <td>{{$post['title']}}</td>
                <td>{{$post->user ? $post->user->name : 'Not Found'}}</td>
                <td>{{$post['created_at']}}</td>
                <td>
                    <a href="{{route('posts.show', ['post' => $post['id']])}}" class="btn btn-info mx-1">View</a>
                    <a href="{{route('posts.edit', ['post' => $post['id']])}}" class="btn btn-primary mx-1">Edit</a>
                    <button type="button" class="btn btn-danger d-inline-block" data-bs-toggle="modal" data-bs-target="#exampleModal{{$post->id}}">
                        Delete
                    </button>
                </td>
                <td>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{route('posts.destroy',['post' => $post['id']])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </td>
            </tr>
            
            @endforeach
        @endif
    </tbody>
</table>
{{-- Pagination --}}
<div class="flex justify-center items-center mt-10">
    {!! $allPosts->links() !!}
</div>
<style> svg{ width: 35px; } </style>

@endsection