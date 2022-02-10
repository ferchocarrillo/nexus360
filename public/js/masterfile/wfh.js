$(document).ready(function () {
    const employeeID = $('#wfh-id');
    const formWFH = document.getElementById('form-wfh');
    const divWFH = $('#wfh');
    var employeeData = {}

    employeeID.select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    employeeID.change(function () {
        divWFH.html('');
        let id = employeeID.val();
        if (id) {
            employeeData = employess.find(employee => {
                return employee.id == id
            });

            if (employeeData) {
                divWFH.html(`
                <div class="custom-control custom-switch d-inline">
                    <input type="checkbox" class="custom-control-input" id="wfh-check" ${ parseFloat(employeeData.wfh) ? 'checked' : ''}>
                    <label class="custom-control-label" for="wfh-check">WFH</label>
                </div>
                <div class="float-right">
                    <button class="btn btn-sm btn-primary" type="submit">Save</button>
                </div>
                `);
            }
        }
    })

    formWFH.addEventListener('submit', function (event) {
        event.preventDefault();
        let employee_id = employeeID.val();
        let wfh = formWFH['wfh-check'].checked;

        if (wfh != employeeData.wfh) {
            $('#logoLoading').modal('show');
            if (employee_id) {
                axios.post('/masterfile/wfh', { employee_id, wfh }).then(res => {
                    setTimeout(() => { $('#logoLoading').modal('hide'); }, 1000)
                    if(res.data.result != true){
                        alert(res.data.result);
                    }
                    let eIndex  = employess.findIndex(employee=>employee.id == employee_id)
                    employess[eIndex].wfh = (wfh ? 1 : 0);
                    employeeData = employess[eIndex];
                })
            }
        } else {
            alert("No changes to save")
        }
    })
})