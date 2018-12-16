@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/posts/{{$post->id}}" method="POST">
                        @method('PATCH')
                        @csrf

                        <div class="control-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title" required value="{{$post->title}}">
                        </div>

                        <div class="control-group mt-2">
                            <label for="">Body</label>
                            <textarea name="body" id="" cols="30" rows="10" class="form-control" required>{{$post->body}}</textarea>
                        </div>

                        <div class="control-group">
                            <button type="submit" class="mt-2 btn btn-primary">Update</button>
                            <a href="javascript:history.go(-1)" class="mt-2 btn btn-warning">Back</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
