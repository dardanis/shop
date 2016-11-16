
@extends('new')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{trans('shop.add_plan')}}
            </header>
            <div class="panel-body">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
         <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/plans/add') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.id')}}</label>
              	<div class="col-sm-6">
                  	<input type="text" class="form-control" name="id" value="{{ old('id') }}" required>
              	</div>
          	</div>
          	<div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}</label>
              	<div class="col-sm-6">
                  	<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
              	</div>
          	</div>
          	<div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.amount')}}</label>
              	<div class="col-sm-6">
                  	<input type="number"  step="any" class="form-control" name="amount" value="{{ old('amount') }}" required>
              	</div>
          	</div>

          	<div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label">{{trans('shop.interval')}}</label>
              	<div class="col-sm-6">
                  	{!! Form::select('interval',[null=>'Please Select one interval']+$interval,'' ,array('class' => 'form-control')) !!}
              	</div>
          	</div>
          	<div class="col-sm-1 col-sm-offset-7" style="padding:0px;">
                <button type="submit" class="btn btn-primary">
                  {{trans('shop.add_plan')}}
                </button>
            </div>
          </form>
              
        </div>
      </section>
    </div>
  </div>                     

@stop