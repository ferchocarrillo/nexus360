{{--  <br>
<strong>Codigo: </strong>{{ $articulo->codigo}}
<br>
@foreach ($articulo->atributos as $atributo)
<div class="from-group">
    <label>{{$atributo->atributo}}</label>
    @if(count($atributo->especificaciones))
        <select class="custom-select" name="atributos[{{$atributo->atributo}}]" id="atributos[{{$atributo->atributo}}]">
            <option value selected disabled> -- </option>
            @foreach($atributo->especificaciones as $especificacion)
                <option value="{{$especificacion->especificacion}}">{{$especificacion->especificacion}}</option>
            @endforeach
        </select>
        {{ Form::label($'obsevaciones', $'obsevaciones')}}
        { Form::textarea('obsevaciones', null, ['col:3']) }
    @else
        <input type="text" class="form-control" name="atributos[{{$atributo->atributo}}]" id="atributos[{{$atributo->atributo}}]">
    @endif
</div>
@endforeach  --}}

<strong>Nombre: </strong>{{ $articulos->articulo}}<br>
<input type="hidden" id="articulo" name="articulo" >




<script>
{{--  document.getElementById('atributos[{{$atributo->atributo}}]')  --}}
document.getElementById('atributos[{{$atributo->atributo}}]')



</script>
