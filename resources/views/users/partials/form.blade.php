@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
@stop


<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : '')]) }}
    @include('errors.errors', ['field' => 'name'])
</div>
<div class="form-group">
    {{ Form::label('username', 'Username') }}
    {{ Form::text('username', null, ['class' => 'form-control ' . ($errors->has('username') ? 'is-invalid' : '')]) }}
    @include('errors.errors', ['field' => 'username'])
</div>
<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', null, ['class' => 'form-control ' . ($errors->has('email') ? 'is-invalid' : '')]) }}
    @include('errors.errors', ['field' => 'email'])
</div>
<div class="form-group">
    {{ Form::label('national_id', 'National ID') }}
    {{ Form::text('national_id', null, ['class' => 'form-control ' . ($errors->has('national_id') ? 'is-invalid' : '')]) }}
    @include('errors.errors', ['field' => 'national_id'])
</div>
<hr>
<div class="form-group">
    {{ Form::label('roles_list', 'Roles List') }}
    {{ Form::select('roles', $roles, null, ['class' => 'custom-select', 'multiple' => 'multiple', 'name' => 'roles[]']) }}
</div>
<hr>
<div class="form-group">
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password', ['class' => 'form-control ' . ($errors->has('password') ? 'is-invalid' : '')]) }}
    @include('errors.errors', ['field' => 'password'])
</div>
<div class="form-group">
    {{ Form::label('password_confirmation', 'Confirm Password') }}
    {{ Form::password('password_confirmation', ['class' => 'form-control form-control-alternative']) }}
</div>
<div class="form-group">
    {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary']) }}
</div>


@push('js')
    <script type="text/javascript" src="{{ asset('vendor/select2/js/select2.min.js') }} "></script>
    <script>
        $.fn.select2.defaults.set("theme", "bootstrap4");
        $.fn.select2.defaults.set("width", "auto");
        $(document).ready(() => {
            $("select[name='roles[]']").select2({
                allowClear: true,
            });
        })
    </script>
@endpush
