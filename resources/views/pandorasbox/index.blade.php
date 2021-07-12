@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', " | Pandora's Box")

@section('content_header')
    
@stop

@section('content')
<div class="row align-items-center">
    <div class="col-sm-3">
        <img src="/img/pandorasbox/logo_transparent.png" alt="" width="100%">
    </div>
    <div class="col-sm-9">
        <div class="card">
            <form action="/pandorasbox" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <select name="category" required class="custom-select">
                            <option value="" selected disabled>Select Category</option>
                            <option value="Operations">Operations</option>
                            <option value="HR">HR</option>
                            <option value="Training">Training</option>
                            <option value="Quality">Quality</option>
                            <option value="WorkForce">WorkForce</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <textarea class="form-control" placeholder="Suggestion" name="suggestion" rows="8" maxlength="255" minlength="50" required></textarea>
                        <span class="badge bg-primary float-right" id="characterCount">0/255</span>
                        <small class="form-text text-danger">
                            Please be specific with the information provided to be able to give you the right solution.
                        </small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="sendSuggestion" class="btn btn-primary"><i class="fas fa-share"></i> Send Suggestion</button>
                </div>
            </form>
        </div>
    </div>
    
</div>

@stop
@push('js')
<script>
    $('#sendSuggestion').click(function(e){
        $("#logoLoading").modal("toggle");
    })

    $('textarea').keyup(function() {
        $('#characterCount').text($(this).val().length + "/255")
    });
</script>
@endpush