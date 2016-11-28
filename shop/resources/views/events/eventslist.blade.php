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
             
            </div>
        </div>
    </div>
    <?php } ?>
</div>