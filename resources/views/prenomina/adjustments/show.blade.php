<style>
    #adjustment-activity {
        /* border-radius: .5rem; */
        /* padding-top: .5rem; */
        /* padding-bottom: .5rem; */
        /* background: #e9ecef; */
    }

    #adjustment-activity ul .list-group-item {
        padding: 1rem 0 .2rem;
        border: none;
        /* background: transparent; */
    }

    #adjustment-activity ul .list-group-item strong {
        position: absolute;
        font-size: .6rem;
        font-weight: normal;
        left: 0;
        top: .1rem;
        color: rgba(0, 0, 0, 0.5);
    }

    #adjustment-activity .info:last-of-type{
        margin-bottom: 0;
    }

    #adjustment-activity .info{
        width: 300px;
        min-height: 170px;
        position: relative;
        border-bottom: 1px solid rgba(0,0,0,.125);
        border-left: 30px solid var(--primary);
        padding: 15px;
        font-size: small;
        display: inline-block;
        margin-bottom: 2px;
    }
    #adjustment-activity .info h3 {
        font-size: 0.8rem;
        color: white;
        text-transform: uppercase;
        letter-spacing: 3px;
        position: absolute;
        bottom: 0;
        left: 0;
        margin-left: -25px;
        -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        transform: rotate(270deg);
        -webkit-transform-origin: 0 0;
        -moz-transform-origin: 0 0;
        -ms-transform-origin: 0 0;
        -o-transform-origin: 0 0;
        transform-origin: 0 0;
    }
    #adjustment-activity #adjustment-approved-time{
        font-size: 1.3rem;
        font-weight: bold;
        color: var(--danger);
    }

    

    
</style>
<div class="row">
    <div class="col" id="adjustment-activity">
        <div class="info">
            <h3>Adjustment</h3>
            <ul class="list-group list-group-flush">
                @if($adjustment->created_by)
                <li class="list-group-item">
                    <strong>Creator</strong>
                    <span id="adjustment-created-by">{{ $adjustment->creator ? $adjustment->creator->name : '' }}</span>
                </li>
                @endif
                <li class="list-group-item">
                    <strong>Adjustment Type</strong>
                    <span id="adjustment-type">{{ $adjustment->adjustment_type }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Justification</strong>
                    <span id="adjustment-justification">{{ $adjustment->justification }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Observations</strong>
                    <span id="adjustment-observations">{{ $adjustment->observations }}</span>
                </li>
                @if ($adjustment->supervisor_approval_required && $adjustment->supervisor_approval_status)
                    <li class="list-group-item">
                        <strong>Supervisor Approval Status</strong>
                        <span id="adjustment-supervisor-approval">{{ $adjustment->supervisor_approval_status }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Supervisor Approval Date</strong>
                        <span
                            id="adjustment-supervisor-approval-date">{{ date('Y-m-d H:i:s', strtotime($adjustment->supervisor_approval_date)) }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Supervisor Comments</strong>
                        <span
                            id="adjustment-supervisor-approval-comment">{{ $adjustment->supervisor_approval_comment }}</span>
                    </li>
                @endif
                @if ($adjustment->om_approval_required && $adjustment->om_approval_status)
                    <li class="list-group-item">
                        <strong>OM Approval Status</strong>
                        <span id="adjustment-om-approval">{{ $adjustment->om_approval_status }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>OM Approval Date</strong>
                        <span
                            id="adjustment-om-approval-date">{{ date('Y-m-d H:i:s', strtotime($adjustment->om_approval_date)) }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>OM Comments</strong>
                        <span id="adjustment-om-approval-comment">{{ $adjustment->om_approval_comment }}</span>
                    </li>
                @endif
                @if ($adjustment->approved_time)
                    <li class="list-group-item">
                        <strong>Approved Time</strong>
                        <span id="adjustment-approved-time">{{ gmdate('H:i:s',$adjustment->approved_time) }}</span>
                    </li>
                @endif
            </ul>
        </div>
        @if ($adjustment->payroll_activity)
        <div class="info">
            <h3>Activity</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Activity Name</strong>
                    <span id="payroll-activity-name">{{ $adjustment->payroll_activity->activity_name }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Activity Type</strong>
                    <span id="payroll-activity-type">{{ $adjustment->payroll_activity->activity_type }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Date</strong>
                    <span id="payroll-activity-date">{{ $adjustment->payroll_activity->date }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Surcharge</strong>
                    <span id="payroll-activity-surcharge">{{ $adjustment->payroll_activity->surcharge }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Start Date</strong>
                    <span
                        id="payroll-activity-start-date">{{ date('Y-m-d H:i:s', strtotime($adjustment->payroll_activity->start_date)) }}</span>
                    {{-- <span id="payroll-activity-start-date">{{ $adjustment->payroll_activity->start_date }}</span> --}}
                </li>
                <li class="list-group-item">
                    <strong>End Date</strong>
                    <span
                        id="payroll-activity-end-date">{{ date('Y-m-d H:i:s', strtotime($adjustment->payroll_activity->end_date)) }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Total Time In Seconds</strong>
                    <span
                        id="payroll-activity-total-time-in-seconds">{{ gmdate('H:i:s', $adjustment->payroll_activity->total_time_in_seconds) }}</span>
                </li>
            </ul>
        </div>            
        @endif
    </div>
    {{-- permission edit --}}
    @if(($permissionOM && $adjustment->om_approval_required &&
        $adjustment->om_approval_status == null && $adjustment->supervisor_approval_status == $approved_status) ||
        ($permissionSupervisor && $adjustment->supervisor_approval_required && 
        $adjustment->supervisor_approval_status == null)
        )
        {{-- @if ($adjustment->status == 'Pendiente') --}}
            <div class="col-md-12 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-normal">Approval Form</h5>
                        <form id="adjustmentForm" method="POST"
                            action="{{ route('prenomina.adjustments.approve', $adjustment->id) }}">
                            @csrf
                            {{-- Approval Status --}}
                            <div class="form-group">
                                {{-- approval_statuses --}}
                                {{ Form::select('adjustment_approval_status', $approval_statuses, null, ['class' => 'form-control', 'id' => 'adjustment-approval-status', 'placeholder' => 'Select Approval Status', 'required']) }}
                            </div>
                            {{-- Approved Time --}}
                            @if ($adjustment->payroll_activity && !$adjustment->approved_time)
                                <div class="form-group">
                                    <label for="approved_time"></label>
                                    <input 
                                        type="range" 
                                        class="custom-range" 
                                        id="approved_time" 
                                        value="{{$adjustment->payroll_activity->total_time_in_seconds}}" 
                                        min="1" 
                                        max="{{$adjustment->payroll_activity->total_time_in_seconds}}"
                                        name="approved_time"
                                        required
                                        >
                                </div>
                            @endif
                            {{-- Comments --}}
                            <div class="form-group">
                                <textarea class="form-control" name="adjustment_comments" id="adjustment-comments" rows="3" placeholder="Comments"
                                    required maxlength="255"></textarea>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endif
</div>
<script>
$(function() {
    const approvedTime = $('#adjustmentForm #approved_time');
    const approvedTimeLabel = $('#adjustmentForm label[for=approved_time]');
    const secondsToTime= (seconds)=>{
        return new Date(parseInt(seconds)*1000).toISOString().slice(11,19)
    }
    const maxTime = approvedTime.val()

    $("#adjustmentForm").on("submit", function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        var formURL = form.attr("action");
        var modal = $("#adjustmentModal");

        axios.interceptors.request.use(
            function(config) {
                modal.find("form").hide();
                modal.find("#loading").show();
                return config;
            },
            function(error) {
                return Promise.reject(error);
            }
        );

        axios.post(formURL, formData)
            .then(function(response) {
                if (response.status == 200) {
                    const event = new Event('refresh_data');
                    document.dispatchEvent(event);
                    // close modal
                    setTimeout(() => {
                        modal.modal("hide");
                    }, 1000);
                }
            })
            .catch(function(error) {
                console.log(error);
            });
    });
    
    if(approvedTime.length){
        approvedTimeLabel.text(secondsToTime(approvedTime.val()))
        approvedTime.on({
            input: function(e){
                // if($(this).val() > maxTime){
                //     $(this).val(maxTime)
                //     $(this).attr('max',maxTime)
                // }
                approvedTimeLabel.text(secondsToTime($(this).val()))
            }
        })
    }


})
</script>
