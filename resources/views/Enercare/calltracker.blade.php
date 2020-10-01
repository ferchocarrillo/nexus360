@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Call Tracker')

@section('content_header')
<h1 class="d-inline">Call Tracker</h1>
<div class="float-right dropdown">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-dollar-sign mr-2"></i> Sales
    </a>
    <div class="dropdown-menu dropdown-menu-right p-0">
        <div class="callout callout-danger mb-0">
        <h6>Today <span class="badge badge-primary ml-2">{{$sales->Today}}</span></h6>
            <h6>This month <span class="badge badge-primary ml-2">{{$sales->ThisMonth}}</span></h6>
            <h6 class="mb-0">Last month <span class="badge badge-primary ml-2">{{$sales->LastMonth}}</span></h6>
        </div>
        {{-- <a href="#" class="mt-1 btn btn-primary text-white btn-sm btn-block show-sales">Show sales</a> --}}
    </div>
</div>
@stop

@section('content')


<calltracker-component 
    :plans="{{$plans}}" 
    :notpitchandsales="{{$notpitchandsales}}"
    :categories="{{json_encode($categories)}}" 
    :allcategories="{{$allcategories}}"
>
</calltracker-component>
{{-- 
        {!! Form::open(['route' => 'enercare.calltrackerStore', 'method'=>'POST']) !!}

        <div class="form-group">
            {{ Form::label('category', 'Category') }}
            {{ Form::select('category',['' => 'Select Category'] + $categories , null ,['required'=>'required', 'data-placeholder'=>"Select Category", 'class' => 'form-control select2 ' . ($errors->has('category') ? 'is-invalid' : '' )]) }}
            @include('errors.errors', ['field' => 'category'])
        </div>
        <div class="form-group">
            {{ Form::label('subcategory', 'Subcategory') }}
            {{ Form::select('subcategory',['' => 'Select Subcategory'] , null ,['required'=>'required', 'data-placeholder'=>"Select Subcategory", 'class' => 'form-control select2 ' . ($errors->has('subcategory') ? 'is-invalid' : '' )]) }}
            @include('errors.errors', ['field' => 'subcategory'])
        </div>

        <div class="form-group">
            {{ Form::label('pitch', 'Pitch ?') }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <input type="checkbox" name="checkPitch" aria-label="Checkbox for following text input"
                            id="checkPitch">
                    </span>
                </div>
                {{ Form::select('pitch[]',['' => 'Select Reason Not Pitch'] + $notpitch  , null ,['required'=>'required', 'class' => 'form-control select2 ' . ($errors->has('pitch') ? 'is-invalid' : '' )]) }}
                @include('errors.errors', ['field' => 'pitch'])
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('sale', 'Was it a sale?') }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <input type="checkbox" aria-label="Checkbox for following text input" id="checkSale" name="checkSale">
                    </span>
                </div>
                {{ Form::select('sale[]',$plans  , null ,['multiple' => true,'data-placeholder'=>"Select Plan", 'class' => 'form-control select2 ' . ($errors->has('sale') ? 'is-invalid' : '' )]) }}
            </div>
            @include('errors.errors', ['field' => 'sale'])
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="btn">Submit</button>
        </div>


        {!! Form::close() !!} --}}

@stop

@push('js')

{{-- <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>

<script>
$.fn.select2.defaults.set("theme", "bootstrap4");
$.fn.select2.defaults.set("width", "resolve");

let allcategories = {!!json_encode($allcategories)!!};
let notpiches = {!!json_encode($notpitch)!!};
let plans = {!!json_encode($plans)!!};
let oldInputs = {!!json_encode(session()->getOldInput())!!}
var pitch = $("select[name='pitch[]'").first();
var sale = $("select[name='sale[]'").first();


$(document).ready(function () {   
    $('.select2').select2({ width: '100%!important' });

    $('#category').change(function () {
        var category = $(this).val();
        if (category == 'Call not completed') {
            $("label[for='site_id']").text('Phone Number')
        } else {
            $("label[for='site_id']").text('Site ID')
        }

        $("#subcategory").empty();
        $("#subcategory").select2({placeholder: "Select Subcategory"});
        $.each(allcategories, function (key, value) {
            if (category == value) {
                var o = new Option(key, key);
                $("#subcategory").append(o);
            }
        });
        $("#subcategory").val("");
        $("#subcategory").trigger('change');
    });

    $('#checkPitch').change(function () {
        fnpitch($('#checkPitch').prop('checked'));
    });

    $('#checkSale').change(function() {
        sale.prop("disabled", !$('#checkSale').prop('checked'));
    });



    fnpitch(false);
    fnOldInputs();

function fnOldInputs(){
    if('category' in oldInputs && oldInputs.category != null){
        $('#category').trigger('change');
        if('subcategory' in oldInputs && oldInputs.subcategory != null){
            $("#subcategory").val(oldInputs.subcategory);
            $("#subcategory").trigger('change');
        }
    }
    
    $("#checkPitch").prop("checked", ('checkPitch' in oldInputs) ? true : false).trigger('change');
    if('pitch' in oldInputs){
            $.each(oldInputs.pitch,function(i,e){
                pitch.find("option[value='" + e +"']").prop("selected",true);
            });

            if('checkSale' in oldInputs){
                $("#checkSale").prop("checked", true).trigger('change');
                if('sale' in oldInputs){
                    $.each(oldInputs.sale,function(i,e){
                        sale.find("option[value='" + e +"']").prop("selected",true);
                    });
                }
            }
    }
}

function fnpitch (bool) {
    pitch.empty();
    $("#checkSale").prop("disabled", !bool);
    if(bool){
        pitch.prop('multiple',true).select2({placeholder: "Select Plan"});
        
        $.each(plans,function(key,value){
            var o = new Option(value,value);
            pitch.append(o);
        })
    }else{
        pitch.prop('multiple',false).select2({placeholder: "Select the reason why you did not pitch"});
        $("#checkSale").prop("checked", false).trigger('change');
        $.each(notpiches,function(key,value){
            var o = new Option(value,value);
            pitch.append(o);
        });
        pitch.val("");
        pitch.trigger('change');
    }
    sale.prop("disabled", !$('#checkSale').prop('checked'));
}


});



</script> --}}
@endpush