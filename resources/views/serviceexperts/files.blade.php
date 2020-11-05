@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Service Experts Files')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <img height="60px" src=" {{ asset('img/serviceexperts_logo.png') }}" title="CGM">

    @can('serviceexperts.filesupload')
        <a href="{{ route('serviceexperts.filesupload') }}" class="btn btn-primary"><i class="fa fa-upload"></i> Upload Files</a>
    @endcan
    {{-- <h1 class="mx-4 text-center">Service Experts</h1> --}}
</div>
@stop

@section('content')

<div class="container">


    @foreach ($files as $file)
    <div class="row align-items-center mb-1">
        <div class="col-1 text-right">
            @switch(pathinfo($file->path)['extension'])
                @case("docx")
                <i class="far fa-file-word fa-2x align-middle mr-2"></i>
                    @break
                @case("pptx")
                <i class="far fa-file-powerpoint fa-2x align-middle mr-2"></i>   
                    @break
                @case("pdf")
                <i class="far fa-file-pdf fa-2x align-middle mr-2"></i>   
                    @break
                @case("xlsx")
                <i class="far fa-file-excel fa-2x align-middle mr-2"></i>    
                    @break
                @default
                <i class="far fa-file fa-2x align-middle mr-2"></i>    
            @endswitch
        </div>
        <div class="col">
            <div class="card border-0">
                <div class="card-body p-2 row align-items-center">
                    <div class="col">
                        <div class="title-project">
                            <a href="{{ route('serviceexperts.filesdownload', $file->id) }}">{{ pathinfo($file->name)['filename'] }}</a> 
                        </div>
                        <div><small>{{$file->created_at}}</small></div>
                    </div>

                    @can('serviceexperts.filesdelete')
                    <div class="col-1">
                        <a href="{{ route('serviceexperts.filesdelete',$file->id) }}" class="text-danger"><i class="far fa-trash-alt"></i></a> 
                    </div>
                    @endcan
                </div>
            </div>
        </div>

    </div>
    @endforeach

</div>



@stop
