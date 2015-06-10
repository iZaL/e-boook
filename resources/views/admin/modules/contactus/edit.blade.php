@extends('admin.layouts.one_col')

@section('title')
    <h3>{{ trans('word.contactus') }}</h3>
@stop

@section('content')

    {!! Form::model($contactInfo, ['action' => ['Admin\AdminContactUsController@update'], 'method' => 'post'], ['class'=>'form-horizontal']) !!}

    <div class="form-group col-md-4 col-lg-4">
        {!! Form::label('company', trans('word.company'), ['class' => 'control-label']) !!}
        {!! Form::text('company', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-2 col-lg-2">
        {!! Form::label('phone', trans('word.phone'), ['class' => 'control-label']) !!}
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-2 col-lg-2">
        {!! Form::label('mobile', trans('word.mobile'), ['class' => 'control-label']) !!}
        {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-4 col-lg-4">
        {!! Form::label('email', trans('word.email'), ['class' => 'control-label']) !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-1 col-lg-1">
        {!! Form::label('zipcode', trans('word.zipcode'), ['class' => 'control-label']) !!}
        {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-2 col-lg-2">
        {!! Form::label('country', trans('word.country'), ['class' => 'control-label']) !!}
        {!! Form::text('country', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-3 col-lg-3">
        {!! Form::label('youtube', trans('word.youtube'), ['class' => 'control-label']) !!}
        {!! Form::text('youtube', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-3 col-lg-3">
        {!! Form::label('instagram', trans('word.instagram'), ['class' => 'control-label']) !!}
        {!! Form::text('instagram', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-3 col-lg-3">
        {!! Form::label('twitter', trans('word.twitter'), ['class' => 'control-label']) !!}
        {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
    </div>



    <div class="form-group col-md-12 col-lg-12">
        {!! Form::label('address', trans('word.address'), ['class' => 'control-label']) !!}
        {!! Form::textarea('address', null, ['class' => 'form-control editor','placeholder'=>trans('word.address')]) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

@stop