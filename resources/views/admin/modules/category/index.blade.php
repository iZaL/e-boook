@extends('admin.layouts.one_col')

@section('content')
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    {{ trans('word.categories') }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            <table class="table table-bordered table-order">
                                <thead>
                                <tr class="info text-center">
                                    <th>{{ trans('id') }}</th>
                                    <th>{{ trans('word.name-ar') }}</th>
                                    <th>{{ trans('word.name-en') }}</th>
                                    <th>{{ trans('word.edit') }}</th>
                                    <th>{{ trans('word.created-at') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                             {!! $category->id !!}
                                        </td>
                                        <td>
                                            <span> {{ $category->name_ar }} </span>

                                        </td>
                                        <td>
                                            <span> {{ $category->name_en }} </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ action('Admin\AdminCategoryController@edit',$category->id) }}" class="text-center btn btn-primary btn-sm">
                                                <i class="fa fa-pencil fa-2x"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <span> {{ $category->created_at->format('Y-m-d') }} </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@stop