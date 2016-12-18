
<?php if(Auth::user()->id!=""){
    $user = App\User::find(Auth::user()->id);

} ?>


<div class="left-tabs profile-tab">
    <p class="title-tab" style="color:#E28D33;"><a href="{{ url("/client/basic/profile") }}" ><?php echo $user->name; ?> <?php echo $user->lastname;?><span class="glyphicon glyphicon-cog" aria-hidden="true" style="float:right"></span></a></p>
</div>

<?php $types=\App\product_type::all();?>

<?php foreach($types as $t){?>
<?php $type_id=$t->id;?>
<?php $categories = \App\Category::whereHas('translations', function ($q) use ($type_id) {
    $q->where('type_id', '=',$type_id);

})->get();?>
<?php  $categories=\App\Category::where('type_id','=',$t->id)->get();?>

<?php if(empty($_GET['cat_id'])){?>
        <?php $category_id="";?>
<?php } else {?>
    <?php  $category_id=$_GET['cat_id'];?>
<?php } ?>
<div class="left-tabs type-tab">
    <p class="title-tab">{{ Lang::get("app.$t->name") }}</p>
    <ul>
        <?php foreach($categories as $c){?>
        <?php  $category_found=$c->id;?>
        <li class="add-product-cat">
            <?php if($category_found==$category_id){?>
            <a href='{{ url("/all?cat_id=$category_found") }}' style="color:#E28D33"><?php echo $c->name;?></a>
                <?php }else { ?>
                <a href='{{ url("/all?cat_id=$category_found") }}'><?php echo $c->name;?></a>
                <?php }?>
                <?php if($t->alias=="shop"){?>
                 <a href="{{ url('client/add/product') }}?cat_id=<?php echo $c->id;?>" title="Add Product">
                <?php }?>
                <?php if($t->alias=="event"){?>
                 <a href="{{ url('client/add/event') }}?cat_id=<?php echo $c->id;?>" title="Add Product">
                <?php }?>
                   <?php if($t->alias=="magazine"){?>
                 <a href="{{ url('client/add/event') }}?cat_id=<?php echo $c->id;?>" title="Add Product">
                <?php }?>
                   <?php if($t->alias=="travel"){?>
                 <a href="{{ url('client/add/event') }}?cat_id=<?php echo $c->id;?>" title="Add Product">
                <?php }?>
                <?php if($category_found==$category_id){?>
                <span class="glyphicon glyphicon-plus plus-red" aria-hidden="true" style="float:right;margin-right:20px;"></span>
                    <?php  } else {?>
                    <span class="glyphicon glyphicon-plus" aria-hidden="true" style="float:right;margin-right:20px;"></span>
                <?php } ?>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>
<?php } ?>

<div class="left-tabs type-tab">
    <p class="title-tab">{{ Lang::get('app.Informations') }}</p>
    <ul>
        <li><span class="type-name"><a href="{{ route('contact') }}" title="My Profile">{{ Lang::get('app.My Informations') }}</a></span></li>

    </ul>
</div>
