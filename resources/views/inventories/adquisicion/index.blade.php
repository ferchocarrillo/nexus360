@extends('adminlte::page')
@section('title_postfix', ' | Adquisiciones')
@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Kaizen.css') }}">
@stop
@section('content_header')
    <h1>Compras y Adquisiciones</h1>
@stop
@section('content')
    <div class="card" style="width: 120px">
        @can('haveaccess', 'adquisicion.create')
            <a href="{{ route('adquisicion.create') }}" class="badge badge-primary float-right">Nueva Compra
            </a>
            <br><br>
        @endcan
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#tipo_entrada').on('change', function() {
                var tEntrada = $(this).val();
                if (tEntrada == 'Nuevo hallazgo') {
                    // Cambio Estado
                    $('#estado option').each(function() {
                        if ($(this).val() != 'Usado') {
                            $(this).hide()
                        } else {
                            $(this).show()
                        }
                    })
                    $('#estado').val('Usado');
                    // Cambio tipo Requerimiento
                } else if (tEntrada == 'Nueva compra') {
                    $('#estado option').each(function() {
                        if ($(this).val() != 'Nuevo') {
                            $(this).hide()
                        } else {
                            $(this).show()
                        }
                    })
                    $('#estado').val('Nuevo');
                } else {
                    $('#estado option').each(function() {
                        $(this).show()
                    })
                    $('#estado').val('');
                }
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#tipo_entrada').on('change', function() {
                var tEntrada = $(this).val();
                if (tEntrada == 'Nuevo hallazgo') {
                    // Cambio Estado
                    $('#tipo_requerimiento option').each(function() {
                        if ($(this).val() != 'Ninguna') {
                            $(this).hide()
                        } else {
                            $(this).show()
                        }
                    })
                    $('#tipo_requerimiento').val('Ninguna');
                    // Cambio tipo Requerimiento
                } else if (tEntrada == 'Nueva compra') {
                    $('#tipo_requerimiento option').each(function() {
                        if ($(this).val() != 'Capex') {
                            $(this).hide()
                        } else {
                            $(this).show()
                        }
                    })
                    $('#tipo_requerimiento').val('Orden de Compra');
                } else {
                    $('#tipo_requerimiento option').each(function() {
                        $(this).show()
                    })
                    $('#tipo_requerimiento').val('');
                }
            })
        })
    </script>
    <script>
        $("#nit").onchange(function() {
            $.ajax({
                url: "proveedores/" + id,
                type: 'GET',
                success: function(result) {
                    $("#NombreEmpresa").val(result.NombreEmpresa);
                }
            })
        });
    </script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery('#ajaxSubmit').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/inventories/proveedores') }}",
                    method: 'post',
                    data: {
                        name: jQuery('#nombreEmpresa').val(),
                        type: jQuery('#type').val(),
                        price: jQuery('#price').val()
                    },
                    success: function(result) {
                        jQuery('.alert').show();
                        jQuery('.alert').html(result.success);
                    }
                });
            });
        });
    </script>
@endpush
