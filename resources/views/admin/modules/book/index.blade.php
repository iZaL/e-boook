
@extends('admin.layouts.one_col')

@section('content')

@section('content')
    <div class="row">
        <div class="col-xs-12">

            <!-- START CONTENT ITEM -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#step1" data-toggle="tab"><i class="fa fa-aw fa-book"></i>{{ trans('word.books') }} </a></li>
                <li><a href="#step2" data-toggle="tab"><i class="fa fa-aw fa-book"></i>{{ trans('word.books-draft') }}</a></li>
                <li><a href="#step3" data-toggle="tab"><i class="fa fa-aw fa-book"></i>{{ trans('word.books-published') }}</a></li>
                <li><a href="#step4" data-toggle="tab"><i class="fa fa-aw fa-profile"></i>{{ trans('word.personal-info') }}</a></li>
            </ul>

            <div class="tab-content">

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
                                @foreach($books as $book)
                                    <tr>
                                        <td class="hidden-xs"><img src="img/product_01.jpg" width="75"></td>
                                        <td>
                                            <a href="detail.html"> {!! $book->title !!} </a>

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
                                @endforeach
                                </tbody>

                            </table>

                        </div>

                    </div>
                </div>

                <div class="tab-pane" id="step2">
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
                                    @if($book->status === 'draft')
                                        <tr>
                                            <td class="hidden-xs"><img src="img/product_01.jpg" width="75"></td>
                                            <td>
                                                <a href="detail.html"> {!! $book->title !!} </a>

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
                                            <td class="hidden-xs"><img src="img/product_01.jpg" width="75"></td>
                                            <td>
                                                <a href="detail.html"> {!! $book->title !!} </a>

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

                {{--Person Information --}}

                <div class="tab-pane" id="step4">
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
                                <tr>
                                    <td class="hidden-xs"><img src="img/product_01.jpg" width="75"></td>
                                    <td>
                                        <a href="{{ route('book.show',$book->id) }}"> {!! $book->title !!} </a>

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

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                {!! $books->render() !!}
            </div>

            <br>

        </div>


        <!-- END CONTENT ITEM -->

    </div>

@stop


@stop
