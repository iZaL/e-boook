@extends('layouts.one_col')

@section('content')
    <div class="row">
        <div class="col-xs-12">

            <!-- START CONTENT ITEM -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#step1" data-toggle="tab"><i class="fa fa-aw fa-book"></i>{{ trans('word.books') }} </a></li>
                <li><a href="#step2" data-toggle="tab"><i class="fa fa-aw fa-book"></i>{{ trans('word.books-draft') }}</a></li>
                <li><a href="#step3" data-toggle="tab"><i class="fa fa-aw fa-book"></i>{{ trans('word.books-published') }}</a></li>
                <li><a href="#step4" data-toggle="tab"><i class="fa fa-aw fa-profile"></i>{{ trans('word.favorite-books') }}</a></li>
                <li><a href="#step5" data-toggle="tab"><i class="fa fa-aw fa-profile"></i>{{  trans('word.personal-info') }}</a></li>
            </ul>

            <div class="tab-content">

                {{--All Books for a user--}}
                <div class="tab-pane active" id="step1">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            <table class="table table-bordered table-order">
                                <thead>
                                <tr>
                                    <th class="hidden-xs">&nbsp;</th>
                                    <th></th>
                                    <th>Total Pages</th>
                                    <th>Status</th>
                                    <th>Last Edited</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($books->count() > 0)
                                    @foreach($books as $book)
                                        <tr>
                                            <td class="hidden-xs"><img src="{{ storage_path('app/cover_'.App::getLocale().'/thumbnail/'.$book->__get('cover')) }}" alt=""></td>
                                            <td>
                                                <a href="{{ route('book.show',$book->id) }}"> {{ $book->__get('title') }} </a>

                                                <p> {{ Str::limit(strip_tags($book->__get('description'))) }} </p>
                                            </td>
                                            <td>
                                                <span> {{ $book->meta ? $book->meta->total_pages : 'N/A' }} </span>

                                            </td>
                                            <td>
                                                <span> {{ $book->status }} </span>
                                            </td>
                                            <td>
                                                <span> {{ $book->updated_at->format('Y-m-d') }} </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                {{ trans('word.no-books-found') }}
                                @endif
                                </tbody>

                            </table>

                        </div>
                        {{--pagination for all books--}}
                        {!! $books->render() !!}
                    </div>
                </div>

                {{--Draft Books for a user--}}

                <div class="tab-pane" id="step2">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">

                            <table class="table table-bordered table-order" id="draft">
                                <thead>
                                <tr>
                                    <th class="hidden-xs">&nbsp;</th>
                                    <th></th>
                                    <th>Total Pages</th>
                                    <th>Status</th>
                                    <th>Last Edited</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                        @if($book->status === 'draft')
                                        <tr>
                                            <td class="hidden-xs"><img src="<img src="{{ storage_path('app/cover_'.App::getLocale().'/thumbnail/'.$book->__get('cover')) }}" alt=""></td>
                                            <td>
                                                <a href="{{ action('BookController@show',$book->id) }}"> {!! $book->title !!} </a>

                                                <p> {!! Str::limit(strip_tags($book->body)) !!} </p>
                                            </td>
                                            <td>
                                                <span> {{ $book->meta ? $book->meta->total_pages : 'N/A' }} </span>

                                            </td>
                                            <td>
                                                <span> {{ $book->status }} </span>
                                            </td>
                                            <td>
                                                <span> {{ $book->updated_at->format('Y-m-d') }} </span>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{--Published Books for a user--}}

                <div class="tab-pane" id="step3">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            <table class="table table-bordered table-order">
                                <thead>
                                <tr>
                                    <th class="hidden-xs">&nbsp;</th>
                                    <th></th>
                                    <th>Total Pages</th>
                                    <th>Status</th>
                                    <th>Last Edited</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                        @if($book->status === 'published')
                                        <tr>
                                            <td class="hidden-xs"><img src="{{ storage_path('app/cover_'.App::getLocale().'/thumbnail/'.$book->__get('cover')) }}" alt=""></td>
                                            <td>
                                                <a href="{{ action('BookController@show'),$book->id }}"> {!! $book->title !!} </a>

                                                <p> {!! Str::limit(strip_tags($book->body)) !!} </p>
                                            </td>
                                            <td>
                                                <span> {{ $book->meta ? $book->meta->total_pages : 'N/A' }} </span>

                                            </td>
                                            <td>
                                                <span> {{ $book->status }} </span>
                                            </td>
                                            <td>
                                                <span> {{ $book->updated_at->format('Y-m-d') }} </span>
                                            </td>
                                        </tr>
                                        @endif
                                @endforeach
                                        {{--@else
                                            <div class="alert alert-warning" role="alert">{{ trans('word.no-books-found') }}</div>
                                        @endif--}}
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


                {{--Favorite List for a user --}}
                <div class="tab-pane" id="step4">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            @if(count($favoriteBooks) > 0)
                                <table class="table table-bordered table-order" id="draft">
                                    <thead>
                                    <tr>
                                        <th class="hidden-xs">&nbsp;</th>
                                        <th></th>
                                        <th>Total Pages</th>
                                        <th>Status</th>
                                        <th>{{ trans('word.remove') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($favoriteBooks as $book)
                                        <tr>
                                            <td class="hidden-xs"><img src="{{ storage_path('app/cover_'.App::getLocale().'/thumbnail/'.$book->__get('cover')) }}" alt=""></td>
                                            <td>
                                                <a href="{{ action('BookController@show',$book->id) }}"> {!! $book->title !!} </a>

                                                <p> {!! Str::limit(strip_tags($book->body)) !!} </p>
                                            </td>
                                            <td>
                                                <span> {{ $book->meta ? $book->meta->total_pages : 'N/A' }} </span>

                                            </td>
                                            <td>
                                                <span> {{ $book->status }} </span>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger" href="{{ action('BookController@removeBookFromUserFavoriteList',[Auth::id(),$book->id]) }}">{{ trans('word.remove') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning" role="alert">{{ trans('word.no-books-found') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                {{--Person Information --}}

                <div class="tab-pane" id="step5">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">

                            <div class="well well-lg">
                                <a class="btn btn-info {{ (App::getLocale('lang') ==='ar') ? 'pull-left' : 'pull-right'  }}" href="{{ action('UserController@edit',Auth::id()) }}">{{ trans('word.edit') }}</a>
                                <div>{{ trans('word.name') }} : {{ Auth::user()->__get('name') }}</div>
                                <div>{{ trans('word.email') }} : {{ Auth::user()->name }}</div>
                                <div>{{ trans('word.phone') }} : </div>
                                <div>{{ trans('word.address') }} : </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <br>

        </div>


        <!-- END CONTENT ITEM -->

    </div>

@stop
