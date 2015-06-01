@extends('admin.layouts.one_col')

@section('title')
    <h1>Contact Us</h1>
@stop

@section('content')

    {!! Form::model($contactInfo, ['action' => ['Admin\AdminContactUsController@update'], 'method' => 'post'], ['class'=>'form-horizontal']) !!}

    <div class="form-group col-md-4 col-lg-4">
        {!! Form::label('company', trans('word.company'), ['class' => 'control-label']) !!}
        {!! Form::text('company', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-4 col-lg-4">
        {!! Form::label('phone', trans('word.phone'), ['class' => 'control-label']) !!}
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-4 col-lg-4">
        {!! Form::label('mobile', trans('word.mobile'), ['class' => 'control-label']) !!}
        {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-4 col-lg-4">
        {!! Form::label('zipcode', trans('word.zipcode'), ['class' => 'control-label']) !!}
        {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-4 col-lg-4">
        {!! Form::label('country', trans('word.country'), ['class' => 'control-label']) !!}
        {!! Form::text('country', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-4 col-lg-4">
        {!! Form::label('email', trans('word.email'), ['class' => 'control-label']) !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>



    <div class="form-group">
        {!! Form::label('address', trans('word.address'), ['class' => 'control-label']) !!}
        {!! Form::textarea('address', null, ['class' => 'form-control editor','placeholder'=>trans('word.address')]) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

@stop