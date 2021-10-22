@extends('adminlte::page')

@section('title_postfix', ' | Control de Novedades')

@section('content_header')
<h1 class="d-inline">Control de Novedades</h1>
<a href="/payrollnovelty" class="btn btn-sm btn-outline-primary float-right">  <i class="fas fa-file-export"></i> Pendientes por Grabar</a>
@stop

@section('content')

        <payroll-novelty-component  
        :contingencies='@json($contingencies)'
        :statuses='@json($statuses)'
        :tags='@json($tags)'
        :employess='@json($employess)'
        :smlvs='@json($smlvs)'
        ></payroll-novelty-component>

@stop