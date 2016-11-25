@include('new_template.client.layouts.default')
<div class="page-content">



    <section>
        <div class="container">

            <div class="row">
                <?php $count=0;?>
                @foreach($categories as $category)
                    <div class="category col-lg-2 col-md-2 col-sm-4 col-xs-6">

                        <a href="#" class="address-pin" data-toggle="tooltip" data-placement="top" title="Adresse">{{$category->name}}</a>
                        @foreach($category->subcategories->chunk(8) as $chunk)
                            <div class="addressArea">
                                @foreach($chunk as $sub)
                                    <a href="{{ URL::route('subcategory_show',array($category->slug,$sub->slug)) }}"><p>{{$sub->name}}</p>
                                    </a>
                                    @endforeach     <!--  end adress -->
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div>
        </div>
    </section><!--Categories Close-->
    <script>
        $(document).ready(function() {


            $('.cat-tiles').on('click', 'a.address-pin', function () {
                $(this).parent().find(".addressArea").toggle("show");
                console.log("clicked");
                return false;
            });
        })
    </script>

    <!--Catalog Grid-->
    <section class="catalog-grid">

        <div class="container">

            <h2 class="primary-color">Products</h2>
            <div class="toolbar">
                <div class="sorter" style="margin-top: 20px">
                    <div class="view-mode">
                        <span title="Grid" id="grid-button" class="button button-active button-grid first">{{trans('shop.grid')}}</span>
                        <span title="List" id="list-button" class="button button-list last">{{trans('shop.list')}}</span>
                        <input type="hidden" value="grid" id="viewtype">
                    </div>
                    <div id="sort-by">
                        <form>
                            <label>{{trans('shop.sortby')}}: </label>
                            <select name="sortby" class="select_style" id="filter-form">
                                <option value="desc" selected>Latest</option>
                                <option value="asc">Ascending</option>
                                <option value="low">Low to high</option>
                                <option value="high">High to low</option>
                            </select>
                        </form>
                    </div>
                    <div class="pager">
                        <div id="limiter">
                            <form>
                                <label>{{trans('shop.view')}}: </label>
                                <select  class="select_style" name="perpage" id="filter-perpage">
                                    <option value="10" selected>10 per page</option>
                                    <option value="20">20 per page</option>
                                    <option value="30">30 per page</option>
                                </select>
                            </form>
                        </div>
                        <div class="pages">
                            @if ($products->lastPage() > 1)
                                <label>{{trans('shop.page')}}:</label>
                                <ol>

                                    <li class="{{ ($products->currentPage() == 1) ? ' disabled' : '' }}">
                                        <a class="button prev i-prev" href="{{ $products->url(1) }}" title="Prev"></a>
                                    </li>
                                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                                        <li class="{{ ($products->currentPage() == $i) ? ' current' : '' }}">
                                            <a class="button" href="{{ $products->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li  class="{{ ($products->currentPage() == $products->lastPage()) ? ' disabled' : '' }}">
                                        <a class="button next i-next" href="{{ $products->url($products->currentPage()+1) }}" title="Next"></a>
                                    </li>
                                </ol>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!--Tile-->

                <!--Tile-->
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="tile">

                            <div class="price-label">CHF {{$product->price}}</div>


                            <div class="footer">
                                <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img src="{{ asset($product->thumbnail) }}">{{$product->title}}</a>

                                <div class="tools">
                                    <div class="rating">
                                        <div class="ratings">
                                            <div class="rating-box">

                                                <div class="rating" style="width:{{$product->rating_cache*20}}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Add To Cart Button-->
                                    <a class="add-cart-btn" href="#"><span>To cart</span><i class="icon-shopping-cart"></i></a>
                                    <!--Share Button-->
                                    <div class="share-btn">
                                        <div class="hover-state">
                                            <a class="fa fa-facebook-square" href="#"></a>
                                            <a class="fa fa-twitter-square" href="#"></a>
                                            <a class="fa fa-google-plus-square" href="#"></a>
                                        </div>
                                        <i class="fa fa-share"></i>
                                    </div>
                                    <!--Add To Wishlist Button-->
                                    <a class="wishlist-btn" href="#">
                                        <div class="hover-state">Wishlist</div>
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Tile-->
                @endforeach

            </div>
        </div>
    </section><!--Catalog Grid Close-->



    <!--Brands Carousel Widget-->
    <section class="brand-carousel">
        <div class="container">
            <h2>Brands in our shop</h2>
            <div class="inner">
                <a class="item" href="#"><img src="img/brands/1.png" alt="1"/></a>
                <a class="item" href="#"><img src="img/brands/1.png" alt="1"/></a>
                <a class="item" href="#"><img src="img/brands/1.png" alt="1"/></a>
                <a class="item" href="#"><img src="img/brands/1.png" alt="1"/></a>
                <a class="item" href="#"><img src="img/brands/1.png" alt="1"/></a>
                <a class="item" href="#"><img src="img/brands/1.png" alt="1"/></a>
                <a class="item" href="#"><img src="img/brands/1.png" alt="1"/></a>
            </div>
        </div>
    </section><!--Brands Carousel Close-->

</div><!--Page Content Close-->

<!--Sticky Buttons-->
<div class="sticky-btns">
    <form class="quick-contact ajax-form" method="post" name="quick-contact">
        <h3>Contact us</h3>
        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.</p>
        <div class="form-group">
            <label for="qc-name">Full name</label>
            <input class="form-control input-sm" type="text" name="name" id="qc-name" placeholder="Enter full name">
        </div>
        <div class="form-group">
            <label for="qc-email">Email</label>
            <input class="form-control input-sm" type="email" name="email" id="qc-email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="qc-message">Your message</label>
            <textarea class="form-control input-sm" name="message" id="qc-message" placeholder="Enter your message"></textarea>
        </div>
        <!-- Validation Response -->
        <div class="response-holder"></div>
        <!-- Response End -->
        <input class="btn btn-success btn-sm btn-block" type="submit" value="Send">
    </form>
    <span id="qcf-btn"><i class="fa fa-envelope"></i></span>
    <span id="scrollTop-btn"><i class="fa fa-chevron-up"></i></span>
</div><!--Sticky Buttons Close-->

<!--Subscription Widget-->
<section class="subscr-widget">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-8 col-sm-8">
                <h2 class="light-color">Subscribe to our news</h2>

                <!--Mail Chimp Subscription Form-->
                <form class="subscr-form" role="form" action="//8guild.us3.list-manage.com/subscribe/post?u=168a366a98d3248fbc35c0b67&amp;id=d704057a31" target="_blank" method="post" autocomplete="off">
                    <div class="form-group">
                        <style>
                            .subscr-form .subscr-next, .subscr-form #subscr-submit{
                                top:4px;
                            }
                        </style>
                        <label class="sr-only" for="subscr-name">Enter name</label>
                        <input type="text" class="form-control" name="FNAME" id="subscr-name" placeholder="Enter name" required style="background:#2ba8db">
                        <button class="subscr-next"><i class="icon-arrow-right"></i></button>
                    </div>
                    <div class="form-group fff" style="display: none">
                        <label class="sr-only" for="subscr-email">Enter email</label>
                        <input type="email" class="form-control" name="EMAIL" id="subscr-email" placeholder="Enter email" required>
                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                        <div style="position: absolute; left: -5000px;"><input type="text" name="b_168a366a98d3248fbc35c0b67_d704057a31" tabindex="-1" value=""></div>
                        <button type="submit" id="subscr-submit"><i class="icon-check"></i></button>
                    </div>
                </form>
                <!--Mail Chimp Subscription Form Close-->
                <p class="p-style2">Please fill the field before continuing</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1">
                <p class="p-style3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
            </div>
        </div>
    </div>
</section><!--Subscription Widget Close-->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5">
                <div class="info">
                    <a class="logo" href=""></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                    <div class="social">
                        <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-youtube-square"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-tumblr-square"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-vimeo-square"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-pinterest-square"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <h2>Latest news</h2>
                <ul class="list-unstyled">
                    <li>25 May <a href="#">Nemo enim ipsam voluptatem</a></li>
                    <li>01 May <a href="#">Neque porro quisquam est</a></li>
                    <li>16 Apr <a href="#">Lorem ipsum dolor sit amet</a></li>
                    <li>10 Jan <a href="#">Sed ut perspiciatis unde</a></li>
                </ul>
            </div>
            <div class="contacts col-lg-3 col-md-3 col-sm-3">
                <h2>Contacts</h2>
                <p class="p-style3">
                    4120 Lenox Avenue, New York, NY,<br/>
                    10035 76 Saint Nicholas Avenue<br/>
                    +48 543765234<br/>
                    +48 555 234 54 34<br/>
                </p>
            </div>
        </div>
        <div class="copyright">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <p>&copy; 2016 SHOP. All Rights Reserved. Designed by <a href="" target="_blank"></a></p>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="payment">
                        <img src="img/payment/visa.png" alt="Visa"/>
                        <img src="img/payment/paypal.png" alt="PayPal"/>
                        <img src="img/payment/master.png" alt="Master Card"/>
                        <img src="img/payment/discover.png" alt="Discover"/>
                        <img src="img/payment/amazon.png" alt="Amazon"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer><!--Footer Close-->