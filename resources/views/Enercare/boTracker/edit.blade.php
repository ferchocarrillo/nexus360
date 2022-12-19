@extends('adminlte::page')
@section('title_postfix', ' | Enercare BO Tracker Edit')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/enercare.css') }}">
@stop
@section('content_header')
    <img alt="logo" class="logo" src="\img\EnercareTracker\enercare-seeklogo.com.svg" />
    <a href="/enercare/botracker" class="btn btn-info float-right" type="button" title="return"><i class="fas fa-undo"></i></a>
    <h1 class="title_h1"> Enercare BO Tracker</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card_first">
                <div class="card-body">
                    <div class="card col-md-12">
                        <div class="card-body">
                            {!! Form::model($trkEdit, ['route' => ['botracker.update', $trkEdit->id], 'method' => 'PATCH']) !!}
                            <div class="form-group">
                                <div class="form-group col-md-8">
                                    <label for="Queue_Tracker">Queue Tracker</label>
                                    @if ($trkEdit->lob == 'OBA')
                                        {{ Form::select('queue_tracker', $obas, null, ['class' => 'custom-select ' . ($errors->has('queue_tracker') ? 'is-invalid' : ''), 'required']) }}
                                    @endif
                                    @if ($trkEdit->lob == 'OFFLINE')
                                        {{ Form::select('queue_tracker', $offlines, null, ['class' => 'custom-select ' . ($errors->has('queue_tracker') ? 'is-invalid' : ''), 'required']) }}
                                    @endif
                                    <div class="form-group col-md-8">
                                        <label for="Case">Case</label>
                                        <input type="text" class="form-control" id="case" placeholder="Case"
                                            name="case" value="{{ old('case', $trkEdit->case) }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop
