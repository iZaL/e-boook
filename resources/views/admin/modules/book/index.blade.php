
@extends('admin.layouts.one_col')

@section('content')

@section('content')
    <div class="row">
        <div class="col-xs-12">

            <!-- START CONTENT ITEM -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#step1" data-toggle="tab"><i class="fa fa-aw fa-book"></i>{{ trans('word.volumes') }} </a></li>
                <li><a href="#step2" data-toggle="tab"><i class="fa fa-aw fa-book"></i>{{ trans('word.draft') }}</a></li>
                <li><a href="#step3" data-toggle="tab"><i class="fa fa-aw fa-book"></i>{{ trans('word.published') }}</a></li>
            </ul>

            {{--All Books--}}

            <div class="tab-content">

                <div class="tab-pane active" id="step1">
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
                                    <th>{{ trans('word.edit') }}</th>
                                    <th>{{ trans('word.delete') }}</th>
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
                                            <span> {{ $book->meta ? $book->meta->total_pages : 'N/A' }} </span>

                                        </td>
                                        <td>
                                            <span> {{ $book->status }} </span>
                                        </td>
                                        <td>
                                            <span> {{ $book->created_at->format('Y-m-d') }} </span>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ action('Admin\AdminBookController@edit',$book->id) }}">
                                                <i class="fa fa-trash-o fa-2x"></i>
                                            </a>
                                        </td>
                                        <td>
                                            {{--Delete Btn with Modal to confirm delete process--}}
                                            @if($admin)
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" href="">
                                                    <i class="fa fa-pencil fa-2x"></i>
                                                </button>
                                                @include('admin.partials._delete_modal')
                                            @endif
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

                {!! $books->render() !!}
            </div>

            <br>

        </div>


        <!-- END CONTENT ITEM -->

    </div>

@stop
