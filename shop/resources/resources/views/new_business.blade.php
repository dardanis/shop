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
    <link href="{{ asset('/css/style-responsive.css') }}" rel="stylesheet" />

    @yield('style')
  </head>
  <body>
  <section id="container" >
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Collapse"></div>
              </div>
            <a href="{{ url('/') }}" class="logo">Shop</a>
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
<!--                             <img alt="" src="img/avatar1_small.jpg"> -->
                            <span class="username">{{Auth::user()->name}}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="{{ url('profile') }}"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="{{ url('logout') }}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
      <!--sidebar start-->
      <aside>

          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="{{Active::route('b_myaccount', 'active')}}" href="{{ url('business/dashboard') }}">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a class="{{Active::route(array('business_products', 'business_products_add'), 'active')}}" href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>My Products</span>
                      </a>
                      <ul class="sub">
                          <li class="{{Active::route('business_products', 'active')}}"><a  href="{{ url('business/b_products') }}">All products</a></li>
                          <li class="{{Active::route('business_products_add', 'active')}}"><a  href="{{ url('business/add/product') }}">Add product</a></li>
                      </ul>
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
    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script class="include" src="{{ asset('/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('/js/jquery.customSelect.min.js') }}" ></script>
    <script src="{{ asset('/js/respond.min.js') }}" ></script>
    <script src="{{ asset('/js/common-scripts.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete" async defer></script>
  <script>
      $(function(){
          $('select.styled').customSelect();
      });
  </script>
  <script src="{{ asset('/js/photopreview.js') }}"></script>
  <script>
    $(function() {
        $('#locale').change(function() {
            this.form.submit();
        });
    });
  </script>
    <script type="text/javascript">
        $(document).on('change', '#first', function () {
        var first = $(this).find(':selected').val();
        var token=$('#token').val();
           $.ajax({
                url: "/ajax",
                type:"POST",
                data: {'_token':token,'first': first },
                success:function(data){
                    var html = '';
                   $.each(data, function (id, name) {
                       html += '<option value="'+id+'">' + name + '</option>';
                   });
                    $('#second').html(html);
                },error:function(){ 
                    alert("error!!!!");
                }
            });
        });
    </script>
  @yield('scripts')
  </body>
</html>
