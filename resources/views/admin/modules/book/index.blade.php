
@extends('admin.layouts.one_col')

@section('content')
    <div class="row">
        <div class="col-xs-12">

            <!-- START CONTENT ITEM -->
            <ul class="nav nav-tabs">
                <li id="tab-1" class="" href="#step1"><a href="#step1" data-toggle="tab"><i class="fa fa-aw fa-book"></i>&nbsp;{{ trans('word.volumes') }} </a></li>
                <li id="tab-2"><a href="#step2" data-toggle="tab"><i class="fa fa-aw fa-book"></i>&nbsp;{{ trans('word.draft') }}</a></li>
                <li id="tab-3"><a href="#step3" data-toggle="tab"><i class="fa fa-aw fa-book"></i>&nbsp;{{ trans('word.published') }}</a></li>
                <li id="tab-4"><a href="#step4" data-toggle="tab"><i class="fa fa-aw fa-file-pdf-o"></i>&nbsp;{{ trans('word.orders') }}</a></li>
                <li id="tab-5"><a href="#step5" data-toggle="tab"><i class="fa fa-aw fa-eye"></i>&nbsp;{{ trans('word.previews') }}</a></li>

            </ul>

            {{--All Books--}}

            <div class="tab-content">

                <div class="tab-pane" id="step1">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            <table class="table table-bordered table-order">
                                <thead>
                                <tr class="info">
                                    <th class="hidden-xs">&nbsp;</th>
                                    <th>{{ trans('word.name') }}</th>
                                    <th>{{ trans('word.total-pages') }}</th>
                                    <th>{{ trans('word.book-type') }}</th>
                                    <th>{{ trans('word.created-at') }}</th>
                                    <th>{{ trans('word.status') }}</th>
                                    <th>{{ trans('word.edit') }}</th>
                                    @if(Session::get('role.admin'))
                                    <th>{{ trans('word.delete') }}</th>
                                    @endif
                                    <th>{{ trans('word.create-preview') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($books as $book)
                                    <tr>
                                        <td class="hidden-xs"><img class="img-table img-rounded img-responsive " src="/img/cover/cover_{{App::getLocale()}}/thumbnail/{{$book->__get('cover') }}" alt=""></td>
                                        <td>
                                            <a href="{{ action('BookController@show', $book->id) }}"> {!! $book->title !!} </a>

                                            <p> {!! Str::limit(strip_tags($book->body)) !!} </p>
                                        </td>
                                        <td>
                                            <span> {{ ($book->meta) ? $book->meta->total_pages : 'N/A' }} </span>

                                        </td>
                                        <td>
                                            <span> {{ $book->type }} </span>
                                        </td>
                                        <td>
                                            <span> {{ $book->created_at->format('Y-m-d') }} </span>
                                        </td>
                                        <td class="text-center">
                                            @if($book->status === 'draft')
                                                @if(Session::get('role.admin'))
                                                    <a class="btn btn-sm btn-warning" href="{{ route('app.admin.book.getUpdateBookStatus',$book->id) }}"><i class="fa fa-pencil fa-2x"></i></a>
                                                @else
                                                    {{ $book->status }}
                                                @endif
                                            @else
                                                {{ $book->status }}
                                            @endif
                                        </td>
                                        @if(Session::get('role.admin'))
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ route('app.admin.book.edit',$book->id) }}">
                                                <i class="fa fa-pencil fa-2x"></i>
                                            </a>
                                        </td>

                                            @elseif(Session::get('role.editor'))
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ route('app.editor.book.edit',$book->id) }}">
                                                    <i class="fa fa-pencil fa-2x"></i>
                                                </a>
                                        </td>
                                        <td>
                                            @if($book->meta)
                                            <a class="btn btn-info btn-rounded btn-sm" href="{{ route('app.editor.book.getCreateNewCustomizedPreview',[$book->id,$book->user_id,$book->meta->total_pages]) }}"><i class="fa fa-newspaper-o fa-2x"></i></a>
                                            @endif
                                        </td>
                                        @endif
                                        {{--Delete Btn with Modal to confirm delete process--}}
                                        @if(Session::get('role.admin'))
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" href="">
                                                <i class="fa fa-trash-o fa-2x"></i>
                                            </button>
                                            @include('admin.partials._delete_modal')
                                        </td>
                                        {{-- Create New Customized Preview--}}
                                        <td>
                                            @if(!$book->free && $book->meta)
                                            <a class="btn btn-info btn-rounded btn-sm" href="{{ route('app.admin.book.getCreateNewCustomizedPreview',[$book->id,$book->user_id,$book->meta->total_pages]) }}"><i class="fa fa-newspaper-o fa-2x"></i></a>
                                            @endif
                                        </td>
                                        @endif
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
                                <tr class="info">
                                    <th class="hidden-xs">&nbsp;</th>
                                    <th>{{ trans('word.book-name') }}</th>
                                    <th>{{ trans('word.total-pages') }}</th>
                                    <th>{{ trans('word.book-type') }}</th>
                                    <th>{{ trans('word.created-at') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($books as $book)
                                    @if($book->status === 'draft')
                                        <tr>
                                            <td class="hidden-xs"><img class="img-table img-rounded img-responsive " src="/img/cover/cover_{{App::getLocale()}}/thumbnail/{{$book->__get('cover') }}" alt=""></td>
                                            <td>
                                                <a href="{{ action('BookController@show', $book->id) }}"> {!! $book->title !!} </a>

                                                <p> {!! Str::limit(strip_tags($book->body)) !!} </p>
                                            </td>
                                            <td>
                                                <span> {{ $book->meta ? $book->meta->total_pages : 'N/A' }} </span>

                                            </td>
                                            <td>
                                                <span> {{ $book->status }} </span>
                                            </td>
                                            <td>
                                                <span> {{ $book->created_at->format('Y-m-d') }} </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                {{--Published Books --}}
                <div class="tab-pane" id="step3">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            <table class="table table-bordered table-order">
                                <thead>
                                <tr class="info">
                                    <th class="hidden-xs">&nbsp;</th>
                                    <th>{{ trans('word.book-name') }}</th>
                                    <th>{{ trans('word.total-pages') }}</th>
                                    <th>{{ trans('word.book-type') }}</th>
                                    <th>{{ trans('word.created-at') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($books as $book)
                                    @if($book->status === 'published')
                                        <tr>
                                            <td class="hidden-xs"><img class="img-table img-rounded img-responsive " src="/img/cover/cover_{{App::getLocale()}}/thumbnail/{{$book->__get('cover') }}" alt=""></td>
                                            <td>
                                                <a href="{{ action('BookController@show', $book->id) }}"> {!! $book->title !!} </a>

                                                <p> {!! Str::limit(strip_tags($book->body)) !!} </p>
                                            </td>
                                            <td>
                                                <span> {{ ($book->meta) ? $book->meta->total_pages : 'N/A' }} </span>

                                            </td>
                                            <td>
                                                <span> {{ $book->status }} </span>
                                            </td>
                                            <td>
                                                <span> {{ $book->created_at->format('Y-m-d') }} </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


                {{--Orders --}}

                <div class="tab-pane" id="step4">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            @if(count($orders) > 0)
                                <table class="table table-bordered table-order" id="draft">
                                    <thead>
                                    <tr>
                                        <th class="hidden-xs">&nbsp;</th>
                                        <th></th>
                                        <th>{{ trans('word.email') }}</th>
                                        <th>{{ trans('word.mobile') }}</th>
                                        <th>{{ trans('word.status') }}</th>
                                        <th>{{ trans('word.order-stage') }}</th>
                                        @if(Session::get('role.admin'))
                                        <th>{{ trans('word.stage-change') }}</th>
                                        <th>{{ trans('word.stage-delete') }}</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="hidden-xs"><img class="img-table img-responsive" src="/img/cover/cover_{{App::getLocale()}}/thumbnail/{{$book->__get('cover') }}" alt="{{ $book->title }}"></td>
                                            <td>
                                                <a href="{{ action('BookController@show',$order->book->id) }}"> {{ $order->book->title }}} </a>

                                                <p> {{ e(Str::limit(strip_tags($order->book->body))) }} </p>
                                            </td>
                                            <td>
                                                {{ $order->user->email }}
                                            </td>
                                            <td>
                                                {{ $order->user->mobile }}
                                            </td>
                                            <td>
                                                <span> {{ $order->book->status }} </span>
                                            </td>
                                            <td>
                                                <span> {{ $order->stage }} </span>
                                            </td>
                                            @if(Session::get('role.admin'))
                                            <td class="text-center">
                                                @if($order->stage === 'order')
                                                <a class="btn btn-success" href="{{ action('Admin\AdminBookController@getAcceptOrder',[$order->user_id,$order->book->id,$order->user->email]) }}/under_process">{{ trans('word.accept') }}</a>
                                                @elseif($order->stage === 'under_process')
                                                <a class="btn btn-primary" href="{{ action('Admin\AdminBookController@getAcceptOrder',[$order->user_id,$order->book->id,$order->user->email]) }}/purchased">{{ trans('word.purchased') }}</a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-danger btn-sm" href="{{ action('Admin\AdminBookController@getDeleteOrder',[$order->user_id,$order->book->id]) }}"><i class="fa fa-trash-o fa-2x"></i></a>
                                            </td>
                                            @endif
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


                {{--Previews --}}
                <div class="tab-pane" id="step5">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            <table class="table table-bordered table-order">
                                <thead>
                                <tr>
                                    <th class="hidden-xs">&nbsp;</th>
                                    <th></th>
                                    <th>{{ trans('word.total-pages') }}</th>
                                    <th>{{ trans('word.status') }}</th>
                                    <th>{{ trans('word.remove') }}</th>
                                    <th>{!! trans('word.last-edited') !!}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($allCustomizedPreviews)

                                    @foreach($allCustomizedPreviews as $book)

                                        <tr>
                                            <td class="hidden-xs"><img class="img-table img-responsive" src="/img/cover/cover_{{App::getLocale()}}/thumbnail/{{$book->__get('cover') }}" alt="{{ $book->title }}"></td>
                                            <td>
                                                @if(Session::get('role.admin'))
                                                <a href="{{ route('app.admin.book.getShowNewCustomizedPreviewForAdmin',[$book->id,$book->user_id]) }}"> {!! $book->title !!}</a>
                                                @elseif(Session::get('role.editor'))
                                                    <a href="{{ route('app.book.getShowNewCustomizedPreviewForUsers',[$book->id,$book->user_id]) }}"> {!! $book->title !!}</a>
                                                @endif
                                                <p> {!! Str::words(strip_tags($book->body),6) !!} </p>

                                            </td>
                                            <td>
                                                <span> {{ ($book->meta) ? $book->meta->total_pages : 'N/A' }} </span>

                                            </td>
                                            <td>
                                                <span> {{ $book->status }} </span>
                                            </td>
                                            <td class="text-center">
                                                @if(Session::get('role.admin'))
                                                 <a class="btn btn-sm btn-danger" href="{{ route('app.admin.book.getDeleteNewCustomizedPreview',[$book->id,$book->user_id]) }}"><i class="fa fa-trash-o fa-2x"></i></a>
                                                @elseif(Session::get('role.editor'))
                                                    <a class="btn btn-sm btn-danger" href="{{ route('app.editor.book.getDeleteNewCustomizedPreview',[$book->id,$book->user_id]) }}"><i class="fa fa-trash-o fa-2x"></i></a>
                                                @endif
                                            </td>
                                            <td>
                                                <span> {{ $book->updated_at->format('Y-m-d') }} </span>
                                            </td>
                                        </tr>

                                    @endforeach
                                @else
                                    <div class="alert alert-warning" role="alert">{{ trans('word.no-books-found') }}</div>
                                @endif
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
