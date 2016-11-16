
<?php 	$typesshop=\App\product_type::where('alias','=',"shop")->get();


foreach($typesshop as $c){
    //$products=Product::with('user')->take(2)->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$c->id)->orderBy('created_at',$sort)->simplePaginate(4);
    $type_id=$c->id;
}?>
<?php $user_id=$product->user_id;
$availability=$product->availability;
$approved=$product->status;?>
<?php    $relatedtoUserShop=\App\Product::whereHas('translations', function($q) use ($user_id,$approved,$availability,$type_id)
{
    $q->where('user_id', '=', $user_id);
    $q->where('status', '=', 1);
    $q->where('availability', '>', 0);
    $q->where('type_id', '=', $type_id);

})->get();?>
<?php    $relatedtoUserOther=\App\Product::whereHas('translations', function($q) use ($user_id,$approved,$availability,$type_id)
{
    $q->where('user_id', '=', $user_id);
    $q->where('status', '=', 1);
    $q->where('availability', '>', 0);
    $q->where('type_id', '!=', $type_id);

})->get();?>

<section class="catalog-grid">
    <?php foreach($relatedtoUserShop as $product){?>
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

</section>