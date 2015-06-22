@extends('admin.layouts.one_col')

@section('style')
    @parent
@stop

@section('script')
    @parent
    @include('partials.tinymce')
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-6">
                    <h3>{{ trans('word.book-edit') }}</h3>
                </div>
                <div class="col-lg-6">
                    <p style="color:red;">(*) - {{ trans('word.all-started-required') }}</p>
                    <p style="color:red;">(*) - {{ trans('word.cover-instructions') }}</p>
                </div>
            </div>
        </div>
        <div class="panel-body">
            @if(Session::get('role.admin'))
            {!! Form::model($book,['route' => 'app.admin.book.update', 'method' => 'PATCH','files'=>'true'], ['class'=>'form-horizontal']) !!}
            @elseif(Session::get('role.editor'))
            {!! Form::model($book,['route' => 'app.editor.book.update', 'method' => 'PATCH','files'=>'true'], ['class'=>'form-horizontal']) !!}
            @endif
        {!! Form::hidden('id',$book->id)!!}
    <div class="row">
        <div class="row page-header">
            <div class="col-lg-2 col-md-2 col-lg-offset-4">
                <img class="img-thumbnail img-responsive " src="/img/cover/cover_ar/thumbnail/{{$book->cover_ar }}" alt="">
            </div>
            <div class="col-lg-2 col-md-2 ">
                <img class="img-thumbnail img-responsive " src="/img/cover/cover_en/thumbnail/{{$book->cover_en }}" alt="">
            </div>
        </div>
        <div class="form-group col-lg-4 col-md-4">
            {!! Form::label('free', trans('word.free-book'))  !!}
            {!! Form::hidden('free', 0) !!}
            {!! Form::checkbox('free', 1, $book->free,['class'=>'free']) !!} </br>
            {!! Form::label('type', trans('word.preview-as-book'))!!}
            {!! Form::radio('type', 'book',true) !!}
            {!! Form::label('type', trans('word.preview-as-poem'))!!}
            {!! Form::radio('type', 'poem', false) !!}
        </div>
        <div class="form-group col-md-2 col-lg-2">
            {!! Form::hidden('price',0) !!}
            {!! Form::label('price', trans('word.price') , ['class' => 'control-label']) !!}*
            {!! Form::text('price', $book->meta->price , ['class' => 'price form-control','placeholder'=> trans('word.price-kd'),'disabled'=>'disabled']) !!}
        </div>
        <div class="form-group col-md-3 col-lg-3">
            {!! Form::label('cover_ar', trans('word.cover_ar') , ['class' => 'control-label']) !!}*
            {!! Form::file('cover_ar', ['class' => 'form-control','placeholder'=> trans('word.cover_ar') ]) !!}
        </div>
        <div class="form-group col-md-3 col-lg-3">
            {!! Form::label('cover_en', trans('word.cover_en') , ['class' => 'control-label']) !!}*
            {!! Form::file('cover_en',['class' => 'form-control','placeholder'=> trans('word.cover_en') ]) !!}
        </div>
    </div>
    <div class="form-group col-md-4 col-lg-4">
        {!! Form::label('title_en', 'Title In English', ['class' => 'control-label']) !!}*
        {!! Form::text('title_en', null, ['class' => 'form-control','placeholder'=>'Book Title in English']) !!}
    </div>

    <div class="form-group col-md-4 col-lg-4">
        {!! Form::label('title_ar', 'Title In Arabic', ['class' => 'control-label']) !!}*
        {!! Form::text('title_ar', null, ['class' => 'form-control','placeholder'=>'Book Title in Arabic']) !!}
    </div>

    <div class="form-group col-md-2 col-lg-2">

        {!! Form::label('category_id', trans('word.categories'), ['class' => 'control-label']) !!}*
        {!! Form::select('category_id', $categories ,null, ['class' => 'form-control','style'=>'text-align:left !important;']) !!}
    </div>
    @if(Session::get('role.admin'))
    <div class="form-group col-md-2 col-lg-2">
        {!! Form::label('status', trans('word.categories'), ['class' => 'control-label']) !!}*
        {!! Form::select('status', $status ,null, ['class' => 'form-control','style'=>'text-align:left !important;']) !!}
    </div>
    @endif
    <div class="row">
        <div class="form-group col-md-6 col-lg-6">
            {!! Form::label('description_ar',  trans('word.description-ar') , ['class' => 'control-label']) !!}*
            {!! Form::textarea('description_ar', null, ['class' => 'form-control','placeholder'=> trans('word.descrption-ar')]) !!}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {!! Form::label('description_en',  trans('word.description-en') , ['class' => 'control-label']) !!}*
            {!! Form::textarea('description_en', null, ['class' => 'form-control','placeholder'=> trans('word.descrption-en')]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('body', 'Book Content', ['class' => 'control-label']) !!}*
        {!! Form::textarea('body', null, ['class' => 'form-control editor','placeholder'=>'Book Content']) !!}
    </div>

    <div class="form-group">
        <div class="col-lg-6">
            {!! Form::submit(trans('word.save'), ['class' => 'btn btn-primary form-control']) !!}
        </div>
        <div class="col-lg-6">
            <a class="btn btn-danger form-control" href="{{ route('home') }}">{{ trans('word.cancel') }}</a>
        </div>
    </div>

    {!! Form::close() !!}
    </div>
</div>

@stop