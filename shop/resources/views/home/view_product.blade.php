@extends('main')

@section('content')
<div class="container">
	<div id="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-7">
						<div class="beta-slider">
							<div class="beta-slider-items">
								@foreach($images as $im)
									<img src="/{{$im->image}}" alt="">
								@endforeach
							</div>
							<div class="text-center">
								<div class="beta-pager-gallery port-gallery">
									<?php $x=0;?>
									@foreach($images as $im)
									  <a data-slide-index="{{$x}}" href=""><img src="/{{$im->image}}" alt="" /></a>
									  <?php $x++;?>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="single-item-body">
							<p class="single-item-title">{{$product->title}}</p>
							<p class="single-item-price">
								<span>$ {{$product->price}}</span>
							</p>
						</div>
						<div class="woocommerce-product-rating" >

		                    <div  title="Rated 4.00 out of 5">
								@for ($i=1; $i <= 5 ; $i++)
		                        <span class="glyphicon glyphicon-star{{ ($i <= $product->rating_cache) ? '' : '-empty'}} stars"></span>
		                      @endfor
		                      <span class="color-gray">({{$product->rating_count}})</span>
							</div>

						</div>
						<div class="clearfix"></div>
						<div class="space20">&nbsp;</div>
						<div class="single-item-desc">
								<p>{{ Str::limit($product->description,100)}} </p>
						</div>
						<div class="space20">&nbsp;</div>

								{!! Form::open(array('method' => 'POST', 'route' => array('add_cart', $product->id))) !!}
										<a ><button type="submit" class="add-to-cart pull-left" ><i class="fa fa-shopping-cart"></button></i></a>
										{!! Form::close() !!}
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="row">
						<div class="col-sm-7">
							<div class="well well-sm">
							<div class="row">
				                <div class="col-md-12">
				                  @if(Session::get('errors'))
				                    <div class="alert alert-danger">
				                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                       <p>There were errors while submitting this review:</p>
				                       @foreach($errors->all(':message') as $message)
				                          {{$message}}
				                       @endforeach
				                    </div>
				                  @endif
				                  @if(Session::has('review_posted'))
				                    <div class="alert alert-success">
				                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                      <h5>Your review has been posted!</h5>
				                    </div>
				                  @endif
				                  @if(Session::has('review_removed'))
				                    <div class="alert alert-success">
				                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                      <h5>Your review has been removed!</h5>
				                    </div>
				                  @endif
				                </div>
						    </div>
							@if (Auth::check())
				            <div class="text-right">
				                <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
				            </div>
				            @else
				            	Log in to post a review
				        	@endif
				            <div class="row" id="post-review-box" style="display:none;">
				                <div class="col-md-12">
				                    <form accept-charset="UTF-8" action="{{ url('/reviews/'.$product->id) }}" method="post">

				                        <input id="ratings-hidden" name="rating" type="hidden">
				                        <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>

				                        <div class="text-right">
				                            <div class="stars starrr" data-rating="0"></div>
				                            <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
				                            <span class="glyphicon glyphicon-remove"></span>Cancel</a>
				                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				                            <button class="btn btn-success btn-sm" type="submit">Save</button>
				                        </div>
				                    </form>
				                </div>
				            </div>
						</div>
							        @foreach($reviews as $review)
							            <div class="row">
							            	<div class="col-sm-12">

							                  {{ $review->user ? $review->user->username: 'Anonymous'}}
							                    @for ($i=1; $i <= 5 ; $i++)
							                      <span class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
							                    @endfor

							                    <span class="pull-right">{{ Carbon::createFromTimestamp(strtotime($review->created_at))->diffForHumans() }}</span>

							                    <p>{{{$review->comment}}}</p>
							                  </div>
							                </div>
							        @endforeach
							        {!!$reviews->appends(Request::except('page'))->render()!!}
						</div>


						<div class="col-sm-5">
							<input type="text" style="display:none;" value="{{$product->lat}}" id="lat">
							<input type="text" style="display:none;" value="{{$product->lng}}" id="lng">
							<div class="col-sm-12" id="map" style="height:300px;"></div>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
					<h4>Related Products</h4>
						<div class="row">
						@foreach($related as $r)
							<div class="col-sm-3">
								<div class="single-item">
									<div class="single-item-header">
										<a href="{{ URL::route('product_show',array($r->user->username,$r->slug)) }}"><img src="{{ asset($r->thumbnail) }}" alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$r->title}}</p>
										<p class="single-item-price">
											<span>${{$r->price}}</span>
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="product.html"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{ URL::route('product_show',array($r->slug)) }}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						@endforeach
						</div>
					</div> <!-- .beta-products-list -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->

@endsection

@section('scripts')
		 <script>
		 	 var lat1=$('#lat').val();
		  var lng1=$('#lng').val();
function initMap() {
  var lat=$('#lat').val();
  var lng=$('#lng').val();
  var latLng = new google.maps.LatLng(lat, lng);

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 8,
    center: latLng
  });

  var marker = new google.maps.Marker({
    position: latLng,
    map: map
  });
}
    </script>
    <script src="{{ asset('/js/review.js') }}"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1Mc3H_kNYc7cS8i8-2z97SqqQQWgIp30&signed_in=true&callback=initMap">
    </script>

@endsection