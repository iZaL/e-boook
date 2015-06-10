@extends('admin.layouts.one_col')

@section('title')
    <h3>{{ trans('word.users') }}</h3>
@stop

@section('content')
<div class="tab-pane active" id="step1">
    <div class="row">
        <div class="col-xs-12 paddingTop10">
            <table class="table table-bordered table-order">
                <thead>
                <tr>
                    <th class="hidden-xs">&nbsp;</th>
                    <th>{{ trans('word.name') }}</th>
                    <th>{{ trans('word.user-type') }}</th>
                    <th>{{ trans('word.email') }}</th>
                    <th>{{ trans('word.mobile') }}</th>
                    <th>{{ trans('word.status') }}</th>
                    <th>{{ trans('word.bank-name') }}</th>
                    <th>{{ trans('word.bank-number') }}</th>
                    <th>{{ trans('word.history-subscribe') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="hidden-xs">{{ $user->id }}</td>
                        <td>
                            <span>{{ $user->name }}</span>
                        </td>
                        <td>
                            <span>{{ $user->roles->first()->name }}</span>
                        </td>
                        <td>
                            <span>{{ $user->email }}</span>
                        </td>
                        <td>
                            <span>{{ $user->mobile }}</span>
                        </td>
                        <td>
                            <span>{{ ($user->active === 1) ? 'active' : 'Not active'}}</span>
                        </td>
                        <td>
                            <span>{{ ($user->bank_name) ? $user->bank_name : trans('word.n-a') }}</span>
                        </td>
                        <td>
                            <span>{{ ($user->bank_number) ? $user->bank_number : trans('word.n-a') }}</span>
                        </td>

                        <td>
                            <span> {{ $user->created_at->format('Y-m-d') }} </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>

    </div>
</div>
@endsection