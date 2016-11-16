@extends('new_template.client.layouts.user_settings')

@section('content')
	<div class="row">
		@foreach($plans  as $plan)
      	<div class="col-lg-3 col-sm-3">
          <div class="pricing-table">
              <div class="pricing-head">
                  <h1>{{$plan->name}}</h1>
                  <h2>
                      <span class="note">CHF</span>{{$plan->amount/100}} </h2>
              </div>
              <ul class="list-unstyled">

              </ul>
              <div class="price-actions">
                  <a class="btn" href="{{url('/charge',$plan->id)}}">{{trans('shop.get_now')}}</a>
              </div>
          </div>
      	</div>
      	@endforeach 

  </div>
@endsection