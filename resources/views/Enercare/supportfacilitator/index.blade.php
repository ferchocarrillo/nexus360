@extends('adminlte::page')
@section('title_postfix', ' | Enercare Support Facilitator')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/enercare.css') }}">
@endsection
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <img alt="logo" class="logo" src="\img\EnercareTracker\enercare-seeklogo.com.svg" />
        <h1> Enercare Support Facilitator </h1>
        @can('enercare.supportfacilitator')
            <a href="{{ url('enercare/supportfacilitator/create') }}" class="btn btn-sm btn-primary float-right"><i
                class="fas fa-feather-alt"></i> Create a New Register</a>
        @endcan
    </div>
@stop
@section('content')
    <div class="card">
        @can('enercare.supportfacilitator.reports.general')
        <a href="{{ route('enercare.supportfacilitator.reportsGeneral') }}">
            <img src="/img/EnercareTracker/excel_logo.png" alt="HTML tutorial" style="width:70px;height:42px;">
        </a>
    @endcan
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="supportFaclitatorTable">
                    <thead class="table-info">
                        <tr>
                            <th>#</th>
                            <th>Agent</th>
                            <th>Process</th>
                            <th>Process Specific</th>
                            <th>Additional Details</th>
                            <th>Behaivor Identified</th>
                            <th>Recomendations</th>
                            <th>Repeated Interaction</th>
                            <th>Observatios</th>
                            <th>Conference In</th>
                            <th>Supervisor Assistence</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facilitators as $fc)
                            <tr>
                                <td>{{$fc->id}}</td>
                                <td>{{$fc->agent}}</td>
                                <td>{{$fc->process}}</td>
                                <td>{{$fc->process_specific}}</td>
                                <td>{{$fc->additional_details}}</td>
                                <td>{{$fc->behavior_identified}}</td>
                                <td>{{$fc->recomendations}}</td>
                                <td>{{$fc->repeated_interaction}}</td>
                                <td>{{$fc->observations}}</td>
                                <td>{{$fc->conference_in}}</td>
                                <td>{{$fc->supervisor_assistence}}</td>
                                <td>{{$fc->creator->name}}</td>
                                <td>{{$fc->created_at}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('/enercare/supportfacilitator/' . $fc->id) }}"
                                            class="btn btn-info btn-sm" role="button" aria-pressed="true" title="See Case">
                                            <i class="fas fa-eye"></i>
                                        </a>
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
            $('#supportFaclitatorTable').DataTable({
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

