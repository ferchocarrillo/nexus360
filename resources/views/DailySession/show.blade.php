<div class="modal-header">
    <h5 class="modal-title">#{{ $dailysession->id }} | {{ $dailysession->agent_name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-custom">
        <div class="employee-info">
            <div class="form-group">
                <label>Corp Email</label>
                <span class="form-control">{{ $dailysession->corporate_email }}</span>
            </div>
            <div class="form-group">
                <label>Team Leader</label>
                <span class="form-control">{{ $dailysession->team_leader }}</span>
            </div>
            <div class="form-group">
                <label>Campaign</label>
                <span class="form-control">{{ $dailysession->campaign }}</span>
            </div>
        </div>
        <div class="form-group">
            <label>Type</label>
            <span class="form-control">{{ $dailysession->type }}</span>
        </div>
        <div class="form-group">
            <label>Tactic</label>
            <span class="form-control">{{ $dailysession->tactic }}</span>
        </div>
        <div class="form-group">
            <label>Behaviour</label>
            <span class="form-control">{{ $dailysession->behaviour }}</span>
        </div>
        <div class="form-group">
            <label>Metric</label>
            <span class="form-control">{{ $dailysession->metric }}</span>
        </div>
        <div class="form-group">
            <label>Score</label>
            <span class="form-control">{{ $dailysession->score }}</span>
        </div>
        <div class="form-group">
            <label>Documented</label>
            <span class="form-control">{{ $dailysession->documented }}</span>
        </div>
        <div class="form-group">
            <label>Root Cause</label>
            <span class="form-control">{{ $dailysession->root_cause }}</span>
        </div>
        <div class="form-group">
            <label>Educational Tool</label>
            <span class="form-control">{{ $dailysession->educational_tool }}</span>
        </div>
        <div class="form-group">
            <label>Comments</label>
            <span class="form-control"><p>{!! $dailysession->comments !!}</p></span>
        </div>
        <div class="form-group">
            <label>Created By</label>
            <span class="form-control">{{ $dailysession->creator->name }}</span>
        </div>
    </div>
</div>
<div class="modal-footer">
    @if (!$dailysession->acknowledge && auth()->user()->national_id == $dailysession->national_id)
    <form action="{{route('dailysession.acknowledge',$dailysession->id)}}" method="POST">
        @method('PUT')
        @csrf
        <button type="sub" class="btn btn-primary">
            <i class="fas fa-clipboard-check"></i> Acknowledge
        </button>
    </form>
    @endif
</div>
