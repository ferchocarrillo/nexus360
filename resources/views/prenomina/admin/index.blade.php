@extends('adminlte::page')

@section('title_postfix', ' | Prenomina Admin')

@section('css')
<style>
    #table-configs th{
        text-transform: capitalize;
    }
</style>
@stop

@section('content_header')
    <h1 class='d-inline'>Prenomina Admin</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-info aling-middle">
                    <h1 class="card-title">Positions</h1>
                    <button class="btn btn-sm btn-info rounded-circle float-right" data-toggle="modal"
                        data-target="#modalPosition">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="card-body p-2">
                    <ul id="positions" class="list-group list-group-flush"></ul>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card shadow" id="configs">
                <div class="card-header bg-info aling-middle">
                    <h1 class="card-title">Configs</h1>
                    <button class="btn btn-sm btn-info rounded-circle float-right" id="btnSaveConfigs" disabled>
                        <i class="fas fa-save"></i>
                    </button>
                </div>
                <div class="card-body p-2">
                    <table class="table table-borderless" id="table-configs">
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Start Modal Positions --}}
    <div class="modal fade" id="modalPosition" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title">Add Position</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formAddPosition">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position" autofocus required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="subbmit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Positions --}}

@stop
@push('js')
    <script>
        $(document).ready(e => {
            let positions = @json($positions);
            const configs = @json($configs);
            let configsUpdates = [];

            function listPositions() {
                positions.sort()
                let positionsHTML = positions.map((p, idx) => {
                    return `<li class='list-group-item'>
                     <span>${p}</span>
                     <button class="btn btn-sm btn-outline-danger rounded-circle float-right delete" data-id="${idx}"><i class="fas fa-trash-alt"></i></button>
                     </li>`
                })
                $('#positions').html(positionsHTML)
            }

            function savePositions() {
                axios.post('/prenomina/admin/savepositions', {
                        positions
                    })
                    .then(res => {
                        
                    })
            }
            $('#modalPosition').on('shown.bs.modal', function() {
                $('#position').focus();
            })
            $('#formAddPosition').submit(e => {
                e.preventDefault()
                let position = e.target.elements['position'].value;
                position = position.trim()
                if (!position || positions.includes(position)) {
                    alert('Invalid Position')
                    return
                }
                positions.push(position);
                listPositions()
                e.target.elements['position'].value = ''
                $('#modalPosition').modal('hide')
                savePositions()
            })
            $(document).on('click', '#positions .delete', function(e) {
                let id = e.currentTarget.dataset.id
                let position = positions[id]
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        positions.splice(id, 1)
                        listPositions()
                        swal.fire(
                            'Deleted!',
                            `The "${position}" position has been deleted.`,
                            'success'
                        )
                        savePositions()
                    }
                })
            })

            function listConfigs(){
                
                let configsHTML = configs.map((c, idx) => {
                    return `<tr>
                        <th>${c.name.replace('_',' ')}</th>
                        <td>
                            <input type="text" class="form-control form-control-sm config" data-id="${c.id}" value="${c.value}">
                        </td>
                    </tr>`
                })
                $('#table-configs tbody').html(configsHTML)
            }

            $(document).on('keyup', '#table-configs .config', function(e) {
                let id = e.currentTarget.dataset.id
                let configVal = $(e.currentTarget).val()
                let config = configs.find(c=>c.id==id);
                if(config){
                    let configIdx = configsUpdates.findIndex(c=>c.id==id)
                    if(config.value != configVal){                    
                        config = {...config}
                        config.value = configVal

                        if(configIdx>=0){
                            configsUpdates[configIdx] = config
                        }else{
                            configsUpdates.push(config)
                        }
                    }else if(configIdx>=0){
                        configsUpdates.splice(configIdx,1)
                    }
                }
                if(configsUpdates.length){
                    $('#btnSaveConfigs').prop('disabled',false)
                }else{
                    $('#btnSaveConfigs').prop('disabled',true)
                }
            })

            $('#btnSaveConfigs').click(e=>{
                if(configsUpdates.length){
                    swal.fire({
                        title: 'Do you want to save the changes?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            return axios.post('/prenomina/admin/saveconfigs', {configsUpdates})
                            .then(res => {
                                swal.fire('Saved!', '', 'success')
                                configs.forEach(c=>{
                                    let config = configsUpdates.find(cu=>cu.id==c.id)
                                    if(config){
                                        c.value = config.value
                                    }
                                })
                                configsUpdates = [];
                                $('#btnSaveConfigs').prop('disabled',true)
                                return res
                            }).catch(error => {
                                swal.showValidationMessage(
                                `Request failed: ${error}`
                                )
                            })
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.value) {
                            swal.fire('Saved!', '', 'success')
                        }
                    })
                }
            })
            

            listConfigs()
            listPositions()
        })
    </script>
@endpush
