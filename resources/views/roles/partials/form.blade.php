@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
@stop
<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null ,['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : '' )]) }}
    @include('errors.errors', ['field' => 'name'])
</div>
<div class="form-group">
    {{ Form::label('slug', 'Slug') }}
    {{ Form::text('slug', null ,['class' => 'form-control ' . ($errors->has('slug') ? 'is-invalid' : '' )]) }}
    @include('errors.errors', ['field' => 'slug'])
</div>
<div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description', null ,['class' => 'form-control ' . ($errors->has('description') ? 'is-invalid' : '' )]) }}
    @include('errors.errors', ['field' => 'description'])
</div>
<hr>
<h3>Special permission</h3>
<div class="form-group">
    <label>{{ Form::radio('special','all-access') }} All access </label>
    <label>{{ Form::radio('special','no-access') }} No access </label>
</div>


<hr>
<div class="form-group">
    {{ Form::label('permissions', 'List Permissions') }}
    {{ Form::select('permissions', $permissions, null, ['class' => 'custom-select', 'multiple' => 'multiple', 'name' => 'permissions[]']) }}
</div>
<hr>
<div class="form-group">
    {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary']) }}
</div>

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/select2/js/select2.min.js') }} "></script>
    <script>
        $.fn.select2.defaults.set("theme", "bootstrap4");
        $.fn.select2.defaults.set("width", "auto");
        $(document).ready(() => {
            $("select[name='permissions[]']").select2({
                allowClear: true,
            });
        })
    </script>
@endpush

