<div class="card card-primary card-outline card-tabs">
    @if(count($data)<1) <div class="card-body">No results found</div>
@else
<div class="card-header p-0 pt-1">
 
    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home"
                role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile"
                role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Appointments</a>
        </li>

        <div class="ml-auto mr-2 d-flex align-items-center">
            <a href="{{ route('cgm.reports.downloadReport',$dates ) }}"
                class="btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

    </ul>
</div>
<div class="card-body">
    <div class="tab-content" id="custom-tabs-one-tabContent">
        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
            aria-labelledby="custom-tabs-one-home-tab">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Call ID</th>
                            <th>Username</th>
                            <th>Company Name</th>
                            <th>Disposition</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $rows =0;
                        @endphp
                        @foreach ($data as $row)
                        @php
                        $rows +=1;
                        @endphp
                        <tr>

                            <td>{{$row->callID}}</td>
                            <td>{{$row->username}}</td>
                            <td>{{$row->company_name}}</td>
                            <td>{{$row->disposition}}</td>
                        </tr>

                        @if ($rows > 50)
                            @break
                        @endif
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
            aria-labelledby="custom-tabs-one-profile-tab">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Call ID</th>
                            <th>Username</th>
                            <th>Company Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                        $sales =0;
                        @endphp
                        @foreach ($data as $row)

                        @if($row->required_appointment == 1 )


                        @php
                        $sales +=1;
                        @endphp
                        <tr>

                            <td>{{$row->callID}}</td>
                            <td>{{$row->username}}</td>
                            <td>{{$row->company_name}}</td>
                            <td>
                            {{-- @if($row->qaRating === null)
                            QA pending
                            @else --}}
                            <a href="{{ route('cgm.reports.pdf',$row->id) }}"><i class="fas fa-file-pdf"></i></a>
                            {{-- @endif --}}
                        
                            </td>
                        </tr>
                        @endif
                        @endforeach

                        @if($sales == 0)
                        <tr>
                            <th>No sales found</th>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endif
</div>