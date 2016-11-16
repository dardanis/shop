@extends('main')

@section('content')
	<div class="container">
		<div id="content">
				<div class="table-responsive">
				<!-- Shop Products Table -->
				@if(count(Cart::getContent())>0)
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name">Product</th>
							<th class="product-price">Price</th>
							<th class="product-quantity">Qty.</th>
							<th class="product-subtotal">Total</th>
							<th class="product-remove">Remove</th>
						</tr>
					</thead>
					<tbody>

						@foreach(Cart::getContent() as $product)
						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									<img class="pull-left" src="{!! asset($product->attributes->image)!!}" alt="" height="50" width="50">
									<div class="media-body">
										<p class="font-large table-title">Men’s Belt</p>
									</div>
								</div>
							</td>

							<td class="product-price">
								<span class="amount">$ {!! $product->price !!}</span>
							</td>

							<td class="product-quantity" width="200">
								{!! Form::open(array('method' => 'POST', 'route' => array('cart.update', $product->id),'id'=>'qty-form')) !!}
                               	<div class="input-group number-spinner">
									<span class="input-group-btn data-dwn">
										<button class="btn btn-default btn-info" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
									</span>
									<input type="text" name="quantity" class="form-control text-center" value="{!! $product->quantity !!}" min="1" max="40">
									<span class="input-group-btn data-up">
										<button class="btn btn-default btn-info" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
									</span>
								</div>
								{!! Form::close() !!}
							</td>

							<td class="product-subtotal">
								<span class="amount">${!! $product->price * $product->quantity!!}</span>
							</td>

							<td class="product-remove">
							{!! Form::open(array('method' => 'DELETE', 'route' => array('cart.delete', $product->id))) !!}
	                            <a  class="remove" title="Remove this item"><button><i class="fa fa-trash-o"></i></button></a>
	                        {!! Form::close() !!}
							</td>
						</tr>
						@endforeach


					</tbody>

					<tfoot>
						<tr >
							<td colspan="6" class="actions">
								<button type="submit" class="beta-btn primary right" name="proceed">Proceed to Checkout <i class="fa fa-chevron-right"></i></button>
							</td>
						</tr>
					</tfoot>
				</table>
				@else
						<h3>No Products in cart</h3>
				@endif
				<!-- End of Shop Table Products -->
			</div>

			@if(count(Cart::getContent())>0)
			<!-- Cart Collaterals -->
			<div class="cart-collaterals">

				<div class="cart-totals pull-right">
					<div class="cart-totals-row"><h5 class="cart-total-title">Cart Totals</h5></div>
					<div class="cart-totals-row"><span>Cart Subtotal:</span> <span>CHF {!! Cart::getSubTotal()!!}</span></div>
					<div class="cart-totals-row"><span>Shipping:</span> <span>Free Shipping</span></div>
					<div class="cart-totals-row"><span>Order Total:</span> <span>CHF {!! Cart::getTotal() !!}</span></div>
				</div>

				<div class="clearfix"></div>
			</div>
			@endif
			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>
	</div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		$(function() {
    var action;
    $(".number-spinner button").mousedown(function () {
        btn = $(this);
        input = btn.closest('.number-spinner').find('input');
        btn.closest('.number-spinner').find('button').prop("disabled", false);

    	if (btn.attr('data-dir') == 'up') {
            action = setInterval(function(){
                if ( input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max')) ) {
                    input.val(parseInt(input.val())+1);
                }else{
                    btn.prop("disabled", true);
                    clearInterval(action);
                }
            }, 50);
    	} else {
            action = setInterval(function(){
                if ( input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min')) ) {
                    input.val(parseInt(input.val())-1);
                }else{
                    btn.prop("disabled", true);
                    clearInterval(action);
                }
            }, 50);
    	}
    }).mouseup(function(){
        clearInterval(action);
    });
});
	</script>

@endsection