@extends('new_template.client.layouts.user_settings')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ Lang::get('titles.home') }}</div>
				
				<div class="panel-body">
					<p>An email was sent to {{ $email }} &nbsp{{ Carbon::createFromTimestamp(strtotime($date))->diffForHumans() }}.</p>

					<p>{{ Lang::get('auth.clickInEmail') }}</p>
					
					<p><a href='/resendEmail'>{{ Lang::get('auth.clickHereResend') }}</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
