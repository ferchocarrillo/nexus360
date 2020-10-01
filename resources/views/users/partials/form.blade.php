@section('css')
<link rel="stylesheet" href=" {{asset('vendor/bootstrap-select/css/bootstrap-select.min.css')}} ">
@stop


<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null ,['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : '' )]) }}
    @include('errors.errors', ['field' => 'name'])
</div>
<div class="form-group">
    {{ Form::label('username', 'Username') }}
    {{ Form::text('username',null ,['class' => 'form-control ' . ($errors->has('username') ? 'is-invalid' : '' )]) }}
    @include('errors.errors', ['field' => 'username'])
</div>
<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', null ,['class' => 'form-control ' . ($errors->has('email') ? 'is-invalid' : '' )]) }}
    @include('errors.errors', ['field' => 'email'])
</div>
<div class="form-group">
    {{ Form::label('national_id','National ID')}}
    {{ Form::text('national_id',null,['class'=>'form-control '. ($errors->has('national_id') ? 'is-invalid': '')]) }}
    @include('errors.errors', ['field' => 'national_id'])
</div>


<hr>
<h3>List Roles</h3>
<div class="form-group">
    <ul class="list-unstyled">
        @foreach($roles as $role)
        <li>
            <label>

                    {{ Form::checkbox('roles[]', $role->id, null) }}

                    {{ $role->name }}
                    <em> ({{ $role->description ?: 'N/A' }})</em>
            </label>
        </li>
        @endforeach
    </ul>
</div>

<hr>
<div class="form-group">
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password' ,['class' => 'form-control ' . ($errors->has('password') ? 'is-invalid' : '' )]) }}
    @include('errors.errors', ['field' => 'password'])
</div>
<div class="form-group">
    {{ Form::label('password_confirmation', 'Confirm Password') }}
    {{ Form::password('password_confirmation' ,['class' => 'form-control form-control-alternative']) }}
</div>
<div class="form-group">
    {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary']) }}
</div>


@push('js')
<script src=" {{asset('vendor/bootstrap-select/js/bootstrap-select.min.js')}} "></script>
<script src=" {{asset('vendor/bootstrap-select/js/i18n/defaults-es_ES.min.js')}} "></script>
<script>

$(document).ready(function () {
    $('select').selectpicker();
});
</script>
@endpush