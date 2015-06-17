@extends('layouts.one_col')

@section('content')
<div class="row">
    <div class="col-xs-12 paddingTop10">

        <div class="well well-lg">
            <div class="row">

                <div class="col-lg-10">

                    <div>{{ trans('word.name') }} : {{ $user->__get('name') }}</div>
                    <div>{{ trans('word.email') }} : {{ $user->email }}</div>
                    <div>{{ trans('word.phone') }} : </div>
                    <div>{{ trans('word.address') }} : </div>
                </div>

                <div class="col-lg-2">
                    @if(Auth::user()->id === $user->id)
                    <a class="btn btn-info {{ (App::getLocale('lang') ==='ar') ? 'pull-left' : 'pull-right'  }}" href="{{ action('UserController@edit',$user->id) }}">{{ trans('word.edit') }}</a></br>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection