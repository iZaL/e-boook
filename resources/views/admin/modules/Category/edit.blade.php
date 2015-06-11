@extends('admin.layouts.one_col')

@section('content')
<div class="row">

<div class="col-lg-6 col-md-6 col-lg-offset-3">
    <div class="panel panel-default">

        <div class="panel-heading">
            {{ trans('word.edit-category') }}
        </div>
        <div class="panel-body">
            {!! Form::model($category,['action'=>['Admin\AdminCategoryController@update',$category->id],'method'=>'put'],['class'=>'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('name_ar',trans('word.category-ar')) !!}
                {!! Form::text('name_ar',null,['class'=>'form-control','placeholder'=>trans('word.category-ar')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_en',trans('word.category-en')) !!}
                {!! Form::text('name_en',null,['class'=>'form-control','placeholder'=>trans('word.category-en')]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit(trans('word.save'),['class'=>'btn btn-success form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

</div>

@endsection