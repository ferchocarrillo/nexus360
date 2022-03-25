@extends('adminlte::page')

@section('title_postfix', ' | Trivias')

@section('content_header')
    <h1 class='d-inline'>Trivias</h1>
@stop
@section('content')
    <div class="container">
        <div class='card'>
            <div class='card-body'>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Code Trivia" id="code">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="btnSearch" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('js')
    <script>
        $('#btnSearch').click((e)=>{
            let code = $('#code').val();
            window.location.replace(`${window.location.href}/${code}`);
        })
    </script>
@endpush