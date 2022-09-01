@extends('adminlte::page')

@section('title_postfix', ' | Prenomina')

@section('css')

    <link rel="stylesheet" href="{{asset('vendor/flatpickr/flatpickr.min.css')}}">
    <style>
        .table-nowrap td,
        .table-nowrap th {
            white-space: nowrap;
        }

        .holiday {
            font-weight: bold;
            background-color: #ffdcd9;
        }
        .dayoff {
            font-weight: bold;
            background-color: #d6e9f9;
        }

    </style>
@stop

@section('content_header')
    <h1 class='d-inline'>Prenomina</h1>
    <div class="float-right">
        <select class="form-control form-control-sm" id="select_payroll">
            <option value="" selected disabled>Select period</option>
            @foreach ($periods as $period)
                <option value="{{ $period->value }}">{{ $period->text }}</option>
            @endforeach
        </select>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="card mb-1 bg-transparent shadow-none" id="employeeFilter" style="display: none">
                        <div class="card-body py-2 ">
                            <div class="form-row">
                                <div class="col-md-9">
                                    <select id="employees" class="form-control"></select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="date" class="form-control">
                                </div>
                            </div>
                            <div id="employeeData" class="mt-2 table-responsive" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="mb-1 px-4" id="timeScheduledPerWeek" style="display: none"></div>
                    <div class="card mb-1" id="offsetHoliday" style="display: none">
                        <div class="card-body">
                        </div>
                    </div>
                    <div class="card mb-1" id="novelty" style="display: none">
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
            <div id="payrollActivities" class="card" style="display: none">
                <div class="card-body">
                    <h5 class="card-title">Payroll Activities <span class="badge badge-light badge-pill"></span></h5>
                    <br>
                    <div class="data mt-3">

                    </div>
                </div>
            </div>  
        </div>
        <div class="col-md-4" id="schedule" style="display: none">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Schedule</h5>
                    <br>
                    <div class="data mt-3"></div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Start Modal Edit --}}
    <div class="modal fade" id="adjustmentModal" tabindex="-1" role="dialog" aria-labelledby="adjustmentModalLabel"
        aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adjustmentModalLabel">Edit Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="data"></div>
                    {{-- loading --}}
                    <div class="text-center" id="loading" style="display: none">
                        <i class="fas fa-spinner fa-pulse fa-3x"></i>
                    </div>
                    {{-- Alert Message Error --}}
                    <div class="alert alert-danger text-center" id="error" style="display: none">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span id="error_text"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit --}}

@stop
@push('js')
    <script type="text/javascript" src="{{ asset('vendor/daterangepicker/moment.min.js') }} "></script>
    <script src="{{asset('vendor/flatpickr/flatpickr.js')}}"></script>
    <script src="{{ asset('js/prenomina.js?v=1.3')}}"></script>
    <script>
        const master_id = {{auth()->user()->masterfile2[0]->id}}
        $(document).ready(function () {
            var selectPayroll = document.getElementById('select_payroll')
            $('#select_payroll option:last-child').attr('selected', 'selected').change();
        })
    </script>
@endpush