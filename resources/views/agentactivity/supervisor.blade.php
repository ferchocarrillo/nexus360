@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Agent Activity - Supervisor')


@section('css')
{{-- <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }} "> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
@stop

@section('content_header')
<h1 class="d-inline">Agent Activity - Supervisor</h1>
@stop

@section('content')


    <agentactivity-supervisor-component :timeserver="{{"'".date('Y-m-d H:i:s')."'"}}"  :pusers="{{ $users }}"> </agentactivity-supervisor-component>

 

<iframe style="display: none;" src="{{'http://'. request()->getHost().':3000'}}" frameborder="0" id="ifm_activity"></iframe>
@stop

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
@endpush