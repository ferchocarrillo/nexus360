@extends('adminlte::page')
@section('title_postfix', ' | Fields Support')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{asset('css/enercare.css')}}">
@endsection
@section('content_header')
<img alt="logo" class="logo" src="\img\EnercareTracker\enercare-seeklogo.com.svg" />
@if (Auth::user()->can('enercare.botracker'))
<a href="{{ route('botracker.create') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-feather-alt"></i> Create a New Register</a>
@endif
<h1 class="title_h1"> Enercare BO Tracker</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover" id="enercareBoTracerTable">
            <thead class="table-info">
                    <tr>
                            <td scope="col"><strong> Queue Tracker</strong></td>
                            <td scope="col"><strong> Case</strong></td>
                            <td></td>
                        </tr>
                        <tbody>
                            @foreach ($trackers_lists as $track)
                                <tr>
                                    <td>{{$track->queue_tracker}}</td>
                                    <td>{{$track->case}}</td>
                                <td>
                                    <a  href="{{ url('/enercare/botracker/'. $track->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="See Case">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @can('enercare.botracker.leader')
                                    <a  href="{{ url('/enercare/botracker/'. $track->id.'/edit' )}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true" title="Edit Case">
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
@can('enercare.botracker.reports.general')
<a href="{{ route('enercare.botracker.reportsGeneral') }}">
    <img src="/img/EnercareTracker/excel_logo.png" alt="HTML tutorial" style="width:70px;height:42px;">
</a>
@endcan
    @stop
    @push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script>
        $(document).ready(function() {
            $('#enercareBoTracerTable').DataTable({
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



