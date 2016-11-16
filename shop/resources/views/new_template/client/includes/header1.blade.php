   <!--Header-->
    <header data-offset-top="500" data-stuck="600"><!--data-offset-top is when header converts to small variant and data-stuck when it becomes visible. Values in px represent position of scroll from top. Make sure there is at least 100px between those two values for smooth animation-->


    <!--Search Form-->
        <form action="/" method="get" class="search-form closed" autocomplete="off" role="search">
            <?php
            $cat = \App\Category::all();?>

            <div class="container">

                <div class="col-md-3">

                    <div class="form-group">
                        <label class="sr-only" for="search-hd">{{ Lang::get('app.Search for procuct') }}</label>
                        <input type="text" class="form-control" name="search" id="search-hd" placeholder="{{ Lang::get('app.Search for procuct') }}">
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="col-lg-10">
                        <select class="form-control" name="category">
                            <option value="">All categories</option>
                            <?php foreach($cat as $c){?>
                            <option style="background:#D2D8DB;"value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
                            <?php }?>
                        </select>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-lg-10">
                        <select class="form-control" name="location">
                            <option value="">Location</option>

                        </select>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-lg-10">
                        <select class="form-control" name="location">
                            <option value="">Km</option>

                        </select>

                    </div>
                </div>
                <button type="submit"><i class="icon-magnifier"></i></button>
                <div class="close-search"><i class="icon-delete" style="color:white !important"></i></div>

            </div>
        </form>


        <!--Split Background-->
        <div class="left-bg"></div>
        <div class="right-bg"></div>

        <div class="container">

            <a class="logo" href="{{ url('/') }}" id="logo">LOGO Here</a>
        <!--Mobile Menu Toggle-->
        <div class="menu-toggle"><i class="fa fa-list"></i></div>
        <div class="mobile-border"><span></span></div>

        <!--Main Menu-->
        <nav class="menu">

          <ul class="main">
          <li style="padding:10px;"><a href="#"></a></li>
          </ul>

          <ul class="catalog">

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

              <?php if(sizeof($cat)>0){?>
              <li   class="has-submenu" id="{{Active::pattern($t->name, 'current-page')}}"><a href="#"><span>{{ Lang::get("app.$t->name")}}</span> </a>
                  <ul class="submenu">
                      <?php foreach($cat as $ct){?>
                          <?php $cat_id=$ct->id;?>
                      <?php  $produ=\App\Product::whereHas('translations', function($q) use ($cat_id)
                      {
                          $q->where('category_id', '=', $cat_id);

                      })->get();?>
                      <?php if(sizeof($produ)>0){?>
                      <li  id="{{Active::pattern($ct->name, 'current-page')}}"><a href="{{url("$ct->slug")}}"><span>{{ Lang::get("app.$ct->name")}}</span> </a>
                          <?php } ?>
                      <?php } ?>
                  </ul>
              </li>
              <?php } else {?>
              <li  id="{{Active::pattern($t->name, 'current-page')}}"><a href="#"><span>{{ Lang::get("app.$t->name")}}</span> </a></li>
              <?php } ?>

              <?php  }?>
          </ul>
        </nav>

        <!--Toolbar-->
        <div class="toolbar group">

                <form action="{{URL::route('language-chooser')}}" method="post" style="margin-top: -14px;margin-bottom: 2px;">

                    <select id="locale" name="locale" class="language-select form-control" style="Width:150px;margin-left:11px;padding:0px;border:0px solid white;color:white;background:#D2D8DB">
                        <option value="en">En</option>
                        <option value="de" {{ Lang::locale()==='de'? ' selected':''}}>De</option>
                        <option value="fr" {{ Lang::locale()==='fr'? ' selected':''}}>Fr</option>
                    </select>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>

          <button class="search-btn btn-outlined-invert"><i class="icon-magnifier"></i></button>

          <div class="middle-btns">
              @if (Auth::guest())
                  <a class="login-btn btn-outlined-invert" href="{{ url('login') }}" style="margin-top: 0px;" > <span>{{ Lang::get("app.Login")}}</span></a>
                  <a class="btn-outlined-invert" href='{{ URL::to("/newsfeed") }}'><span>{{Lang::get('app.Newsfeed')}}</span></a>


                  <a class="btn-outlined-invert" href="{{ url('wishlist') }}"><span>{{ Lang::get("app.Wishlist")}}</span></a>
              @else

                <a class="btn-outlined-invert" href='{{ URL::to("/newsfeed") }}'><span>{{Lang::get('app.Newsfeed')}}</span></a>


              <a class="btn-outlined-invert" href="{{ url('wishlist') }}"><span>{{ Lang::get("app.Wishlist")}}</span></a>
              <div class="loged_dropdown ">
                  <a href="#" class="btn-outlined-invert"  style="margin-left:0px;">{{ Auth::user()->name }}</a>
                  <ul>

                      @if(Auth::user()->role_id==1)
                          <li><a  style="" href="{{ url('admin/dashboard') }}">{{Lang::get('app.Dashboard')}}</a></li>
                      @endif
                      @if(Auth::user()->role_id!=1)
                          <li><a style="" href="{{ route('myprofile') }}">{{Lang::get('app.My Account')}}</a></li>
                          <li><a style="" href="{{ url('viewprofile') }}">{{Lang::get('app.My Profile')}}</a></li>
                          <li><a style="" href="{{ route('mydashboard') }}">{{ Lang::get('app.Dashboard')}}</a></li>
                      @else
                          <li><a style="" href="{{ route('admin_profile') }}">{{Lang::get('app.My Account')}}</a></li>
                      @endif

                      <li><a style="" href="{{ route('myoders') }}">{{Lang::get('app.My Orders')}}</a></li>

                      <li><a style="" href="{{ url('logout') }}">{{trans('app.logout')}}</a></li>

                  </ul>
                  @endif
              </div>



          </div>
            @if (!Auth::guest())
          <div class="cart-btn">
              <a class="btn btn-outlined-invert" href="{{ url('cart') }}"><i class="icon-shopping-cart-content"></i><span><?php echo count(Cart::getContent());?></span></a>

            <!--Cart Dropdown-->
              <div class="cart-dropdown">
                  <span></span><!--Small rectangle to overlap Cart button-->
                  <div class="body">
                      <table>
                          <tr>
                              <th>{{ Lang::get('app.Items') }}</th>
                              <th>{{ Lang::get('app.Quantity') }}</th>
                              <th>{{ Lang::get('app.Price') }}</th>
                          </tr>
                          @foreach(Cart::getContent() as $product)
                              <?php $prod = \App\Product::where('id', '=', $product->id)->get();?>
                              <?php foreach($prod as $prodid){?>
                            <?php $slug_prod=$prodid->slug;?>
                                    <?php }?>
                              <tr class="item">

                                  {!! Form::open(array('method' => 'DELETE', 'route' => array('cart.delete', $product->id))) !!}
                                  <td><button class="btn-delete"><i class="icon-delete"></i></button>{{$product->name}}</td>
                                  {!! Form::close() !!}
                                  <td><input type="text" value="<?php echo $product->quantity;?>"></td>
                                  <td class="price">CHF {{ $product->price }}</td>
                              </tr>
                          @endforeach
                      </table>
                  </div>
                  <div class="footer group">
                      <div class="buttons">
                          {!! Form::open(array('route' => 'checkout','files'=>true,'class'=>'form-horizontal tasi-form','data-parsley-validate')) !!}

                          <input type="hidden" id="token" value="{{ csrf_token() }}">

                          <script
                                  src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                  data-key="pk_test_Lk0vCk42DUQFsEXczhSJzEFA"
                                  data-amount="{{Cart::getSubTotal()*100}}"
                                  data-name="SHOP"
                                  data-description="Products"

                                  data-locale="auto">
                          </script>

                          {!! Form::close() !!}


                      </div>
                      <div class="total">CHF {!! Cart::getTotal()!!}</div>
                  </div>
              </div><!--Cart Dropdown Close-->
          </div>
        </div><!--Toolbar Close-->
            @endif
      </div>
    </header><!--Header Close-->
