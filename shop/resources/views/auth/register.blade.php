@extends('new_template.client.layouts.default')

@section('content')
	<div class="page-content">
	<h1>{{ Lang::get("app.Register:")}}</h1>

	@include('errors')

	<form method="POST" action="/register">
		{!! csrf_field() !!}

		<div class="form-group">
			<label for="name">{{ Lang::get("app.Name:")}}</label>
			<input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
		</div>

		<div class="form-group">
			<label for="email">{{ Lang::get("app.Email Address:")}}</label>
			<input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
		</div>

		<div class="form-group">
			<label for="password">{{ Lang::get("app.Password:")}}</label>
			<input type="password" name="password" id="password" class="form-control">
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-default">{{ Lang::get("app.Register")}}</button>
		</div>
	</form>
	</div>
@stop