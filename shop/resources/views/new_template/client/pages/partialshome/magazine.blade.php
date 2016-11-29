<?php 
    $sort="desc";
    $typesshop=App\product_type::where('alias','=','magazine')->get()->first();
        $products=App\Product::with('user')->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$typesshop->id)->orderBy('created_at',$sort)->simplePaginate(4);
?>

<?php foreach($products as $product) {?>

<?php if($product->availability>0){?>
<div class="col-md-3 col-sm-12">
    <div class="items">
        <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                    src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>

        <div class="item-content">
            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                <p class="title">{{$product->title}}</p>
            </a>

            <p class="p-price"><span class="price">Price</span><span class="price-value"> <?php if($product->price!="0.00"){?>CHF {{$product->price}}<?php } ?></span></p>
            <p class="p-price"><span class="discount">Discount</span><span class="discount-value">  <?php if($product->price!="0.00"){?>CHF {{$product->price}}<?php } ?></span></p>
            <p class="p-price">  <span class="price">{{ Lang::get('app.Availability') }}: <?php echo $product->availability; ?></span></p>
            <?php if (Auth::guest()){?>

                        <?php } else { ?>
            <?php 	$following = \Illuminate\Support\Facades\DB::table('user_follows')->where('follow_user_id', '=',$product->user_id)->where('follower_user_id','=',Auth::user()->id)->get();?>
            <?php if(sizeof($following)>0){?>

            <div class="user-follow">
                <span class="home-username">{{ Lang::get('app.By')}} <?php echo $product->user->username;?></span>
                <a class="" style="color:#6ADAA2;border:none;margin-left:0px;display:block" href='{{ URL::to("/viewprofile?user_id=$product->user_id") }}'>
                    {{Lang::get('app.Following')}}
                    <i class="fa fa-plus"></i>
                </a>


            </div>
            <?php } else {?>

            <div class="user-follow">
                <span class="home-username">{{ Lang::get('app.By')}} <?php echo $product->user->username;?></span><br/>
                {!! Form::open(array('method' => 'POST', 'route' => array('follow', $product->user_id), 'class'=>'formCart inline-form')) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn-follow" id=""
                        style="padding:10px;border:none;margin-left:0px;display:block">
                    {{ Lang::get('app.Follow user')}}
                    <i class="fa fa-plus"></i>
                </button>

                {!! Form::close() !!}

            </div>
            <?php } ?>
            {!! Form::open(array('method' => 'POST', 'route' => array('add_wishlist', $product->id), 'class'=>'formCart inline-form')) !!}
            <button type="submit" class="wishlist-btn" id="cartBtn">
                <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                <span class="hover-state">{{ Lang::get('app.Wishlist')}}</span>

            </button>
            {!! Form::close() !!}
            <?php } ?>
            <?php  $url=URL::route('product_show',array($product->slug,$product->id));?>
{{--            <div class="tools">

                <!--Add To Cart Button-->
                {!! Form::open(array('method' => 'POST', 'route' => array('add_cart', $product->id), 'class'=>'formCart')) !!}
                <button type="submit" class="add-cart-btn" style="">
                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><span style="padding-left: 10px">To cart</span></button>

                {!! Form::close() !!}
                        <!--Share Button-->

                <!--Add To Wishlist Button-->
                {!! Form::open(array('method' => 'POST', 'route' => array('add_wishlist', $product->id), 'class'=>'formCart')) !!}
                <button type="submit" class="wishlist-btn" id="cartBtn">
                    <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                    <span class="hover-state">{{ Lang::get('app.Wishlist')}}</span>

                </button>
                {!! Form::close() !!}
            </div>--}}
        </div>
    </div>
</div>
<?php } ?>
<?php } ?>