@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Reminders')

@section('content_header')
    <h1>Send Reminder</h1>
@stop

@section('content')
    <div class="form-group">
        <input id="msgReminder" class="form-control" placeholder="Message">
    </div>
    <div class="form-group">
        <select id="campaign" class="custom-select">
            <option value="" disabled selected>--Select Campaign--</option>
            @foreach ($campaigns as $campaign)
                <option value="{{$campaign}}">{{$campaign}}</option>
            @endforeach
        </select>
    </div>
    <div id="response" class="form-group"></div>
    <button class="btn btn-primary" id="addREminder"><i class="fas fa-bell"></i> Add Reminder</button>

    
@stop

@push('js')
<script>

$(document).ready(()=>{
    let ifm_reminder = document.querySelector('#ifm_reminder')
    let buttonReminder = document.querySelector("#addREminder")
    let inputReminder = document.querySelector("#msgReminder")
    let campaign = document.querySelector("#campaign")
    let response = document.querySelector("#response")
    buttonReminder.addEventListener("click",(e)=>{

        if (inputReminder.value == '' || campaign.value == ''){
            $(response).html(`
            <div class="alert alert-danger" role="alert">
                All fields are required
            </div>
            `).find('.alert')
            .delay(3000).slideUp(300);

            return false;
        }

        $.get('/reminders',{campaign: campaign.value,reminder: inputReminder.value})
        .then(users=>{
            let data = {reminder:inputReminder.value,users:users}
            ifm_reminder.contentWindow.postMessage(JSON.stringify(data),'*')    

            inputReminder.value = "";
            campaign.value = "";
            $(response).html(`
            <div class="alert alert-success" role="alert">
                Reminder Sent Successfully
            </div>
            `).find('.alert')
            .delay(3000).slideUp(300);

            
        })
    })    
})

</script>

@endpush
