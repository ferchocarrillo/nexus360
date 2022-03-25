@foreach ($dailySessions as $dailySession)
    <div class="col-xl-3 col-md-4 col-sm-6 mb-2">
        <div class="card shadow">
            <div class="card-body  h-100">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            {{ $dailySession->agent_name }} 
                            @if (!$dailySession->acknowledge)
                                <span class="text-danger"><i class="fas fa-exclamation-circle"></i></span>    
                            @endif
                        </div>
                        <div class="text-xs text-muted text-uppercase mb-1">
                            {{ $dailySession->created_at }}
                        </div>
                        <div class="text-xs text-muted text-uppercase mb-1">
                            {{ $dailySession->tactic }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <a class="showDailySession" href="#" data-id="{{$dailySession->id}}"><i class="fas fa-chevron-right fa-2x text-info"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@if (count($dailySessions)==0)
<div class="col-xl-3 col-md-4 col-sm-6 mb-2">
    <div class="card shadow">
        <div class="card-body  h-100">
            No results found
        </div>
    </div>
</div>
@endif