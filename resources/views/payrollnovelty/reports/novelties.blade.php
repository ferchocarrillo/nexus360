@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Control de Novedades Reporte Novedades')


@section('css')
{{-- <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }} "> --}}
@stop

@section('content_header')
<h1 class="d-inline">Reporte Novedades</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('payrollnovelty.reports.noveltiesDownload') }}" method="POST">
                @csrf
                <label for="">Fecha Inicial</label>
                <input type="date" class="form-control form-control-lg" name="start_date" required/>
                @include('errors.errors', ['field' => 'start_date'])
                <button class="btn mt-3 btn-primary"><i class="fas fa-download"></i> Descargar</button>
            </form>
        </div>
    </div>    
</div>

@stop