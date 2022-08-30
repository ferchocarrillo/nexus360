$(function() {
    const scheduleElement = document.getElementById("schedule");
    const payrollActivitiesElement = document.getElementById("payrollActivities");

    let noveltiesEditables = ["Tiempo pendiente aprobar", "Inasistencia Hrs"];
    let payroll = {};

    let employees = [];
    let employee_id;
    let employee = {};
    let calendar = [];
    let classNovelties = {
        "Inasistencia Hrs": "table-danger",
        "Tiempo pendiente aprobar": "table-info",
        "Tiempo laborado": "",
        "Tiempo injustificado": "table-secondary",
        "Hora Extra": "table-success",
        "Reposicion Hora": "table-success",
        "Permiso Remunerado": "table-warning",
        "Permiso No Remunerado": "table-warning",
        "Error del sistema": "table-warning"
    };

    document.addEventListener("refresh_data", function(e) {
        getPayroll();
    });

    function secondstoHHMMSS(seconds) {
        if (!seconds) return "";
        var sec_num = parseInt(seconds, 10); // don't forget the second param
        var hours = Math.floor(sec_num / 3600);
        var minutes = Math.floor((sec_num - hours * 3600) / 60);
        var seconds = sec_num - hours * 3600 - minutes * 60;

        if (hours < 10) {
            hours = "0" + hours;
        }
        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        if (seconds < 10) {
            seconds = "0" + seconds;
        }
        return hours + ":" + minutes + ":" + seconds;
    }

    function getEmployees(period) {
        let [year, month, q] = period;
        let employeesSelect = $('#employees')
        $("#employeeFilter").hide();
        $("#employees")
            .val("")
            .change();

        if(employeesSelect.data('select2')){
            employeesSelect.val(null).empty().select2('destroy')
        }
        
        $("#logoLoading").modal("show");
        axios
            .post("/prenomina/getemployees", { q, month, year })
            .then(function(response) {
                data = response.data;
                employees = data.employees;

                if(employees.length){
                    
                    let employeesData = employees.map(d => {
                        return {
                            id: d.id,
                            text: d.national_id + " " + d.full_name
                        };
                    });
                    
                    calendar = data.calendar;

                    if(employees.length == 1){
                        employeesSelect.select2({
                            data: employeesData,
                        })
                        .change();
                    }else{
                        // add option for placeholder
                        employeesData.unshift({
                            id: "",
                            text: "Seleccione un empleado"
                        });

                        employeesSelect.select2({
                            placeholder: "Select Employee",
                            data: employeesData,
                            minimumInputLength: 4,
                            allowClear: true
                        })
                        .change();
                    }                        
                    
                    $("#employeeFilter").show();
                }else{
                    console.log('Employees Not Found');
                    alert('No results found')
                }

                
                // hide modal logoLoading
                setTimeout(() => {
                    $("#logoLoading").modal("hide");
                }, 1000);
            });
    }

    function getPayroll() {
        let date = $("#date").val();
        let period = $("#select_payroll")
            .val()
            .split("-");

        scheduleElement.style.display = 'none';
        scheduleElement.querySelector('.data').innerHTML = '';
        
        payrollActivitiesElement.style.display = 'none';
        payrollActivitiesElement.querySelector('.card-title>span').innerText = '';
        payrollActivitiesElement.querySelector('.data').innerHTML = '';
        
        $("#novelty")
            .html("")
            .hide();
        $("#offsetHoliday")
            .html("")
            .hide();
        $('#timeScheduledPerWeek').html("").hide();

        if (!employee_id || !date || !period) {
            return;
        }

        let [year, month, q] = period;

        // show modal logoLoading
        $("#logoLoading").modal("show");
        // get payroll
        axios
            .post("/prenomina/getpayroll", {
                q,
                month,
                year,
                date,
                employee_id
            })
            .then(function(response) {
                payroll = response.data;
                if(payroll.hrsScheduledPerWeek){
                    $('#timeScheduledPerWeek').html(`
                        <strong>Hrs Scheduled Per Week: ${(payroll.hrsScheduledPerWeek.hrs)}</strong>
                        <span class="font-weight-lighter font-italic text-muted">
                            (${payroll.hrsScheduledPerWeek.week_start} - ${payroll.hrsScheduledPerWeek.week_end})
                        </span>
                    `)
                    .show();
                }
                if (payroll.schedule) {
                    if (payroll.availableOffsetHoliday && payroll.employee_id != master_id && payroll.payroll_activities.length
                        && !payroll.calendar.closed) {
                        $(
                            `<button class="btn btn-primary"> Request Offset Holiday </button>`
                        )
                            .on({
                                click: function() {
                                    swal.fire({
                                        title: "Request Offset Holiday",
                                        // icon: "info",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Send",
                                        focusConfirm: false,
                                        html: `<input type="text" id="offsetHolidayObservations" class="swal2-input" placeholder="Observations">`,
                                        preConfirm: () => {
                                            const observations = swal
                                                .getPopup()
                                                .querySelector(
                                                    "#offsetHolidayObservations"
                                                )
                                                .value.trim();
                                            if (!observations) {
                                                swal.showValidationMessage(
                                                    `Please enter observations`
                                                );
                                            }
                                            return { observations };
                                        }
                                    }).then(result => {
                                        if (result.value) {
                                            const observations =
                                                result.value.observations;
                                            $("#logoLoading").modal("show");

                                            axios
                                                .post(
                                                    "/prenomina/adjustments/offsetholiday",
                                                    {
                                                        q,
                                                        month,
                                                        year,
                                                        date,
                                                        employee_id,
                                                        observations
                                                    }
                                                )
                                                .then(function(response) {
                                                    console.log(response.data);
                                                    getPayroll();
                                                });
                                        }
                                    });
                                }
                            })
                            .appendTo("#offsetHoliday");
                        $("#offsetHoliday").show();
                    }

                    let scheduleHTML = `
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-1"><span class="text-muted">In: </span>${payroll.schedule.in.substring(0,19)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">Out: </span>${payroll.schedule.out.substring(0,19)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">Start Break 1: </span>${!payroll.schedule.start_break1? "": payroll.schedule.start_break1.substring(0,19)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">End Break 1: </span>${!payroll.schedule.end_break1? "": payroll.schedule.end_break1.substring(0,19)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">Break Time 1: </span>${secondstoHHMMSS(payroll.schedule.break_time1)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">Start Break 2: </span>${!payroll.schedule.start_break2? "": payroll.schedule.start_break2.substring(0,19)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">End Break 2: </span>${!payroll.schedule.end_break2? "": payroll.schedule.end_break2.substring(0,19)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">Break Time 2: </span>${secondstoHHMMSS(payroll.schedule.break_time2)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">Start Break 3: </span>${!payroll.schedule.start_break3? "": payroll.schedule.start_break3.substring(0,19)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">End Break 3: </span>${!payroll.schedule.end_break3? "": payroll.schedule.end_break3.substring(0,19)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">Break Time 3: </span>${secondstoHHMMSS(payroll.schedule.break_time3)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">Total Break Time: </span>${secondstoHHMMSS(payroll.schedule.total_break_time)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">Start Lunch: </span>${!payroll.schedule.start_lunch? "": payroll.schedule.start_lunch.substring(0,19)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">End Lunch: </span>${!payroll.schedule.end_lunch? "": payroll.schedule.end_lunch.substring(0,19)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">Lunch Time: </span>${secondstoHHMMSS(payroll.schedule.lunch_time)}</li>
                        <li class="list-group-item p-1"><span class="text-muted">Schedule Time: </span>${secondstoHHMMSS(payroll.schedule.schedule_time)}</li>
                    </ul>
                    `
                    scheduleElement.querySelector('.data').innerHTML = scheduleHTML;
                    scheduleElement.style.display = null;
                }
                if (payroll.payroll_activities.length) {

                    payrollActivitiesElement.style.display = null;
                    payrollActivitiesElement.querySelector('.card-title>span').innerText = payroll.payroll_activities.length
                    
                    let activitiesRows = payroll.payroll_activities
                        .map(activity => {
                            let buttons = "";
                            let noveltyEditable = noveltiesEditables.includes(
                                activity.activity_type
                            );
                            if (noveltyEditable) {
                                // dropdown items
                                if (
                                    (!activity.adjustments.length ||
                                    activity.adjustments[
                                        activity.adjustments.length - 1
                                    ].status == "Rechazado") && activity.employee_id == master_id
                                    && !payroll.calendar.closed
                                ) {
                                    // Create
                                    buttons += `
                                        <button type="button" class="dropdown-item" data-action="create" data-toggle="modal" data-target="#adjustmentModal" data-activity-code="${activity.code}">
                                            <i class="fas fa-plus-circle"></i> Create
                                        </button>
                                    `;
                                }
                                activity.adjustments.forEach(a => {
                                    // Show
                                    buttons += `
                                    <button type="button" class="dropdown-item" data-action="show" data-toggle="modal" data-target="#adjustmentModal" data-activity-code="${activity.code}" data-adjustment-id="${a.id}">
                                        ${a.icon_status} <span class="text-muted font-italic">#${a.id}</span> ${a.status}
                                    </button>
                                    `;
                                });

                                if(buttons){
                                    buttons = `
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            ${buttons}
                                        </div>
                                    </div>
                                    `;
                                }

                                
                            }

                            return `
                            <tr class="${
                                classNovelties[activity.activity_type]
                            }">
                                <td>${activity.activity_type}</td>
                                <td>${activity.activity_name}</td>
                                <td>${activity.surcharge}</td>
                                <td>${
                                    activity.start_date
                                        ? activity.start_date.substring(0, 19)
                                        : activity.start_date
                                }</td>
                                <td>${
                                    activity.end_date
                                        ? activity.end_date.substring(0, 19)
                                        : activity.end_date
                                }</td>
                                <td>${secondstoHHMMSS(
                                    activity.total_time_in_seconds
                                )}</td>
                                <td>${buttons}</td>
                            </tr>
                            `;
                        })
                        .join("");
                    let summaryRows = payroll.summary
                        .map(activity => {
                            return `
                            <tr class="${
                                classNovelties[activity.activity_type]
                            }">
                                <td>${activity.activity_type}</td>
                                <td>${activity.surcharge}</td>
                                <td>${secondstoHHMMSS(
                                    activity.total_time_in_seconds
                                )}</td>
                            </tr>
                            `;
                        })
                        .join("");
                    let activitiesHTML = `
                    <div class="table-responsive">
                        <table class="table table-nowrap table-bordered table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Novelty</th>
                                    <th>Activity</th>
                                    <th>Surcharge</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Total Time</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                ${activitiesRows}
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h5 class="text-center"> Summary </h5>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-bordered table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Novelty</th>
                                    <th>Surcharge</th>
                                    <th>Total Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${summaryRows}
                            </tbody>
                        </table>
                    </div>
                    `;

                    payrollActivitiesElement.querySelector('.data').innerHTML = activitiesHTML;
                } else {
                    payrollActivitiesElement.querySelector('.data').innerHTML = '<div class="text-center mb-3">No activities</div>'
                }
                if (payroll.novelty) {
                    // badge novelty
                    $("#novelty")
                        .html(
                            `<span class="badge badge-danger text-uppercase p-2">${payroll.novelty.type}</span>`
                        )
                        .show();

                    if(payroll.adjustment && payroll.adjustment.status == 'Aprobado'){
                        $(`<h4 class="mb-0"><span class="badge badge-success text-uppercase p-3 w-100">
                                <i class="fas fa-calendar-check fa-lg mr-2"></i>  ${payroll.adjustment.justification}
                            </span></h4>`).appendTo("#novelty");
                    }
                        
                    if(payroll.availableJustifyAbsence){
                    
                        $(
                            `<button class="btn btn-info"><i class="fas fa-calendar-check fa-lg mr-2"></i> Justify Absense </button>`
                        )
                            .on({
                                click: function() {
                                    swal.fire({
                                        title: "Justify Absense",
                                        // icon: "info",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Send",
                                        focusConfirm: false,
                                        html: `
                                        <select class="form-control form-control-lg" id="justifyAbsenseType">
                                            <option value="" selected disabled>Justification</option>
                                            <option>Cambio de Horario Extemporaneo</option>
                                            <option>Agente olvidó Loguearse</option>
                                            <option>Usuario no creado (Agente en Entrenamiento)</option>
                                        </select>
                                        <input type="text" id="justifyAbsenseObservations" class="swal2-input" placeholder="Observations">
                                        `,
                                        preConfirm: () => {
                                            const observations = swal
                                                .getPopup()
                                                .querySelector(
                                                    "#justifyAbsenseObservations"
                                                )
                                                .value.trim();
                                            const justification = swal
                                                .getPopup()
                                                .querySelector(
                                                    "#justifyAbsenseType"
                                                )
                                                .value.trim();
                                            if (!justification){
                                                swal.showValidationMessage(
                                                    `Please enter justification`
                                                );
                                            }else if(!observations) {
                                                swal.showValidationMessage(
                                                    `Please enter observations`
                                                );
                                            }
                                            return { justification, observations };
                                        }
                                    }).then(result => {
                                        if (result.value) {
                                            const justification = result.value.justification;
                                            const observations = result.value.observations;
                                            $("#logoLoading").modal("show");

                                            axios
                                                .post(
                                                    "/prenomina/adjustments/justifyabsense",
                                                    {
                                                        'id':payroll.id,
                                                        justification,
                                                        observations
                                                    }
                                                )
                                                .then(function(response) {
                                                    getPayroll();
                                                });
                                        }
                                    });
                                }
                            })
                            .appendTo("#novelty");
                    }
                }

                // hide modal logoLoading
                setTimeout(() => {
                    $("#logoLoading").modal("hide");
                }, 1000);
            });
    }

    $("#select_payroll").on("change", function(e) {
        var period = $(this)
            .val()
            .split("-");
        if (period) getEmployees(period);
    });

    $("#date").flatpickr();

    $("#employees").on("change", function() {
        employee_id = $(this).val();

        $("#date")
            .val("")
            .change()
            .hide();
        $("#employeeData").hide();

        $("#novelty")
            .html("")
            .hide();
        $("#offsetHoliday")
            .html("")
            .hide();

        $('#timeScheduledPerWeek').html("").hide();

        if (!employee_id) return;

        employee = employees.filter(d => d.id == employee_id)[0];

        if (employee) {
            $("#date").show();
            $("#employeeData").show();
            $("#employeeData").html(`
                <table class="table table-nowrap table-borderless table-sm mb-0">
                    <tbody>
                        <tr>
                            <td><strong>Campaign: </strong>${employee.campaign}</td>
                            <td><strong>Date of hire: </strong>${employee.date_of_hire}</td>
                        </tr>
                        <tr>
                            <td><strong>Hrs per week: </strong>${employee.hrs_per_week}</td>
                            <td><strong>Lob: </strong>${employee.lob}</td>
                        </tr>
                        <tr>
                            <td><strong>Supervisor: </strong>${employee.supervisor}</td>
                            <td><strong>Day off: </strong>${employee.mandatory_rest_day}</td>
                        </tr>
                        <tr>
                            <td><strong>Compensation day: </strong>${employee.compensation_day}</td>
                        </tr>
                    </tbody>
                </table>
            `);
            $("#date").flatpickr({
                minDate: calendar[0].date,
                maxDate: calendar[calendar.length - 1].date,
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    let dateString = dayElem.dateObj.toISOString().substr(0,10);
                    let calendarDate = calendar.find(d=>d.date == dateString)

                    let day = dayElem.dateObj.getDay() || 7;
                    if (day == parseInt(employee.mandatory_rest_day)) {
                        dayElem.classList.add("dayoff");
                    }else if(calendarDate && calendarDate.holiday){
                        dayElem.classList.add("holiday");
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    instance.element.blur();
                }
            });
        }
    });

    $("#date").on("change", function() {
        getPayroll();
    });

    $("#adjustmentModal").on("show.bs.modal", function(e) {
        let button = $(e.relatedTarget);
        let action = button.data("action");
        let activity_code = button.data("activity-code");
        let adjustment_id = button.data("adjustment-id");
        let modal = $(this);

        modal.find(".data").html("");
        modal.find("#loading").show();
        modal.find("#error").hide();

        if (action === "create") {
            modal.find(".modal-title").text("Create Adjustment");

            axios
                .get(`/prenomina/adjustments/create/${activity_code}`)
                .then(response => {
                    modal.find(".data").html(response.data);
                    modal.find("#loading").hide();
                });
        } else if (action === "show") {
            modal.find(".modal-title").text("Adjustment");

            axios
                .get(`/prenomina/adjustments/${adjustment_id}`)
                .then(response => {
                    modal.find(".data").html(response.data);
                    modal.find("#loading").hide();
                });
        }
    });
});
