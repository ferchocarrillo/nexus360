@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' . config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | MasterFile WFH')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
@stop


@section('content_header')
    <h1 class="d-inline">WFH</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form id="form-wfh">
                    <div class="form-group">
                        <select id="wfh-id" class="custom-select" required>
                            <option value="" selected disabled>Select Employee ...</option>
                            @foreach ($employess as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->text }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="wfh"></div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/select2/js/select2.min.js') }} "></script>
    <script>
        const employess = @json($employess);
    </script>
    <script src="{{ asset('js/masterfile/wfh.js') }}"></script>
@endpush
