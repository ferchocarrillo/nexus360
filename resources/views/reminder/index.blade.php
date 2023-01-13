@extends('adminlte::page')
@section('title_postfix', ' | Reminders')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{asset('css/reminders.css')}}">
@endsection
@section('content_header')
@if (Auth::user()->can('reminder.create'))
<a href="{{ route('reminder.create') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-feather-alt"></i> Create a New Reminder</a>
@endif
<h1>Reminders Received</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover" id="remindersTable">
            <thead>
                    <tr>
                        <th style="text-align: center; width:164px;">Received Date</th>
                    <th scope="col-sm-12">Message</th>
                    <th style="text-align: center;" scope="col-6 .col-md-4">Process</th>
                    <th scope="col"></th>
                    </tr>
                <tbody>
                @foreach ($recipients as $rcp)
                <tr>
                    <td>{{$rcp->reminder->created_at->format('d-m-Y')}}</td>
                    <td>{{ $rcp->reminder->reminder }}</td>
                    @if  ($rcp->acknowledge_required  == 1 && $rcp->acknowledge  != 1  )
                    <td style="background: #F0F5AE; text-align: center;">
                        <i class="fas fa-exclamation-triangle" style="z-index: 9999"></i>
                    </td>
                    @elseif ($rcp->acknowledge_required  == 1 && $rcp->acknowledge  == 1  )
                    <td style="background: #BBF5AE; text-align: center;">
                        <i class="far fa-check-circle" style="z-index: 9999"></i>
                    </td>
                    @else
                    <td style="background: #e8eee7">
                    </td>
                    @endif
                    <td>
                        <a href="/reminder/popup/{{ $rcp->id }}" class="btn btn-info showReminder" target="iframe_a">
                            <i class="far fa-eye" ></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalReminder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Reminder</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <iframe src="" name="iframe_a" id="iframeReminder" class="w-100" style="height: 800px;" frameborder="0"></iframe>
        </div>
        </div>
    </div>
</div>
    @stop
    @push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script>
        $(document).ready(function() {
            $('#remindersTable').DataTable({
                language: {
                    "processing": "Processing...",
                    "lengthMenu": "Show _MENU_ records",
                    "zeroRecords": "No results found",
                    "emptyTable": "No data available in this table",
                    "infoEmpty": "Showing records from 0 to 0 of a total of 0 records",
                    "infoFiltered": "(filtering a total of _MAX_ records)",
                    search: `<div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>`,
                    searchPlaceholder: 'Search...',
                    "infoThousands": ",",
                    "loadingRecords": "Loading...",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    },
                    "info": "Showing _START_ to _END_ of _TOTAL_ records"
                }
            });
            $('#modalReminder').on('hidden.bs.modal', function (event) {
                $('#iframeReminder').attr('src','')
            })
            $('.showReminder').click(e=>{
                $('#modalReminder').modal('show');
            })
        })
</script>
@endpush
