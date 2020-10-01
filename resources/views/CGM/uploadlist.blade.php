@extends('adminlte::page')

@section('title_postfix', ' | Upload List')

@section('content_header')
<h1 class="d-inline">Upload List</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        <form action="{{ url('/cgm/uploadlist') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="uploadList" accept=".csv">
                    <label for="uploadList" class="custom-file-label form-control  @error('uploadList') is-invalid @enderror">Choose List</label>
                    @error('uploadList') <span class="invalid-feedback" role="alert">{{ $message}}</span>@enderror
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