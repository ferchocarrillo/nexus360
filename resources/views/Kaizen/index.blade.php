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
    <a href="/kaizen/create" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i></a>
    {{-- <div class="input-group">
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
    </div> --}}
</div>
@stop

@section('content')

{{-- <div class="card">
    <div class="card-body table-responsive"> --}}
        <table class="table table-borderless" id="tableKaizens" style="width:100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th width="35px"></th>
                </tr>
            </thead>
        </table>
    {{-- </div>
</div> --}}
@stop

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js') }} "></script>
    <script>

    $(document).ready(function(){
        var i = 1;
        var lState = true;
        var filters={
            status:{
                open:false,
                closed:false
            },
            unassigned:false
        }
        var sort={
            id:null,
            daysopen:null,
            daysleft:null,
            assigned_to:null,
            status:null
        }
        var sortCols = [];
        var classStatus={
            'Pending':'badge-secondary',
            'In Progress':'badge-success',
            'Pending Review':'badge-info',
            'On Hold':'badge-warning',
            'Closed':'badge-danger',
        }
        var table = $('#tableKaizens').DataTable({
            "dom": 'B<"top float-right"f>irt<"bottom"p>',
            // "dom": 'B<"top float-right"f>rt<"bottom"i>',
            responsive: true,
            stateSave: true,
            drawCallback: function() {
                if(lState){
                    lState = false;
                    var stateSave = this.api().state();
                    var nodes = $(this.api().buttons().nodes());

                    if(stateSave.columns[2].search.search.includes("Pending|In Progress|Pending Review|On Hold")){
                        $(nodes[2]).toggleClass('active')
                        filters.status.open = true;
                    }
                    if(stateSave.columns[2].search.search.includes("Closed")){
                        $(nodes[3]).toggleClass('active')
                        filters.status.closed = true;
                    }
                    if(stateSave.columns[3].search.search.includes("^$")){
                        $(nodes[4]).toggleClass('active')
                        filters.unassigned = true;
                    }

                    for (let o = 1; o <= 6; o++) {
                        var index = stateSave.order.findIndex((col)=>{return col[0] == o});
                        if (index > -1) {
                            sortCols.push(stateSave.order[index]);
                            if (stateSave.order[index][1] == 'asc') {
                                $(nodes[4+o]).append('    <i class="fas fa-sort-down"></i>');
                            }else{
                                $(nodes[4+o]).append('    <i class="fas fa-sort-up"></i>');
                            }
                        }
                    }
                }

            },
            ajax:location.href,
            buttons: [
                {
                    extend: 'collection',
                    text: '<i class="fas fa-filter"></i> Filter',
                    autoClose: 'true',
                    className: 'btn-sm btn-default',
                    buttons: [
                        {
                            text: 'Open',
                            action: function ( e, dt, node, config ) {
                                // $(e.currentTarget).toggleClass('btn-default btn-primary')
                                $(e.currentTarget).toggleClass('active')
                                filters.status.open = $(e.currentTarget).hasClass('active')
                                filterStatus();
                            }
                        },
                        {
                            text: 'Closed',
                            action: function ( e, dt, node, config ) {
                                // $(e.currentTarget).toggleClass('btn-default btn-primary')
                                $(e.currentTarget).toggleClass('active')
                                filters.status.closed = $(e.currentTarget).hasClass('active')
                                filterStatus();
                            }
                        },
                        {
                            text: 'Unassigned',
                            action: function ( e, dt, node, config ) {
                                // $(e.currentTarget).toggleClass('btn-default btn-primary')
                                $(e.currentTarget).toggleClass('active')
                                filters.unassigned = $(e.currentTarget).hasClass('active')
                                table.column(3)
                                .search((filters.unassigned ? '^$':''),true,false)
                                .draw();
                            }
                        }
                    ]
                },
                {
                    extend: 'collection',
                    text: '<i class="fas fa-sort-amount-down"></i> Sort By',
                    // autoClose: 'true',
                    className: 'btn-sm btn-default',
                    buttons: [
                        {
                            text: 'ID',
                            action: function ( e, dt, node, config ) {
                                var colID = 1;
                                var index = sortCols.findIndex((col)=>{return col[0] == colID});
                                $(e.currentTarget).find('i').remove();
                                if (index > -1) {
                                    if (sortCols[index][1] == 'asc' && !e.ctrlKey) {
                                        sortCols[index][1] = 'desc'
                                        $(e.currentTarget).append('    <i class="fas fa-sort-up"></i>');
                                    }else{
                                        sortCols.splice(index,1);
                                    }
                                }else{
                                    sortCols.push([colID, 'asc']);
                                    $(e.currentTarget).append('    <i class="fas fa-sort-down"></i>');
                                }
                                if (sortCols.length == 0) {
                                    table.order([0,"asc"]).draw();
                                }else{
                                    table.order(sortCols).draw()
                                }
                            }
                        },
                        {
                            text: 'Status',
                            action: function ( e, dt, node, config ) {
                                var colID = 2;
                                var index = sortCols.findIndex((col)=>{return col[0] == colID});
                                $(e.currentTarget).find('i').remove();
                                if (index > -1) {
                                    if (sortCols[index][1] == 'asc' && !e.ctrlKey) {
                                        sortCols[index][1] = 'desc'
                                        $(e.currentTarget).append('    <i class="fas fa-sort-up"></i>');
                                    }else{
                                        sortCols.splice(index,1);
                                    }
                                }else{
                                    sortCols.push([colID, 'asc']);
                                    $(e.currentTarget).append('    <i class="fas fa-sort-down"></i>');
                                }
                                if (sortCols.length == 0) {
                                    table.order([0,"asc"]).draw();
                                }else{
                                    table.order(sortCols).draw()
                                }
                            }
                        },
                        {
                            text: 'Assigned',
                            action: function ( e, dt, node, config ) {
                                var colID = 3;
                                var index = sortCols.findIndex((col)=>{return col[0] == colID});
                                $(e.currentTarget).find('i').remove();
                                if (index > -1) {
                                    if (sortCols[index][1] == 'asc' && !e.ctrlKey) {
                                        sortCols[index][1] = 'desc'
                                        $(e.currentTarget).append('    <i class="fas fa-sort-up"></i>');
                                    }else{
                                        sortCols.splice(index,1);
                                    }
                                }else{
                                    sortCols.push([colID, 'asc']);
                                    $(e.currentTarget).append('    <i class="fas fa-sort-down"></i>');
                                }
                                if (sortCols.length == 0) {
                                    table.order([0,"asc"]).draw();
                                }else{
                                    table.order(sortCols).draw()
                                }
                            }
                        },
                        {
                            text: 'Deadline',
                            action: function ( e, dt, node, config ) {
                                var colID = 4;
                                var index = sortCols.findIndex((col)=>{return col[0] == colID});
                                $(e.currentTarget).find('i').remove();
                                if (index > -1) {
                                    if (sortCols[index][1] == 'asc' && !e.ctrlKey) {
                                        sortCols[index][1] = 'desc'
                                        $(e.currentTarget).append('    <i class="fas fa-sort-up"></i>');
                                    }else{
                                        sortCols.splice(index,1);
                                    }
                                }else{
                                    sortCols.push([colID, 'asc']);
                                    $(e.currentTarget).append('    <i class="fas fa-sort-down"></i>');
                                }
                                if (sortCols.length == 0) {
                                    table.order([0,"asc"]).draw();
                                }else{
                                    table.order(sortCols).draw()
                                }
                            }
                        },
                        {
                            text: 'Days Open',
                            action: function ( e, dt, node, config ) {
                                var colID = 5;
                                var index = sortCols.findIndex((col)=>{return col[0] == colID});
                                $(e.currentTarget).find('i').remove();
                                if (index > -1) {
                                    if (sortCols[index][1] == 'asc' && !e.ctrlKey) {
                                        sortCols[index][1] = 'desc'
                                        $(e.currentTarget).append('    <i class="fas fa-sort-up"></i>');
                                    }else{
                                        sortCols.splice(index,1);
                                    }
                                }else{
                                    sortCols.push([colID, 'asc']);
                                    $(e.currentTarget).append('    <i class="fas fa-sort-down"></i>');
                                }
                                if (sortCols.length == 0) {
                                    table.order([0,"asc"]).draw();
                                }else{
                                    table.order(sortCols).draw()
                                }
                            }
                        },
                        {
                            text: 'Days Left',
                            action: function ( e, dt, node, config ) {
                                var colID = 6;
                                var index = sortCols.findIndex((col)=>{return col[0] == colID});
                                $(e.currentTarget).find('i').remove();
                                if (index > -1) {
                                    if (sortCols[index][1] == 'asc' && !e.ctrlKey) {
                                        sortCols[index][1] = 'desc'
                                        $(e.currentTarget).append('    <i class="fas fa-sort-up"></i>');
                                    }else{
                                        sortCols.splice(index,1);
                                    }
                                }else{
                                    sortCols.push([colID, 'asc']);
                                    $(e.currentTarget).append('    <i class="fas fa-sort-down"></i>');
                                }
                                if (sortCols.length == 0) {
                                    table.order([0,"asc"]).draw();
                                }else{
                                    table.order(sortCols).draw()
                                }
                            }
                        },
                    ]
                }
            ],
            columns:[
                {"data":"title",
                    "render":(data, type, row)=>{
                        return `
                            <div class="card border-0 mb-0">
                                <div class="card-body p-2 row align-items-center">
                                    <div class="col-5">
                                        <div>
                                            <h5 class="mb-0"><b>#${row.id}</b>   ${data}</h5>
                                        </div>
                                        <h5 class="mb-0"><span class="badge ${classStatus[row.status]}">${row.status}</span></h5>
                                        <div><small>${row.required.name}</small></div>
                                        <div><small>${row.created_at.substr(0,16)}</small></div>
                                    </div>
                                    <div class="col-3 text-muted"">
                                        <div>Days Open: <span class="badge ${(row.daysopen >= 8 ? 'badge-danger' : 'badge-primary')}">${row.daysopen}</span></div> 
                                        <div>Days Left: <span class="badge ${(row.daysleft < 0 ? 'badge-danger' : 'badge-primary')}">${row.daysleft}</span></div> 
                                    </div>
                                    <div class="col-3 text-muted">
                                        <div class="font-italic">${(row.assigned_to ? row.assigned.name : '')}</div> 
                                        <div>
                                            <small class="font-weight-light">${(row.deadline ? row.deadline : '')}</small>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <a href="/kaizen/${row.id}" class="btn btn-sm btn-secondary"><i class="far fa-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                            `
                        return `<b>#${row.id}</b>   ${data}`
                    },
                    "orderData":1
                },
                {"data":"id", visible:false},
                {"data":"status", visible:false},
                {"data":"assigned_to", visible:false},
                {"data":"deadline", visible:false},
                {"data":"daysopen", visible:false},
                {"data":"daysleft", visible:false},
                
            ],
            
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Kaizen"
            },
            // "paging": false,
            // order:[[0,"asc"]]
        });

        function filterStatus(){
            var search = [];

            if(filters.status.open){
                search.push('Pending','In Progress','Pending Review','On Hold')
            }
            if(filters.status.closed){
                search.push('Closed')
            }

            table.column(2)
                .search(search.join('|'),true,false)
                .draw();
            
        }
    })
</script>
@endpush
