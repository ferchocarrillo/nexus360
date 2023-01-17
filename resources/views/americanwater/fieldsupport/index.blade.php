@extends('adminlte::page')
@section('title_postfix', ' | Fields Support')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{asset('css/fieldsupport.css')}}">
@endsection
@section('content_header')
<img alt="logo" class="logo" src="{{asset('/img/americanWater/american_water_logo.png')}}" />
@if (Auth::user()->can('americanwater.fieldsupport'))
<a href="{{ route('fieldsupport.create') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-feather-alt"></i> Create a New Register</a>
@endif
<h1 class="title_h1">Field Support List</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover" id="fieldsupportTable">
            <thead class="table-info">
                    <tr>
                    <th>CPH</th>
                        <th>Claim Number</th>
                    <th>Threshold</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Observations</th>
                    <th>Created Date</th>
                    <th></th>
                    </tr>
                <tbody>
                @foreach ($fields_lists as $field)
                <tr>
                    <td>{{$field->cph}}</td>
                    <td>{{ $field->claim_number }}</td>
                    <td>{{ $field->threshold }}</td>
                    <td>{{ $field->status }}</td>
                    <td>{{$field->type}}</td>
                    <td>{{$field->observations}}</td>
                    <td>{{$field->created->format('d-m-Y')}}</td>
                    <td>
                        <a  href="{{ url('/americanwater/fieldsupport/'. $field->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="See Case">
                            <i class="fas fa-eye"></i>
                        </a>
                        @can('americanwater.fieldsupport.leader')
                        <a  href="{{ url('/americanwater/fieldsupport/'. $field->id.'/edit' )}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true" title="Edit Case">
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
@can('americanwater.fieldsupport.reports.general')
<a href="{{ route('americanwater.fieldsupport.reportsGeneral') }}">
    <img src="/img/americanWater/excel_logo.png" alt="HTML tutorial" style="width:70px;height:42px;">
</a>
@endcan



    @stop
    @push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script>
        $(document).ready(function() {
            $('#fieldsupportTable').DataTable({
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
