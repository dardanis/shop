@extends('main')

@section('content')
<div class="container">
		<div id="content">
			<div class=" col-sm-9 main-content pull-right">
				<div class="beta-products-list">
					@foreach($category as $category)
					<h4 class="wow fadeInLeft">{{$category->name}}</h4>
					@endforeach
					<div class="beta-products-details">
						<p class="pull-right">
							<span class="sort-by">Sort by </span>
							<select name="sortproducts" class="beta-select-primary">
								<option value="desc">Latest</option>
								<option value="popular">Popular</option>
								<option value="rating">Rating</option>
								<option value="best">Best</option>
							</select>
						</p>
						<div class="clearfix"></div>
					</div>
					<div class="row">
						
							
						
					</div>
					<div class="row">
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
												
					</div>
				</div> <!-- .beta-products-list -->
				<div class="space50">&nbsp;</div>
			</div> <!-- .main-content -->

			<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Categories</h3>
						<div class="widget-body">
							<ul class="sidebar1" style="list-style:none;">
								@foreach($categories as $category)
									@if($category->slug=='erotique')
									<li><a href="{{ URL::route('category_static') }}">{{$category->name}}</a>
									@else
										<li><a href="{{ URL::route('category_show',array($category->slug)) }}">{{$category->name}}</a>
											<div class="wrap-popup">
												<div class="popup" >
													<ul class="list1">
													@foreach($category->subcategories as $sub)
														<li><a href="{{ URL::route('subcategory_show',array($category->slug,$sub->slug)) }}">{{$sub->name}}</a></li>
													@endforeach
													</ul>
												</div>
											</div>
										</li>
									@endif
								@endforeach
							</ul>
						</div>
					</div> <!-- brands widget -->

				</div> <!-- .aside -->

		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
