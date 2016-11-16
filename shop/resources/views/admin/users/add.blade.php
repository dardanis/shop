
@extends('new')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{trans('shop.add_user')}} 
            </header>
            <div class="panel-body">
          @include('errors_messages')
         <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/users') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group @if($errors->has('name')) has-error @endif">
              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}</label>
              	<div class="col-sm-6">
                  	<input type="text" class="form-control" name="name" value="{{ old('name') }}">
              	</div>
          	</div>
          	<div class="form-group @if($errors->has('lastname')) has-error @endif">
              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.lastname')}}</label>
              	<div class="col-sm-6">
                  	<input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">
              	</div>
          	</div>
          	<div class="form-group @if($errors->has('username')) has-error @endif">
              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.username')}}</label>
              	<div class="col-sm-6">
                  	<input type="text" class="form-control" name="username" value="{{ old('username') }}">
              	</div>
          	</div>
          	<div class="form-group @if($errors->has('email')) has-error @endif">
              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.email_address')}}</label>
              	<div class="col-sm-6">
                  	<input type="email" class="form-control" name="email" value="{{ old('email') }}">
              	</div>
          	</div>
          	<div class="form-group @if($errors->has('password')) has-error @endif">
              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.password')}}</label>
              	<div class="col-sm-6">
                  	<input type="password" class="form-control" name="password">
              	</div>
          	</div>
          	<div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.confirm_password')}}</label>
              	<div class="col-sm-6">
                  	<input type="password" class="form-control" name="password_confirmation">
              	</div>
          	</div>
          	<div class="form-group @if($errors->has('role')) has-error @endif">
              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.role')}}</label>
              	<div class="col-sm-6">
                  	{!! Form::select('role',[null=>'Please Select one role']+$roles,'' ,array('class' => 'form-control')) !!}
              	</div>
          	</div>
          	<div class="col-sm-1 col-sm-offset-7" style="padding:0px;">
                <button type="submit" class="btn btn-primary">
                  {{trans('shop.add_user')}}
                </button>
            </div>
          </form>
              
        </div>
      </section>
    </div>
  </div>                     

@stop