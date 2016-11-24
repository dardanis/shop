
<h2 class="title-single">
    <?php echo $product->title;?>
</h2>
<hr style="margin-top: 0px;">
<div class="description-single">
    <p>
        <?php echo $product->description;?>
    </p>
</div>
<div class="price"><span  class="currency-single">CHF</span> <span class="price-single">{{$product->price}} </span>
    <?php if($user_id['id']!=$product->user_id){?>
    {!! Form::open(array('method' => 'POST', 'route' => array('add_wishlist', $product->id), 'class'=>'formCart')) !!}
    <button type="submit"  class="btn btn-success btn-sm" id="" style="padding:10px;">
        <i class="icon-heart"></i>{{ Lang::get('app.Add to wishlist') }}
    </button>
    {!! Form::close() !!}
    <?php } ?>
</div>


