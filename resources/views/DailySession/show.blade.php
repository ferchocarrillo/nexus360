<div class="modal-header">
    <h5 class="modal-title">#{{ $dailysession->id }} | {{ $dailysession->agent_name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-custom">
        <div class="employee-info">
            <div class="row">
                <div class="form-group col-md-6 col-lg-4">
                    <label>Corp Email</label>
                    <span class="form-control text-truncate" title="{{ $dailysession->corporate_email }}">{{ $dailysession->corporate_email }}</span>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label>Team Leader</label>
                    <span class="form-control text-truncate" title="{{ $dailysession->team_leader }}">{{ $dailysession->team_leader }}</span>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label>Campaign</label>
                    <span class="form-control text-truncate" title="{{ $dailysession->campaign }}">{{ $dailysession->campaign }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 col-lg-4">
                <label>Type</label>
                <span class="form-control">{{ $dailysession->type }}</span>
            </div>
            <div class="form-group col-md-6 col-lg-4">
                <label>Tactic</label>
                <span class="form-control">{{ $dailysession->tactic }}</span>
            </div>
            <div class="form-group col-md-6 col-lg-4">
                <label>Behaviour</label>
                <span class="form-control">{{ $dailysession->behaviour }}</span>
            </div>
            <div class="form-group col-md-6 col-lg-4">
                <label>Metric</label>
                <span class="form-control">{{ $dailysession->metric }}</span>
            </div>
            <div class="form-group col-md-6 col-lg-4">
                <label>Score</label>
                <span class="form-control">{{ $dailysession->score }}</span>
            </div>
            <div class="form-group col-md-6 col-lg-4">
                <label>Created By</label>
                <span class="form-control">{{ $dailysession->creator->name }}</span>
            </div>
            <div class="form-group col-12">
                <label>Comments</label>
                <p class="form-control" style="white-space:pre-wrap;height:auto;">{!! $dailysession->comments !!}</p>
            </div>
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
