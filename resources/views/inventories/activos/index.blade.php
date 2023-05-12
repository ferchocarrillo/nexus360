@extends('adminlte::page')
@section('title_postfix', ' | Activos')
@section('content')
@section('content_header')
<h1 class="d-inline">Lista de Activos Fijos</h1>
@stop
@section('content')
<div class="form-group">
@can('haveaccess','activos.create')
<a href="{{route('activos.create')}}"
    class="btn btn-primary"
    >Nuevos Activos
</a>
@endcan

@can('haveaccess','activos.list')
<a href="{{route('activos.list')}}"
    class="btn btn-primary"
    >Ver Activos
</a>
@endcan
@can('haveaccess','activos\asignacion')
<a href="{{url('inventories/asignacion/create')}}"
    class="btn btn-primary"
    >Asignacion de Activos
</a>
@endcan

@can('haveaccess','activos\bajas')
<a href="{{url('inventories/bajas/create')}}"
    class="btn btn-primary"
    >Bajas de Stock
</a>
@endcan

@can('haveaccess','activos\cambios')
<a href="{{url('inventories/cambios/create')}}"
    class="btn btn-primary"
    >Cambios en Stock
</a>
@endcan

@can('haveaccess','activos\traslado')
<a href="{{url('inventories/traslado/create')}}"
    class="btn btn-primary"
    >Traslado de Stock
</a>
@endcan

@can('haveaccess','activos\consulta')
<a href="{{url('inventories\consulta')}}"
    class="btn btn-primary"
    >Consulta de Stock
</a>
@endcan
</div>

</div>
<form action="{{ url('inventories/activos')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
    {{csrf_field()}}
    <div class="container">
                    </td>
                    </tr>
                    </tbody>
                </table>
@stop
<br>
<button class= "float-right"><img src="\img\diskette.png" alt=""  width="30px"></button>
</form>

