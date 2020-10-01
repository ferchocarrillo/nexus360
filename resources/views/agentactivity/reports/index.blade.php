@extends('adminlte::page')


@section('title_postfix', ' | Report Agent Activity')

@section('content_header')
<div class="row align-items-center">
    <div class="col-md-8">
        <h1 class="d-inline">Report Agent Activity</h1>
    </div>

    {{-- FILTERS --}}
    <div class="col-md-4 mt-3 mt-md-0 text-right">
        <div class="input-group">
            {{-- FILTER DATE --}}
            <input type="text" class="form-control form-control-sm" name="daterange" value="01/01/2020 - 01/15/2020" />
            <div class="input-group-append">                  
                <button class="btn btn-primary btn-search btn-sm d-inline-block" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@stop


@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}" />
@endsection


@section('content')

<div id="result"></div>

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


    $('.btn-search').click(function (e) { 

        $('#logoLoading').modal('show');
        e.preventDefault();
        let startDate = $('input[name="daterange"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
        let endDate = $('input[name="daterange"]').data('daterangepicker').endDate.format('YYYY-MM-DD');

        let dataForm = {startDate, endDate};
        
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


        fetch('/agentactivity/report/getData',{ 
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            credentials: "same-origin",
            body: JSON.stringify(dataForm),
            method: 'POST' 
        })
        .then((data)=> {
        data.text().then(function(text){

            setTimeout(() => {
                $('#logoLoading').modal('hide');
            }, 1000);

            // console.log(JSON.parse(text));
            $('#result').html(text);
        });
        })
        
    });



});


</script>

@endpush
