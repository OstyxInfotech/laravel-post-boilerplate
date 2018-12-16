@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">Posts</span>
                    <span class="float-right">
                        <a href="posts/create" class="btn btn-primary btn-small">Add New Post</a>
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td><a href="/posts/{{$post->id}}">{{$post->id}}</a></td>
                                    <td>{{iconv_strlen($post->title)>40 ? substr($post->title, 0, 40).'...' : $post->title }}</td>
                                    <td><a href="/authors/{{$post->owner->id}}">{{$post->owner->name}}</a></td>
                                    <td>
                                        <a href="/posts/{{$post->id}}/edit" class="btn btn-warning btn-xs">
                                            Edit
                                        </a>
                                        <form action="/posts/{{$post->id}}" method="POST" class="form-horizontal float-right">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
