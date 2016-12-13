<?php $user_id=\App\User::find(Auth::user()->id);

$user_role = $user_id['role']['name'];

$user_id=$user_id['id'];
        $cat_id=$_GET['cat_id'];
$product = \App\Product::whereHas('translations', function ($q) use ($user_id,$cat_id) {
    $q->where('user_id', '=', $user_id);
    $q->where('category_id', '=', $cat_id);
})->get();
?>


<div class="row">
<?php foreach($product as $p){?>
<?php   $producttype=\App\product_type::where('id','=',$p->type_id)->get();?>

<div class="col-md-3 col-sm-12">
    <div class="items">
        <a href="{{"/edit/$p->slug/$p->id"}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
        <a href="{{ URL::route('product_show',array($p->slug,$p->id)) }}"><img
                    src="{{ asset($p->thumbnail) }}" class="img-responsive"></a>

        <div class="item-content">
            <p class="title" style="word-break: break-all;height:40px;">{{ $p->title }}</p>
            <?php foreach($producttype as $pt){?>
            <?php if($pt->alias=="shop"){?>
                        <p class="p-price" style=""><span class="price"><?php if($p->price!=""){?> {{ Lang::get('app.Price') }}<?php }?></span ><span class="price-value"  style="float:right"><?php if($p->price!=""){ echo $p->price;}?></span></p>
            <p class="p-price"><span class="discount">{{ Lang::get('app.Discount') }}</span><span class="discount-value"  style="float:right">500</span></p>
            <?php }else{?>

            <?php }?>
            <?php }?>

        </div>
    </div>
</div>

<?php } ?>
</div>

