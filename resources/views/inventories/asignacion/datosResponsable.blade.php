<div class="card">
    <div class="card-header">
        <h1 class="card-title">Datos Responsable</h1>
        <button type="button" data-toggle="modal" data-target="#modalEspecificaciones"
            class="btn btn-success float-right" id="btnAdd">
            Agregar Activo
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" value="{{ $employee->full_name }}" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Cargo</label>
                    <input type="text" value="{{ $employee->position }}" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Telefono</label>
                    <input type="text" value="{{ $employee->phone_number }}" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Campaña</label>
                    <input type="text" value="{{ $employee->campaign }}" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Supervisor</label>
                    <input type="text" value="{{ $employee->supervisor }}" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Wave</label>
                    <input type="text" value="{{ $employee->wave }}" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Site</label>
                    <input type="text" value="{{ $employee->site }}" class="form-control" readonly />
                </div>
            </div>
        </div>
    </div>
</div>
