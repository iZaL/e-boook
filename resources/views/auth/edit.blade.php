@extends('layouts.one_col')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('word.update') }}</div>
				<div class="panel-body">
					<div class="alert alert-info" role="alert">{{trans('word.fields-required')}}</div>

					{!! Form::model($user,['action'=>['UserController@update'],'method' =>'post','role'=>'form','class'=>'form-horizontal']) !!}

					{!! Form::hidden('id',$user->id) !!}
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.name_en') }}*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name_en" value="{{ $user->name_en }}">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.name_ar') }}*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name_ar" value="{{ $user->name_ar }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.email') }}*</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ $user->email }}">
							</div>
						</div>
					@if(Session::get('role.admin'))
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.active') }}*</label>
							<div class="col-md-6">
								{!! Form::select('active',['1'=>'active','0'=>'deactivated'],$user->active,['class'=>'form-control']) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.role') }}*</label>
							<div class="col-md-6">
								{!! Form::select('role_name',$roles,$user->roles->first()->id,['class'=>'form-control']) !!}
							</div>
						</div>
					@endif
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.mobile') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="mobile" value="{{ $user->mobile }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.bank-number') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="bank_number" value="{{ $user->bank_number }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.bank-name') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="bank_name" value="{{ $user->bank_name }}">
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-success">
									{{ trans('word.update') }}
								</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
