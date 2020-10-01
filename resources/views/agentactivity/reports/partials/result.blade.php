<div class="card">

    <div class="card-header">
     
        <div class="d-sm-flex align-items-center justify-content-between">
            <span>Records: {{count($activities)}}</span>
            <a href="{{ route('agentactivity.reportdownload',$dates ) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Activity</th>
                        <th>StartTime</th>
                        <th>EndTime</th>
                        <th>Total Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $activity->Agent }}</td>
                        <td>{{ $activity->Activity }}</td>
                        <td>{{ $activity->Start_Time }}</td>
                        <td>{{ $activity->End_Time }}</td>
                        <td>{{ $activity->DIFF }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>