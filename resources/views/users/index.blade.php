@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">User Management ({{$users->total()}})</span>
                    <span class="float-right">
                        <a href="posts/create" class="btn btn-primary btn-small">Add New User</a>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name }}</td>
                                    <td>{{$user->email}}</a></td>
                                    <td>
                                        <a class="btn btn-xs btn-warning" href="/users/{{$user->id}}">Details</a>
                                        <form action="/users/{{$user->id}}" method="POST" class="form-horizontal float-right">
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
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
