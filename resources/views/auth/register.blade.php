@extends('layouts.one_col')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('word.register') }}</div>
				<div class="panel-body">
					<div class="alert alert-info" role="alert">{{trans('word.fields-required')}} </br>
					{{trans('word.bank-info-not-shown')}}
					</div>
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.name_en') }}*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.name_ar') }}*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name_ar" value="{{ old('name_ar') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.email') }}*</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.mobile') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.bank-number') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="bank_number" value="{{ old('bank_number') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.bank-name') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="bank_name" value="{{ old('bank_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.password') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('word.confirm-password') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									{{ trans('word.register') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
