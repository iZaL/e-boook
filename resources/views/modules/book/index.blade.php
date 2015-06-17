
@extends('layouts.one_col')

@section('content')

    @include('modules.book._latest_added')

        @if(isset($render))

        {!! $books->render() !!}

        @endif

    @if(isset($mostFavoriteBooks))

        @include('modules.book._most_favorited')

    @endif

@stop
