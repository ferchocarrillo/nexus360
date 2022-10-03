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
        <div class="row">
            <div class="form-group col-md-6 col-lg-4">
                {!! Form::label('type', 'Type', ['class' => 'required']) !!}
                {!! Form::select('type', $lists['type'], null, ['placeholder' => 'Select Type', 'class' => 'custom-select', 'required']) !!}
            </div>
            <div class="form-group col-md-6 col-lg-4">
                {!! Form::label('tactic', 'Tactic', ['class' => 'required']) !!}
                {!! Form::select('tactic', $lists['tactic'], null, ['placeholder' => 'Select Tactic', 'class' => 'custom-select', 'required']) !!}
            </div>
            <div class="form-group col-md-6 col-lg-4">
                {!! Form::label('behaviour', 'Behaviour', ['class' => 'required']) !!}
                {!! Form::select('behaviour', $lists['behaviour'], null, ['placeholder' => 'Select Behaviour', 'class' => 'custom-select', 'required']) !!}
            </div>
            <div class="form-group col-md-6 col-lg-4">
                {!! Form::label('metric', 'Metric', ['class' => 'required']) !!}
                {!! Form::select('metric', $lists['metric'], null, ['placeholder' => 'Select Metric', 'class' => 'custom-select', 'required']) !!}
            </div>
            <div class="form-group col-md-6 col-lg-4">
                {!! Form::label('score', 'Score (If Apply)') !!}
                {!! Form::number('score', null, ['placeholder' => 'Score', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group col-12">
                {!! Form::label('comments', 'Comments', ['class' => 'required']) !!}
                {!! Form::textarea('comments', null, ['class' => 'form-control','placeholder'=>"Agent Commitment\n\nSupervisor Commitment\n\nObservations", 'required']) !!}
            </div>
        </div>
        
        <button class="btn btn-primary" type="submit">Add Record</button>
    </div>
    {!! Form::close() !!}
</div>