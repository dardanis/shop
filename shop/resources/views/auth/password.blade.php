
@extends('new_template.client.layouts.auth')
@section('content')

				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
						<div class="panel-heading">{{ Lang::get("app.Reset Password")}}</div>
						<div class="panel-body">
							@if (session('status'))
								<div class="alert alert-success">
									{{ session('status') }}
								</div>
							@endif

							@if (count($errors) > 0)
								<div class="alert alert-danger">
									<strong>Whoops!</strong> {{ Lang::get("app.There were some problems with your input")}}.<br><br>
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif

							<form class="form-horizontal" role="form" method="POST" action="/password/email">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

								<div class="form-group">
									<div class="col-md-12">
										<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ Lang::get("app.E-Mail Address")}}">
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6">
										<button type="submit" class="btn btn-success">
											{{ Lang::get("app.Send Password Reset Link")}}
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
@endsection
