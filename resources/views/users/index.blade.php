@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Users')

@section('content_header')
<h1 class="d-inline">Users</h1>

<div class="float-right">
    @can('users.upload')
    <a href="{{ route('users.upload') }}" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i> Upload</a>
    @endcan
    @can('users.create')
    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Create</a>
    @endcan
</div>


@stop

@section('content')
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th width="10px">ID</th>
                    <th>Name</th>
                    <th>Manager</th>
                    <th>Roles</th>
                    <th>Status</th>
                    <th width="30px">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id}} </td>
                    <td>{{ $user->name}} </td>
                    <td>{{ ($user->masterfile() ? $user->masterfile()->supervisor : 'N/A') }}</td>
                    <td>
                        @foreach($user->roles as $role)
                        {{ $role->name}}
                        @endforeach
                    </td>
                    <td>{{ ($user->masterfile() ? $user->masterfile()->status : 'N/A') }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="BasicExample">
                            @can('users.show')
                            <a href="{{ route('users.show',$user->id) }}" class="btn btn-sm btn-primary">Show</a>
                            @endcan
                            @can('users.edit')
                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-dark">Edit</a>
                            @endcan
                            @can('users.destroy')
                            {!! Form::open(['route'=>['users.destroy', $user->id],
                            'method'=>'DELETE']) !!}
                            <button class="btn btn-sm btn-danger">Delete</button>
                            {!! Form::close() !!}
                            @endcan

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>
@stop