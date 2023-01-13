@extends('adminlte::page')
@section('title_postfix', ' | Moduurn Call Tracker Report')
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <img alt="logo" class="logo" src="\img\moduurn\ModuurnLogo2.svg" />
        <h1> Call Tracker Report</h1>  
        <a href="{{route('moduurn.calltracker.index')}}" class="btn btn-moduurn" type="button" title="return">
            <i class="fas fa-undo"></i>
        </a>
    </div>
@stop
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/moduurn.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card card_first">
            <div class="card-body">
                <div class="card mb-0">
                    <div class="card-body">
                        <form action="{{ route('moduurn.calltracker.reportsGeneralDownload') }}" method="POST">
                            @csrf
                            <input type="text" class="form-control form-control-lg" name="daterange" value="" />
                            <button class="btn mt-3 btn-moduurn"><i class="fas fa-download"></i> Download</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script type="text/javascript" src="{{ asset('vendor/daterangepicker/moment.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/daterangepicker/daterangepicker.js') }} "></script>
    <script>
        $(document).ready(function() {
            $('.filter-menu option, .filter-menu select').click(function(e) {
                e.stopPropagation()
            });
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
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, function(start, end, label) {
                startDate = start.format('YYYY-MM-DD');
                endDate = end.format('YYYY-MM-DD');
            });
        });
    </script>
@endpush
