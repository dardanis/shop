@extends('new_template.client.layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{trans('shop.dashboard')}}
            </header>
            <div class="panel-body">
            @include('errors_messages')
			{!! link_to_route('client_products', trans('shop.products'), array(), array('class' => 'btn btn-primary')) !!}
		      </div>
        </section>
    </div>
</div>
@endsection