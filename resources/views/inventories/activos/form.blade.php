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
</div>
<h3>Lista de Atributos</h3>
<div class="form-group">
    <ul class="list-unstyled">
        @foreach($atributos as $atributo)
        <li>
            <label>
                {{ Form::checkbox('atributos[]', $atributo->id, null) }}
                {{ $atributo->atributo }}
            </label>
        </li>
        @endforeach
    </ul>
</div>
<div class="form-group">
    {{ Form::submit('Guardar Articulo', ['class' => 'btn btn-sm btn-primary','onclick="showAlert()"']) }}
</div>
<script>
    function showAlert(){
        swal
        .fire({
        title: "Datos registrados correctamente",
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

