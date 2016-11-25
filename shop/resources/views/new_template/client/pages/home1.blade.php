@include('new_template.client.layouts.default')
<style>
    .catalog-grid{
        width:100%;
    }
</style>
{{ Lang::get("app.Test test")}}
{{ Lang::get("app.Test test1")}}
<div class="page-content">


    <div class="container">
        <section class="hero-slider">
            <div class="master-slider" id="hero-slider">

                <!--Slide 1-->
                <div class="ms-slide" data-delay="7">
                    <div class="overlay"></div>



                    <section class="catalog-grid" style="margin-left:150px;">
                        <?php $SliderProduct1=DB::table('slider_products')->skip(0)->take(3)->get();?>
                        <?php $products1=array();?>
                        <?php foreach($SliderProduct1 as $sp1){?>

                        <?php $product_id=$sp1->product_id; ?>
                        <?php   $products1=\App\Product::whereHas('translations', function($q) use ($product_id)
                        {

                            $q->where('product_id', '=', $product_id);

                        })->get();?>

                        <?php foreach($products1 as $product){?>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="tile">

                            <?php if($product->price!="0.00"){?><div class="price-label">CHF {{$product->price}}</div><?php } ?>
                            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                        src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>

                            <div class="footer" style="padding:0px;">
                                <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                    <span style="padding:10px;">{{$product->title}}</span>
                                </a>
                                <span style="color:#ffaa00;padding:10px;">{{ Lang::get('app.Availability') }}: <?php echo $product->availability; ?></span>

                        </div>
                    </div>
                    </div>
                    <?php } ?>
                   <?php } ?>
                    </section>
                </div>


                <!--Slide 2-->
                <div class="ms-slide" data-delay="7">
                    <span class="overlay"></span>
                    <section class="catalog-grid" style="margin-left:150px;">
                        <?php $SliderProduct2=DB::table('slider_products')->skip(3)->take(3)->get();?>
                        <?php $products2=array();?>
                        <?php foreach($SliderProduct2 as $sp1){?>

                        <?php $product_id=$sp1->product_id; ?>
                        <?php   $products2=\App\Product::whereHas('translations', function($q) use ($product_id)
                        {

                            $q->where('product_id', '=', $product_id);

                        })->get();?>

                        <?php foreach($products2 as $product){?>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="tile">

                                <?php if($product->price!="0.00"){?><div class="price-label">CHF {{$product->price}}</div><?php } ?>
                                <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                            src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>

                                <div class="footer" style="padding:0px;">
                                    <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                        <span style="padding:10px;">{{$product->title}}</span>
                                    </a>
                                    <span style="color:#ffaa00;padding:10px;">{{ Lang::get('app.Availability') }}: <?php echo $product->availability; ?></span>

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </section>
                </div>

                <!--Slide 3-->
                <div class="ms-slide" data-delay="7">
                    <div class="overlay"></div>
                    <section class="catalog-grid" style="margin-left:150px;">
                        <?php $SliderProduct3=DB::table('slider_products')->skip(6)->take(3)->get();?>
                        <?php $products3=array();?>
                        <?php foreach($SliderProduct3 as $sp1){?>

                        <?php $product_id=$sp1->product_id; ?>
                        <?php   $products2=\App\Product::whereHas('translations', function($q) use ($product_id)
                        {

                            $q->where('product_id', '=', $product_id);

                        })->get();?>

                        <?php foreach($products3 as $product){?>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="tile">

                                <?php if($product->price!="0.00"){?><div class="price-label">CHF {{$product->price}}</div><?php } ?>
                                <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                            src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>

                                <div class="footer" style="padding:0px;">
                                    <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                        <span style="padding:10px;">{{$product->title}}</span>
                                    </a>
                                    <span style="color:#ffaa00;padding:10px;">{{ Lang::get('app.Availability') }}: <?php echo $product->availability; ?></span>

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </section>
                </div>

            </div>
        </section><!--Hero Slider Close-->
    <section class="catalog-grid">

            <h2 class="primary-color">{{Lang::get('app.Products')}}</h2>
            <div class="row">
        @foreach($products as $product)

               <?php if($product->availability>0){?>            <!--Tile-->
  <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="tile">

                    <?php if($product->price!="0.00"){?><div class="price-label">CHF {{$product->price}}</div><?php } ?>
                        <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                    src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>

                    <div class="footer">
                    <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                        <span>{{$product->title}}</span>
                    </a>
                        <span style="color:#ffaa00;">{{ Lang::get('app.Availability') }}: <?php echo $product->availability; ?></span>
                        <?php if (Auth::guest()){?>

                        <?php } else { ?>
                        <?php 	$following = \Illuminate\Support\Facades\DB::table('user_follows')->where('follow_user_id', '=',$product->user_id)->where('follower_user_id','=',Auth::user()->id)->get();?>
                        <?php if(sizeof($following)>0){?>

                        <div class="user-follow">
                            <span class="home-username">{{ Lang::get('app.By')}} <?php echo $product->user->username;?></span>
                            <a class="" style="padding-left:5px;color:#a3c756" href='{{ URL::to("/followingprofile/$product->user_id") }}'>
                                {{Lang::get('app.Following')}}
                                <i class="fa fa-plus"></i>
                            </a>


                        </div>
                        <?php } else {?>

                        <div class="user-follow">
                            <span class="home-username">{{ Lang::get('app.By')}} <?php echo $product->user->username;?></span>
                            {!! Form::open(array('method' => 'POST', 'route' => array('follow', $product->user_id), 'class'=>'formCart')) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn-follow" id=""
                                    style="background: #a3c756;border:none;margin-left:0px;">
                               {{ Lang::get('app.Follow user')}}
                                <i class="fa fa-plus"></i>
                            </button>

                            {!! Form::close() !!}
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <?php  $url=URL::route('product_show',array($product->slug,$product->id));?>

                        <div class="tools">
                            <div class="rating">
                                <div class="ratings">
                                    <div class="rating-box">

                                        <div class="rating" style="width:{{$product->rating_cache*20}}%"></div>
                                    </div>
                                </div>
                                </div>

                            <!--Add To Cart Button-->
                            {!! Form::open(array('method' => 'POST', 'route' => array('add_cart', $product->id), 'class'=>'formCart')) !!}
                            <button type="submit" class="add-cart-btn" style="border:none">
                                <span>To cart</span><i class="icon-shopping-cart"></i></button>

                            {!! Form::close() !!}
                                    <!--Share Button-->
                            <div class="share-btn">
                                <div class="hover-state">
                                    <a class="fa fa-facebook-square" href="<?php echo Share::load($url,'t')->facebook();?>" target="_blank"></a>
                                    <a class="fa fa-twitter-square" href="<?php echo Share::load($url, $product->title)->twitter();?>" target="_blank"></a>
                                    <a class="fa fa-google-plus-square"   href="<?php echo Share::load($url, '')->gplus();?>" target="_blank"target="_blank"></a>
                                </div>
                                <i class="fa fa-share"></i>
                            </div>
                            <!--Add To Wishlist Button-->
                            {!! Form::open(array('method' => 'POST', 'route' => array('add_wishlist', $product->id), 'class'=>'formCart')) !!}
                            <button type="submit" class="wishlist-btn" id="cartBtn"
                                    style="background: none;border:none;">
                                <div class="hover-state">{{ Lang::get('app.Wishlist')}}</div>
                                <i class="fa fa-plus"></i>
                            </button>
                            {!! Form::close() !!}
                        </div>
                        </div>
                        </div>
          </div>
                <?php } ?>
            <!--Tile-->
        @endforeach

    </div>
        <?php echo $products->render(); ?>
        </section>

        <section class="catalog-grid">

            <h2 class="primary-color">Events</h2>
            <div class="row">
                @foreach($productsevent as $product)

                        <!--Tile-->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile">

                        <?php if($product->price!="0.00"){?><div class="price-label">CHF {{$product->price}}</div><?php } ?>
                        <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                    src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>

                        <div class="footer">
                            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                <span>{{$product->title}}</span>
                            </a>


                            <div class="tools">
                                <div class="rating">
                                    <div class="ratings">
                                        <div class="rating-box">

                                            <div class="rating" style="width:{{$product->rating_cache*20}}%"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--Add To Cart Button-->
                                {!! Form::open(array('method' => 'POST', 'route' => array('add_cart', $product->id), 'class'=>'formCart')) !!}
                                <button type="submit" class="add-cart-btn" style="border:none">
                                    <span>To cart</span><i class="icon-shopping-cart"></i></button>

                                {!! Form::close() !!}
                                        <!--Share Button-->
                                <div class="share-btn">
                                    <div class="hover-state">
                                        <a class="fa fa-facebook-square" href="#"></a>
                                        <a class="fa fa-twitter-square" href="#"></a>
                                        <a class="fa fa-google-plus-square" href="#"></a>
                                    </div>
                                    <i class="fa fa-share"></i>
                                </div>
                                <!--Add To Wishlist Button-->
                                {!! Form::open(array('method' => 'POST', 'route' => array('add_wishlist', $product->id), 'class'=>'formCart')) !!}
                                <button type="submit" class="wishlist-btn" id="cartBtn"
                                        style="background: none;border:none;">
                                    <div class="hover-state">{{ Lang::get('app.Wishlist') }}</div>
                                    <i class="fa fa-plus"></i>
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!--Tile-->
                @endforeach

            </div>
            <?php echo $productsevent->render(); ?>
        </section>
        <section class="catalog-grid">

            <h2 class="primary-color">Travel</h2>
            <div class="row">
                @foreach($productstravel as $product)

                        <!--Tile-->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile">

                        <?php if($product->price!="0.00"){?><div class="price-label">CHF {{$product->price}}</div><?php } ?>
                        <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                    src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>

                        <div class="footer">
                            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                <span>{{$product->title}}</span>
                            </a>

                            <div class="tools">
                                <div class="rating">
                                    <div class="ratings">
                                        <div class="rating-box">

                                            <div class="rating" style="width:{{$product->rating_cache*20}}%"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--Add To Cart Button-->
                                {!! Form::open(array('method' => 'POST', 'route' => array('add_cart', $product->id), 'class'=>'formCart')) !!}
                                <button type="submit" class="add-cart-btn" style="border:none">
                                    <span>To cart</span><i class="icon-shopping-cart"></i></button>

                                {!! Form::close() !!}
                                        <!--Share Button-->
                                <div class="share-btn">
                                    <div class="hover-state">
                                        <a class="fa fa-facebook-square" href="#"></a>
                                        <a class="fa fa-twitter-square" href="#"></a>
                                        <a class="fa fa-google-plus-square" href="#"></a>
                                    </div>
                                    <i class="fa fa-share"></i>
                                </div>
                                <!--Add To Wishlist Button-->
                                {!! Form::open(array('method' => 'POST', 'route' => array('add_wishlist', $product->id), 'class'=>'formCart')) !!}
                                <button type="submit" class="wishlist-btn" id="cartBtn"
                                        style="background: none;border:none;">
                                    <div class="hover-state">{{ Lang::get('app.Wishlist') }}</div>
                                    <i class="fa fa-plus"></i>
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!--Tile-->
                @endforeach

            </div>
            <?php echo $productstravel->render(); ?>
        </section>


    </div><!--Page Content Close-->
    </div>
