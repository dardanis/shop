

@include('new_template.client.layouts.default')

        <!--Page Content-->
<div class="container">

    <div class="div-content-other">

    <!--Shopping Cart Message-->
    <section class="cart-message">
        <i class="fa fa-check-square"></i>
        <p class="p-style3">{{$product->title}}</p>
        <a class="btn-outlined-invert btn-success btn-sm" href="shop-single-item-v2.html">{{ Lang::get('app.View cart') }}</a>
    </section><!--Shopping Cart Message Close-->

    <!--Catalog Single Item-->
    <section class="catalog-single">
        <div class="container">
            <?php if($product->status==0){?>
            <div class="alert alert-warning">
                {{ Lang::get('app.The item is not approved yet from administrator') }}
                <?php if($user_role=="admin"){?>
                {!! Form::open(array('method' => 'put', 'route' => array('approvedetails', $product->slug,$product->id))) !!}
                {!! Form::submit(trans('shop.approve'), array('class' => 'btn btn-success btn-xs')) !!}
                {!! Form::close() !!}

                <?php } ?>
            </div>
            <?php } ?>
            <div class="row">

                <!--Product Description-->
                <div class="col-lg-6 col-md-6">
                    <h1>{{$product->title}}</h1>
                    <p class="p-style2">
                        <?php echo $product->teaser;?>
                    </p>
                    <div class="rate">

                        <div style="width:{{$product->rating_cache*20}}%" class="rating"></div>

                        <p class="rating-links"> <a>{{$product->rating_count}} {{Lang::get('app.Reviews')}}</a> </p>
                    </div>
                    <div class="price">CHF <span style="padding-left:5px;"></span>{{$product->price}} </div>
                    <div class="buttons group">
                        <div class="qnt-count" style="float:left;">


                            {{ Lang::get('app.Quantity') }} <input id="quantity" class="form-control" type="text" value="<?php echo $product->availability;?>">

                        </div>


                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-5">
                            <h3>{{ Lang::get('app.Tell friends') }}</h3>
                            <div class="social-links">
                                <a href="#"><i class="fa fa-tumblr-square"></i></a>
                                <a href="#"><i class="fa fa-pinterest-square"></i></a>
                                <a href="#"><i class="fa fa-facebook-square"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-7">
                            <h3>{{ Lang::get('app.Tags') }}</h3>
                            <div class="tags">
                                <?php echo $product->search_keywords;?>
                            </div>
                        </div>
                    </div>

                </div>


                <!--Product Gallery-->
                <div class="col-lg-6 col-md-6 product-view">

                    <div class="CONTAINER">
                        <?php if(sizeof($images)>0){?>
                                <!-- Jssor Slider Begin -->
                        <!-- You can move inline styles to css file or css block. -->
                        <div id="slider1_container" style="position: relative; width: 720px;
				        height: 445px; overflow: hidden;">

                            <!-- Loading Screen -->
                            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
				                background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
                                </div>
                                <div style="position: absolute; display: block; background: url(/images/loadingSlider.gif) no-repeat center center;
                                        top: 0px; left: 0px;width: 100%;height:100%;">
                                </div>
                            </div>
                            <!-- Slides Container -->
                            <div u="slides" style="cursor: pointer; position: absolute; left: 0px; top: 0px; width: 720px; height: 445px;
				            overflow: hidden;">

                                <?php foreach($images as $im){?>


                                <?php if($im->image!=""&&$im->image!=null)
                                {?>

                                <div>
                                    <img  u="image" class="big_img_slider" src="/<?php echo $im->image; ?>" alt=""/>
                                    <img u="thumb" src="/<?php echo $im->image;  ?>" alt=""/>
                                </div>

                                <?php }?>
                                <?php }?>
                            </div>

                            <!-- Thumbnail Navigator Skin Begin -->
                            <div u="thumbnavigator" class="jssort07" style="position: absolute; width: 720px; height: 100px; left: 0px; bottom: 0px; overflow: hidden; ">
                                <div style=" background-color: #000; filter:alpha(opacity=30); opacity:.3; width: 100%; height:100%;"></div>

                                <div u="slides" style="cursor: move;">
                                    <div u="prototype" class="p" style="POSITION: absolute; WIDTH: 99px; HEIGHT: 66px; TOP: 0; LEFT: 0;">
                                        <div u="thumbnailtemplate" class="i" style="position:absolute;"></div>
                                        <div class="o">
                                        </div>
                                    </div>
                                </div>

                                <!-- Arrow Left -->
							            <span u="arrowleft" class="jssora11l" style="width: 37px; height: 37px; top: 123px; left: 8px;">
							            </span>
                                <!-- Arrow Right -->
							            <span u="arrowright" class="jssora11r" style="width: 37px; height: 37px; top: 123px; right: 8px">
							            </span>
                                <!-- Arrow Navigator Skin End -->
                            </div>
                            <!-- ThumbnailNavigator Skin End -->

                            <!-- Trigger -->

                            <?php } ?>

                        </div>
                        <?php if(sizeof($images)>0){?>

                        <?php } else{?>
                        {!! Form::open(['url' => route("postUpload",$product->id), 'class' => 'dropzone', 'files'=>true, 'id'=>'real-dropzone','style'=>'border:none']) !!}
                        @include('pictures.partialgallery')

                        {!! Form::close() !!}
                        <?php } ?>

                    </div>



                </div>
            </div>
        </div>

    </section><!--Catalog Single Item Close-->
    <script
            src="http://maps.googleapis.com/maps/api/js">
    </script>
    <!--Tabs Widget-->
    <section class="tabs-widget">
        <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
            <li> <a href="#product_tabs_description" data-toggle="tab"> {{Lang::get('app.Description')}}</a> </li>
            <li> <a href="#reviews_tabs" data-toggle="tab">{{Lang::get('app.Reviews')}}</a> </li>
            <li> <a href="#attributes_tabs" data-toggle="tab">{{Lang::get('app.Specifications')}}</a> </li>
            <li class="active"> <a href="#adress_tabs" data-toggle="tab">{{Lang::get('app.Adress')}}</a> </li>
        </ul>

        <div id="productTabContent" class="tab-content container">
            <div class="tab-pane fade " id="product_tabs_description">
                <div class="std">
                    <div class="col-md-3"><img class="img-responsive" src="/<?php echo $product->thumbnail; ?>" alt=""/></div><div class="col-md-9"><p><?php echo $product->description; ?></p></div>
                </div>
            </div>

            <div class="tab-pane fade in active" id="adress_tabs">
                <?php if(sizeof($product->adress)>0){?>
                <div class="std">



                    <div class="col-md-3">
                        <h2>{{ Lang::get('app.Adress Info') }}</h2>
                        <table>
                            <?php foreach($product->adress as $padress){?>
                            <tr>
                                <td style="padding-right:36px;"><b>{{Lang::get('app.Tel')}}:</b></td>
                                <td><?php echo $padress->tel;?></td>
                            </tr>
                            <tr>
                                <td><b>{{ Lang::get('app.Mobile') }}:</b></td><td><?php echo $padress->mobile;?></td>
                            </tr>
                            <tr>
                                <td><b>{{ Lang::get('app.Email') }}:</b></td><td><?php echo $padress->email;?></td>
                            </tr>
                            <tr>
                                <td><b>{{ Lang::get('app.Web') }}:</b></td><td><?php echo $padress->web;?></td>
                            </tr>
                            <tr>

                            <?php  $lat=$padress->lat;?>
                            <?php  $lon=$padress->lon;?>

                            <?php }?>
                        </table>
                    </div>


                    <div class="col-md-9">

                        <div id="map" style="width:auto;height:300px;margin-bottom:100px;"></div>

                    </div>
                </div>
                <?php } else { ?>
                        @include('adress/adresspartial')
                <?php } ?>
            </div>


            <div class="tab-pane fade" id="attributes_tabs">
                <div class="box-collateral box-reviews" id="customer-reviews">
                    <div class="box-reviews1">
                        <?php if(sizeof($product_attributes)>0){?>
                        <div class="col-sm-12">
                            <div class="col-sm-6">

                                <?php $category_id=$product->category_id;?>

                                <?php
                                $rows = 2;
                                $totalCount = count($product_attributes);
                                $rowCount = $totalCount / $rows;
                                $firstList = $product_attributes->slice(0, $rowCount);
                                $secondList = $product_attributes->slice($rowCount, $totalCount);?>
                                <table style="float:left">
                                    <?php $current_attr = "";?>
                                    <?php $half=0;?>
                                    <?php $i=0;?>
                                    <?php $product_attributes2 = $product_attributes;
                                    foreach($firstList as $pa)
                                    {

                                    if($pa->attribute->name != $current_attr)
                                    {

                                    $current_attr = $pa->attribute->name;?>
                                    <tr><td style="padding-right:10px;"><b><?php  echo $pa->attribute->name; ?>:</b></td><?php
                                        $pa2_arr = array();

                                        foreach($product_attributes2 as $pa1){
                                            if($current_attr == $pa1->attribute->name)
                                                $pa2_arr[] = $pa1->value;
                                        }?>
                                        <td><?php echo implode(",", $pa2_arr);?></td>

                                    </tr>
                                    <?php

                                    }

                                    }?>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table>
                                    <?php foreach($secondList as $pa)
                                    {

                                    if($pa->attribute->name != $current_attr)
                                    {

                                    $current_attr = $pa->attribute->name;?>
                                    <tr><td style="padding-right:10px;"><b><?php  echo $pa->attribute->name; ?>:</b></td><?php
                                        $pa2_arr = array();

                                        foreach($product_attributes2 as $pa1){
                                            if($current_attr == $pa1->attribute->name)
                                                $pa2_arr[] = $pa1->value;
                                        }?>
                                        <td><?php echo implode(",", $pa2_arr);?></td>

                                    </tr>
                                    <?php

                                    }

                                    }?>


                                </table>

                            </div>

                        </div>

                            <?php } else {?>
                            <div class="col-sm-12">
                                @include('attributes/attributes_partial')
                            </div>
                            <?php } ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div><!-- end of attributes tab -->
            <div class="tab-pane fade" id="reviews_tabs">
                <div class="box-collateral box-reviews" id="customer-reviews">
                    <div class="box-reviews1">
                        <div class="col-sm-12">
                            <div class="well well-sm">

                                @if (Auth::check())
                                    <div class="text-right">
                                        <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">{{ Lang::get('app.Leave review') }}</a>
                                    </div>
                                @else
                                    {{Lang::get('app.Log in to post reviews')}}
                                @endif

                                <div class="row" id="post-review-box" style="display:none;">
                                    <div class="col-md-12">
                                        <form accept-charset="UTF-8" action='{{ url("/reviews/$slug/$id") }}' method="post">

                                            <input id="ratings-hidden" name="rating" type="hidden">
                                            <textarea class="form-control"   id="new-review"  style="opactity:1!important;width:100%;resize:none;" name="comment" placeholder="{{ Lang::get('app.Enter your review here') }}..." rows="5"></textarea>

                                            <div class="text-right">
                                                <div class="stars starrr" data-rating="0"></div>
                                                <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                                    <span class="glyphicon glyphicon-remove"></span>{{Lang::get('app.Cancel')}}</a>
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                <button class="btn btn-success btn-sm" type="submit">{{Lang::get('app.Save')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @foreach($reviews as $review)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php $userss= \Illuminate\Support\Facades\DB::table('users')->where('id', '=', $review->user_id)->get()?>
                                        <?php foreach($userss as $u){?>
                                    <?php echo $u->username;?>
                                    <?php }?>

                                        @for ($i=1; $i <= 5 ; $i++)
                                            <span style="font-size: 18px !important;color: rgb(255, 214, 88);" class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
                                        @endfor

                                        <span class="pull-right">{{ Carbon::createFromTimestamp(strtotime($review->created_at))->diffForHumans() }}</span>

                                        <p>{{{$review->comment}}}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Tabs Widget Close-->
    <?php if(sizeof($product->adress)>0){?>
    <script>
        function initMap() {
            var myLatLng = {lat: <?php echo $lat;?>, lng: <?php echo $lon;?>};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'ShopCH!'
            });
        }
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
    <?php } ?>

    <div class="container">

        <?php 	$typesshop=\App\product_type::where('alias','=',"shop")->get();


        foreach($typesshop as $c){
            //$products=Product::with('user')->take(2)->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->where('type_id','=',$c->id)->orderBy('created_at',$sort)->simplePaginate(4);
            $type_id=$c->id;
        }?>
        <?php $user_id=$product->user_id;
        $availability=$product->availability;
        $approved=$product->status;?>
        <?php    $relatedtoUserShop=\App\Product::whereHas('translations', function($q) use ($user_id,$approved,$availability,$type_id)
        {
            $q->where('user_id', '=', $user_id);
            $q->where('status', '=', 1);
            $q->where('availability', '>', 0);
            $q->where('type_id', '=', $type_id);

        })->get();?>
        <?php    $relatedtoUserOther=\App\Product::whereHas('translations', function($q) use ($user_id,$approved,$availability,$type_id)
        {
            $q->where('user_id', '=', $user_id);
            $q->where('status', '=', 1);
            $q->where('availability', '>', 0);
            $q->where('type_id', '!=', $type_id);

        })->get();?>



    </div>
</div><!--Page Content Close-->
</div>

<script src="{{ asset('/js/jquery.fancybox.js') }}"></script>
<?php if(sizeof($images)>0){?>
<script src="{{ asset('/js/jssor.slider.mini.js') }}"></script>
<?php } ?>
<script src="{{ asset('/js/custom.js') }}"></script>
<script src="{{ asset('/js/review.js') }}"></script>
<link  media="screen" rel="stylesheet" href="{{ asset('/css/jquery.fancybox.css') }}">
<?php if(sizeof($images)>0){?>
<script>
    jQuery(document).ready(function ($) {

        var options = {
            $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
            $AutoPlayInterval: 5000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
            $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
            $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
            $UISearchMode: 0,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).

            $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                $Loop: 2,                                       //[Optional] Enable loop(circular) of carousel or not, 0: stop, 1: loop, 2 rewind, default value is 1
                $SpacingX: 3,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                $SpacingY: 3,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                $DisplayPieces: 6,                              //[Optional] Number of pieces to display, default value is 1
                $ParkingPosition: 204,                          //[Optional] The offset position to park thumbnail,

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 6                                       //[Optional] Steps to go for each navigation request, default value is 1
                }
            }
        };

        var jssor_slider1 = new $JssorSlider$("slider1_container", options);

        //responsive code begin
        //you can remove responsive code if you don't want the slider scales while window resizes
        function ScaleSlider() {
            var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
            if (parentWidth)
                jssor_slider1.$ScaleWidth(Math.min(parentWidth, 720));
            else
                window.setTimeout(ScaleSlider, 30);
        }
        ScaleSlider();

        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);


        setTimeout(function() {
            // Do something after 5 seconds
            resizeImages();
        }, 1000);
        //responsive code end
    });

    function resizeImages(){
        $(".big_img_slider").each(function(){
            var image = new Image();
            image.src = $(this).attr("src");
            var width=image.naturalWidth;
            var height=image.naturalHeight;

            var properties=width/height;
            if(properties!=1.625)
            {  console.log("note equal");
                if(properties<1.625)
                {
                    $(this).css({"width":"720px","height":"auto"});
                    //console.log("lower");
                }
                else{
                    widthResized=properties*443;
                    $(this).css({"width":"auto","height":"443px","max-width":widthResized});
                    //console.log("grater");
                }
            }
        })
    }


    $(".big_img_slider").on("click", function() {
        var source=$(this).attr("src").replace(/thumbnails/g, "").replace(/g_/g, "");
        $.fancybox.open({
            href : source,
            closeBtn: true,
            closeClick : true,
            openEffect : 'elastic',
            openSpeed  : 150,
            closeEffect : 'elastic',
            closeSpeed  : 150,
            helpers : {
                overlay : null
            }
        });

    });
</script>
<?php } ?>
        <!-- Thumbnail Item Skin Begin -->
<style>
    /* jssor slider thumbnail navigator skin 07 css */
    /*
    .jssort07 .p            (normal)
    .jssort07 .p:hover      (normal mouseover)
    .jssort07 .pav          (active)
    .jssort07 .pav:hover    (active mouseover)
    .jssort07 .pdn          (mousedown)
    */
    .jssort07 .i {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 99px;
        height: 66px;
        filter: alpha(opacity=80);
        opacity: .8;
    }

    .jssort07 .p:hover .i, .jssort07 .pav .i {
        filter: alpha(opacity=100);
        opacity: 1;
    }

    .jssort07 .o {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 97px;
        height: 64px;
        border: 1px solid #000;
        transition: border-color .6s;
        -moz-transition: border-color .6s;
        -webkit-transition: border-color .6s;
        -o-transition: border-color .6s;
    }

    * html .jssort07 .o {
        /* ie quirks mode adjust */
        width /**/: 99px;
        height /**/: 66px;
    }

    .jssort07 .pav .o, .jssort07 .p:hover .o {
        border-color: #fff;
    }

    .jssort07 .pav:hover .o {
        border-color: #0099FF;
    }

    .jssort07 .p:hover .o {
        transition: none;
        -moz-transition: none;
        -webkit-transition: none;
        -o-transition: none;
    }
</style>
<!-- Thumbnail Item Skin End -->
<!-- Arrow Navigator Skin Begin -->
<style>
    /* jssor slider arrow navigator skin 11 css */
    /*
.jssora11l              (normal)
.jssora11r              (normal)
.jssora11l:hover        (normal mouseover)
.jssora11r:hover        (normal mouseover)
.jssora11ldn            (mousedown)
.jssora11rdn            (mousedown)
*/
    .jssora11l, .jssora11r, .jssora11ldn, .jssora11rdn {
        position: absolute;
        cursor: pointer;
        display: block;

        overflow: hidden;
    }

    .jssora11l {
        background-position: -11px -41px;
    }

    .jssora11r {
        background-position: -71px -41px;
    }

    .jssora11l:hover {
        background-position: -131px -41px;
    }

    .jssora11r:hover {
        background-position: -191px -41px;
    }

    .jssora11ldn {
        background-position: -251px -41px;
    }

    .jssora11rdn {
        background-position: -311px -41px;
    }
</style>
