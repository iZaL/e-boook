
@extends('layouts.one_col')

@section('content')
    @foreach($books as $book)
        <div class="">{{ $book->title_en }}</div>
        <div class="">{{ $book->body  }}</div>
    @endforeach
    <?php echo $books->render(); ?>


<div class="row">

    <div class="col-xs-12 col-sm-12">


        <!-- START CONTENT ITEM -->
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                <h3></h3>
            </div>
        </div>
        <!-- END CONTENT ITEM -->


        <!-- START CONTENT ITEM -->
        <div class="row">
            <div class="col-xs-12">
                <div class="row product-list-inline-small">
                    <div class="col-xs-3">
                        <div class="thumbnail">
                            <a href="{{ route('book.show',$book->id) }}"><img src="img/product_01.jpg" alt=""></a>
                            <div class="caption">
                                <a href="detail.html">{{ $book->__get('title') }}</a>
                                <p>Lorem ipsum dolor sit amet <span class="label label-info price pull-right">&euro; 123,-</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT ITEM -->
    </div>

@stop
