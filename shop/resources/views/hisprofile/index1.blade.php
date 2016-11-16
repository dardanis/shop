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
                                          <!--Tile-->
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="items">


                                        <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                                    src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>
                                        <div class="item-content">
                                            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                                <p class="title">{{$product->title}}</p>
                                            </a>
                                            <p class="p-price"><span class="price">Price</span><?php if($product->price!="0.00"){?>CHF {{$product->price}}<?php } ?></p>
                                            <p class="p-price"><span class="discount">Discount</span><span class="discount-value"><?php if($product->price!="0.00"){?>CHF {{$product->price}}<?php } ?></span></p>
                                            <p><span class="price">{{ Lang::get('app.Availability') }}: <?php echo $product->availability; ?></span></p>
                                        </div>

                                    </div>
                                </div>


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
