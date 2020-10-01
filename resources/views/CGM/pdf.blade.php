<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CGM Appointment</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {

            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            text-align: left;
            background-color: #ffffff;
        }

        .logo img {
            width: 110px;
        }

        .logo {
            margin-top: 10px;
        }

        .text-primary {
            color: #143E70;
        }

        .title {
            width: 100%;
            font-size: 25pt;
            margin-top: 0px;
            margin-bottom: 5px;
        }

        .other-text {
            position: absolute;
            text-align: left;
            font-style: italic;
            font-size: 8;
            top: 110px;
            left: 400px;
        }


        hr {
            border: 0;
            border-top: 1px solid #ccc;
            margin: 0px;
        }

        .contact-list {
            margin-top: 5px;
            list-style-type: none;
            font-size: 9pt;
        }

        .container {
            margin-left: 55px;
            margin-right: 55px;
            margin-top: 40px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .column {
            float: left;
        }

        .border {
            border: 1px solid #ddd;
        }

        .information {
            margin-bottom: 10px;
        }

        .information>div:nth-child(1) {
            width: 20%;
            text-align: right;
            font-size: 9;
            font-weight: bold;
            line-height: 1.2;
        }

        .information>div:nth-child(2) {
            width: 78%;
            padding-left: 20px;
            font-size: 9;
            line-height: 1.2;
        }

        .engagement {
            margin-bottom: 10px;
        }

        .engagement>div:nth-child(1) {
            width: 20%;
            text-align: right;
        }

        .engagement>div:nth-child(2) {
            width: 78%;
            padding-left: 20px;
            font-size: 9;
            font-weight: bold;
            line-height: 1.2;
        }

        .align-items-center {
            -webkit-box-align: center !important;
            -ms-flex-align: center !important;
            align-items: center !important;
        }

        .d-flex {
            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;
        }


    </style>
</head>

<body>


    <div class="container">
        <div class="row ">
            <div class="column logo" style="width:17%;;height:200px;">
                <img src="{{ asset('img/appointment_icon.png') }}" alt="">
            </div>
            <div class="column " style="width:81%;height:200px;">
                <span class="other-text text-primary">Scheduled by your partner at Infinity</span>
                <h1 class="title text-primary">Appointment Confirmation</h1>
                <hr>
                <ul class="contact-list">
                    <li style="text-transform:capitalize;font-weight:bold;">
                        {{$apt->executive_first_name.' '.$apt->executive_last_name}}</li>
                    <li style="text-transform:capitalize;"></li>
                    <li style="text-transform:uppercase;">{{$apt->company_name}}</li>
                    <li style="text-transform:uppercase;">{{$apt->location_address}}</li>
                    <li style="text-transform:uppercase;">
                        {{$apt->location_city.', '. $apt->location_state.' '.$apt->location_zip_code}}</li>
                    <li style="text-transform:uppercase;font-weight:bold;">
                        {{date('m/d/y h:i:s a',strtotime($apt->appointment_date))}}</li>
                    <li style="text-transform:lowercase;font-weight:bold;">{{$apt->confirmed_email}}</li>
                    <li style="text-transform:capitalize;font-weight:bold;">{{$apt->phone_number_combined}}</li>
                </ul>
            </div>
        </div>

        <div class="row" style="margin-top:10px;">
            <div class="column" style="width:8%;height:25px;">
                <h5 class="text-primary">Criteria</h5>
            </div>
            <div class="column" style="width:91%;height:25px;">
                <hr style="margin-top:9px;">
            </div>
        </div>

        <div class="row information">
            <div class="column">
                <p class="text-primary">Speciality of the practice</p>
            </div>
            <div class="column">
                <p>{{$apt->speciality_of_the_practice}}</p>
            </div>
        </div>
        <div class="row information">
            <div class="column">
                <p class="text-primary">Solutions currently being used</p>
            </div>
            <div class="column">
                <p>{{$apt->solutions_currently_being_used}}</p>
            </div>
        </div>
        <div class="row information">
            <div class="column">
                <p class="text-primary">Current contract term</p>
            </div>
            <div class="column">
                <p>{{$apt->current_contract_term}}</p>
            </div>
        </div>
        <div class="row information">
            <div class="column">
                <p class="text-primary">Customer budget</p>
            </div>
            <div class="column">
                <p>{{$apt->customer_budget}}</p>
            </div>
        </div>
        <div class="row information">
            <div class="column">
                <p class="text-primary">Percent of claims paid</p>
            </div>
            <div class="column">
                <p>{{$apt->percent_of_claims_paid}}%</p>
            </div>
        </div>
        <div class="row information">
            <div class="column">
                <p class="text-primary">Current solution positives</p>
            </div>
            <div class="column">
                <p>{{$apt->current_solution_positives}}</p>
            </div>
        </div>
        <div class="row information">
            <div class="column">
                <p class="text-primary">Current solution challenges/wish list</p>
            </div>
            <div class="column">
                <p>{{$apt->current_solution_challenges}}</p>
            </div>
        </div>
        <div class="row information">
            <div class="column">
                <p class="text-primary">Additional participants</p>
            </div>
            <div class="column">
                <p>{{$apt->additional_participants}}</p>
            </div>
        </div>
        <div class="row information">
            <div class="column">
                <p class="text-primary">CGM solutions of interest</p>
            </div>
            <div class="column">
                <p>{{$apt->cgm_solutions_of_interest}}</p>
            </div>
        </div>
        <div class="row information">
            <div class="column">
                <p class="text-primary">Comments</p>
            </div>
            <div class="column">
                <p>{!! nl2br(e($apt->comments)) !!}</p>
            </div>
        </div>
        @if ($apt->details_confirmed_via_call != null)
        <div class="row" style="margin-top:10px;">
            <div class="column" style="width:13%;height:25px;">
                <h5 class="text-primary">Engagement</h5>
            </div>
            <div class="column" style="width:86%;height:25px;">
                <hr style="margin-top:9px;">
            </div>
        </div>

        <div class="row engagement d-flex align-items-center">
            <div class="column">
                <img src="{{ asset('img/check_'.($apt->details_confirmed_via_call ? 'OK': 'KO').'.png') }}" width="20px"
                    alt="">
            </div>
            <div class="column">
                <p class="text-primary">Details confirmed via call</p>
            </div>
        </div>
        <div class="row engagement d-flex align-items-center">
            <div class="column">
                <img src="{{ asset('img/check_'.($apt->voice_recording_sent ? 'OK': 'KO').'.png') }}" width="20px"
                    alt="">
            </div>
            <div class="column">
                <p class="text-primary">Voice recording sent</p>
            </div>
        </div>
        <div class="row engagement d-flex align-items-center">
            <div class="column">
                <img src="{{ asset('img/check_'.($apt->accepted_calendar_invite ? 'OK': 'KO').'.png') }}" width="20px"
                    alt="">
            </div>
            <div class="column">
                <p class="text-primary">Accepted calendar invite</p>
            </div>
        </div>

        <div class="row" style="margin-top:10px;">
            <div class="column" style="width:8%;height:25px;">
                <h5 class="text-primary">Quality</h5>
            </div>
            <div class="column" style="width:91%;height:25px;">
                <hr style="margin-top:9px;">
            </div>
        </div>

        <div class="row information">
            <div class="column">
                <img src="{{ asset('img/check_OK.png') }}" width="20px" alt="">
            </div>
            <div class="column">
                <p>Appointment quality checked by {{$apt->qaName}} on {{date('M d yy h:i:s A',strtotime($apt->dateQA))}}
                </p>
            </div>
        </div>
        @endif


    </div>



</body>

</html>