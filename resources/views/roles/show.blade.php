@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form action="/roles/{{$role->id}}" method="POST">
        @csrf
        @method('PATCH')
            <div class="card">
                <div class="card-header">{{$role->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group list-group-flush">
                    <div class="row">
                        @foreach($models as $model)
                            <li class="list-group-item col-md-6 border-0">
                                <div class="card">
                                    <div class="card-header">
                                        {{$model}}
                                        <span class="float-right">
                                            <input type="checkbox" name="title" id="title_{{strtolower($model)}}" />
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                        @foreach($permissions->where('model', $model) as $permission)
                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{$permission->id}}" {{$role_permissions->contains($permission->id) ? 'checked' : ''}}>{{studly_case($permission->permission)}}
                                                    </label>
                                                </div>
                                            </li>
                                         @endforeach
                                         </ul>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </div>
                    </ul>


                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="javascript:history.go(-1)" class="btn btn-warning float-right">Back</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        /*$('input[name="all"],input[name="title"]').bind('click', function(){*/
        $('input[name="title"]').bind('click', function(){
            var status = $(this).is(':checked');
            $('input[type="checkbox"]', $(this).closest('li')).attr('checked', status);
        });
    })
</script>
@endpush
