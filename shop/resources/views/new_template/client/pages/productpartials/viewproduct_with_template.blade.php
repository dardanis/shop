

@include('new_template.client.layouts.default')
<script src="{{ asset('/js/photopreview.js') }}"></script>
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
                    <!-- title here -->
                    {!! Form::open(array('route' => array('add_product_template',$product->id),'files'=>true,'class'=>'form-horizontal tasi-form','data-parsley-validate')) !!}
                    <h1>{{$product->title}}</h1>
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::text('title', null, [
                           'class'                         => 'form-control',
                           'placeholder'                   => 'Please insert your title here..',
                           'required',
                           'id'                            => '',
                           'data-parsley-required-message' => 'Title Name is required',
                           'data-parsley-trigger'          => 'change focusout',


                       ]) !!}

                        </div>
                    </div>
                    <div class="form-group">
                        <p class="col-md-12">{{ $product->teaser }}</p>
                        <div class="col-sm-12">
                            {!! Form::text('teaser', null, [
                           'class'                         => 'form-control',
                           'placeholder'                   => 'Please insert short description here..',
                           'required',
                           'id'                            => '',
                           'data-parsley-required-message' => 'Teaser is required',
                           'data-parsley-trigger'          => 'change focusout',


                       ]) !!}

                        </div>
                    </div>
                    <div class="form-group">
                    <!-- description here -->
                    <div class="col-md-3 col-sm-3"><img style="max-height:100px;height:100px;"class="img-responsive" src="/<?php echo $product->thumbnail; ?>" alt=""/></div>
                    <div class="col-md-9 col-md-9" style="word-break:break-word"><?php echo $product->description; ?></div>
                        </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-md-6" style="clear:both;margin-top:10px;">
                            <div class="fileupload-new-first thumbnail img-responsive" style="width: 200px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="preview" src="#"/>
                            </div>
                            <input onchange="readURL(this)" ; class="parsley-error" placeholder="" required="required" id="imgfile" data-parsley-required-message="Front image is required" data-parsley-trigger="change focusout" name="image" type="file" data-parsley-id="14">

                        </div>
                        <div class="col-sm-6 col-md-6">
                            {!! Form::textarea('description', null, [
                    'class'                         => 'form-control',
                    'name'=>'description',
                    'placeholder'                   => 'Please insert your descripion here..',
                    'id'                            => '',
                    'data-parsley-required-message' => 'Description is required',
                    'data-parsley-trigger'          => 'change focusout',
                    'style'=>'width:90%'

                    ]) !!}

                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3>{{ Lang::get('app.Tags') }}</h3>
                            <?php echo $product->search_keywords;?>

                    </div>


                        <div class="col-sm-12">
                            {!! Form::text('search_keywords', null, [
                           'class'                         => 'form-control',
                           'placeholder'                   => 'Please insert tags for better search, sepereated by commas...',
                           'id'                            => '',

                           'data-parsley-trigger'          => 'change focusout',


                       ]) !!}

                        </div>
                    </div>

                    <div class="rate">

                    </div>
                    <div class="price">CHF <span style="padding-left:5px;"></span>{{$product->price}} </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::text('price', null, array('class' => 'form-control', 'placeholder' => 'Please insert price here...')) !!}
                        </div>
                    </div>
                    <div class="buttons group">
                        <div class="qnt-count" style="float:left;">

                           {{ Lang::get('app.Quantity') }}: <?php echo $product->availability;?>

                        </div>
                        <div class="form-group">

                            <div class="col-sm-12">
                                {!! Form::text('availability', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Please quantity here...',
                        'id'                            => 'availability',

                        ]) !!}

                            </div>
                        </div>


                    </div>
                    <div class="col-sm-1 col-sm-offset-8" style="">
                        <button type="submit" class="btn btn-primary">
                            {{ Lang::get('app.Save') }}
                        </button>
                    </div>
                    {!! Form::close() !!}

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
                                    <img  u="image" class="" src="/<?php echo $im->image; ?>" alt=""/>
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



                    </div>


                        </div>
                    </div>


                </div>
            </div>
        </div>

    </section><!--Catalog Single Item Close-->
    <script
            src="http://maps.googleapis.com/maps/api/js">
    </script>
</div>


</div><!--Page Content Close-->


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
