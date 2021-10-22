@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Payroll Novelty Admin')


@section('css')
{{-- <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }} "> --}}
@stop

@section('content_header')
<h1 class="d-inline">Control de Novedades Administrador</h1>
@stop

@section('content')

@if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
<div class="row">
    <div class="col-md-6">
        
        <div class="card shadow ">
            <div class="card-header bg-info align-middle">
                <h1 class="card-title">SMLV</h1>
                @if (($smlvs_yearsAvailable))
                <button class="btn btn-sm btn-info rounded-circle float-right" data-toggle="modal" data-target="#modalSMLV">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
                @endif
            </div>
            <div class="card-body p-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Año</th>
                            <th>Salario</th>
                            <th>Salario Diario</th>
                            <th width="10px"></th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($smlvs as $salary)
                            <tr data-smlv="{{$salary}}">
                                <td>{{$salary->year}}</td>
                                <td>{{$salary->salary}}</td>
                                <td>{{$salary->daily_salary}}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary rounded-circle editSMLV">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </td>
                            </tr>
                         @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <!-- Modal -->
<div class="modal fade" id="modalSMLV" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Agregar SMLV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{route('payrollnovelty.admin.smlvSave')}}" method="POST">
                @csrf
                <div class="modal-body">
                        <input type="hidden" name="action" id="smlvAction" value="store">
                        <div class="form-group">
                            <label for="year">Año</label>
                            <select name="year" id="smlvYear" class="custom-select" required>
                                <option value="" data-available="false" disabled>Seleccione un Año</option>
                                @foreach ($smlvs_years as $year)
                                    @if (in_array($year,$smlvs_yearsAvailable))
                                        <option value="{{$year}}">{{$year}}</option>
                                    @else
                                    <option value="{{$year}}" data-available="false" disabled>{{$year}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="salary">SMLV</label>
                            <input type="number" class="form-control" id="smlvSalary" name="salary" min="0" required>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="subbmit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@stop
@push('js')
<script>
    $(document).ready(function(){
        $('.editSMLV').click(function(e){
            var data = $(this).closest('tr').data('smlv');
            $('#smlvYear').val(data.year);
            $('#smlvYear option').attr('disabled','disabled')
            $('#smlvYear option:selected').removeAttr('disabled');
            $('#smlvSalary').val(data.salary);
            $('#smlvAction').val('update');
            $('#modalSMLV .modal-title').text('Editar SMLV '+data.year)
            $('#modalSMLV').modal('show')
        })

        $('#modalSMLV').on('hidden.bs.modal', function (e) {
            $('#modalSMLV .modal-title').text('Agregar SMLV');
            $("#smlvYear").val('');
            $("#smlvSalary").val('');
            $('#smlvYear option').attr('disabled','disabled')
            $('#smlvYear option:not([data-available="false"])').removeAttr('disabled');
            $('#smlvAction').val('store');
        })
    })
</script>


@endpush