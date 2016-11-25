<div class="alert alert-warning">
    {{ Lang::get('app.The item is not approved yet from administrator') }}
    <?php if($user_role=="admin"){?>
    {!! Form::open(array('method' => 'put', 'route' => array('approvedetails', $product->slug,$product->id))) !!}
    {!! Form::submit(trans('shop.approve'), array('class' => 'btn btn-success btn-xs')) !!}
    {!! Form::close() !!}
    <?php } ?>
</div>