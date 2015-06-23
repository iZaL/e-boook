@extends('layouts.one_col')


@section('style')
    @parent
    <link rel="stylesheet" href="/css/lightbox.css"/>
@stop
@section('script')
    @parent
    <script src="/js/lightbox.min.js"></script>
@stop

@section('content')
    <!-- START CONTENT ITEM -->

    <div class="row">
        <div class="col-xs-9">
            <h2><span class="label label-default">{{ Str::limit($book->__get('title'),20) }}</span></h2>
        </div>
        <div class="col-xs-3">
            <div class="social-icons pull-right">

                <!-- Replace with something like:
                <div class="fb-like fb_edge_widget_with_comment fb_iframe_widget" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="arial">
                    <span style="height: 20px; width: 107px; ">
                        <iframe id="f36680bf28" name="f1bd6447bc" scrolling="no" style="border: none; overflow: hidden; height: 20px; width: 107px; " title="Like this content on Facebook." class="fb_ltr" src="http://www.facebook.com/plugins/like.php"></iframe>
                    </span>
                </div>
                -->
            </div>
        </div>
    </div>
    <!-- END CONTENT ITEM -->

    <div class="row product-detail">

        <div class="col-xs-12 col-sm-5 col-md-4">

            <!-- START CONTENT ITEM -->
            <a data-lightbox="example-1" data-title="My caption" href="/img/cover/cover_{{App::getLocale()}}/large/{{$book->__get('cover') }}">

                <img id="example-1" class="product-image img-responsive" src="/img/cover/cover_{{App::getLocale()}}/large/{{$book->__get('cover') }}" alt="{{ $book->title }}">
            </a>

            {{--<a class="product-detail-lightbox colorbox" rel="colorbox1" href="/img/cover/cover_{{App::getLocale()}}/large/{{$book->__get('cover') }}" title="{{ $book->title }}">
                <img class="details_page product-image img-responsive" src="/img/cover/cover_{{App::getLocale()}}/thumbnail/{{$book->__get('cover') }}" alt="{{ $book->title }}"></a>--}}

            <!-- END CONTENT ITEM -->
        </div>

        <div class="hidden-xs col-sm-2 col-md-1">

            <!-- START CONTENT ITEM -->
            <div class="row">
                <div class="col-sm-6 col-md-12 visible-xs">

                   {{-- <a rel="colorbox1" href="{{ $book->__get('title') }}" class="colorbox thumbnail">
                        <img alt="{{ $book->__get('title') }}" src="{{ $book->__get('cover') }}" class="img-responsive">
                    </a>--}}
                </div>
            </div>
            <!-- END CONTENT ITEM -->

        </div>

        <div class="col-xs-12 col-sm-5 col-md-7">

            <!-- Data of the BOOK ITEM -->
            <div class="well">
                <div class="row">
                    <div class="col-xs-6 col-sm-5 col-md-7 {{ App::getLocale('locale') === 'ar' ? 'text-left' : ''  }}">
                        <strong>{{ trans('word.author') }}</strong> <a href="{{ action('UserController@showSingleProfile', $author->id) }}"><span>{{ $author->__get('name') }}</span></a><br>
                        <strong>{{ trans('word.author-email') }}:</strong> <span>{{ $author->email }}</span><br>
                        <strong>{{ trans('word.pages-count') }}:</strong> <span>{{ $bookMeta ? $bookMeta->total_pages : '' }}</span><br>
                        <strong>{{ trans('word.book-extention') }}</strong> <span>{{ trans('word.pdf') }}</span><br>
                        <strong>{{ trans('word.book-type') }}:</strong> <span>{{ $book->status }}</span><br>
                        <strong>{{ trans('word.book-created_at') }}:</strong> <span>{{ $book->created_at->format('d-m-Y') }}</span><br>
                    </div>
                    <div class="col-xs-6 col-sm-7 col-md-5">
                        <span class="label label-important price"> {{  (!$book->free) ? ($bookMeta ?  'KD'.$bookMeta->price : '' ) : trans('word.free') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3>{{ trans('word.description') }}</h3>
                    </div>
                    <div class="col-lg-10">
                        <p>{{ $book->__get('description') }}</p>
                        </br>
                    </div>
                    <div class="col-lg-2">
                        {{--Views Number --}}
                        <a class="btn btn-info btn-sm" href="#"><i class="fa fa-eye fa-aw"></i> {{ $book->views }}</a>
                    </div>

                </div>

                <div class="row">
                    @if(!Session::get('auth.id'))
                    <div class="row">
                        <div class="col-lg-8 alert alert-info col-lg-offset-2">
                                {{ trans('word.needs-registeration') }}
                                <a class="btn btn-success btn-sm" href="/auth/register">{{ trans('word.register') }}</a>

                        </div>
                    </div>
                    @endif
                    <div class="col-xs-12 col-md-4">
                        <a class="btn btn-block btn-primary {{ (! Session::get('auth.id') || $book->free) ? 'disabled' : '' }}" alt="{{ trans('word.make-order') }}" href="{{ action('BookController@getCreateNewOrder',[$book->id,Session::get('auth.id')]) }}"><i class="fa fa-fw fa-list-alt"></i>  {{ trans('word.order-now') }}</a>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <a class="btn btn-block btn-danger {{ (! Session::get('auth.id')) ? 'disabled' : '' }}" href="{{ (Session::get('auth.id')) ? action('BookController@getCreateNewFavoriteList', [Session::get('auth.id'),$book->id]) : '#' }}"><i class="fa fa-fw fa-heart"></i>  {{ trans('word.add-favorite') }}</a>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        {{--Full Link for the Free Books-- Free Value = 1 --}}
                        @if($book->free)
                            <a class="btn btn-block btn-default {{ (!Session::get('auth.id')) ? 'disabled' : '' }}"
                               href="{{ action('BookController@getFreePdfFile',$book->url) }}">
                                <i class="fa fa-fw fa-book"></i>  {{ trans('word.book-full-preview') }}
                            </a>
                        @else
                        {{--Preview Link for Paid Books Only 10 Pages can be previewed - Free Value = 0 --}}
                        <a class="btn btn-block btn-default {{ (!Session::get('auth.id')) ? 'disabled' : '' }}"
                           href="{{ (Session::get('auth.id') && !$book->free) ? action('BookController@getFirstTenPagesForPaidBooks',$book->url) : '#' }}">
                            <i class="fa fa-fw fa-book"></i>  {{ trans('word.book-preview') }}
                        </a>
                        @endif
                    </div>

                    {{--Rating System--}}


                    {{--End of Rating System--}}
                </div>
            </div>
            <!-- END CONTENT ITEM -->

        </div>
    </div>
    <div id="disqus_thread"></div>
@stop

@section('script')
    @parent
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES * * */
        var disqus_shortname = 'ebookapp';

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
    {{--Rating Scripts--}}

@stop
