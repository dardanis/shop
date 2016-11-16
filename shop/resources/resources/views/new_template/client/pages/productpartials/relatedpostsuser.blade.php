
<?php 	$typesshop=\App\product_type::where('alias','=',"shop")->get();


foreach($typesshop as $c){
    //$products=Product::with('user')->take(2)->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$c->id)->orderBy('created_at',$sort)->simplePaginate(4);
    $type_id=$c->id;
}?>
<?php $user_id=$product->user_id;
$availability=$product->availability;
$approved=$product->status;?>

<?php  $relatedtoUserOther=\App\Product::whereHas('translations', function($q) use ($user_id,$approved,$availability,$type_id)
{
    $q->where('user_id', '=', $user_id);
    $q->where('status', '=', 1);
    $q->where('availability', '>', 0);
    $q->where('type_id', '!=', $type_id);

})->get();?>

    <?php foreach($relatedtoUserOther as $product){?>

        <div class="tile">

            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">{{$product->title}}</a><br/><hr/>

        </div>

    <?php } ?>

