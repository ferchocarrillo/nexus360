@extends('adminlte::page')

@section('title_postfix', ' | Prenomina Adjustments')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />

    <style>
        .table-nowrap td,
        .table-nowrap th {
            white-space: nowrap;
        }
        table.dataTable thead {
        display: none;
        }
        table.dataTable tr.dtrg-group.dtrg-level-0 td a {
            /* font-weight: bold; */
        }
        table.dataTable tr.dtrg-group.dtrg-level-1 td a {
            font-weight: lighter;
        }

        table.dataTable tr.dtrg-group.dtrg-level-1 td:nth-child(1){
            padding-left: 2em;
        }
    </style>
@stop

@section('content_header')
    <h1 class='d-inline'>Adjustments</h1>
@stop
@section('content')
    <button type="button" class="btn btn-sm btn-info float-right ml-2" id="btnReload">
        <i class="fas fa-sync-alt"></i> Refresh
    </button>
    <button type="button" class="btn btn-sm btn-outline-secondary float-right" data-toggle="modal" data-target="#summaryAdjustments">
        <i class="fas fa-table"></i> Summary
    </button>
    <ul class="nav nav-tabs" id="tabsAdjustments" role="tablist">
        @if ($permissionOM)
            <li class="nav-item">
                <a class="nav-link active" id="om-tab" data-toggle="tab" href="#om" role="tab" aria-controls="om"
                    aria-selected="true">
                    OM
                    <span class="badge badge-pill badge-danger"></span>
                </a>
            </li>
        @endif
        @if ($permissionSupervisor)
            <li class="nav-item">
                <a class="nav-link" id="supervisor-tab" data-toggle="tab" href="#supervisor" role="tab"
                    aria-controls="supervisor" aria-selected="false">
                    Supervisor
                    <span class="badge badge-pill badge-danger"></span>
                </a>
            </li>
        @endif
    </ul>
    <div class="tab-content" id="tabsAdjustmentsContent">
        @if ($permissionOM)
            <div class="tab-pane fade show active" id="om" role="tabpanel" aria-labelledby="om-tab">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- Table with rows collapse --}}
                            <table class="table table-hover table-nowrap mb-0" id="adjustmentsOM" style="width:100%">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($permissionSupervisor)
            <div class="tab-pane fade" id="supervisor" role="tabpanel" aria-labelledby="supervisor-tab">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- Table with rows collapse --}}
                            <table class="table table-hover table-nowrap mb-0" id="adjustmentsSupervisor"
                                style="width:100%">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="summaryAdjustments" tabindex="-1" role="dialog" aria-labelledby="summaryAdjustmentsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="summaryAdjustmentsLabel">Summary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="summary" class="table table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Supervisor</th>
                                <th>Payroll Manager</th>
                                <th>Pending For</th>
                                <th>Cant</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot class="thead-dark">
                            <tr>
                                <th colspan="3">TOTAL</th>
                                <th><span id="nAdjustments">0</span></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="adjustmentModal" tabindex="-1" role="dialog" aria-labelledby="adjustmentModalLabel"
        aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl" role="document">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables-plugins/rowgroup/js/dataTables.rowGroup.min.js') }} "></script>
    <script>
        var urlGetAdjustments = '{{ route('prenomina.adjustments.pending') }}';
    </script>
    <script type="text/javascript" src="{{asset('js/payroll/adjustments.js')}}"></script>
@endpush
