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
                    <td>${adjustment.date}</td>
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

        var totalAdjustments = {};
        function summaryAdjustments(adjustments,pending_for,count){
            let data =Object.values(adjustments).flat(1).reduce((p, c) => {
                let idx = p.findIndex(x=>x.supervisor==c.employee.supervisor && x.payroll_manager == c.employee.payroll_manager)
                if (idx<0) {
                    p.push({'supervisor':c.employee.supervisor,'payroll_manager':c.employee.payroll_manager,'count': 1, 'pending_for':pending_for});
                }else{
                    p[idx].count ++;
                }
                return p;
            }, []);


            data.forEach(x=>{
                $('#summary tbody').append(`
                <tr>
                    <td>${x.supervisor}</td>
                    <td>${x.payroll_manager}</td>
                    <td>${x.pending_for}</td>
                    <td>${x.count}</td>
                </tr>
                `)
            })

            totalAdjustments[pending_for] = count;
            $('#nAdjustments').text(Object.values(totalAdjustments).reduce((a, b) => a + b, 0))
        }
        $(function() {
            $('#tabsAdjustments li:first-child a').tab('show')

            var tableAdjustmentsOM = $('#adjustmentsOM').DataTable({
                ordering: false,
                responsive: true,
                data: [],
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
                data: [],
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

            function convertData(adjustments){
                var data = [];
                for (var employee_id in adjustments) {
                    data.push({
                        'employee_id': employee_id, // employee_id
                        'employee_name': adjustments[employee_id][0].employee
                            .full_name, // employee_name
                        'adjustments': adjustments[employee_id] // adjustments
                    });
                }
                return data;
            }

            function getAdjustments(){
                $.get('{{ route('prenomina.adjustments.pending') }}')
                .then(response=>{
                    let dataAdjustment = response;
                    if(dataAdjustment.OM.adjustments){
                        let OMAdjustments = convertData(dataAdjustment.OM.adjustments)
                        $('#adjustmentsOM').DataTable().clear().rows.add(OMAdjustments).draw();
                        $('#om-tab>span').text(dataAdjustment.OM.count);
                        summaryAdjustments(dataAdjustment.OM.adjustments,'OM',dataAdjustment.OM.count)
                    }
                    if(dataAdjustment.Supervisor.adjustments){
                        let SupervisorAdjustments = convertData(dataAdjustment.Supervisor.adjustments)
                        $('#adjustmentsSupervisor').DataTable().clear().rows.add(SupervisorAdjustments).draw();
                        $('#supervisor-tab>span').text(dataAdjustment.Supervisor.count);
                        summaryAdjustments(dataAdjustment.Supervisor.adjustments,'Supervisor',dataAdjustment.Supervisor.count)
                    }

                    
                })
            }
            getAdjustments();
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
                getAdjustments();
            });

        })
    </script>
@endpush
