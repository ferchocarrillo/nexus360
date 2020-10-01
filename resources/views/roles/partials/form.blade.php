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
<h3>List Permissions</h3>
<div class="form-group">
    <ul class="list-unstyled">
        @foreach($permissions as $permission)
        <li>
            <label>

                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                    {{ $permission->name }}
                    <em> ({{ $permission->description ?: 'N/A' }})</em>
            </label>
        </li>
        @endforeach
    </ul>
</div>
<div class="form-group">
    {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary']) }}
</div>