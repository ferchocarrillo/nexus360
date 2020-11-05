@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Service Experts Files')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <img height="60px" src=" {{ asset('img/serviceexperts_logo.png') }}" title="CGM">
    <h1 class="mx-4 text-center">Upload Content</h1>
</div>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        <form action="{{ route('serviceexperts.filesuploadstore') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="file" accept=".doc,.docx,.xls,.xlsx,.xlsm,.xlsb,.pptx,.pdf">
                    <label for="file" class="custom-file-label form-control  @error('file') is-invalid @enderror">Choose List</label>
                    @error('file') <span class="invalid-feedback" role="alert">{{ $message}}</span>@enderror
                </div>
            </div>
          

            <div class="form-group">
                <button class="btn btn-primary">
                    <i class="fa fa-upload"></i> Upload
                </button>
            </div>
        </form>
    </div>
</div>
@stop
@push('js')

<script>
    $('.custom-file-input').on('change',function(){
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
})

</script>

@endpush