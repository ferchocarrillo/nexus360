@extends('adminlte::page')
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
</div>
@stop

@section('content')
    <table class="table table-borderless" id="tableKaizens" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th width="35px"></th>
            </tr>
        </thead>
    </table>
@stop

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js') }} "></script>
    <script>
    const columnsDatatables = {
        0: "title",
        1: "id",
        2: "status",
        3: "assigned_to",
        4: "deadline",
        5: "daysopen",
        6: "daysleft",
        7: "group",
        8: "type",
    }
    const groups = @json($groups)

    $(document).ready(function(){
        var i = 1;
        var lState = true;
        var status = 'Open'
        var groupsFilter = []
        var typesFilter = []
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
        let btnGroups = {
            extend: 'collection',
            text: 'Group',
            name: 'groups',
            buttons: Object.keys(groups).map(group=>{
                return {
                    text: group,
                    name: 'group_'+group,
                    action: function ( e, dt, node, config ){
                        let isActive = $(e.currentTarget).toggleClass('active').hasClass('active')
                        filterGroup(group,isActive)
                    }
                }
            })
        }
        let btnTypes = {
            extend: 'collection',
            text: 'Type',
            name: 'types',
            buttons: [...new Set(Object.values(groups).flat())].map(type=>{
                return {
                    text: type,
                    name: 'type_'+type,
                    action: function ( e, dt, node, config ){
                        let isActive = $(e.currentTarget).toggleClass('active').hasClass('active')
                        filterType(type,isActive)
                    }
                }
            })
        }
        var table = $('#tableKaizens').DataTable({
            "dom": 'B<"top float-right"f>irt<"bottom"p>',
            // "dom": 'B<"top float-right"f>rt<"bottom"i>',
            responsive: true,
            stateSave: true,
            drawCallback: function() {
                if(lState){
                    lState = false;
                    var dt = this.api();
                    var stateParams = dt.state();

                    let filters = stateParams.columns.reduce((obj,item,idx)=>{
                        if(item.search.search){
                            return Object.assign(obj,{[columnsDatatables[idx]]: item.search.search})
                        }else{
                            return obj
                        }
                    },{})

                    if(filters.assigned_to){
                        $(dt.buttons('assigned_to:name').nodes()).toggleClass('active')
                    }
                    if(filters.group){
                        filters.group.split('|').forEach(g=>{
                            $(dt.buttons('group_'+g+':name').nodes()).toggleClass('active')
                            typesFilter.push(g)
                            // debugger
                        })
                    }
                    if(filters.type){
                        filters.type.split('|').forEach(t=>{
                            $(dt.buttons('type_'+t+':name').nodes()).toggleClass('active')
                            typesFilter.push(t)
                            // debugger
                        })
                    }
                    var nodes = $(this.api().buttons('sortby:name').nodes());
                    for (let o = 1; o <= 6; o++) {
                        var index = stateParams.order.findIndex((col)=>{return col[0] == o});
                        if (index > -1) {
                            sortCols.push(stateParams.order[index]);
                            if (stateParams.order[index][1] == 'asc') {
                                $(nodes[o-1]).append('    <i class="fas fa-sort-down"></i>');
                            }else{
                                $(nodes[o-1]).append('    <i class="fas fa-sort-up"></i>');
                            }
                        }
                    }
                    
                }
            },
            ajax: {
                'type': 'GET',
                'url': location.href,
                'data': function(d){
                    return {status};
                }
            },
            buttons: [
                {
                    extend: 'collection',
                    text: '<i class="fas fa-filter"></i> Filter',
                    autoClose: 'true',
                    className: 'btn-sm btn-default',
                    buttons: [
                        {
                            text: 'Open',
                            name: 'open',
                            className: 'active',
                            action: function ( e, dt, node, config ) {
                                changeStatus('Open',dt)    
                            }
                        },
                        {
                            text: 'Closed',
                            name: 'closed',
                            action: function ( e, dt, node, config ) {
                                changeStatus('Closed',dt)
                            }
                        },
                        {
                            text:'<hr>',
                            className:'disabled',
                            attr: {
                                style: 'height: 5px;margin-top: -10px;padding: 0;'
                            },
                        },
                        {
                            text: 'Unassigned',
                            name: 'assigned_to',
                            action: function ( e, dt, node, config ) {
                                let isActive = $(e.currentTarget).toggleClass('active').hasClass('active')
                                table.column(3).search((isActive ? '^$':''),true,false).draw();
                            }
                        },
                        btnGroups,
                        btnTypes,
                    ]
                },
                {
                    extend: 'collection',
                    text: '<i class="fas fa-sort-amount-down"></i> Sort By',
                    className: 'btn-sm btn-default',
                    buttons: [
                        {
                            text: 'ID',
                            name: 'sortby',
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
                            name: 'sortby',
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
                            name: 'sortby',
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
                            name: 'sortby',
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
                            name: 'sortby',
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
                            name: 'sortby',
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
                },
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
                {"data":"group", visible:false},
                {"data":"type", visible:false},                
            ],
            processing: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Kaizen",
                processing: `<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                       </span>&emsp;Loading ...` 
            },
            // "paging": false,
            // order:[[0,"asc"]]
        });

        function changeStatus(s, dt){
            if(s==status) return;
            let btnOpen = $(dt.buttons('open:name')[0].node)
            let btnClosed = $(dt.buttons('closed:name')[0].node)

            if(s=='Open'){
                btnOpen.addClass('active')
                btnClosed.removeClass('active')
                status = 'Open'
            }else{
                btnClosed.addClass('active')
                btnOpen.removeClass('active')
                status = 'Closed'
            }

            dt.ajax.reload()
        }

        function filterGroup(group, isActive){
            if(isActive){
                groupsFilter.push(group)
            }else(
                groupsFilter = groupsFilter.filter(e=>e!=group)
            )
            // debugger
            table.column(7).search(groupsFilter.join('|'),true, false).draw()
        }
        function filterType(type, isActive){
            if(isActive){
                typesFilter.push(type)
            }else(
                typesFilter = typesFilter.filter(e=>e!=type)
            )
            // debugger
            table.column(8).search(typesFilter.join('|'),true, false).draw()
        }
    })
</script>
@endpush
