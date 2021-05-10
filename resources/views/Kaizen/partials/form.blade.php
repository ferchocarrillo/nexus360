<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class'=>'form-control','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('group', 'Group') !!}
    {!! Form::select('group', $groups, null, ['placeholder'=>'','class'=>'custom-select','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('campaign','Campaign') !!}
    {!! Form::select('campaign', $campaigns, null, ['placeholder'=>'','class'=>'custom-select','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('type', 'Type') !!}
    {!! Form::select('type', $types, null, ['placeholder'=>'','class'=>'custom-select','required']) !!}
</div>
<div class="form-group" id="schedules">

</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control','maxlength'=>'500','required']) !!}
</div>
<button type="submit" class="btn btn-primary">Save changes</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<script>
    var types = @json($types);
    var schedules = @json($schedules);

    $( document ).ready(function() {
        $('#group').change((e)=>{
            let group = $('#group').val()
            $('#type').html('<option selected="selected" disabled value=""></option>');
            $('#schedules').html('');
            if(group=='Schedules'){
                $.each(schedules, function(key, value) {   
                    $('#type')
                        .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
                });
            }else{
                $.each(types, function(key, value) {   
                    $('#type')
                        .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
                });
            }
        })
        $('#type').change((e)=>{
            let type = $('#type').val();
            if(Object.keys(schedules).includes(type)){
                $('#schedules').html(`
                <table class='table'>
                    <thead>
                        <tr>
                           <th>Date</th>
                        </tr>
                    </thead>
                </table>
                `);
            }
        })
    });
    
</script>