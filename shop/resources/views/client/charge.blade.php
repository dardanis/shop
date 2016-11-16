@extends('new_template.client.layouts.user_settings')

@include('stripescripts')
@section('content')
<div class="row">
	<div class="col-lg-6">
      <section class="panel">
          <header class="panel-heading">
              Payment Form
          </header>
          <div class="panel-body" >
              <form class="form-horizontal tasi-form" role="form" action="/charge" method="POST" id="payment-form">
              		<div class="form-group">
              			<span class="payment-errors"></span>
              		</div>
                  	<input type="hidden" value="{{$id}}" name="type">`
				    <div class="form-group">
		              <label class="col-sm-3 control-label">Card Number</label>
		              <div class="col-sm-9">
		                  <input type="text" size="20" data-stripe="number" class="form-control">
		              </div>
		          	</div>
		          	<br>
                  	<div class="form-group">
		              <label class="col-sm-3 control-label">CVC</label>
		              <div class="col-sm-2">
		                  <input type="text" size="4" data-stripe="cvc" class="form-control">
		              </div>
		          	</div>
		          	<br>
				    <div class="form-group">
		              <label class="col-sm-3 control-label">Expiration</label>
		              <div class="col-sm-2">
		                  <input type="text" placeholder="" data-mask="99" size="2" data-stripe="exp-month" class="form-control">
		                  <span class="help-inline">Month</span>
		              </div>
		              <div class="col-sm-2">
		                  <input type="text" size="4" data-stripe="exp-year" data-mask="9999" class="form-control">
		                  <span class="help-inline">Year</span>
		              </div>
		          	</div>
                  <button type="submit" class="btn btn-info pull-right">Pay</button>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>

          </div>
      </section>
  </div>
</div>
@endsection
