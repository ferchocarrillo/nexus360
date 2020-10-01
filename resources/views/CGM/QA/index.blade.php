@extends('adminlte::page')

@section('title_postfix', ' | QA List')

@section('content_header')
<h1>QA Pending</h1>
@stop

@section('content')

<div class="card">
    @if(count($data)< 1) <div class="card-body">
        No results found
</div>
@else

<div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Call ID</th>
                    <th>Username</th>
                    <th>Company Name</th>
                    <th>Appt. Date</th>
                    <th width="150px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                <tr>
                    <td>{{$row->callID}}</td>
                    <td>{{$row->username}}</td>
                    <td>{{$row->company_name}}</td>
                    <td>{{$row->appointment_date}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href=" {{ route('cgm.qa.rating',$row->id) }} ">
                            <i class="fas fa-receipt mr-2"></i>
                            Rate this call
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>


<div class="card-footer">

    <div class="d-sm-flex align-items-center justify-content-between">
        <span>Records: {{count($data)}}</span>
    </div>
</div>

@endempty
</div>

@stop