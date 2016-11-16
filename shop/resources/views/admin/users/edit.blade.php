@extends('new')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{trans('shop.edit_user')}}
            </header>
            <div class="panel-body">
           		{!! Form::model($user, array('class'=>'form-horizontal tasi-form','method' => 'PATCH', 'route' => array('user_update', $user->id))) !!}
			@include('errors_messages')
			<div class="form-group @if($errors->has('name')) has-error @endif">
			<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}</label>
                <div class="col-sm-10">
				{!! Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Please insert your name here...')) !!}
				</div>
			</div>
			<div class="form-group @if($errors->has('lastname')) has-error @endif">
			<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.lastname')}}</label>
                <div class="col-sm-10">
				{!! Form::text('lastname', Input::old('lastname'), array('class' => 'form-control', 'placeholder' => 'Please insert your lastname here...')) !!}
				</div>
			</div>
			<div class="form-group @if($errors->has('email')) has-error @endif">
			<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.email')}}</label>
                <div class="col-sm-10">
				{!! Form::text('email', Input::old('email'), array('class' => 'form-control')) !!}
				</div>
			</div>
			<div class="form-group @if($errors->has('username')) has-error @endif">
			<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.username')}}</label>
                <div class="col-sm-10">
				{!! Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => 'Please insert your username here...')) !!}
				</div>
			</div>
			<div class="form-group @if($errors->has('role')) has-error @endif">
				<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.role')}}</label>
			 	<div class="col-lg-10">
				{!! Form::select('role_id',$roles,Input::old('role_id'),array('class' => 'form-control','id'=>'first')) !!}
				</div>
			</div>						
			<div class="col-sm-2 col-sm-offset-10">
				{!! Form::submit(trans('shop.save'), array('class' => 'btn btn-success')) !!}
				{!! link_to_route('users', trans('shop.cancel'), array(), array('class' => 'btn btn-danger'))!!}
				{!! Form::close() !!}
			</div>
		</div>
	</div> 
</div>
@endsection