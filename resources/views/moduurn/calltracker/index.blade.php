@extends('adminlte::page')
@section('title_postfix', ' | Moduurn Call Tracker')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/moduurn.css') }}">
@endsection
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <img alt="logo" class="logo" src="\img\moduurn\ModuurnLogo2.svg" />
        <h1> Call Tracker </h1>
        @can('moduurn.calltracker')    
            <a href="{{ route('moduurn.calltracker.create') }}" class="btn btn-sm float-right btn-moduurn">
                <i class="fas fa-plus"></i> New Record
            </a>
        @endcan
    </div>
@stop
@section('content')
    <div class="card">
        @can('moduurn.calltracker.reports.general')
            <div class="card-header border-0">
                <a href="{{ route('moduurn.calltracker.reportsGeneral') }}" class="btn btn-report">
                    Export to Excel <i class="far fa-file-excel ml-2"></i>
                </a>
            </div>
        @endcan
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="moduurmTrackerTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Phone Number</th>
                            <th>List ID</th>
                            <th>Not Show</th>
                            <th>Schedule</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trackers as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->phone_number1 }}</td>
                                <td>{{ $record->list_id }}</td>
                                <td>{{ $record->not_show }}</td>
                                <td>{{ $record->date_schedule }}</td>
                                <td>{{ $record->creator->name }}</td>
                                <td>{{ $record->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('moduurn.calltracker.show', $record->id) }}"
                                            class="btn btn-info btn-sm" role="button" aria-pressed="true" title="See Case">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @can('moduurn.calltracker.leader')
                                            <a href="{{ route('moduurn.calltracker.edit', $record->id) }}"
                                                class="btn btn-warning btn-sm" role="button" aria-pressed="true"
                                                title="Edit Case">
                                                <i class="fas fa-eye-dropper"></i>
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script>
        $(document).ready(function() {
            $('#moduurmTrackerTable').DataTable();
        })
    </script>
@endpush
