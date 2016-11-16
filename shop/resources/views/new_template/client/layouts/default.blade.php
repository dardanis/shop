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

<script src="{{ asset('/js/libs/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('/js/libs/jquery-ui-1.10.4.custom.min.js') }}"></script>
<script src="{{ asset('/js/libs/jquery.easing.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('/js/dropzone.js') }}"></script>
<script src="{{ asset('/js/upload.js') }}"></script>
<script src="{{ asset('/js/review.js ') }}"></script>
<script src="{{ asset('/js/photopreview.js ') }}"></script>

</body>
</html>
<?php $detect = new Mobile_Detect;?>
<?php if($detect->isMobile() || $detect->isTablet()){?>
<style>
    header{
        height: 450px;
    }
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
        padding-top: 20px;
    }
</style>
<?php } else {?>
    <style>
        .navbar-header{
        height:10px;
        }
         header{
             height: 209px;
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
            padding-top: 20px;
        }
    </style>
<?php } ?>

<style>
    header form{
        margin:0px;
    }
</style>


<script>
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
