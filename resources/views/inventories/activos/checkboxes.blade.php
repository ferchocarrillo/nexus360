@section('content')
<form action="{{ url('inventories/activos')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
    {{csrf_field()}}
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    {{ Form::label('Articulo', 'Articulo') }}
                    {{ Form::text('articulo', null ,['class' => 'form-control ' . ($errors->has('articulo') ? 'is-invalid' : '' ),'required']) }}
                    @include('errors.errors', ['field' => 'articulo'])
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    {{ Form::label('Codigo', 'Codigo') }}
                    {{ Form::text('codigo', null ,['class' => 'form-control ' . ($errors->has('codigo') ? 'is-invalid' : '' ),'required']) }}
                    @include('errors.errors', ['field' => 'codigo'])
                </div>
            </div>
        </div>
    </div>
<div class="card-group">
    {{ Form::label('atributos', 'Atributos') }}
    <div class="col">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('tipo_adaptador', 1)}}
                            {{ Form::label('tipo_adaptador', 'Tipo de adaptador')}}
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('T_E_Cable_Video_PANTALLA', 1)}}
                            {{ Form::label('T_E_Cable_Video_PANTALLA', 'Tipo extención cable video pantalla')}}
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('T_E_Cable_Video_TELEVISOR', 1)}}
                            {{ Form::label('T_E_Cable_Video_TELEVISOR', 'Tipo extención cable video televisor')}}
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('longitud', 1)}}
                            {{ Form::label('longitud', 'Longitud')}}
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('tipo_silla', 1)}}
                            {{ Form::label('tipo_silla', 'Tipo silla')}}
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('tipo_microfono', 1)}}
                            {{ Form::label('tipo_microfono', 'Tipo microfono')}}
                        </div>
                    </div>
                </div>
    </div>
    <div class="col">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('marca_mouse_teclado', 1)}}
                            {{ Form::label('marca_mouse_teclado', 'Marca mouse teclado')}}
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('marca', 1)}}
                            {{ Form::label('marca', 'Marca')}}
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('marca_ventilador', 1)}}
                            {{ Form::label('marca_ventilador', 'Marca ventilador')}}
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('modelo', 1)}}
                            {{ Form::label('modelo', 'Modelo')}}
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('serial', 1)}}
                            {{ Form::label('serial', 'Serial')}}
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{Form::checkbox('velocidad', 1)}}
                            {{ Form::label('velocidad', 'Velocidad')}}
                        </div>
                    </div>
                </div>
    </div>
    <div class="col">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('tipo_tv', 1)}}
                        {{ Form::label('tipo_tv', 'Tipo TV')}}
                    </div>
                </div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('licencia_windows', 1)}}
                        {{ Form::label('licencia_windows', 'Licencia Windows')}}
                    </div>
                </div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('windows', 1)}}
                        {{ Form::label('windows', 'Windows')}}
                    </div>
                </div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('tamaño_tv', 1)}}
                        {{ Form::label('tamaño_tv', 'Tamaño TV')}}
                    </div>
                </div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('tamaño_pantalla', 1)}}
                        {{ Form::label('tamaño_pantalla', 'Tamaño pantalla')}}
                    </div>
                </div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('tipo_disco_duro', 1)}}
                        {{ Form::label('tipo_disco_duro', 'Tipo disco duro')}}
                    </div>
                </div>
            </div>
    </div>
    <div class="col">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('capacidad_disco_duro', 1)}}
                        {{ Form::label('capacidad_disco_duro', 'Capacidad disco duro')}}
                    </div>
                </div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('procesador', 1)}}
                        {{ Form::label('procesador', 'Procesador')}}
                    </div>
                </div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('tipo_memoria_ram', 1)}}
                        {{ Form::label('tipo_memoria_ram', 'Tipo memoria RAM')}}
                    </div>
                </div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('colores', 1)}}
                        {{ Form::label('colores', 'Colores')}}
                    </div>
                </div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('tipo_de_conexion', 1)}}
                        {{ Form::label('tipo_de_conexion', 'Tipo de conexion')}}
                    </div>
                </div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        {{Form::checkbox('tarjeta_grafica', 1)}}
                        {{ Form::label('tarjeta_grafica', 'Tarjeta grafica')}}
                    </div>
                </div>
            </div>
    </div>
</div>
