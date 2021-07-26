@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Logs')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
@stop


@section('content_header')
    <h1 class="d-inline">Logs</h1>
    <div class="float-right">
        <select class="custom-select" name="log">
            @foreach ($logs["data"]["available_log_dates"] as $logFile)
                <option value="{{ $logFile }}"
                    @if ($logFile == $logs["data"]["filename"])
                        selected="selected"
                    @endif
                >{{ $logFile }}</option>
                
            @endforeach
        </select>
    </div>
@stop

@section('content')

<div class="card">
    <div class="card-body table-responsive">
        <table class="table" id="tableLogs">
            <thead>
                <tr>
                    <th width="160">Timestamp</td>
                    <th width="120">User</td>
                    {{-- <th width="120">Env</td> --}}
                    <th width="120">Type</td>
                    <th>Message</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs["data"]["logs"] as $log)
                    <tr>
                        <td>{{ $log["timestamp"] }}</td>
                        <td>{{ $log["user"] }}</td>
                        {{-- <td>{{ $log["env"] }}</td> --}}
                        <td><span class="badge badge-danger">{{ $log["type"] }}</span></td>
                        <td>{{ $log["message"] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script>
        $(document).ready(function () {
            var table = $('#tableLogs').DataTable({
                responsive: true,
                "dom": '<"top float-right"f>rt<"bottom"i>',
                "paging": false,
            });
            $('[name=log]').change((e)=>{
                window.location.href ="/logs/"+$('[name=log]').val();
            })
        })
    </script>
@endpush
