<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/settings.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/responsive.css') }}">
	<link rel="stylesheet" title="style" href="{{ asset('/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/jquery.bxslider.css') }}">

</head>
<body>
	<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
						@if (Auth::guest())
						<li><a href="{{ url('login') }}"><i class="fa fa-user"></i> Login</a></li>
						<li><a href="{{ url('signup') }}"><i class="fa fa-user"></i> Register</a></li>
						@else
                            @if(Auth::user()->role_id==1)
						<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-user"></i>Dashboard</a></li>
                            @elseif(Auth::user()->role_id==2)
                         <li><a href="{{ url('client/dashboard') }}"><i class="fa fa-user"></i>My account</a></li>
                         	@elseif(Auth::user()->role_id==3)
                         	<li><a href="{{ url('business/dashboard') }}"><i class="fa fa-user"></i>My account</a></li>
                            @endif
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
                                @if(Auth::user()->role_id==2)
								<li>{!! link_to_route('myprofile', 'My Profile') !!}</li>
								@elseif(Auth::user()->role_id==3)
								<li>{!! link_to_route('myprofile', 'My Profile') !!}</li>
								@else
								<li>{!! link_to_route('admin_profile', 'My Profile') !!}</li>
								@endif
								<li><a href="{{ url('logout') }}">Logout</a></li>
							</ul>
						</li>

						@endif
						<li class="hidden-xs">
							<form action="{{URL::route('language-chooser')}}" method="post">
							<select id="locale" name="locale">
					 			<option value="en">English</option>
					 			<option value="de" {{ Lang::locale()==='de'? ' selected':''}}>German</option>
					 			<option value="fr" {{ Lang::locale()==='fr'? ' selected':''}}>French</option>
							</select>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
						</li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="{{ url('/') }}" id="logo">LOGO Here</a>
				</div>
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="/">
					        <input type="text" value="" name="search" id="s" placeholder="{{trans('main.search')}} ..." />
					        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>
					<div class="beta-comp">
						<div class="cart">
							<div class="beta-select"><i class="fa fa-shopping-cart"></i> {{trans('main.cart')}} ({{Cart::getContent()->count()}}) <i class="fa fa-chevron-down"></i></div>
							<div class="beta-dropdown cart-body">
							@if(count(Cart::getContent())>0)
								@foreach(Cart::getContent() as $product)
								<div class="cart-item">
								{!! Form::open(array('method' => 'DELETE', 'route' => array('cart.delete', $product->id))) !!}
	                            <a class="cart-item-delete" ><button><i class="fa fa-times"></i></button></a>
	                            {!! Form::close() !!}

									<div class="media">
										<a class="pull-left" href="#"><img src="{{asset($product->attributes->image)}}" alt=""></a>
										<div class="media-body">
											<span class="cart-item-title">{{$product->name}}</span>
											<span class="cart-item-amount">{{$product->quantity}}*<span>CHF {{$product->price}}</span></span>
										</div>
									</div>
								</div>
								@endforeach
								<div class="cart-caption">
									<div class="cart-total text-right">Total: <span class="cart-total-value">CHF  {{Cart::getTotal()}}</span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="{{url('/cart')}}" class="beta-btn primary text-center">My cart <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
								@else
									No product in cart
								@endif
							</div>
						</div> <!-- .cart -->
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom">
			<div class="container">
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="{{ url('/') }}">{{trans('shop.home')}}</a></li>
						<li><a href="{{url('shop')}}">{{trans('shop.shop')}}</a></li>
						<li><a href="{{url('exchange')}}">{{trans('shop.exchange')}}</a></li>
						<li><a href="{{url('auction')}}">{{trans('shop.auction')}}</a></li>
						<li><a href="{{url('travel')}}">{{trans('shop.travel')}}</a></li>
						<li><a href="{{url('eveniment')}}">{{trans('shop.eveniment')}}</a></li>
						<li><a href="{{ url('contact') }}">{{trans('shop.contact')}}</a></li>

					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div> <!-- #header -->
	@yield('content')


	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="widget">
						<h4 class="widget-title">Information</h4>
						<div>
							<ul>
								<li><a href=""><i class="fa fa-chevron-right"></i> Title</a></li>
								<li><a href=""><i class="fa fa-chevron-right"></i> Title</a></li>
								<li><a href=""><i class="fa fa-chevron-right"></i> Title</a></li>
								<li><a href=""><i class="fa fa-chevron-right"></i> Title</a></li>
								<li><a href=""><i class="fa fa-chevron-right"></i> Title</a></li>
								<li><a href=""><i class="fa fa-chevron-right"></i> Title</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
				<div class="col-sm-10">
					<div class="widget">
						<h4 class="widget-title">Contact Us</h4>
						<div>
							<div class="contact-info">
								<i class="fa fa-map-marker"></i>
								<p>Lorem ipsum dolor ... Phone: +78 123 456 78</p>
								<p>Nemo enim ipsam voluptatem quia voluptas sit asnatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="widget">
						<h4 class="widget-title">Newsletter Subscribe</h4>
						<form action="#" method="post">
							<input type="email" name="your_email">
							<button class="pull-right" type="submit">Subscribe <i class="fa fa-chevron-right"></i></button>
						</form>
					</div>
				</div>

			</div> <!-- .row -->
		</div> <!-- .container -->
	</div> <!-- #footer -->
	<div class="copyright">
		<div class="container">
			<p class="pull-left">Copyright &copy; 2015</p>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .copyright -->


	<!-- include js files -->
	<script src="{{ asset('/js/jquery.js') }}"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

	<script src="{{ asset('/js/jquery-ui-1.10.4.custom.min.js') }}"></script>
	<script src="{{ asset('/js/waypoints.min.js') }}"></script>
	<script src="{{ asset('/js/jquery.bxslider.min.js') }}"></script>
	<script src="{{ asset('/js/wow.min.js') }}"></script>

		<script>
		$(function() {
		    $('#locale').change(function() {
		        this.form.submit();
		    });
		});
		$(function(){
			$('#filter-form').change(function(){
				var sort=$('#filter-form').val();
				var sale='';
				if(sort=='asc' || sort=='desc'){
					$('#prod').load('shop?sort='+sort +' #prod');
				}else if(sort=='low' || sort=='high'){
					if(sort=='low'){
						sale='asc';
					}else if(sort=='high'){
						sale='desc';
					}
					$('#prod').load('shop?sale='+sale +' #prod');
				}

			});
		});
		$(function(){
			$('#filter-form-home').change(function(){
				var sort=$('#filter-form-home').val();
				var sale='';
				if(sort=='asc' || sort=='desc'){
					$('#prod-home').load('?sort='+sort +' #prod-home');
				}else if(sort=='low' || sort=='high'){
					if(sort=='low'){
						sale='asc';
					}else if(sort=='high'){
						sale='desc';
					}
					$('#prod-home').load('?sale='+sale +' #prod-home');
				}

			});
		});
	</script>
	<script src="{{ asset('/js/scripts.min.js') }}"></script>
	<script src="{{ asset('/js/dug.js') }}"></script>

	<script>
	 jQuery(document).ready(function($) {
                'use strict';
				try {
		if ($(".animated")[0]) {
            $('.animated').css('opacity', '0');
			}
			$('.triggerAnimation').waypoint(function() {
            var animation = $(this).attr('data-animate');
            $(this).css('opacity', '');
            $(this).addClass("animated " + animation);

			},
                {
                    offset: '80%',
                    triggerOnce: true
                }
			);
	} catch(err) {

		}

var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       150,          // distance to the element when triggering the animation (default is 0)
    mobile:       false        // trigger animations on mobile devices (true is default)
  }
);
wow.init();

$(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag
        $(".main-menu a").each(function() {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
				$(this).parents('li').addClass('parent-active');
            }
        });
    });

	});

	</script>
	@yield('scripts')



</body>
</html>