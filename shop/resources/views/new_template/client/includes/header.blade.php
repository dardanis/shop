<script src="{{ asset('/js/libs/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('/js/libs/jquery-ui-1.10.4.custom.min.js') }}"></script>
<script src="{{ asset('/js/libs/jquery.easing.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
    <!-- search and user menu -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
    </div>


        <div class="row" style="padding-top: 10px;">
            <div class="container">
                <div class="main-content">
                    <div class="language" style="">

                        <div class="lang">

                            <form action="{{URL::route('language-chooser')}}" method="post">

                                <ul class="langlist">
                                    <li><input type="submit" value="en" name="locale"  class="btn-lang en-lng"/></li>
                                    <li><input type="submit" value="de" name="locale" class="btn-lang de-lng"/></li>
                                    <li><input type="submit" value="fr" name="locale" class="btn-lang fr-lng"/></li>
                                </ul>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>
                    </div>
                    <div class="under-lang">
            <div class="col-md-2 logo-div">
                <h2 class="logo">
                    <a class="logo" href="{{ url('/') }}" id="logo">LOGO HERE</a>
                </h2>
            </div>
            <!-- search by category -->
            <form action="/" method="get">
                <div class="col-md-4  col-sm-12 col-xs-12 search-div">
                    <div class="col-md-12 searchcategory">
                        <div class="form-group">
                            <span class="bold-11">Keyword</span><br>
                            <input type="text" class="form-control seach-keyword" placeholder="keyword">

                            <select class="form-control seach-category">
                                <option selected="">Auto</option>
                                <option>Technology</option>
                                <option>Clothes</option>
                            </select>

                            <button type="button" class="btn btn-default btn-search">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>

                </div>
                <!-- end of search by category -->
                <div class="col-md-3 col-sm-12 col-xs-12 searchdistance">
                    <div class="col-md-12 searchcategory">
                        <div class="form-group">
                            <span class="bold-11">Distance and location</span><br>
                            <input type="text" class="form-control seach-location">

                            <select class="form-control seach-distance">
                                <option selected="">10km</option>
                                <option>20km</option>
                                <option>30km</option>
                            </select>

                            <button type="button" class="btn btn-default btn-location">
                                <span class="glyphicon glyphicon-map-marker"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <?php if (Auth::guest()){?>
            <div class="col-md-3 col-sm-12 col-xs-12 usernav">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span><br>
                    <a class="bold-11" href='{{ URL::to("/newsfeed") }}'><span>{{Lang::get('app.Newsfeed')}}</span></a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 ">
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span><br>
                    <a class="bold-11" href="{{ url('wishlist') }}"><span>{{ Lang::get("app.Wishlist")}}</span></a>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-4">
                    <a class="bold-11" href="{{ url('login') }}" style="margin-top: 0px;" >
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span><br>
                     <span>{{ Lang::get("app.Login")}}</span></a>

                </div>
            </div>
            <?php } else if(Auth::user()->role_id==1){?>


            <div class="col-md-3 col-sm-12 col-xs-12 usernav">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span><br>
                    <a class="bold-11" href='{{ URL::to("/newsfeed") }}'><span>{{Lang::get('app.Newsfeed')}}</span></a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 ">
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span><br>
                    <a class="bold-11" href="{{ url('wishlist') }}"><span>{{ Lang::get("app.Wishlist")}}</span></a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#"  style="padding: 0px;"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" style="color:#E28D33"></span></a>
                        <ul class="dropdown-menu">
                            <li><a style="" href="{{ route('myprofile') }}">{{Lang::get('app.My Account')}}</a></li>
                            <li> <a style="" href="{{ url('viewprofile') }}">{{Lang::get('app.My Profile')}}</a></li>
                            <li><a  style="" href="{{ url('admin/dashboard') }}">{{Lang::get('app.Dashboard')}}</a></li>
                            <li> <a style="" href="{{ route('myoders') }}">{{Lang::get('app.My Orders')}}</a></li>
                            <li> <a style="" href="{{ url('logout') }}">{{trans('app.logout')}}</a></li>

                        </ul>
                        <a class="bold-11" href="#" style="margin: 0px;color: black;padding: 0px;"><span style="    font-size: 12px;">{{ Auth::user()->username}}</span></a>
                    </li>

                </ul>

            </div>

            <?php } else if(Auth::user()->role_id!=1){?>
            <div class="col-md-3 col-sm-12 col-xs-12 usernav">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <a class="bold-11" href='{{ URL::to("/newsfeed") }}'>
                    <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span><br>
                   <span>{{Lang::get('app.Newsfeed')}}</span></a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 ">
                    <a class="bold-11" href="{{ url('wishlist') }}">
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span><br>
                    <span>{{ Lang::get("app.Wishlist")}}</span></a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#"  style="padding: 0px;"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" style="color:#E28D33"></span></a>
                        <ul class="dropdown-menu">
                            <li><a style="" href="{{ route('myprofile') }}">{{Lang::get('app.My Account')}}</a></li>
                            <li> <a style="" href="{{ url('viewprofile') }}">{{Lang::get('app.My Profile')}}</a></li>
                            <li> <a style="" href="{{ route('mydashboard') }}">{{ Lang::get('app.Dashboard')}}</a></li>
                            <li> <a style="" href="{{ route('myoders') }}">{{Lang::get('app.My Orders')}}</a></li>
                            <li> <a style="" href="{{ url('logout') }}">{{trans('app.logout')}}</a></li>

                        </ul>
                        <a class="bold-11" href="#" style="margin: 0px;color: black;padding: 0px;"><span style="    font-size: 12px;">{{ Auth::user()->username}}</span></a>
                    </li>

                </ul>

            </div>

            <?php }?>
                        </div>
                </div>
                </div>
        </div>
        <style>
        .orange{
            color:orange;
        }
        </style>
        <!-- Brand and toggle get grouped for better mobile display -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">



                <ul class="nav navbar-nav">
                    <?php $type = \Illuminate\Support\Facades\DB::table('product_types')
                            ->orderBy('sort_order', 'asc')
                            ->get();?>
                    <?php foreach($type as $t){?>
                    <?php
                    $type_id=$t->id;
                    $cat=\App\Category::whereHas('translations', function($q) use ($type_id)
                    {
                        $q->where('type_id','=',$type_id);

                    })->get();?>

                             
                    <?php if($t->alias=="shop"){?>
                        <li id="{{Active::pattern($t->name, 'current-page')}}"><a href="{{ route('shophome') }}" class="home-menu"><span>{{ Lang::get("app.$t->name")}}</span> </a> </li>
                        <?php } ?>
                        <?php if($t->alias=="event"){?>
                        <li id="{{Active::pattern($t->name, 'current-page')}}"><a href="{{ route('eventshome') }}"><span>{{ Lang::get("app.$t->name")}}</span> </a> </li>
                        <?php } ?>
                        <?php if($t->alias=="travel"){?>
                        <li id="{{Active::pattern($t->name, 'current-page')}}"><a href="{{ route('travelhome') }}"><span>{{ Lang::get("app.$t->name")}}</span> </a> </li>
                        <?php } ?>
                          <?php if($t->alias=="magazine"){?>
                        <li id="{{Active::pattern($t->name, 'current-page')}}"><a href="{{ route('magazinehome') }}"><span>{{ Lang::get("app.$t->name")}}</span> </a> </li>
                        <?php } ?>
                      

                    <?php  }?>
                </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<?php if(Lang::locale()==='de'){?>
<style>
    .de-lng{
        color:#E28D33;
    }
</style>
<?php }?>
<?php if(Lang::locale()==='en'){?>
<style>
    .en-lng{
        color:#E28D33;
    }
</style>
<?php }?>
<?php if(Lang::locale()==='fr'){?>
<style>
    .fr-lng{
        color:#E28D33;
    }
</style>
<?php }?>
<style>
.orange{
    color:#E28D33 !important;
}
</style>
 <script>
$(document).ready(function(){
  var checkUrlmenu = function () {

         var found = false;
        $(".navbar-collapse ul li a").each(function () {

            var href = $(this).attr("href");

            if (window.location.href.indexOf(href) > -1 && !found) {
                console.log("found it");
                $(this).addClass("orange");
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

      var checktoplinks = function () {

         var found = false;
        $(".user-profile-top ul li a").each(function () {

            var href = $(this).attr("href");

            if (window.location.href.indexOf(href) > -1 && !found) {
                console.log("found it");
                $(this).addClass("orange");
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

    
        checktoplinks();
      checkUrlmenu();
})
</script>