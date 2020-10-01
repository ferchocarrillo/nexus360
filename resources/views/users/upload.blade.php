@extends('adminlte::page')

@section('title_postfix',' | Upload Users')

@section('content_header')
    <h1 class="d-inline">Upload Users</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('users.uploadStore') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="uploadUsers" accept=".xlsx">
                    <label for="uploadUsers" class="custom-file-label form-control  @error('uploadUsers') is-invalid @enderror">Choose List</label>
                    @error('uploadUsers') <span class="invalid-feedback" role="alert">{{ $message}}</span>@enderror
                </div>
            </div>
          

            <div class="form-group">
                <button class="btn btn-primary">
                    <i class="fa fa-upload"></i> Upload
                </button>
            </div>
        </form>

        @if ($errors->any())
        
            <ul class="list-group list-group-flush">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item bg-danger">{!! $error !!}</li>
                @endforeach
            </ul>
    @endif


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

