@extends('adminlte::page')


@section('title_postfix', ' | Report KPIS')

@section('content_header')
<div class="row align-items-center">
    <div class="col-md-6">
        <h1 class="d-inline">Report KPIS (Today)</h1>
    </div>


</div>

@stop


@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
@endsection



@section('content')
<div class="container">
        <div class="row mb-2">
          <div class=" col-md-4">
            <select class="form-control form-control-sm" name="wave" id="wave">
              <option value="">Select wave</option>
              @foreach ($waves as $wave)
            <option value="{{$wave->Wave}}">{{$wave->Wave}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-2">
          <label for="groupby" class="col-sm-1 col-form-label">Group by </label>
          <div class="form-inline col-sm-9">
            <div class="custom-control custom-switch mr-4">
              <input class="custom-control-input" type="checkbox" id="checkAgent" name="checkAgent" value="option1">
              <label class="custom-control-label" for="checkAgent">Agent</label>
            </div>
            <div class="custom-control custom-switch mr-4">
              <input class="custom-control-input" type="checkbox" id="checkSupervisor" name="checkSupervisor" value="option2">
              <label class="custom-control-label" for="checkSupervisor">Supervisor</label>
            </div>
            <div class="custom-control custom-switch mr-4">
              <input class="custom-control-input" type="checkbox" id="checkOM" name="checkOM" value="option2">
              <label class="custom-control-label" for="checkOM">OM</label>
            </div>
            <div class="custom-control custom-switch">
              <input class="custom-control-input" type="checkbox" id="checkLOB" name="checkLOB" value="option2">
              <label class="custom-control-label" for="checkLOB">LOB</label>
            </div>
          </div>
          <div class="col-sm-2 d-flex justify-content-end">
            <button type="submit" class="btn btn-sm btn-primary btn-search"><i class="fas fa-search" aria-hidden="true"></i> Search</button>
          </div>
        </div>


        <div id="result"></div>
</div>



@stop

@push('js')

<script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>

<script type="text/javascript" src="{{ asset('vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.colVis.min.js') }} "></script>

<script>
    $(document).ready(function () {    
        $('.btn-search').click(function (e) { 
            e.preventDefault();
        
            $('#logoLoading').modal('show');
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var dataForm = {
                'wave': $("#wave").val(),
                'checkAgent': $('#checkAgent').prop('checked'),
                'checkSupervisor': $('#checkSupervisor').prop('checked'),
                'checkOM': $('#checkOM').prop('checked'),
                'checkLOB': $('#checkLOB').prop('checked')
            }

            fetch('/enercare/reports/kpis',{ 
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            credentials: "same-origin",
            body: JSON.stringify(dataForm),
            method: 'POST' 
            })
            .then((data)=> {
            data.text().then(function(text){

                setTimeout(() => {
                    $('#logoLoading').modal('hide');
                }, 1000);
                
                $('#result').html(text);

                $(".tablekpis").DataTable({
                  dom: "<'d-flex justify-content-between'Bf>r<'table-responsive't>ip",
                    "order": [],
                    pageLength: 50,
                    "bAutoWidth": false,
                    buttons: [
                        {
                            extend: 'colvis',
                            text: '<i class="fas fa-columns"></i>',
                            titleAttr: 'Colvis'
                        }
                    ]
                })
            });
            })


        });
    });


</script>

@endpush
