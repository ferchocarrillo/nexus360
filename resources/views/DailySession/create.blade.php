<div class="modal-header">
    <h5 class="modal-title">New Record | {{ $agent->full_name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    {!! Form::open(['route' => 'dailysessions.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-custom" id="formNewRecord">
        <input type="hidden" name="agent_id" value="{{ $agent->id }}">
        <div class="form-group">
            {!! Form::label('type', 'Type', ['class' => 'required']) !!}
            {!! Form::select('type', $lists['type'], null, ['placeholder' => 'Select Type', 'class' => 'custom-select', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tactic', 'Tactic', ['class' => 'required']) !!}
            {!! Form::select('tactic', $lists['tactic'], null, ['placeholder' => 'Select Tactic', 'class' => 'custom-select', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('behaviour', 'Behaviour', ['class' => 'required']) !!}
            {!! Form::select('behaviour', $lists['behaviour'], null, ['placeholder' => 'Select Behaviour', 'class' => 'custom-select', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('metric', 'Metric', ['class' => 'required']) !!}
            {!! Form::select('metric', $lists['metric'], null, ['placeholder' => 'Select Metric', 'class' => 'custom-select', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('score', 'Score (If Apply)') !!}
            {!! Form::number('score', null, ['placeholder' => 'Score', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('documented', 'Documented', ['class' => 'required']) !!}
            {!! Form::select('documented', $lists['documented'], null, ['placeholder' => 'Select Documented', 'class' => 'custom-select', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('root_cause', 'Root Cause', ['class' => 'required']) !!}
            {!! Form::select('root_cause', $lists['root_cause'], null, ['placeholder' => 'Select Root Cause', 'class' => 'custom-select', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('educational_tool', 'Educational Tool', ['class' => 'required']) !!}
            {!! Form::select('educational_tool', [], null, ['placeholder' => 'Select Educational Tool', 'class' => 'custom-select', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('comments', 'Comments', ['class' => 'required']) !!}
            {!! Form::textarea('comments', null, ['class' => 'form-control','placeholder'=>"Agent Commitment\n\nSupervisor Commitment\n\nObservations", 'required']) !!}
        </div>
        <button class="btn btn-primary" type="submit">Add Record</button>
    </div>
    {!! Form::close() !!}
</div>

<script>
    (() => {
        const root_causes = @json($lists['root_causes']);

        $('#formNewRecord #root_cause').change(e => {
            let root_cause = $(e.target).val();
            $('#formNewRecord #educational_tool').empty()
                .append('<option selected value>Select Educational Tool</option>')
                .append(root_causes.filter(e => e.root_cause == root_cause)
                    .map(e => `<option value="${e.educational_tool}">${e.educational_tool}</option>`).join(''))
        })

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        })
    })();
</script>
