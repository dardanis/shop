<?php $user_id=\App\User::find(Auth::user()->id);
$user_role = $user_id['role']['name'];
$user_id=$user_id['id'];

?>

<div class="row">
    <?php foreach($product as $p){?>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="items">

            <a href="{{ URL::route('product_show',array($p->slug,$p->id)) }}"><img
                        src="{{ asset($p->thumbnail) }}" class="img-responsive"></a>
            <?php if($p->user_id==$user_id){?>

            <?php } ?>
            <div class="item-content">
                <p class="title" style="word-break: break-all;height:40px;">{{ $p->title }}</p>
                <p class="p-price" style=""><span class="price"><?php if($p->price!=""){?> {{ Lang::get('app.Price') }}<?php }?></span ><span class="price-value"  style="float:right"><?php if($p->price!=""){ echo $p->price;}?></span></p>
                <p class="p-price"><span class="discount">{{ Lang::get('app.Discount') }}</span><span class="discount-value"  style="float:right">500</span></p>
            </div>
        </div>
    </div>
    <?php } ?>
</div>