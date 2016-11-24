{{--@extends('new_template.client.layouts.user_settings')--}}

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ Lang::get("app.Reset Password")}}{{ Lang::get('titles.home') }}</div>

				<div class="panel-body">
					<p>{{ Lang::get('auth.sentEmail',
						['email' => $email] ) }}</p>

					<p>{{ Lang::get('auth.clickInEmail') }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection




