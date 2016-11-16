@extends('main')

@section('content')
	<div class="container">
		<div id="content">
				<div class="table-responsive">
				<!-- Shop Products Table -->
				@if(count(Wishlist::getContent())>0)
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name">Product</th>
							<th class="product-price">Price</th>
							<th class="product-quantity">Qty.</th>
							<th class="product-subtotal">Total</th>
							<th class="product-subtotal">Add to Cart</th>
							<th class="product-remove">Remove</th>
						</tr>
					</thead>
					<tbody>

						@foreach(Wishlist::getContent() as $product)
						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									<img class="pull-left" src="{!! asset($product->attributes->image)!!}" alt="" height="50" width="50">
									<div class="media-body">
										<p class="font-large table-title">{!! $product->name !!}</p>
									</div>
								</div>
							</td>

							<td class="product-price">
								<span class="amount">$ {!! $product->price !!}</span>
							</td>

							<td class="product-quantity" width="200">
								{{$product->quantity}}
							</td>

							<td class="product-subtotal">
								<span class="amount">${!! $product->price * $product->quantity!!}</span>
							</td>
							<td class="product-subtotal">
								{!! Form::open(array('method' => 'POST', 'route' => array('add_cart_wishlist', $product->id))) !!}
									<a ><button type="submit" class="add-to-cart pull-left" ><i class="fa fa-shopping-cart"></button></i></a>
								{!! Form::close() !!}
							</td>
							<td class="product-remove">
							{!! Form::open(array('method' => 'DELETE', 'route' => array('wishlist.delete', $product->id))) !!}
	                            <a  class="remove" title="Remove this item"><button><i class="fa fa-trash-o"></i></button></a>
	                        {!! Form::close() !!}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
					<h3>No Products in wishlist</h3>
				@endif
				<!-- End of Shop Table Products -->
			</div>
			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>
	</div>
	</div>
@endsection

