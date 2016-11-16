<script src="{{ asset('/js/jssor.slider.mini.js') }}"></script>

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
            background: url("<?php echo Yii::app()->theme->baseUrl; ?>/images/a11.png") no-repeat;
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
