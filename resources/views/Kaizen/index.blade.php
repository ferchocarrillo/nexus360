@extends('adminlte::page')
{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Kaizen')


@section('css')
{{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
<link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/kaizen.css')}}">
@stop

@section('content_header')
<h1 class="d-inline">Kaizen <span class="kaizen">改善</span></h1>
<div class="float-right">
    <div class="input-group">
        <div class="input-group">
            {{-- <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-filter"></i></span>
            </div>
            <select name="status" id="status" class="custom-select mr-3">
                <option value="">Filter Status</option>
            </select> --}}
            <a href="/kaizen/create" class="btn btn-outline-primary" type="button" ><i class="fas fa-plus"></i></a>
          </div>
    </div>

</div>
@stop

@section('content')

<table class="table table-sm">
    <thead class="thead-dark">
        <tr>
            <th class="bg-primary">Title</th>
            <th class="bg-primary">Status</th>
            <th class="bg-primary">Created By</th>
            <th class="bg-primary">Assigned To</th>
            <th class="bg-primary">Deadline</th>
            {{-- <th class="bg-primary">Last Comment</th> --}}
            <th class="bg-primary" width="35px"></th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($kaizens as $kaizen)
            <tr>
                <td data-title="{{$kaizen->title}}" data-id="{{$kaizen->id}}">{{$kaizen->title}}</td>
                <td data-status="{{$kaizen->status}}">{{$kaizen->status}}</td>
                <td data-created_by="{{$kaizen->created_by}}">{{$kaizen->required['name']}}</td>
                <td data-assigned_to="{{$kaizen->assigned_to}}">{{$kaizen->assigned['name']}}</td>
                <td data-deadline="{{$kaizen->deadline}}">{{$kaizen->deadline}}</td>
                {{-- <td></td> --}}
                <td>
                    <div class="btn-group">
                        <a href="/kaizen/{{$kaizen->id}}" class="btn btn-sm btn-secondary"><i class="far fa-eye"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>




@stop
@push('js')

@endpush