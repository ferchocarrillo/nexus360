@extends('adminlte::page')
@section('title_postfix', ' | Users')
@section('content_header')
<h1 class="d-inline">Users</h1>
<div class="float-right">
    @can('users.create')
    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Create</a>
    @endcan
</div>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
@endsection
@section('content')
@can('users.upload')
<div class="card bg-transparent shadow-none">
    <div class="card-body">
        <form action="{{ route('users.upload') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row mb-0">
                <div class="custom-file col-sm-10">
                    <input type="file" class="custom-file-input" name="uploadUsers" accept=".xlsx">
                    <label for="uploadUsers" class="custom-file-label form-control  @error('uploadUsers') is-invalid @enderror">Choose List</label>
                    @error('uploadUsers') <span class="invalid-feedback" role="alert">{{ $message}}</span>@enderror
                </div>
                <div class="col-sm-2 text-right">
                    <button class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                </div>
            </div>
        </form>
        @if(session('validation'))
            <hr>
            <ul class="list-group list-group-flush">
            @foreach(session('validation') as $validation)
                <li class="list-group-item list-group-item-danger">
                    <div class="row">
                    <div class="col-1"><strong>{{$validation['national_id']}}</strong></div>
                    <div class="col">
                        @foreach($validation['validation'] as $error)
                            <span class="badge badge-danger">{{$error}}</span>
                        @endforeach
                    </div>
                </div>
                </li>
            @endforeach
            </ul>
        @endif
    </div>
</div>
@endcan
<div class="card">
    <div class="card-body table-responsive">
        <table class="table" id="tableUsers" style="width:100%">
            <thead>
                <tr>
                    <th width="5px"></th>
                    <th width="10px">ID</th>
                    <th width="10px">Status</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Roles</th>
                    <th>Created</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@stop

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>



    <script>

    $('.custom-file-input').on('change',function(){
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    })


        function format ( row ) {
            // `d` is the original data object for the row
            return `
            <table class=" table-borderless table-sm">
                <tr>
                    <td>Manager:</td>
                    <td>${(row.nid ? row.supervisor : '')}</td>
                </tr>
                <tr>
                    <td>Position:</td>
                    <td>${(row.nid ? row.position : '')}</td>
                </tr>
                <tr>
                    <td>Campaign:</td>
                    <td>${(row.nid ? row.campaign : '')}</td>
                </tr>
            </table>
            `;
        }

        $(document).ready(function(){
            var table = $('#tableUsers').DataTable({

                responsive: true,
                ajax:"/users",
                columns:[
                    {
                        "className":"details-control",
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    {"data":"national_id"},
                    {"data":""},
                    {"data":"username"},
                    {"data":""},
                    {"data":""}
                ],
                columnDefs:[
                    {
                        "render":function(data, type, row){
                            return `<a class="btn btn-primary btn-sm rounded-circle" href="#" role="button"><i class="fas fa-plus"></i></a>`;
                        },
                        "targets":0
                    },
                    {
                        "render":function(data,type,row){
                            return (row.nid ? `<span class="badge badge-${(row.status=='Active'?'success':'danger')}">${row.status}</span>` : '');
                        },
                        "targets": 2
                    },
                    {
                        "render":function(data,type,row){
                            return (row.nid ? row.full_name : row.name);
                        },
                        "targets": 4
                    },
                    {
                        "render":function(data,type,row){
                            return (row.roles.length ? row.roles.map(rol=>{return '<span class="badge badge-secondary mx-1">' + rol.name  + '</span>'}).join('') : '');
                        },
                        "targets": 5
                    },
                    {
                        "render":function(data,type,row){
                            return (row.created_at);
                        },
                        "targets": 6
                    },
                    {
                        "render":function(data,type,row){
                            return `<a class="btn btn-info btn-sm" href="/users/${row.id}/edit"><i class="fas fa-pencil-alt"></i></a>`
                        },
                        "targets": 7
                    },
                ],
                order:[[3,"asc"]]
            });

            $('#tableUsers tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var cell = tr.find('td:first')
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    row.child.hide();
                    cell.find('i').attr('class','fas fa-plus');
                    cell.find('a').attr('class','btn btn-primary btn-sm rounded-circle');
                }
                else {
                    row.child( format(row.data()) ).show();
                    cell.find('i').attr('class','fas fa-minus') ;
                    cell.find('a').attr('class','btn btn-danger btn-sm rounded-circle');
                }
            });
        })
    </script>
@endpush
