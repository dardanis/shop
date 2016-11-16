<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Shop</title>

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-reset.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/style2.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style-responsive.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/demo_page.css') }}"/>
    <link href="{{ asset('/css/demo_table.css') }}"/>
    <link href="{{ asset('/css/DT_bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/colorpicker.css') }}">

    @yield('style')
</head>
<body>
<section id="container">
    <header class="header white-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Collapse"></div>
        </div>
        <a href="{{ url('/') }}" class="logo">LOGO HERE</a>

        <div class="top-nav ">
            <ul class="nav pull-right top-menu">
                <li>
                    <form action="{{URL::route('language-chooser')}}" method="post">
                        <select id="locale" name="locale" class="form-control input-sm m-bot15">
                            <option value="en">English</option>
                            <option value="de" {{ Lang::locale()==='de'? ' selected':''}}>German</option>
                            <option value="fr" {{ Lang::locale()==='fr'? ' selected':''}}>French</option>
                        </select>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" src="{{asset(Auth::user()->avatar)}}">
                        <span class="username">{{Auth::user()->name}}</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li><a href="{{ url('admin/profile') }}"><i
                                        class=" fa fa-suitcase"></i>{{trans('header.myprofile')}}</a></li>
                        <li><a href="{{ url('logout') }}"><i class="fa fa-key"></i>{{trans('header.logout')}}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <!--sidebar start-->
    <aside>

        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="{{Active::route('admin_dashboard', 'active')}}" href="{{ url('admin/dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{trans('shop.dashboard')}}</span>
                    </a>
                </li>



                <li class="sub-menu">
                    <a class="{{Active::route(array('admin_products', 'products_add'), 'active')}}" href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>{{trans('shop.products')}}</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Active::route('admin_products', 'active')}}"><a
                                    href="{{ url('admin/a_products') }}">{{trans('shop.all_products')}}</a></li>
                        <li class="{{Active::route('products_add', 'active')}}"><a
                                    href="{{ url('client/add/product') }}">{{trans('shop.add_product')}}</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="{{Active::route(array('categoriesindex', 'addcategory'), 'active')}}" href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>{{trans('shop.categories')}}</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Active::route('categoriesindex', 'active')}}"><a
                                    href="{{ url('admin/categories') }}">{{trans('shop.all_categories')}}</a></li>
                        <li class="{{Active::route('addcategory', 'active')}}"><a
                                    href="{{ url('admin/categories/add') }}">{{trans('shop.add_category')}}</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="{{Active::route(array('type_form', 'type_form'), 'active')}}" href="javascript:;">
                        <i class="fa fa-archive"></i>
                        <span>Product Type</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Active::route('typeindex', 'active')}}"><a
                                    href="{{ url('types/admin') }}">Types</a></li>
                        <li class="{{Active::route('type_form', 'active')}}"><a
                                    href="{{ url('types/add') }}">Create type</a>
                        </li>

                    </ul>
                </li>

                <li class="sub-menu">
                    <a class="{{Active::route(array('areas_create', 'areas_create'), 'active')}}" href="javascript:;">
                        <i class="fa fa-archive"></i>
                        <span>Ares</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Active::route('areaindex', 'active')}}"><a
                                    href="{{ url('area/admin') }}">Areas</a></li>
                        <li class="{{Active::route('areas_create', 'active')}}"><a
                                    href="{{ url('areas/add') }}">Create Area</a>
                        </li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="{{Active::route(array('users', 'create_users','client_users','business_users'), 'active')}}"
                       href="javascript:;">
                        <i class="fa fa-users"></i>
                        <span>{{trans('shop.users')}}</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Active::route('users', 'active')}}">

                        </li>
                        <li class="{{Active::route('business_users', 'active')}}"><a
                                    href="{{ url('admin/users/business') }}">{{trans('shop.business_users')}}</a></li>
                        <li class="{{Active::route('client_users', 'active')}}"><a
                                    href="{{ url('admin/users/clients') }}">{{trans('shop.client_users')}}</a></li>
                        <li class="{{Active::route('create_users', 'active')}}"><a
                                    href="{{ url('admin/users/add') }}">{{trans('shop.add_user')}}</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="{{Active::route(array('subscription_plans', 'plan_add'), 'active')}}" href="javascript:;">
                        <i class="fa fa-archive"></i>
                        <span>{{trans('shop.subscription_plans')}}</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Active::route('subscription_plans', 'active')}}"><a
                                    href="{{ url('admin/plans') }}">{{trans('shop.all_plans')}}</a></li>
                        <li class="{{Active::route('plan_add', 'active')}}"><a
                                    href="{{ url('admin/plans/add') }}">{{trans('shop.add_plan')}}</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="{{Active::route(array('translation_add', 'translation_add'), 'active')}}" href="javascript:;">
                        <i class="fa fa-archive"></i>
                        <span>Translations</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Active::route('translationindex', 'active')}}"><a
                                    href="{{ url('translation/admin') }}">All Translations</a></li>
                        <li class="{{Active::route('translation_add', 'active')}}"><a
                                    href="{{ url('translation/add') }}">Add Translation</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="{{Active::route(array('admin_ads'), 'active')}}" href="{{ url('admin/ads') }}">
                        <i class="fa fa-users"></i>
                        <span>Ads</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <section id="main-content">
        <section class="wrapper">
            @yield('content')
        </section>
    </section>
    <!--main content end-->
</section>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css">
<script src="{{ asset('/js/jquery.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/lang/en-gb.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/js/bootstrap-datetimepicker.min.js"></script>

<script class="include" src="{{ asset('/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('/js/jquery.customSelect.min.js') }}"></script>
<script src="{{ asset('/js/respond.min.js') }}"></script>
<script src="{{ asset('/js/common-scripts.js') }}"></script>
<script src="{{ asset('/js/colorpicker.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete" async defer></script>
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>

<script src="{{ asset('/js/dropzone.js') }}"></script>
<script src="{{ asset('/js/upload.js') }}"></script>

<script>
    $(function () {
        $('#header_color, #background_color, #text_color').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                $(el).val(hex);
                $(el).ColorPickerHide();
            },
            onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
            }
        })
                .bind('keyup', function(){
                    $(this).ColorPickerSetColor(this.value);
                });
        $('select.styled').customSelect();
    });
</script>
<script src="{{ asset('/js/photopreview.js') }}"></script>
<script>
    $(function () {
        $('#locale').change(function () {
            this.form.submit();
        });
    });

    $('#datepicker').datetimepicker();


    $(function () {
        refreshTable();
    });
    function refreshTable() {
        $('#online_users').load('dashboard' + ' #online_users', function () {
            setTimeout(refreshTable(), 1000);
        });
    }
</script>
<script type="text/javascript">
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

    tinymce.init({
        selector: '#mytextarea'
    });


    $("#data-type").on('change',function() {
        $list= $('option:selected', this).text();
        if($list=="list"){
            $('#list-attributes').show();
        }else {
            $('#list-attributes').hide();
        }
    })

    $("#btn-list-attributes").on('click',function () {
        var newTextBoxDiv = $(document.createElement('Div'))
                .attr("class", 'otheroptions');
        newTextBoxDiv.html('<div class="col-md-2 col-sm-2"></div><div class="col-md-3"><input type="text" class="form-control txtplus" placeholder="Enter Values" style="margin-top:10px" name="attribute_item[]"></div>');
        newTextBoxDiv.appendTo("#add-dynamic-items");


    });

    $('.btn-list-attributes_edit').click(function(){
        var clickedID = this.id;
        var newTextBoxDiv = $(document.createElement('Div'))
                .attr("class", 'otheroptions');
        newTextBoxDiv.html('<input type="hidden" name="edit_add_item[]" value="'+clickedID+'"/><div class="col-md-2 col-sm-2"></div><div class="col-md-3"><input type="text" class="form-control txtplus" placeholder="Enter Values" style="margin-top:10px" name="attribute_item_'+clickedID+'[]"></div>');
        newTextBoxDiv.appendTo("#add-dynamic-items_edit_"+clickedID);
    });
</script>
@yield('scripts')
</body>
</html>
