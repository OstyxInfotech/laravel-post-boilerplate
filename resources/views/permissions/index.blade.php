@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">Permission Management</span>
                    <span class="float-right">
                        {{-- <a href="permissions/create" class="btn btn-primary btn-small">Create Model</a> --}}
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <ul class="list-group">
                       <li class="list-group-item list-group-item-primary">Models</li>
                        @foreach ($permissions as $permission)
                            <li class="list-group-item">
                                {{$permission->model}}
                            </li>
                        @endforeach
                   </ul>
                </div>

                <div class="card-footer">

                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">
                    <span class="float-left">Create Permission Model</span>
                </div>

                <div class="card-body">
                    <form action="/permissions" method="post" class="form">
                            @csrf

                        <div class="form-group">
                            <label for="model">Model</label>
                            <input id="model" name="model" type="text" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>


                </div>

                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
