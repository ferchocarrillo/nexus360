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
