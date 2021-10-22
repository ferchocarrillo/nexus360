@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Control de Novedades Reporte Novedades')


@section('css')
{{-- <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }} "> --}}
@stop

@section('content_header')
<h1 class="d-inline">Reporte General Novedades</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('payrollnovelty.reports.generalDownload') }}" method="POST">
                @csrf
                <div class="form-group text-center">
                <button class="btn mt-3 btn-primary"><i class="fas fa-download"></i> Descargar Reporte</button>
                </div>
            </form>
        </div>
    </div>    
</div>

@stop