@extends('adminlte::page')
@section('title_postfix', ' | Call Tracker')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/moduurn.css') }}">
@endsection
@section('content_header')
    <img alt="logo" class="logo" src="\img\moduurn\ModuurnLogo2.svg" />
    @if (Auth::user()->can('moduurn/calltracker.create'))
        <a href="{{ route('calltracker.create') }}" class="btn btn-sm btn-primary float-right botones"><i
                class="fas fa-feather-alt"></i> Create a New Register</a>
    @endif
    <h1 class="title_h1"> Moduurn Tracker </h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="moduurmTrackerTable">
                <thead class="table-info">
                    <tr>
                        <td>Principal Number</td>
                        <td>Secundary Number</td>
                        <td>list Id</td>
                        <td>Not Show</td>
                        <td>Is Schedule</td>
                        <td>Reason</td>
                        <td>Type</td>
                        <td>Transfer Call</td>
                        <td>Date</td>
                        <td>Country/Region/State</td>
                        <td>Expert</td>
                        <td>Created By</td>
                        <td>Create at</td>
                        <td></td>
                    </tr>
                <tbody>
                    @foreach ($trackers as $track)
                        <tr>
                            <td>{{ $track->phone_number1 }}</td>
                            <td>{{ $track->phone_number2 }}</td>
                            <td>{{ $track->list_id }}</td>
                            <td>{{ $track->not_show }}</td>
                            <td>{{ $track->is_schedule }}</td>
                            <td>{{ $track->reason_not_schedule }}</td>
                            <td>{{ $track->type }}</td>
                            <td>{{ $track->transferCall }}</td>
                            <td>{{ $track->date_schedule }}</td>
                            <td>{{ $track->country }} - {{ $track->region }} - {{ $track->state }}</td>
                            <td>{{ $track->expert }}</td>
                            <td>{{ $track->creador->name }}</td>
                            <td>{{ $track->created }}</td>
                            <td>
                                <a href="{{ url('/moduurn/calltracker/' . $track->id) }}" class="btn btn-info btn-sm"
                                    role="button" aria-pressed="true" title="See Case">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('moduurn.calltracker.leader')
                                    <a href="{{ url('/moduurn/calltracker/' . $track->id . '/edit') }}"
                                        class="btn btn-warning btn-sm" role="button" aria-pressed="true" title="Edit Case">
                                        <i class="fas fa-eye-dropper"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @can('moduurn.calltracker.reports.general')
        <a href="{{ route('moduurn.calltracker.reportsGeneral') }}">
            <img src="/img/moduurn/excel_logo.png" alt="HTML tutorial" style="width:70px;height:42px;">
        </a>
    @endcan
@stop
@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script>
        $(document).ready(function() {
            $('#moduurmTrackerTable').DataTable({
                language: {
                    "processing": "Processing...",
                    "lengthMenu": "Show _MENU_ records",
                    "zeroRecords": "No results found",
                    "emptyTable": "No data available in this table",
                    "infoEmpty": "Showing records from 0 to 0 of a total of 0 records",
                    "infoFiltered": "(filtering a total of _MAX_ records)",
                    search: `<div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>`,
                    searchPlaceholder: 'Search...',
                    "infoThousands": ",",
                    "loadingRecords": "Loading...",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    },
                    "info": "Showing _START_ to _END_ of _TOTAL_ records"
                }
            });
        })
    </script>
@endpush
