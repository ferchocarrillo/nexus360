@extends('adminlte::page')

@section('title_postfix', ' | American Water BO Tracker')


@section('css')

@stop

@section('content_header')
<h1 class="d-inline">American Water BO Tracker</h1>
@stop

@section('content')
@if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
<american-water-bo-tracker-component :olddata='@json(old())'></american-water-bo-tracker-component>
@stop