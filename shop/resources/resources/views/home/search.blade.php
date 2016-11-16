@extends('main')

@section('content')
<div class="container">
		<div id="content">
			<div class=" col-sm-12 main-content pull-right">
				<div class="beta-products-list">
					<div class="row">
					@if(count($products)>0)
						@foreach($products as $product)
						<div class="col-sm-4">
							<div class="single-item">

								<div class="single-item-header">
									<a href="{{ URL::route('product_show',array($product->user->username,$product->slug)) }}"><img src="{{ asset($product->thumbnail) }}" alt=""></a>
								</div>
								<div class="single-item-body">
									<p class="single-item-title">{{$product->title}}</p>
									<p class="single-item-price">
										<span>${{$product->price}}</span>
									</p>
								</div>
								<div class="single-item-caption">
									{!! Form::open(array('method' => 'POST', 'route' => array('add_cart', $product->id))) !!}
										<a ><button type="submit" class="add-to-cart pull-left" ><i class="fa fa-shopping-cart"></button></i></a>
										{!! Form::close() !!}
									<a class="beta-btn primary" href="{{ URL::route('product_show',array($product->user->username,$product->slug)) }}">Details <i class="fa fa-chevron-right"></i></a>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						@endforeach	
					@else
						<h2>No Products Found</h2>
					@endif					
					</div>
				</div> <!-- .beta-products-list -->
				<div class="space50">&nbsp;</div>
			</div> <!-- .main-content -->



		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
