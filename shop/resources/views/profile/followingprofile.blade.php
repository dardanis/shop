@include('new_template.client.layouts.default')
<div class="container">
<div class="page-content">

        <section class="profile-section">
            <div class="profile-container" style="margin-top: 30px;">
                <div class="row">
                    <div class="p-image-section col-xs-12 col-lg-2">
                        <img class="profile-pic  img-responsive" src="/{{$user->profile}}" alt="" id="preview_profile" style="max-height:200px" />
                    </div>
                    <div class="col-lg-9"><h3 class="p-name"><?php echo $user->name;?><span style="padding-left: 10px;"><?php echo $user->lastname; ?></span></h3></div>
                </div>
                <div class="row">
                    <div class="p-info-section col-xs-12 col-lg-9" style="margin-top:20px;">

                        <div class="col-lg-12" style="padding:0px">
                            <ul class="profile-tabs nav nav-tabs">
                                <li class="active"><a href="#myproducts" data-toggle="tab" aria-expanded="true">{{ Lang::get('app.Products') }}</a></li>
                                <li class=""><a href="#onsale" data-toggle="tab" aria-expanded="false">{{ Lang::get('app.Items on sale') }}</a></li>
                                <li class=""><a href="#photogallery" data-toggle="tab" aria-expanded="false">{{ Lang::get('app.Photos') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in catalog-grid" id="myproducts">
                        <div class="container">
                            <div class="row">
                                <!--Tile-->
                                <?php foreach($product as $product){?>
                                <?php if($product->availability>0){?>            <!--Tile-->
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="tile">

                                        <?php if($product->price!="0.00"){?><div class="price-label">CHF {{$product->price}}</div><?php } ?>
                                        <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                                    src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>

                                        <div class="footer">
                                            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                                <span>{{$product->title}}</span>
                                            </a>
                                            <span style="color:#ffaa00;">{{ Lang::get('app.Availability') }}: <?php echo $product->availability; ?></span>

                                            <?php  $url=URL::route('product_show',array($product->slug,$product->id));?>

                                            <div class="tools">
                                                <div class="rating">
                                                    <div class="ratings">
                                                        <div class="rating-box">

                                                            <div class="rating" style="width:{{$product->rating_cache*20}}%"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--Add To Cart Button-->
                                                {!! Form::open(array('method' => 'POST', 'route' => array('add_cart', $product->id), 'class'=>'formCart')) !!}
                                                <button type="submit" class="add-cart-btn" style="border:none">
                                                    <span>To cart</span><i class="icon-shopping-cart"></i></button>

                                                {!! Form::close() !!}
                                                        <!--Share Button-->
                                                <div class="share-btn">
                                                    <div class="hover-state">
                                                        <a class="fa fa-facebook-square" href="<?php echo Share::load($url,'t')->facebook();?>" target="_blank"></a>
                                                        <a class="fa fa-twitter-square" href="<?php echo Share::load($url, $product->title)->twitter();?>" target="_blank"></a>
                                                        <a class="fa fa-google-plus-square"   href="<?php echo Share::load($url, '')->gplus();?>" target="_blank"target="_blank"></a>
                                                    </div>
                                                    <i class="fa fa-share"></i>
                                                </div>
                                                <!--Add To Wishlist Button-->
                                                {!! Form::open(array('method' => 'POST', 'route' => array('add_wishlist', $product->id), 'class'=>'formCart')) !!}
                                                <button type="submit" class="wishlist-btn" id="cartBtn"
                                                        style="background: none;border:none;">
                                                    <div class="hover-state">Wishlist</div>
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php } ?>
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="onsale">
                    </div>
                    <div class="tab-pane fade" id="photogallery">
                        <section class="profile-gallery-widget">
                            <div class="container">
                                <div class="row profile-gallery-grid">
                                    <!--Item-->
                                    <div class="pf-gallery-item col-lg-3" data-src="">

                                    </div>

                                </div>
                            </div>
                        </section><!--Gallery Widget Close-->
                    </div>
                </div>
            </div>



        </section>
    </div>
</div>
