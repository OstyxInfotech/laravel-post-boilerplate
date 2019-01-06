@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$user->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

               <form action="/users/{{$user->id}}" method="post" id="roles-form">
                    @csrf
                    @method('PATCH')

                    <ul class="list-group">
                        @foreach ($roles as $role)
                            <li class="list-group-item">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" value="{{$role->id}}" class="form-check-input" name="roles[]" {{$user->hasRoleById($role->id) ? 'checked': ''}}> {{$role->name}}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
               </form>

                </div>
                <div class="card-footer">
                    <button onclick="document.getElementById('roles-form').submit();" class="btn btn-primary">Save</button>
                    <a href="javascript:history.go(-1)" class="btn btn-warning float-right">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
