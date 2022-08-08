@extends('adminlte::page')

@section('title_postfix', ' | Prenomina Adjustments')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />

    <style>
        .table-nowrap td,
        .table-nowrap th {
            white-space: nowrap;
        }
    </style>
@stop

@section('content_header')
    <h1 class='d-inline'>Adjustments</h1>
@stop
@section('content')
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
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th width="110"></th>
                                    </tr>
                                </thead>
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
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
    <script>
        function secondstoHHMMSS(seconds) {
            if (!seconds) return '';
            var sec_num = parseInt(seconds, 10); // don't forget the second param
            var hours = Math.floor(sec_num / 3600);
            var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
            var seconds = sec_num - (hours * 3600) - (minutes * 60);

            if (hours < 10) {
                hours = "0" + hours;
            }
            if (minutes < 10) {
                minutes = "0" + minutes;
            }
            if (seconds < 10) {
                seconds = "0" + seconds;
            }
            return hours + ':' + minutes + ':' + seconds;
        }

        function format(d) {
            var rows = d.adjustments.map(function(adjustment) {
                return `
                <tr>
                    <td>${adjustment.payroll_activity ? adjustment.payroll_activity.date : adjustment.payroll_date}</td>
                    <td>${adjustment.adjustment_type}</td>
                    <td>${adjustment.justification}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                            data-target="#adjustmentModal"
                            data-activity-code="${adjustment.activity_code}"
                            data-activity-id="${adjustment.id}">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
                `;
            }).join('');

            var html = `
            <table class="table table-sm table-borderless table-nowrap mb-0">
                <thead>
                    <tr>
                        <th width="100">Date</th>
                        <th>Adjustment Type</th>
                        <th>Justification</th>
                        <th width="60"></th>
                    </tr>
                </thead>
                <tbody>
                    ${rows}
                </tbody>
            </table>
            `;

            return html;
        }

        $(function() {

            var tableAdjustmentsOM = $('#adjustmentsOM').DataTable({
                ordering: false,
                responsive: true,
                ajax: {
                    url: "{{ route('prenomina.adjustments.pending.om') }}",
                    dataSrc: function(json) {
                        $('#om-tab>span').text(json.count);
                        var data = [];
                        for (var employee_id in json.adjustments) {
                            data.push({
                                'employee_id': employee_id, // employee_id
                                'employee_name': json.adjustments[employee_id][0].employee
                                    .full_name, // employee_name
                                'adjustments': json.adjustments[employee_id] // adjustments
                            });
                        }
                        return data;
                    }
                },
                columns: [{
                        className: "details-control",
                        data: 'employee_name',
                        render: function(data, type, row, meta) {
                            // <div class="d-flex justify-content-between">
                            return `
                                <a href="#" 
                                    class="btn-link">
                                    <i class="fas fa-chevron-right"></i>
                                    ${data}
                                    <span class="badge badge-pill badge-info">${row.adjustments.length}</span>
                                </a>`;
                        }
                    },
                    {
                        data: '',
                        render: function(data, type, row, meta) {
                            return `
                                <button class="btn btn-sm btn-outline-secondary btn-approve-all" data-employee-id="${row.employee_id}">
                                    <i class="fas fa-check-double"></i> Approve All
                                </button>
                            `
                        }
                    }
                ]
            })

            var tableAdjustmentsSupervisor = $('#adjustmentsSupervisor').DataTable({
                ordering: false,
                responsive: true,
                ajax: {
                    url: "{{ route('prenomina.adjustments.pending.supervisor') }}",
                    dataSrc: function(json) {
                        $('#supervisor-tab>span').text(json.count);
                        var data = [];
                        for (var employee_id in json.adjustments) {
                            data.push({
                                'employee_id': employee_id, // employee_id
                                'employee_name': json.adjustments[employee_id][0].employee
                                    .full_name, // employee_name
                                'adjustments': json.adjustments[employee_id] // adjustments
                            });
                        }
                        return data;
                    }
                },
                columns: [{
                    className: "details-control",
                    data: 'employee_name',
                    render: function(data, type, row, meta) {
                        // <div class="d-flex justify-content-between">
                        return `
                                <a href="#" 
                                    class="btn-link">
                                    <i class="fas fa-chevron-right"></i>
                                    ${data}
                                    <span class="badge badge-pill badge-info">${row.adjustments.length}</span>
                                </a>`;
                    }
                }]
            })

            $('#adjustmentsOM tbody').on('click', 'tr td.details-control', function(e) {
                e.preventDefault();
                var tr = $(this).closest('tr');
                var row = tableAdjustmentsOM.row(tr);
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                    $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
                } else {
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                    $(this).find('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
                }
            });

            $('#adjustmentsSupervisor tbody').on('click', 'tr td.details-control', function(e) {
                e.preventDefault();
                var tr = $(this).closest('tr');
                var row = tableAdjustmentsSupervisor.row(tr);
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                    $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
                } else {
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                    $(this).find('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
                }
            });

            $('#adjustmentModal').on('show.bs.modal', function(e) {
                let button = $(e.relatedTarget);
                let option = button.data('option');
                let activity_code = button.data("activity-code");
                let activity_id = button.data("activity-id");
                let modal = $(this);

                modal.find('.data').html('');
                modal.find("#loading").show();
                modal.find("#error").hide();

                modal.find(".modal-title").text("Adjustment");

                axios.get(`/prenomina/adjustments/${activity_id}`)
                    .then(response => {
                        modal.find('.data').html(response.data);
                        modal.find("#loading").hide();
                    })
            });

            $('#adjustmentsOM').on('click', '.btn-approve-all', function(e) {
                e.preventDefault();
                let btn = $(this);
                let employee_id = btn.data('employee-id');

                swal.fire({
                    title: "Are you sure?",
                    text: "You will not be able to undo this action!",
                    icon: "warning",
                    // type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Yes, approve all!",
                    closeOnConfirm: false
                }).then(result => {
                    if (result.value) {        
                        btn.prop('disabled', true);
                        axios.post('/prenomina/adjustments/approveall', {
                            employee_id: employee_id
                        })
                        .then(response => {
                            swal.fire({
                                title: "Approved!",
                                text: "All adjustments have been approved!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            tableAdjustmentsOM.ajax.reload();
                            tableAdjustmentsSupervisor.ajax.reload();
                        })
                        .catch(error => {
                            swal.fire({
                                title: "Error!",
                                text: "Something went wrong!",
                                icon: "error",
                                confirmButtonText: "Ok"
                            });
                            btn.prop('disabled', false);
                            console.log(error.response);
                        })
                    }
                })

            });

            document.addEventListener('refresh_data', function(e) {
                tableAdjustmentsOM.ajax.reload();
                tableAdjustmentsSupervisor.ajax.reload();
            });

        })
    </script>
@endpush
