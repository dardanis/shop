<!DOCTYPE html>
<html lang="en">
<head>
    @include('new_template.client.includes.head')
</head>
<body class="cms-index-index cms-home-page">
<header>
    @include('new_template.client.includes.header')
</header>

<div class="container">
<div class="page-content" style="margin-bottom:0px;">

        <div class="row ">

            <div class="col-md-12 col-xs-12">
                <ul class="dashboard-link-list" style="padding-left:0px ">
                    <li style="float:left"><a href="{{ route('myprofile') }}" title="My Profile"><i class="fa fa-user"></i><span>{{ Lang::get('app.My Profile') }}</span></a></li>
                    <li style="float:left"><a href="{{ url('client/c_products') }}" title="My Products"><i class="fa fa-list"></i><span>{{ Lang::get('app.My Products') }}</span></a></li>
                    <li style="float:left"><a href="{{ url('alladresess') }}" title="My Adressess"><i class="fa fa-list"></i><span>{{ Lang::get('app.My Adresses') }}</span></a></li>
                    <li style="float:left"><a href="{{ url('client/add/product') }}" title="Add Product"><i class="fa fa-plus"></i><span>{{ Lang::get('app.Add Product') }}</span></a></li>

                </ul>
            </div>
        </div>
    </div>
</div>

@yield('content')
<style>

    .profile-image-box a{
        display:block;


    }
    .profile-image-box{
        border:1px solid #dedede;
        padding:20px;
        margin:30px 20px;;
    }
    .profile-image-box a img{
        min-hegiht:200px
    }
    ul.dashboard-link-list{
        margin-top:30px;
    }
    ul.dashboard-link-list li {
        overflow: hidden;
        padding-bottom: 10px;
    }

    ul.dashboard-link-list li a {
        display: block;
        overflow: hidden;
        font: 600 16px/20px "Open Sans", sans-serif;
        color: #555454;
        text-shadow: 0px 1px white;
        text-transform: uppercase;
        text-decoration: none;
        position: relative;
        border: 1px solid;
        border-color: #cacaca #b7b7b7 #9a9a9a #b7b7b7;
        background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgi�pZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiIC8+PC9zdmc+IA==');
        background-size: 100%;
        background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #f7f7f7), color-stop(100%, #ededed));
        background-image: -moz-linear-gradient(#f7f7f7, #ededed);
        background-image: -webkit-linear-gradient(#f7f7f7, #ededed);
        background-image: linear-gradient(#f7f7f7, #ededed);
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
    }

    ul.dashboard-link-list li a i {
        font-size: 25px;
        color:#2ba8db;
        position: absolute;
        left: 0;
        top: 0;
        width: 52px;
        height: 100%;
        padding: 10px 0 0 0;
        text-align: center;
        border: 1px solid #fff;
        -moz-border-radius-topleft: 4px;
        -webkit-border-top-left-radius: 4px;
        border-top-left-radius: 4px;
        -moz-border-radius-bottomleft: 4px;
        -webkit-border-bottom-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    ul.dashboard-link-list li a span {
        display: block;
        padding: 13px 15px 15px 17px;
        overflow: hidden;
        border: 1px solid;
        margin-left: 52px;
        border-color: #fff #fff #fff #c8c8c8;
        -moz-border-radius-topright: 5px;
        -webkit-border-top-right-radius: 5px;
        border-top-right-radius: 5px;
        -moz-border-radius-bottomright: 5px;
        -webkit-border-bottom-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

</style>

<script src="{{ asset('/js/photopreview.js') }}"></script>
<script src="{{ asset('/js/libs/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('/js/libs/jquery-ui-1.10.4.custom.min.js') }}"></script>
<script src="{{ asset('/js/libs/jquery.easing.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('/js/pluginstheme/smoothscroll.js') }}"></script>
<script src="{{ asset('/js/pluginstheme/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/js/pluginstheme/icheck.min.js') }}"></script>
<script src="{{ asset('/js/pluginstheme/jquery.placeholder.js') }}"></script>
<script src="{{ asset('/js/pluginstheme/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('/js/pluginstheme/jquery.touchSwipe.min.js') }}"></script>
<script src="{{ asset('/js/pluginstheme/jquery.shuffle.min.js') }}"></script>
<script src="{{ asset('/js/pluginstheme/lightGallery.min.js') }}"></script>
<script src="{{ asset('/js/pluginstheme/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/js/pluginstheme/masterslider.min.js') }}"></script>
<script src="{{ asset('/mailer/mailer.js') }}"></script>
<script src="{{ asset('/js/scripts.js ') }}"></script>
<script>

    $(document).ready(function(){
        $('.form_datetime').datetimepicker({
            //language:  'fr',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });

        var checkUrl=function()
        {  var found=false;
            $(".step-tab").each(function(){
                var href=$(this).attr("href");
                var url=window.location.href;
                url=url.replace('add-room','room');
                url=url.replace('edit-room','room');
                url=url.replace('manage-price','price');
                if (url.indexOf(href) > -1 && !found) {
                    //  console.log("found it");
                    $(this).addClass("activestep");
                    //$(this).closest(".parent").addClass("active");
                    found=true;
                }
                else{//console.log("notFound")
                }
            })
            if(found==false)
            {
                $(".start").addClass("activestep");
            }

        }
        checkUrl();
        $(".disabled-menu .step-tab").removeAttr("onclick");
        $(".disabled-menu .step-tab").removeAttr("href");
        $(".disabled-menu ").removeAttr("onclick");
        $(".disabled-menu").removeAttr("href");
        $(".disabled-menu").on("click",function(){
            $("#upgrade").modal("show");
        })


        $("button[type=\"submit\"]").on("click",function(){
            setTimeout(function(){

                if($("form").find('.has-error').length)
                {
                    $("#error-modal").modal("show");
                }

            }, 400);

        })


        var checkUrl=function()
        {  var found=false;
            $("#top-navbar-collapse ul li a").each(function(){
                var href=$(this).attr("href");
                if (window.location.href.indexOf(href) > -1 && !found) {
                    //  console.log("found it");
                    if(!$(this).parent().hasClass("start"))
                    {
                        $(this).parent() . addClass("activeMenu");
                        //$(this).closest(".parent").addClass("active");
                        found = true;
                    }
                }
                else{//console.log("notFound")
                }
            })
            if(found==false)
            {
                $(".start").addClass("activeMenu");
            }

        }
        checkUrl();
    })
</script>


<!-- include js files -->








@yield('scripts')
</body>
</html>

<script>



    $(function () {
        $('#locale').change(function () {
            this.form.submit();
        });
    });


    $(document).on('change', '#type-scratch', function () {
        var type = $(this).find(':selected').val();
        var token = $('#token').val();
        $.ajax({
            url: "/ajax1",
            type: "POST",
            data: {'_token': token, 'type': type},
            success: function (data) {
                var html = '';
                html +='<option>Please Select one category</option>';
                $.each(data, function (id, name) {
                    html += '<option value="' + id + '">' + name + '</option>';
                });
                $('#first-scratch').html(html);
            }, error: function () {
                alert("error!!!!");
            }

        });
    })
    $(document).on('change', '#first-scratch', function () {
        var first = $(this).find(':selected').val();
        var token = $('#token').val();
        $.ajax({
            url: "/ajax",
            type: "POST",
            data: {'_token': token, 'first': first},
            success: function (data) {
                var html = '';

                $.each(data, function (id, name) {
                    html += '<option value="' + id + '">' + name + '</option>';
                });
                $('#second-scratch').html(html);
            }, error: function () {
                alert("error!!!!");
            }
        });

    });
    $(document).on('change', '#first', function () {
        var first = $(this).find(':selected').val();
        var token = $('#token').val();
        $.ajax({
            url: "/ajax",
            type: "POST",
            data: {'_token': token, 'first': first},
            success: function (data) {
                var html = '';

                $.each(data, function (id, name) {
                    html += '<option value="' + id + '">' + name + '</option>';
                });
                $('#second').html(html);
            }, error: function () {
                alert("error!!!!");
            }
        });

    });

    $(document).on('click','#btn-findproducts',function(event){

        $('#getproducts').empty();
        $("#loading").show();
        $('#getproducts').append(" <h2>{{ Lang::get('app.Found products') }}</h2>");

            event.preventDefault();
            var subcategoryid= $('#second').find(':selected').val();
            $.ajax({
                url: "{{ url('ajaxfindproduct') }}",
                type: "get",
                data: {subcategoryid:subcategoryid},
                dataType: "json",
                success: function(data)
                {
                    // alert( data["data"][0]["id"] );
                    $.each(data,function(index,val)
                    {

                        $('#getproducts').append("<a href='/products/"+val.slug+"/"+val.id+"?template=usetemplate' id='"+val.id+"' class='ajax-product'><div style='border:1px solid #ABAEB2;padding:10px;margin-bottom:10px;height:200px;'><div class='product-image'><img style='width:100px;height:100px' src=/"+val.thumbnail+"/></div><div class='stickit col-lg-12' id='"+val.id+"'><div class='description' style='word-break: break-all'>"+val.teaser+"</div></div></div></a>");
                        $("#loading").hide();
                    })
                    $('.ajax-product').on('click',function()
                    {
                        $.ajax({
                            url: "{{ url('getproductajax') }}",
                            type: "get",
                            contentType:'multipart/form-data',
                            data: {prodid: $(this).prop('id')},
                            dataType: "json",
                            success: function (data) {

                                $.each(data,function(index,val)
                                {
                                    var input="";
                                    $('#title').val(val.title);

                                    var formData = new FormData();
                                    formData.append('file', $('#imgfile')[0].files["http://localhost:5555/img/products/1456680377.jpg"]);


                                    //$('body#tinymce').text(val.description);
                                    tinyMCE.activeEditor.setContent(val.description);
                                    $('#price').val(val.price);

                                })
                            }
                        })

                    })
                }
            })

    })

    $('#marke').on('change',function(){
        var attributeitem= $(this).find(':selected').val();

        $.ajax({
            url: "{{ url('ajaxfindattributeitem') }}",
            type: "get",
            data: {attributeitem:attributeitem},
            dataType: "json",
            success: function (data) {
                var html = '';
                html +='<option>Please Select one item</option>';
                $.each(data, function (id, item_value) {
                    html += '<option value="' + item_value + '">' + item_value + '</option>';
                });
                $('#model').html(html);
            }, error: function () {
                alert("error!!!!");
            }
        })
    })

</script>
