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
    <link href="{{ asset('/css/dropzone.css') }}" rel="stylesheet"/>
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
                        <li><a href="{{ url('profile') }}"><i class=" fa fa-suitcase"></i>{{trans('header.myprofile')}}
                            </a></li>
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
                    <a class="{{Active::route('myaccount', 'active')}}" href="{{ url('client/dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{trans('shop.dashboard')}}</span>
                    </a>
                </li>


                <li class="sub-menu">
                    <a class="{{Active::route(array('client_products', 'products_add'), 'active')}}"
                       href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>{{trans('shop.my_products')}}</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Active::route('client_products', 'active')}}"><a
                                    href="{{ url('client/c_products') }}">{{trans('shop.all_products')}}</a></li>
                        <li class="{{Active::route('products_add', 'active')}}"><a
                                    href="{{ url('client/add/product') }}">{{trans('shop.add_product')}}</a></li>
                    </ul>
                </li>
                @if(auth()->user()->stripe_active==0)
                    <li>
                        <a class="{{Active::route('account_type', 'active')}}" href="{{ url('client/account') }}">
                            <i class="fa fa-user"></i>
                            <span>{{trans('shop.upgrade')}}</span>
                        </a>
                    </li>
                @endif
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
<script src="{{ asset('/js/jquery.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script class="include" src="{{ asset('/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('/js/jquery.customSelect.min.js') }}"></script>
<script src="{{ asset('/js/respond.min.js') }}"></script>
<script src="{{ asset('/js/common-scripts.js') }}"></script>
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>


<script>
    $(function () {
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

</script>


@yield('scripts')
</body>
</html>
