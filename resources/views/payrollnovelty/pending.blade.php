@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Control de Novedades')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
@stop


@section('content_header')
<h1 class="d-inline">Control de Novedades</h1>
<a href="/payrollnovelty" class="btn btn-sm btn-outline-primary float-right"> <i class="fa fa-search" ></i>  Novedades</a>
@stop

@section('content')


<div class="card">
    <div class="card-header">
        <h1 class="card-title">Pendientes por grabar</h1>
        @can('payrollnovelty.flatfile')            
        <div class="float-right">
            <button class="btn btn-sm btn-primary" id="btnSaveNovasoft">Grabar en Novasoft</button>
        </div>
        @endcan
    </div>
    <div class="card-body">

        <div class="table-responsive">
        <table class="table table-sm" id="table-novelties">
            <thead>
                <tr>
                    <th class="text-nowrap">CON</th>
                    <th class="text-nowrap">ID EMPLEADO</th>
                    <th class="text-nowrap">ETIQUETA</th>
                    <th class="text-nowrap">CONT</th>
                    <th class="text-nowrap" width="800">DX</th>
                    <th class="text-nowrap">FEC INICIO</th>
                    <th class="text-nowrap">FEC FIN</th>
                    <th class="text-nowrap">D/H</th>
                    <th class="text-nowrap">PROR</th>
                    <th class="text-nowrap" width="800">ESTADO / ENTIDAD</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($novelties as $novelty)
                <tr>
                    <td class="text-nowrap">#{{$novelty->id}}</td>
                    <td class="text-nowrap">{{$novelty->national_id}}</td>
                    <td class="text-nowrap">{{$novelty->tag}}</td>
                    <td class="text-nowrap">{{$novelty->contingency}}</td>
                    <td class="">{{$novelty->cie10}} - {{$novelty->cie10_description}}</td>
                    <td class="text-nowrap">{{$novelty->start_date}}</td>
                    <td class="text-nowrap">{{$novelty->end_date}}</td>
                    <td class="text-nowrap">{{$novelty->days_hours}}</td>
                    <td class="text-nowrap">{{($novelty->extension==0?'NO':($novelty->extension==1?'SI':''))}} <span>-{{$novelty->extension_id}} </span> </td>
                    <td class="">{{$novelty->status}} / {{$novelty->eps}}</td>
                    <td><a href="/payrollnovelty/{{$novelty->id}}" class="btn btn-info btn-sm" target="_blank" rel="noopener noreferrer"><i class="fas fa-eye"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

@can('payrollnovelty.flatfile')
<div class="modal fade" id="modalFlatFile" tabindex="-1" role="dialog" aria-labelledby="modalFlatFileLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadown">
            <div class="modal-header">
                <h5 class="modal-title">Crear Archivo Plano</h5>
            </div>
            <div class="modal-body">
                <div class="form-group text-center">
                    <a href="/payrollnovelty/downloadflatfile" class="btn btn-info text-white">
                        <i class="fas fa-download"></i>   Descargar Archivo Plano
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="applyFlatFile">Cambiar Etiqueta de Novedades</button>
            </div>
        </div>
    </div>
</div>
@endcan

@stop

@push('js')
<script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>

<script>
    $(document).ready(function(){

        $('#table-novelties').DataTable({
            'order': [[5,'asc']]
        });
    })
</script>

@can('payrollnovelty.flatfile')
<script>
    $(document).ready(function(){

        $('#btnSaveNovasoft').click((e)=>{
            $('#modalFlatFile').modal('show');
        })

        $('#applyFlatFile').click(e=>{
            swal
            .fire({
                title: "Las novedades están grabadas en Novasoft ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: "Cancelar"
            })
            .then(result => {
                $('#modalFlatFile').modal('hide');
                if (result.value) {
                    $('#logoLoading').modal('show');
                    axios.post("/payrollnoveelty/updateTags")
                    .then(response => {
                        console.log(response.data)
                        if(!response.data){
                            swal.fire({
                                icon: 'error',
                                title: 'No se grabaron novedades',
                            })
                            setTimeout(() => {
                                $('#logoLoading').modal('hide');
                            }, 1000);
                        }else{
                            location.reload()
                        }
                    });
                }
            });
        })
    })
</script>

@endcan
@endpush