@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">Role Management ({{$roles->total()}})</span>
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
                                <th>Role</th>
                                <th>Slug</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name }}</td>
                                    <td>{{$role->slug}}</a></td>
                                    <td>
                                        <a class="btn btn-xs btn-warning" href="/roles/{{$role->id}}">Details</a>
                                        <form action="/roles/{{$role->id}}" method="POST" class="form-horizontal float-right">
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
                    {{$roles->links()}}
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">Add New Role</div>
                <div class="card-body">
                    <form action="/roles" method="POST" class="form" id="form-role">
                        @csrf
                        <div class="form-group">
                            <label for="">Role</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" onClick="document.getElementById('form-role').submit()">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
