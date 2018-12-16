@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">{{$user->name}}'s Posts({{$posts->count()}})</span>
                    <span class="float-right">
                        <a href="javascript:history.go(-1);" class="btn btn-primary btn-small">Back</a>
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
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td><a href="/posts/{{$post->id}}">{{$post->id}}</a></td>
                                    <td>{{iconv_strlen($post->title)>40 ? substr($post->title, 0, 40).'...' : $post->title }}</td>
                                    <td><a href="/authors/{{$post->owner->id}}">{{$post->owner->name}}</a></td>
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
