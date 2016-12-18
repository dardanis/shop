<!DOCTYPE html>
<html lang="en">
<head>
    @include('new_template.client.includes.head')

</head>

<body>


<header>

    @include('new_template.client.includes.header')


</header>

<div class="container">
@yield('content')
</div>

        <!-- include js files -->



<script src="{{ asset('/js/dropzone.js') }}"></script>
<script src="{{ asset('/js/upload.js') }}"></script>
<script src="{{ asset('/js/review.js ') }}"></script>
<script src="{{ asset('/js/photopreview.js ') }}"></script>

</body>
</html>

<?php $detect = new Mobile_Detect;?>
<?php if($detect->isMobile() || $detect->isTablet()){?>
<style>

    .searchdistance{
        padding-bottom: 20px;
    }
    .btn-location{
        width:10%;

    }
    .seach-location{
        width:60%;
    }
    .text-green-15{
        float: left;
        margin-top: 10px;
        margin-left: 10px;
    }
    .profile-left{
        padding-left: 0px;
        padding-right:0px;
        overflow: auto;
        clear: both;
        /* clear: left; */
        position: relative;
    }
    .user-profile-top{
        padding-bottom: 20px;
    }
    .no-padding{
        padding-left: 0px !important;
    }
    .main-content{
        background:white;
        width: 100%;
        height: 400px;
    }
    .navbar-nav{
        margin:0px;
    }
    .navbar-right .open{
        background: #e5dede;
        color: black;
    }
    .search-div .glyphicon {
        color: #E28D33;
        height: 20px;
    }
    .usernav{
        padding-top: 10px;
    }
</style>
<?php } else {?>
    <style>
        .navbar-header{
        height:10px;
        }
         header{
             height: 175px;
        }
        .profile-left{
            padding-left: 0px;

        }
        .main-content{
            background:white;
            height:137px;
            width: 100%;

        }
        .search-div .glyphicon {
            color: #E28D33;
            height: 20px;
        }
        .usernav{
            padding-top: 10px;
        }
    </style>
<?php } ?>

<style>
    header form{
        margin:0px;
    }
</style>


<script>
$(document).ready(function(){
  var checkUrlmenu = function () {
        var found = false;
        $(".navbar-collaps ul li a").each(function () {

            var href = $(this).attr("href");
            alert(href);

    })
    }
      checkUrlmenu();
})

    var checkUrl = function () {
        var found = false;
        $("ul li a").each(function () {

            var href = $(this).attr("href");

            if (window.location.href.indexOf(href) > -1 && !found) {
                console.log("found it");
                $(this).addClass("selected_category");
                //$(this).closest(".parent").addClass("active");
                found = true;
            }
            else {//console.log("notFound")
            }
        })
        if (found == false) {
            $(".start").addClass("active");
        }

    }


    var checkUrl1 = function () {
        var found1 = false;
        $(".tittle-tab a").each(function () {
            var href1 = $(this).attr("href");

            if (window.location.href.indexOf(href1) > -1 && !found1) {
                //  console.log("found it");
                $(this).addClass("selected_category");
                //$(this).closest(".parent").addClass("active");
                found1 = true;
            }
            else {//console.log("notFound")
            }
        })
        if (found1 == false) {
            $(".start").addClass("active");
        }

    }
    checkUrl();


    function profilechange(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview_profile').src=e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $(document).ready(function () {
        $('#loading').toggle();
        var attributes = [];

        // Listen for 'change' event, so this triggers when the user clicks on the checkboxes labels
        $('input[name="attribute_value[]"]').on('change', function (e) {

            e.preventDefault();
            attributes = []; // reset
            $('.products-div').html("");
            $('input[name="attribute_value[]"]:checked').each(function()
            {
                attributes.push($(this).val());
            });
            $('#loading').toggle();
            $.get('/searchattributes', {attributes: attributes,category:'<?php if(isset($_GET['cat_id'])){ echo $_GET['cat_id'];}else { echo "";}?>',subcategory:'<?php if(isset($_GET['subcategory'])){ echo $_GET['subcategory'];}else { echo "";}?>',fromprice:$('#fromprice').val(),
                toprice:$('#toprice').val(),
                subsub:'<?php if(isset($_GET['subsub'])){ echo $_GET['subsub'];}else { echo "";}?>'

            }, function(markup)
            {
                $('#loading').toggle();
                $('.products-div').html(markup);
            });

        });

    });
</script>
<script>
    $(document).ready(function(){
        var attributes = [];
        $('#default-filter').on('change','#fromprice,#toprice',function(){
            attributes = []; // reset

            $('#loading').toggle();
            $('input[name="attribute_value[]"]:checked').each(function()
            {
                attributes.push($(this).val());
            });
            $.get('/searchattributes', {attributes: attributes,category:'<?php if(isset($_GET['cat_id'])){ echo $_GET['cat_id'];}else { echo "";}?>',subcategory:'<?php if(isset($_GET['subcategory'])){ echo $_GET['subcategory'];}else { echo "";}?>',fromprice:$('#fromprice').val(),
                toprice:$('#toprice').val(),
                subsub:'<?php if(isset($_GET['subsub'])){ echo $_GET['subsub'];}else { echo "";}?>'

            }, function(markup)
            {
                $('#loading').toggle();
                $('.products-div').html(markup);
            });
        })

    })

    $(document).ready(function(){
        var attributes = [];
        $('#default-filter1').on('change','#frompricehome,#topricehome',function(){
            attributes = []; // reset

            $('#loading').toggle();
            $('input[name="attribute_value[]"]:checked').each(function()
            {
                attributes.push($(this).val());
            });
            $.get('/myshop', {attributes: attributes,category:'<?php if(isset($_GET['cat_id'])){ echo $_GET['cat_id'];}else { echo "";}?>',subcategory:'<?php if(isset($_GET['subcategory'])){ echo $_GET['subcategory'];}else { echo "";}?>',fromprice:$('#frompricehome').val(),
                toprice:$('#topricehome').val(),
                subsub:'<?php if(isset($_GET['subsub'])){ echo $_GET['subsub'];}else { echo "";}?>'

            }, function(markup)
            {
                $('#loading').toggle();
                $('.products-div').html(markup);
            });
        });
    })
    function clearfield()
    {
        document.getElementById('frompricehome').value= " " ;

    }


</script>
<script>
    $(document).on('change', '#sub-cat', function () {
        var type = $(this).find(':selected').val();
        var token = $('#token').val();
        $.ajax({
            url: "/ajax1",
            type: "POST",
            data: {'_token': token, 'type': type},
            success: function (data) {
                var html = '';
                html +='<option>Please select sub sub category</option>';
                $.each(data, function (id, name) {
                    html += '<option value="' + id + '">' + name + '</option>';
                });
                $('#subsubcat').html(html);
            }, error: function () {
                alert("error!!!!");
            }

        });
    })
</script>

<script>
    $(document).ready(function(){
        $('#add-adress-product').toggle();
        $('.address-close').toggle();
        $('.show-another-adress').click(function(e) {
            e.preventDefault();
            $('#add-adress-product').toggle('slow');
            $('.address-close').toggle();
            $('.address-open').toggle();
        })
    })
</script>
<script>
$(document).ready(function(){
    $('#order-create').toggle();
    $('#show-offer-create').click(function(e){
        $(this).addClass('selected_category');
        e.preventDefault();
        $('#order-create').toggle('slow');
    })
})
</script>


<script>
    $(document).ready(function(){
        $('#fileuploadorder').hide();
        $('#txtvideo').hide();
        $('#show-photo-upload').click(function(){

            $(this).attr('checked', true);
            $('#fileuploadorder').show();
            $('#txtvideo').hide();

        })
        $('#show-video-upload').click(function(){

            $(this).attr('checked', true);
            $('#fileuploadorder').hide();
            $('#txtvideo').show();

        })
    })

</script>


<style>
 #fileuploadorder{
     width: 200px;
     height: 20px;
     margin-top: 20px;
 }
</style>

<script src="{{ asset('/js/jquery.fancybox.js') }}"></script>

<script src="{{ asset('/js/jssor.slider.mini.js') }}"></script>

<script src="{{ asset('/js/custom.js') }}"></script>
<script src="{{ asset('/js/review.js') }}"></script>
<link  media="screen" rel="stylesheet" href="{{ asset('/css/jquery.fancybox.css') }}">

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
