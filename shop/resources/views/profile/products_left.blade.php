<?php $user_id=\App\User::find(Auth::user()->id);

$user_role = $user_id['role']['name'];

$user_id=$user_id['id'];
$product = \App\Product::whereHas('translations', function ($q) use ($user_id) {
    $q->where('user_id', '=', $user_id);
})->get();
?>


<?php foreach($product as $p){?>

    <div class="items" style="border:none;height:200px;">
        <div clas="col-md-12">
        <div clas="col-md-3">
            <a href="{{ URL::route('product_show',array($p->slug,$p->id)) }}">
                <img   src="{{ asset($p->thumbnail) }}" class="img-responsive" style="width:200px;height:200px;float: left;margin-right: 10px;"></a>
        </div>
        <div clas="col-md-9">
            <p class="title" style="word-break: break-all;height:40px;margin-bottom:60px;margin-right:10px;">{{ $p->title }}</p>
            <p class="p-price" style=""></span ><span class="price-value" style="color:#6ADAA2"><?php if($p->price!=""){ echo $p->price;}?></span></p>

        </div>
        </div>
    </div>

<?php } ?>
