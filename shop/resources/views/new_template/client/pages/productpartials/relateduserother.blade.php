
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
    <?php foreach($relatedtoUserOther as $product){?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="tile">

            <?php if($product->price!="0.00"){?><div class="price-label">CHF {{$product->price}}</div><?php } ?>
            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                        src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>

            <div class="footer">
                <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                    <span>{{$product->title}}</span>
                </a>
                <?php  $url=URL::route('product_show',array($product->slug,$product->id));?>
                <div class="tools">
                    <div class="rating">
                        <div class="ratings">
                            <div class="rating-box">

                                <div class="rating" style="width:{{$product->rating_cache*20}}%"></div>
                            </div>
                        </div>
                    </div>

                            <!--Share Button-->
                    <div class="share-btn">
                        <div class="hover-state">
                            <a class="fa fa-facebook-square" href="<?php echo Share::load($url,'t')->facebook();?>" target="_blank"></a>
                            <a class="fa fa-twitter-square" href="<?php echo Share::load($url, $product->title)->twitter();?>" target="_blank"></a>
                            <a class="fa fa-google-plus-square"   href="<?php echo Share::load($url, '')->gplus();?>" target="_blank"target="_blank"></a>
                        </div>
                        <i class="fa fa-share"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php } ?>

</section>