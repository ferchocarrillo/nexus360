@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | American Water Reporte Bo Tracker')


@section('content_header')
<h1 class="d-inline">Report Bo Tracker</h1>
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}" />
@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Select Date</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('americanwater.botracker.reportsGeneralDownload') }}" method="POST">
                @csrf
                <input type="text" class="form-control form-control-lg" name="daterange" value="" />
                <button class="btn mt-3 btn-primary"><i class="fas fa-download"></i> Download</button>
            </form>
        </div>
    </div>    
</div>



@stop

@push('js')
<script type="text/javascript" src="{{ asset('vendor/daterangepicker/moment.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('vendor/daterangepicker/daterangepicker.js') }} "></script>


<script>
    $(document).ready(function () {
    $('.filter-menu option, .filter-menu select').click(function(e) {e.stopPropagation()});


    $('input[name="daterange"]').daterangepicker({
        opens: 'left',
        autoApply: true,
        startDate: moment(),
        endDate: moment(),
        locale: {
            format: 'YYYY-MM-DD'
        },
        ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
    }, function(start, end, label) {
        startDate = start.format('YYYY-MM-DD');
        endDate = end.format('YYYY-MM-DD');
    });

});


</script>

@endpush
