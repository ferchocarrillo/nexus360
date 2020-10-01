@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Upload Agent Performance')

@section('content_header')
<h1 class="d-inline">Upload Agent Performance</h1>
@stop

@section('content')


<form action="{{ url('/enercare/uploads/agentperformance') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="AgentPerformance" accept=".csv" required>
            <label for="AgentPerformance" class="custom-file-label form-control  @error('AgentPerformance') is-invalid @enderror">Choose List</label>
            @error('AgentPerformance') <span class="invalid-feedback" role="alert">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-primary">
            <i class="fa fa-upload"></i> Upload
        </button>
    </div>



    @if (session('data'))    
    @foreach (session('data') as $fileImport)
        <div class="alert alert-{{($fileImport->result == 'success' ? 'success' : 'danger')}}">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="list-unstyled mb-0">
                <li><strong>File: </strong>{{$fileImport->subdirectory}}</li>
                <li><strong>Result: </strong>{{$fileImport->result}}</li>
                @if ($fileImport->result == 'success')
                    <li><strong>Rows Inserted: </strong>{{$fileImport->rows_inserted}}</li>
                    <li><strong>Rows Loaded: </strong>{{$fileImport->rows_loaded}}</li>
                @else
                    <li><strong>Error: </strong>{{$fileImport->error}}</li>
                @endif
                
            </ul>
        </div>
    @endforeach
    @endif

</form>

@stop

@push('js')
<script>
    $('.custom-file-input').on('change',function(){
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);


})

</script>

@endpush