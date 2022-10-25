@extends('adminlte::page')

@section('title_postfix', ' | Prenomina Admin')

@section('css')
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

            function save() {
                console.log(positions);
                axios.post('/prenomina/admin/savepositions', {
                        positions
                    })
                    .then(res => {
                        console.log(res);
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
                save()
            })
            $(document).on('click', '.delete', function(e) {
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
                        save()
                    }
                })
            })
            listPositions()
        })
    </script>
@endpush
