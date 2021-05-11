@extends('adminlte::page')
{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Kaizen')


@section('css')
{{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
<link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/kaizen.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
@stop

@section('content_header')
<h1 class="d-inline">Kaizen <span class="kaizen">改善</span></h1>
<div class="float-right">
    <div class="input-group">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-filter"></i>  Filter Status</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="?">All Kaizens</a>
                    <a class="dropdown-item" href="?status=Open">Open</a>
                    <a class="dropdown-item" href="?status=Closed">Closed</a>
                </div>
            </div>

        <div class="input-group-append">
            <a href="/kaizen/create" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>
@stop

@section('content')

<div class="card">
    <div class="card-body table-responsive">
        <table class="table" id="tableKaizens" style="width:100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Assigned To</th>
                    <th>Deadline</th>
                    <th width="35px"></th>
                </tr>
            </thead>
            {{-- <tbody>
                @foreach ($kaizens as $kaizen)
                    <tr>
                        <td><b>#{{$kaizen->id}}</b>  {{$kaizen->title}}</td>
                        <td>{{$kaizen->status}}</td>
                        <td>{{$kaizen->required['name']}}</td>
                        <td>{{(isset($kaizen->assigned['name'])?$kaizen->assigned['name']:'')}}</td>
                        <td>{{$kaizen->deadline}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="/kaizen/{{$kaizen->id}}" class="btn btn-sm btn-secondary"><i class="far fa-eye"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
        
            </tbody> --}}
            
        </table>
    </div>
</div>
@stop

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script>

    $(document).ready(function(){
        var table = $('#tableKaizens').DataTable({
            responsive: true,
            ajax:location.href,
            columns:[
                {"data":"title",
                    "render":(data, type, row)=>{
                        return `<b>#${row.id}</b>   ${data}`
                    }
                },
                {"data":"status"},
                {"data":"required.name"},
                {"data":"assigned",
                    "render":(data, type, row)=>{    
                        if(data){
                            return row.assigned.name
                        }
                        return data
                    }
                },
                {"data":"deadline"},
                {"data":null,
                    "render":(data, type, row)=>{    
                        return `<a href="/kaizen/${row.id}" class="btn btn-sm btn-secondary"><i class="far fa-eye"></i></a>`
                    }
                }

            ],
            "dom": '<"top float-right"f>rt<"bottom"i>',
            "paging": false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Kaizen"
            },
            order:[[0,"asc"]]
        })
    })
</script>
@endpush
