@include('new_template.client.layouts.default')




        <!--Page Content-->
<div class="page-content">



    <!--Catalog Grid-->
    <section class="catalog-grid">
        <div class="container">

            <div class="row">
                <div class="filters-mobile col-lg-3 col-md-3 col-sm-4">
                    <div class="shop-filters">

                        <!--Price Section-->
                        <section class="filter-section">
                            <h3>Filter by price</h3>
                            <form method="get" name="price-filters">
                                <span class="clear" id="clearPrice" >Clear price</span>
                                <div class="price-btns">
                                    <button class="btn btn-success btn-sm" value="below 50$">below 50$</button><br/>
                                    <button class="btn btn-success btn-sm disabled" value="50$-100$">50$-100$</button><br/>
                                    <button class="btn btn-success btn-sm" value="100$-300$">100$-300$</button><br/>
                                    <button class="btn btn-success btn-sm" value="300$-1000$">300$-1000$</button>
                                </div>
                                <div class="price-slider">
                                    <div id="price-range"></div>
                                    <div class="values group">
                                        <!--data-min-val represent minimal price and data-max-val maximum price respectively in pricing slider range; value="" - default values-->
                                        <input class="form-control" name="minVal" id="minVal" type="text" data-min-val="10" value="180">
                                        <span class="labels">$ - </span>
                                        <input class="form-control" name="maxVal" id="maxVal" type="text" data-max-val="2500" value="1400">
                                        <span class="labels">$</span>
                                    </div>
                                    <input class="btn btn-primary btn-sm" type="submit" value="Filter">
                                </div>
                            </form>
                        </section>

                        <!--Colors Section-->
                        <section class="filter-section">
                            <h3>Filter by color</h3>
                            <span class="clear clearChecks">Clear colors</span>
                            <label>
                                <input type="checkbox" name="colors" value="black" id="color_0" checked>
                                Black (12)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="colors" value="white" id="color_1">
                                White (1)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="colors" value="green" id="color_2">
                                Green  (34)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="colors" value="blue" id="color_3">
                                Blue (23)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="colors" value="red" id="color_4">
                                Red (12)</label>
                        </section>

                        <!--Colors Section-->
                        <section class="filter-section">
                            <h3>Filter by size</h3>
                            <span class="clear clearChecks">Clear size</span>
                            <label>
                                <input type="checkbox" name="sizes" value="small" id="size_0" checked>
                                Small (12)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="sizes" value="white" id="size_1">
                                Medium (34)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="sizes" value="green" id="size_2">
                                Large (11)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="sizes" value="blue" id="size_3">
                                Extra large (1)</label>
                            <br>
                            <label>
                                <input type="checkbox" name="sizes" value="red" id="size_4">
                                Superman (0)</label>
                        </section>

                        <!--Categories Section-->
                        <section class="filter-section">
                            <h3>Categories</h3>
                            <ul class="categories">
                                <li class="has-subcategory"><a href="#">iPhone cases (123)</a><!--Class "has-subcategory" for dropdown propper work-->
                                    <ul class="subcategory">
                                        <li><a href="#">iPhone cases (1)</a></li>
                                        <li><a href="#">iPad cases (45)</a></li>
                                        <li><a href="#">MacBook cases (34)</a></li>
                                        <li><a href="#">Something (12)</a></li>
                                        <li><a href="#">Air cases (23)</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">iPad cases (34)</a></li>
                                <li><a href="#">MacBook cases (78)</a></li>
                                <li class="has-subcategory"><a href="#">Something (45)</a>
                                    <ul class="subcategory">
                                        <li><a href="#">Subcategory (1)</a></li>
                                        <li><a href="#">Subcategory (45)</a></li>
                                        <li><a href="#">Subcategory (23)</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Air cases (23)</a></li>
                            </ul>
                        </section>
                    </div>
                </div>

                <!--Tiles-->
                <div class="col-lg-9 col-md-9 col-sm-9">

                    <div class="row">
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
                                    <!--Tile-->

                    </div>
                    <!--Pagination-->

                </div>
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
                        <label class="sr-only" for="subscr-name">Enter name</label>
                        <input type="text" class="form-control" name="FNAME" id="subscr-name" placeholder="Enter name" required>
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

<!--Footer-->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5">
                <div class="info">

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

                </p>
            </div>
        </div>
        <div class="copyright">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <p>&copy; 2016 SHOP. All Rights Reserved. Designed by <a href="#" target="_blank">SHOP</a></p>
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


</body><!--Body Close-->
</html>
