@extends('adminlte::page')
@section('title_postfix', ' | Moduurn Call Tracker')
@section('content_header')
    <img alt="logo" class="logo" src="\img\moduurn\ModuurnLogo2.svg" />
    <h1 class="title_h1"> Report Moduurn Call Tracker</h1>
    <div class="float-right">
        <a href="/moduurn/calltracker" class="btn btn-info" type="button" title="return"><i class="fas fa-undo"></i></a>
    </div>
@stop
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/moduurn.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card_first">
                <div class="card-body">
                    <form action="{{ route('moduurn.calltracker.reportsGeneralDownload') }}" method="POST">
                        @csrf
                        <div class="card col-md-12">
                            <div class="card-body">
                                <input type="text" class="form-control form-control-lg" name="daterange"
                                    value="" />
                                <button class="btn mt-3 btn-primary"><i class="fas fa-download"></i> Download</button>
                            </div>
                        </div>
                    </form>
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
