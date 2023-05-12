<input type="hidden" class="inpArticulo" name="articulo_nombre" value="{{$articulo->articulo}}">
<input type="hidden" class="inpArticulo" name="id_articulo" id="id_articulo" value="{{$articulo->id}}">
@foreach ($articulo->atributos as $atributo)
<div class="from-group">
    <label>{{$atributo->atributo}}</label>
    @if(count($atributo->especificaciones))
        <select class="inpArticulo custom-select" name="{{$atributo->atributo}}">
            <option value selected disabled> -- </option>
            @foreach($atributo->especificaciones as $especificacion)
                <option value="{{$especificacion->especificacion}}">{{$especificacion->especificacion}}</option>
            @endforeach
        </select>
    @else
        <input type="text" class="inpArticulo form-control" name="{{$atributo->atributo}}" id="{{$atributo->atributo}}">
    @endif
</div>
@endforeach


