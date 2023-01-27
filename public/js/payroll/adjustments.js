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


var totalAdjustments = {};
function summaryAdjustments(adjustments, pending_for, count) {
    let data = adjustments.reduce((p, c) => {
        let idx = p.findIndex(
            x =>
                x.supervisor == c.employee.supervisor &&
                x.payroll_manager == c.employee.payroll_manager
        );
        if (idx < 0) {
            p.push({
                supervisor: c.employee.supervisor,
                payroll_manager: c.employee.payroll_manager,
                count: 1,
                pending_for: pending_for
            });
        } else {
            p[idx].count++;
        }
        return p;
    }, []);

    data = data.sort((a, b) => b.count - a.count);

    data.forEach(x => {
        $("#summary tbody").append(`<tr>
          <td>${x.supervisor}</td>
          <td>${x.payroll_manager}</td>
          <td>${x.pending_for}</td>
          <td>${x.count}</td>
          </tr>`);
    });

    totalAdjustments[pending_for] = count;
    $("#nAdjustments").text(
        Object.values(totalAdjustments).reduce((a, b) => a + b, 0)
    );
}
$(function() {
    $('#tabsAdjustments li:first-child a').tab('show')

    var collapsedGroupsSupervisor = {};
    var topSupervisor = "";
    var collapsedGroupsOM = {};
    var topOM = "";

    var tableAdjustmentsOM = $("#adjustmentsOM").DataTable({
        responsive: true,
        paging: false,
        data: [],
        columns: [
            { data: "employee.supervisor", title: "Supervisor" },
            { data: "employee.full_name", title: "Employee" },
            { data: "date", title: "Date", className: "pl-5" },
            { data: "adjustment_type", title: "Adjustment Type" },
            { data: "justification", title: "Justification" },
            {
                data: "",
                render: function(data, type, row, meta) {
                    return `
                        <button class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                                data-target="#adjustmentModal"
                                data-activity-code="${row.activity_code}"
                                data-activity-id="${row.id}">
                                <i class="fas fa-eye"></i>
                            </button>
                    `;
                }
            }
        ],
        order: [
            [0, "asc"],
            [1, "asc"],
            [2, "asc"]
        ],
        columnDefs: [
            {
                targets: [0, 1],
                visible: false
            }
        ],
        rowGroup: {
            dataSrc: ["employee.supervisor", "employee.full_name"],
            startRender: function (rows, group, level) {
              var all;
              var approveall = null;
              var employee_id = null;
      
              if (level === 0) {
                topOM = group;
                all = group;
              } else {
                all = topOM + group;
                // if parent collapsed, nothing to do
                if (!!collapsedGroupsOM[topOM]) {
                  return;
                }
                employee_id = rows.data()[0].employee_id;
                approveall = `<td>
                <button class="btn btn-sm btn-outline-secondary btn-approve-all" data-employee-id="${employee_id}">
                <i class="fas fa-check-double"></i> Approve All
                </button>
                </td>`;
              }
              if (collapsedGroupsOM[all] === undefined) {
                collapsedGroupsOM[all] = true;
              }
              var collapsed = !!collapsedGroupsOM[all];
      
              rows.nodes().each(function (r) {
                r.style.display = collapsed ? "none" : "";
              });
              return $("<tr/>")
                  .append(
                      `<td colspan="${approveall ? "3" : "4"}">
                        <a href="#" class="btn-link">
                        <i class="fas fa-chevron-${collapsed ? 'right' : 'down'}"></i>
                        ${group}
                        <span class="badge badge-pill badge-info">${rows.count()}</span>
                        </a>
                        </td>
                        ${approveall}`
                  )
                  .attr("data-name", all)
                  .toggleClass("collapsed", collapsed);
            },
          },

    });

    $("#adjustmentsOM tbody").on("click", "tr.dtrg-start td:nth-child(1)", function (e) {
        e.preventDefault()
        var name = $(this).parent('tr').data("name");
        collapsedGroupsOM[name] = !collapsedGroupsOM[name];
        tableAdjustmentsOM.draw(false);
    });
    var tableAdjustmentsSupervisor = $("#adjustmentsSupervisor").DataTable({
        responsive: true,
        paging: false,
        data: [],
        columns: [
            { data: "employee.supervisor", title: "Supervisor" },
            { data: "employee.full_name", title: "Employee" },
            { data: "date", title: "Date", className: "pl-5" },
            { data: "adjustment_type", title: "Adjustment Type" },
            { data: "justification", title: "Justification" },
            {
                data: "",
                render: function(data, type, row, meta) {
                    return `
                  <button class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                          data-target="#adjustmentModal"
                          data-activity-code="${row.activity_code}"
                          data-activity-id="${row.id}">
                          <i class="fas fa-eye"></i>
                      </button>
              `;
                }
            }
        ],
        order: [
            [0, "asc"],
            [1, "asc"],
            [2, "asc"]
        ],
        columnDefs: [
            {
                targets: [0, 1],
                visible: false
            }
        ],
        rowGroup: {
            dataSrc: ["employee.supervisor", "employee.full_name"],
            startRender: function(rows, group, level) {
                var all;
                if (level === 0) {
                    topSupervisor = group;
                    all = group;
                } else {
                    all = topSupervisor + group;
                    // if parent collapsed, nothing to do
                    if (!!collapsedGroupsSupervisor[topSupervisor]) {
                        return;
                    }
                }
                if (collapsedGroupsSupervisor[all] === undefined) {
                    collapsedGroupsSupervisor[all] = true;
                }
                var collapsed = !!collapsedGroupsSupervisor[all];

                rows.nodes().each(function(r) {
                    r.style.display = collapsed ? "none" : "";
                });
                return $("<tr/>")
                    .append(
                        `<td colspan="4">
                        <a href="#" class="btn-link">
                        <i class="fas fa-chevron-${collapsed ? 'right' : 'down'}"></i>
                        ${group}
                        <span class="badge badge-pill badge-info">${rows.count()}</span>
                        </a>
                        </td>`
                    )
                    .attr("data-name", all)
                    .toggleClass("collapsed", collapsed);
            }
        }
    });

    $("#adjustmentsSupervisor tbody").on("click", "tr.dtrg-start  td:nth-child(1)", function (e) {
        e.preventDefault()
        var name = $(this).parent('tr').data("name");
        collapsedGroupsSupervisor[name] = !collapsedGroupsSupervisor[name];
        tableAdjustmentsSupervisor.draw(false);
    });

    function getAdjustments(){
        $("#logoLoading").modal("show");
        $.get(urlGetAdjustments)
        .then(response=>{
            let dataAdjustment = response;
            $("#summary tbody").empty()
            if(dataAdjustment.OM.adjustments){
                let OMAdjustments = dataAdjustment.OM.adjustments.sort(
                    (a, b) => {
                        if (a.employee.supervisor < b.employee.supervisor) {
                            return -1;
                        } else if (
                            a.employee.supervisor > b.employee.supervisor
                        ) {
                            return 1;
                        }
                        return 0;
                    }
                );
                $('#adjustmentsOM').DataTable().clear().rows.add(OMAdjustments).draw();
                $('#om-tab>span').text(dataAdjustment.OM.count);
                summaryAdjustments(dataAdjustment.OM.adjustments,'OM',dataAdjustment.OM.count)
            }
            if(dataAdjustment.Supervisor.adjustments){
                let SupervisorAdjustments = dataAdjustment.Supervisor.adjustments.sort(
                    (a, b) => {
                        if (a.employee.supervisor < b.employee.supervisor) {
                            return -1;
                        } else if (
                            a.employee.supervisor > b.employee.supervisor
                        ) {
                            return 1;
                        }
                        return 0;
                    }
                );
                $('#adjustmentsSupervisor').DataTable().clear().rows.add(SupervisorAdjustments).draw();
                $('#supervisor-tab>span').text(dataAdjustment.Supervisor.count);
                summaryAdjustments(dataAdjustment.Supervisor.adjustments,'Supervisor',dataAdjustment.Supervisor.count)
            }

            // hide modal logoLoading
            setTimeout(() => {
                $("#logoLoading").modal("hide");
            }, 1000);
        })
    }
    getAdjustments();

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
            preConfirm: ()=>{
                swal.showLoading()
            }
        }).then(result => {
            if (result.value) {        
                btn.prop('disabled', true);
                axios.post('/prenomina/adjustments/approveall', {
                    employee_id: employee_id
                })
                .then(response => {
                    getAdjustments();
                    swal.fire({
                        title: "Approved!",
                        text: "All adjustments have been approved!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000
                    });
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

    $('#btnReload').on('click',function(e){
        getAdjustments();
    })

    document.addEventListener('refresh_data', function(e) {
        getAdjustments();
    });

})
