@extends('adminlte::page')

@section('title_postfix', ' | Download Lists')

@section('content_header')
<h1 class="d-inline">Download Lists</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Name List</th>
                    <th>Cant Rows</th>
                    <th width="10px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lists as $item)
                <tr>
                    <td>
                        {{ $item->name_file_upload}}
                    </td>
                    <td>{{ $item->Cant}}</td>
                    <td>
                        <a class="btn btn-sm btn-outline-primary"
                            href="{{ route('cgm.downloadlist',$item->name_file_upload) }}">
                        <i class="fas fa-download"></i>
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>

    </div>
</div>
@stop