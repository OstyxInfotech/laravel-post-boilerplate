@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$post->title}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                {{$post->body}}

                </div>

                <div class="card-footer">
                    <span class="float-left"><em>Author: <a href="/authors/{{$post->owner->id}}">{{$post->owner->name}}</a></em></span>
                    <a href="javascript:history.go(-1)" class="btn btn-warning float-right">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
