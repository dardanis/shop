@extends('new')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{trans('shop.edit_plan')}}
            </header>
			<div class="panel-body">
               		{!! Form::model($plan, array('class'=>'form-horizontal tasi-form','method' => 'POST' ,'route' => array('plan_update', $plan->id))) !!}
					@if($errors->any())
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</div>
					@endif
					
	          	<div class="form-group">
	              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}</label>
	              	<div class="col-sm-10">
	                  	{!! Form::text('name', Input::old('name'),array('class' => 'form-control','required'=>'true')) !!}
	              	</div>
	          	</div>
				<div class="form-group">			
					<div class="col-sm-offset-10">
					<input type="hidden" id="token" value="{{ csrf_token() }}">
					{!! Form::submit(trans('shop.save'), array('class' => 'btn btn-success')) !!}
					{!! link_to_route('subscription_plans', trans('shop.cancel'), array(), array('class' => 'btn btn-danger'))!!}
					{!! Form::close() !!}
					</div>
				</div>
		</div>
		</div>
	</div>
@endsection
