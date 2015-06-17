{{--latest added--}}
<div class="row">

    <div class="col-xs-12 col-sm-12">


        <!-- START CONTENT ITEM -->
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                <h3>All Books </h3>
            </div>
        </div>
        <!-- END CONTENT ITEM -->


        <!-- START CONTENT ITEM -->
        <div class="row" style="text-align: center">
            @foreach($books as $book)

                <div class="col-xs-12 col-md-3" style="margin:0px;">
                    <div class=" product-list-inline-small">
                        <div class="thumbnail">
                            <a href="{{ action('BookController@show',$book->id) }}"><img class="img-responsive " src="/img/cover/cover_{{App::getLocale()}}/thumbnail/{{$book->__get('cover') }}" alt=""></a>
                            <div class="caption">
                                <div class="row">
                                    <a href="{{ action('BookController@show',$book->id) }}"><h4>{!! Str::limit($book->__get('title'),25) !!}</h4></a>
                                    <p>{!! e(Str::limit($book->__get('body'),25)) !!} </p>
                                    <span class="label label-info price pull-right">{{ ($book->free === 0) ? $book->meta->price.' KD': e(trans('word.free')) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            @endforeach
        </div>
        <!-- END CONTENT ITEM -->
    </div>
</div>