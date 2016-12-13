<?php foreach($products as $product) {?>

<?php if($product->availability > 0){?>
<div class="col-md-3 col-sm-12">
    <div class="items" style="padding-bottom: 0; min-height: 263px">
        <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                    src="{{ asset($product->thumbnail) }}" class="img-responsive" width="60px" height="60px"></a>

        <div class="item-content">
            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                <p class="title">Tileeee</p>
            </a>
            <span style="color: #33FF3F; font-size: large">2`500,-</span>
            <?php if (Auth::guest()){ ?>
            
                        <?php } else { ?>
            <?php    $following = \Illuminate\Support\Facades\DB::table('user_follows')->where('follow_user_id', '=',
                    $product->user_id)->where('follower_user_id', '=', Auth::user()->id)->get();?>
            <?php if(sizeof($following) > 0){?>

            <div class="user-follow">
                <span class="home-username">{{ Lang::get('app.By')}} <?php echo $product->user->username;?></span>
                <a class="" style="color:#6ADAA2;border:none;margin-left:0px;display:block"
                   href='{{ URL::to("/viewprofile?user_id=$product->user_id") }}'>
                    {{Lang::get('app.Following')}}
                    <i class="fa fa-plus"></i>
                </a>


            </div>
            <?php } else {?>
            <div class="user-follow">
                <span class="home-username"
                      style="margin-left: 118px;">{{ Lang::get('app.By')}} <?php echo $product->user->username;?></span><br/>
                {!! Form::open(array('method' => 'POST', 'route' => array('follow', $product->user_id), 'class'=>'formCart inline-form')) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn-follow" id=""
                        style="padding: 9px; border:none;display:block; float: right; margin-left: 127px;position: absolute;">
                    {{ Lang::get('app.Follow user')}}
                    <i class="fa fa-plus"></i>
                </button>

                {!! Form::close() !!}

            </div>
            <?php } ?>
            {!! Form::open(array('method' => 'POST', 'route' => array('add_wishlist', $product->id), 'class'=>'formCart inline-form')) !!}
            <button type="submit" class="wishlist-btn" id="cartBtn">
                <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                <span class="hover-state">{{ Lang::get('app.Wishlist')}}</span>

            </button>
            <br><br>
            {!! Form::close() !!}
            <?php } ?>
            <?php  $url = URL::route('product_show', array($product->slug, $product->id));?>

        </div>
    </div>
</div>

<?php } ?>
<?php } ?>