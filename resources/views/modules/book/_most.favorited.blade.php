{{--Favorites--}}
<div class="row">

    <div class="col-xs-12 col-sm-12">


        <!-- START CONTENT ITEM -->
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                <h3>{{ trans('word.most-favorited') }} </h3>
            </div>
        </div>
        <!-- END CONTENT ITEM -->


        <!-- START CONTENT ITEM -->
        <div class="row" style="text-align: center">
            @foreach($mostFavoriteBooks as $book)
                <div class="col-xs-12 col-md-3" style="margin:0px;">
                    <div class=" product-list-inline-small">
                        <div class="thumbnail">
                            <a href="{{ action('BookController@show',$book->id) }}"><img src="{{ $book->__get('cover') }}" alt=""></a>
                            <div class="caption">
                                <a href="{{ action('BookController@show',$book->id) }}"><h4>{{ $book->__get('title') }}</h4></a>
                                <p>{{ \Str::limit($book->__get('body'),25) }} </p>
                                <span class="label label-info price pull-right">&euro; 123,-</span>
                            </div>
                        </div>
                    </div>


                </div>
            @endforeach
        </div>
        <!-- END CONTENT ITEM -->
    </div>
</div>