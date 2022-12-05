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
@can('reminder.create')
<a href="{{ route('reminder.create') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-feather-alt"></i>
    Create a New Reminder</a>
@endcan
<h1>Reminders Sent # &nbsp{{ $reminders->id}}</h1>
@stop
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    {{ Form::label('messege', 'Messege', ['class' => 'col-md-4 col-form-label col-form-label-sm']) }}
                    <div class="col-md-8">
                        <input type="text" id="messege" name="messege" value="{{ $reminders->reminder}}"
                            class="form-control form-control-lg" disabled>
                    </div>
                    @include('errors.errors', ['field' => 'messege'])
                </div>
                <div class="form-group row">
                    {{ Form::label('send_to', 'Send to', ['class' => 'col-md-4 col-form-label col-form-label-sm']) }}
                    <div class="col-md-8">
                        <input type="text" id="send_to" name="send_to" value="{{ $reminders->campaign}}"
                            class="form-control form-control-lg" disabled>
                    </div>
                    @include('errors.errors', ['field' => 'send_to'])
                </div>
                <div class="form-group row">
                    {{ Form::label('date_to', 'Date to Send', ['class' => 'col-md-4 col-form-label col-form-label-sm'])
                    }}
                    <div class="col-md-8">
                        <input type="text" id="date_to" name="date_to"
                            value="{{ $reminders->created_at->format('d-m-Y')}}" class="form-control form-control-lg"
                            disabled>
                    </div>
                    @include('errors.errors', ['field' => 'date_to'])
                </div>
                <div class="form-group row">
                    {{ Form::label('acknowledge_required', 'Acknowledge Required', ['class' => 'col-md-4 col-form-label
                    col-form-label-sm']) }}
                    <div class="col-md-8">
                        @if ( $reminders->recipients[0]->acknowledge_required == true )
                        <input type="text" id="acknowledge_required" name="acknowledge_required" value="Yes"
                            class="form-control form-control-lg" disabled>
                        @else
                        <input type="text" id="acknowledge_required" name="acknowledge_required" value="No"
                            class="form-control form-control-lg" disabled>
                        @endif
                    </div>
                </div>
                @include('errors.errors', ['field' => 'acknowledge'])
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover" id="remindersTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Team Leader</th>
                            <th>Campaign</th>
                            <th>Acceptance Status</th>
                            <th>Acceptance Date</th>
                        </tr>
                    <tbody>
                        @foreach ($reminders->recipients as $rm)
                        <tr>
                            <td>{{$rm->user->name}}</td>
                            <td>{{str_replace(["[",'"',"]"],[" "," "," "], $rm->user->masterfile2->pluck('supervisor')->first())}}</td>
                            <td>{{str_replace(["[",'"',"]"],[" "," "," "], $rm->user->masterfile2->pluck('campaign')->first())}}</td>
                            <td>
                                @if ($rm->acknowledge_required)
                                    @if($rm->acknowledge == 1)
                                        Acepted
                                    @else
                                        Pendient
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if ($rm->acknowledge != null)
                                    {{$rm->updated_at}}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
