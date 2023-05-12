<div class="row">
    <div class="col-sm-3">
      <div class="card">
        <div class="card-body">
            {{ Form::label('tipo_entrada', 'Tipo de entrada') }}
            {{ Form::select('tipo_entrada',$tipos_de_entrada, null ,['placeholder' => '--','class' => 'custom-select ' . ($errors->has('tipo_entrada') ? 'is-invalid' : '' ),'required']) }}
            @include('errors.errors', ['field' => 'tipo_entrada'])
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card">
        <div class="card-body">
            {{ Form::label('bodega', 'Bodega') }}
            {{ Form::select('bodega',$bodega, null ,['placeholder' => '--','class' => 'custom-select ' . ($errors->has('bodega') ? 'is-invalid' : '' ),'required']) }}
            @include('errors.errors', ['field' => 'bodega'])
        </div>
      </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
              {{ Form::label('estado', 'Estado') }}
              {{ Form::select('estado', ["Nuevo"=>"Nuevo","Usado"=>"Usado"],null,['placeholder'=>'--','class' => 'custom-select ' . ($errors->has('estado') ? 'is-invalid' : '' ),'required']) }}
              @include('errors.errors', ['field' => 'estado'])
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
              {{ Form::label('tipo_requerimiento', 'Tipo Requerimiento') }}
              {{ Form::select('tipo_requerimiento',["Capex"=>"Capex","Orden de Compra"=>"Orden de Compra","Ninguna"=>"Ninguna"], null ,['placeholder'=>'--','class' => 'custom-select ' . ($errors->has('tipo_requerimiento') ? 'is-invalid' : '' ),'required']) }}

              @include('errors.errors', ['field' => 'tipo_requerimiento'])
          </div>
        </div>
      </div>
</div>
<div class="row">


</div>
<div class="row">
    <div class="col-sm-3">
      <div class="card">
        <div class="card-body">
            {{ Form::label('id_proveedor', 'NIT') }}
            {{ Form::select('id_proveedor',$nit, null ,['placeholder'=>'--','class' => 'custom-select ' . ($errors->has('id_proveedor') ? 'is-invalid' : '' ),'required']) }}

            @include('errors.errors', ['field' => 'id_proveedor'])
        </div>
      </div>
    </div>


    <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
              {{ Form::label('companyName', 'Company Name') }}

              @foreach ($companyNames as $companyName)
              {{ Form::input($companyName->companyName,['placeholder'=>'--','class' => 'custom-select ' . ($errors->has('id_proveedor') ? 'is-invalid' : '' ),'required']) }}
              @endforeach
              @include('errors.errors', ['field' => 'id_proveedor'])
          </div>
        </div>
      </div>




    <div class="col-sm-3">
      <div class="card">
        <div class="card-body">
            {{ Form::label('grupo', 'Familia') }}
            {{ Form::select('grupo',$inventories_actives_codes, null ,['placeholder' => '--','class' => 'custom-select ' . ($errors->has('grupo') ? 'is-invalid' : '' ),'required']) }}
            @include('errors.errors', ['field' => 'grupo'])
        </div>
      </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
        {{ Form::label('n_factura', 'No. Factura') }}
        {{ Form::text('n_factura', null ,['class' => 'form-control' . ($errors->has('n_factura') ? 'is-invalid' : '' )]) }}
        @include('errors.errors', ['field' => 'n_factura'])
    </div>
    </div>
</div>


    {{--  <div class="col">
        {{ Form::label('codigo', 'Codigo') }}
        {{ Form::text('codigo', null ,['class' => 'form-control ' . ($errors->has('codigo') ? 'is-invalid' : '' )]) }}
        @include('errors.errors', ['field' => 'codigo'])
    </div>  --}}
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
        {{ Form::label('descripcion', 'Descripcion') }}
        {{ Form::text('descripcion', null ,['class' => 'form-control ' . ($errors->has('descripcion') ? 'is-invalid' : '' )]) }}
        @include('errors.errors', ['field' => 'descripcion'])
    </div>
</div>
</div>
<div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        {{ Form::label('costo_unitario', 'Costo Unitario') }}
        {{ Form::text('costo_unitario', null ,['class' => 'form-control ' . ($errors->has('costo_unitario') ? 'is-invalid' : '' )]) }}
        @include('errors.errors', ['field' => 'costo_unitario'])
    </div>
</div>
</div>
    {{--  <div class="col-sm-3">
   <div class="card">
      <div class="card-body">
        {{ Form::label('anulado', 'Anulado') }}
        {{ Form::text('anulado', null ,['class' => 'form-control ' . ($errors->has('anulado') ? 'is-invalid' : '' )]) }}
        @include('errors.errors', ['field' => 'anulado'])
    </div>
</div>  --}}

    <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        {{ Form::label('numero_requerimiento', 'Numero Requerimiento') }}
        {{ Form::number('numero_requerimiento', null ,['class' => 'form-control ' . ($errors->has('numero_requerimiento') ? 'is-invalid' : '' )]) }}
        @include('errors.errors', ['field' => 'numero_requerimiento'])
    </div>
</div>
</div>


<div class="form-group">
    {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary']) }}
</div>
</div>
@push('js')
<script>
    $(document).ready(function(){
        $('#tipo_entrada').on('change',function(){
            var tEntrada = $(this).val();
            if(tEntrada=='Nuevo hallazgo'){

                // Cambio Estado
                $('#estado option').each(function(){
                    if($(this).val() != 'Usado'){
                        $(this).hide()
                    }else{
                        $(this).show()
                    }
                })
                $('#estado').val('Usado');



                // Cambio tipo Requerimiento


            }else if(tEntrada=='Nueva compra'){
                $('#estado option').each(function(){
                    if($(this).val() != 'Nuevo'){
                        $(this).hide()
                    }else{
                        $(this).show()
                    }
                })
                $('#estado').val('Nuevo');
            }else{
                $('#estado option').each(function(){
                    $(this).show()
                })
                $('#estado').val('');
            }
        })
    })
</script>
<script>
    $(document).ready(function(){
        $('#tipo_entrada').on('change',function(){
            var tEntrada = $(this).val();
            if(tEntrada=='Nuevo hallazgo'){

                // Cambio Estado
                $('#tipo_requerimiento option').each(function(){
                    if($(this).val() != 'Ninguna'){
                        $(this).hide()
                    }else{
                        $(this).show()
                    }
                })
                $('#tipo_requerimiento').val('Ninguna');
                // Cambio tipo Requerimiento
            }else if(tEntrada=='Nueva compra'){
                $('#tipo_requerimiento option').each(function(){
                    if($(this).val() != 'Capex'){
                        $(this).hide()
                    }else{
                        $(this).show()
                    }
                })
                $('#tipo_requerimiento').val('Orden de Compra');
            }else{
                $('#tipo_requerimiento option').each(function(){
                    $(this).show()
                })
                $('#tipo_requerimiento').val('');
            }
        })
    })
</script>
@endpush
