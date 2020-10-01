@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Roles')


@section('css')
{{-- <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }} "> --}}
@stop

@section('content_header')
<h1 class="d-inline">Roles</h1>
@can('roles.create')
<a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary float-right">Create</a>
@endcan
@stop

@section('content')
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th width="10px">ID</th>
                    <th>Name</th>
                    <th width="30px">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id}} </td>
                    <td>{{ $role->name}} </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="BasicExample">
                            @can('roles.show')
                            <a href="{{ route('roles.show',$role->id) }}" class="btn btn-sm btn-primary">Show</a>
                            @endcan
                            @can('roles.edit')
                            <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-sm btn-dark">Edit</a>
                            @endcan
                            @can('roles.destroy')
                            {!! Form::open(['route'=>['roles.destroy', $role->id],
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

        {{ $roles->render() }}
    </div>
</div>
@stop