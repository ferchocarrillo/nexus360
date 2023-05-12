    <div class="col-md-4 float-right">
        <a href="{{route('activos.list')}}"
        class="btn btn-info"
        >Ver Activos
    </a>
    </div>


<div class="row">
    <div class="form-group col-md-6">
        <div class="col-md-12">
            <div class="card">
                {{ Form::label('Articulo', 'Articulo') }}
                {{ Form::text('articulo', null ,['class' => 'form-control ' . ($errors->has('articulo') ? 'is-invalid' : '' ),'required']) }}
                @include('errors.errors', ['field' => 'articulo'])
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-12">
            <div class="card">
                {{ Form::label('Codigo', 'Codigo') }}
                {{ Form::text('codigo', null ,['class' => 'form-control ' . ($errors->has('codigo') ? 'is-invalid' : '' ),'required']) }}
                @include('errors.errors', ['field' => 'codigo'])
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <div class="card">
                    <input class="form-check-input" type="checkbox" id="anulado" name="anulado" value="activo">
                    <label class="form-check-label" for="anulado">Activar</label>
                    @include('errors.errors', ['field' => 'anulado'])
            </div>
        </div>
    </div>
</div>
    <div class="form-group">
        {{ Form::submit('Registrar cambios', ['class' => 'btn btn-sm btn-primary' ,'onclick="showAlert()"']) }}
    </div>


<script>
    function showAlert(){
        swal
        .fire({
        title: "Articulo Activado Correctamente",
        icon: "success",
        showCancelButton: false,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
        })
        .then((result) => {
        console.log("OK");
        });
        }

</script>
