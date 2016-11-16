@extends('main')

@section('content')
	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9 main-content pull-right">

					<div class="beta-products-list">
						<h4>{{trans('main.newproducts')}}</h4>
						<div class="beta-products-details">
							<form >

							<p class="pull-right">
								<span class="sort-by">{{ _('Sort by') }} </span>
								<select name="sortby" id="filter-form-home" class="beta-select-primary">
									<option value="desc">Latest</option>
									<option value="asc">Ascending</option>
									<option value="low">Low to high</option>
									<option value="high">High to low</option>
								</select>
								<input type="hidden" id="token-home" value="{{ csrf_token() }}">
							</p>
							</form>
							<div class="clearfix"></div>
						</div>
						<div id="prod-home">
						<div class="row">
							 @foreach($products as $product)
							<div class="col-sm-4 ">
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
										{!! Form::open(array('method' => 'POST', 'route' => array('add_wishlist', $product->id))) !!}
										<a ><button type="submit" class="add-to-cart pull-left" ><i class="fa fa-heart"></button></i></a>
										{!! Form::close() !!}
										<a class="beta-btn primary" href="{{ URL::route('product_show',array($product->user->username,$product->slug)) }}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>

				</div> <!-- .main-content -->

				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title"><?php echo _('Categories')?></h3>
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
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->

@endsection
