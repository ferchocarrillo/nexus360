@extends('adminlte::page')
@section('title_postfix', ' | Fields Support')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{asset('css/dearservice.css')}}">
@endsection
@section('content_header')
<img alt="logo" class="logo" src="\img\Dear Service\dear_service.png" />
@if (Auth::user()->can('dearservice.tracker'))
<a href="{{ url('dearservice/tracker/create') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-feather-alt"></i> Create a New Register</a>
@endif
<h1 class="title_h1">Dear Service Tracker List</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover" id="dearservicetable">
            <thead class="table-info">
                    <tr>
                    <th>Custumer Name</th>
                    <th>Phone Number</th>
                    <th>Disposition</th>
                    <th>Call Attempts</th>
                    <th>Comments</th>
                    <th>Created by</th>
                    <th>Created at</th>
                    </tr>
                <tbody>
                @foreach ($trackers as $trk)
                <tr>
                    <td>{{ $trk->custumer_name}}</td>
                    <td>{{ $trk->phone_number }}</td>
                    <td>{{ $trk->disposition }}</td>
                    <td>{{ $trk->call_attempts }}</td>
                    <td>{{ $trk->comments}}</td>
                    <td>{{ $trk->creator->name}}</td>
                    <td>{{ $trk->created_at->format('d-m-Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@can('dearservice.tracker.reports.general')
<a href="{{ route('dearservice.tracker.reportsGeneral') }}">
    <img src="/img/americanWater/excel_logo.png" alt="HTML tutorial" style="width:70px;height:42px;">
</a>
@endcan
    @stop
    @push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script>
        $(document).ready(function() {
            $('#dearservicetable').DataTable({
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
