@include('new_template.client.layouts.default')
<div class="page-content">
    <section class="cat-tiles">

        <div class="container inner-page-cat">
            <h2><?php echo $alias;?></h2>
            <section class="row" style="margin-left: 20px">
                <!--Category-->
                <?php $count=0;?>



                <div id="filters">
                @foreach ($sub->chunk(3) as $chunk)
                    <div class="category col-lg-4 col-md-4 col-sm-4 col-xs-6">
                        <section class="filter-section">


                        @foreach ($chunk as $product)
                            <?php  $count++;?>
                                <div class="filterblock">
								<label>
                                <input type="checkbox" name="" class="category" value="<?php echo $product->id;?>"  rel="<?php echo $product->id;?>" style="">
                                {{$product->name}}
								</label>
								
                            <br>
                        @endforeach

                        </section>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--Catalog Grid-->
    <div class="container">

        <div class="row" style="margin-top: 30px;">
            <div class="filters-mobile col-lg-3 col-md-3 col-sm-3">

                <div class="shop-filters">

                    <!--Price Section-->
                    <section class="filter-section">
                        <h3>Filter by price</h3>
                        <form method="get" name="price-filters">
                            <span class="clear" id="clearPrice">Clear price</span>
                            <div class="price-btns">
                                <button class="btn btn-success btn-sm" value="below 50$">below 50$</button><br>
                                <button class="btn btn-success btn-sm disabled" value="50$-100$">50$-100$</button><br>
                                <button class="btn btn-success btn-sm" value="100$-300$">100$-300$</button><br>
                                <button class="btn btn-success btn-sm" value="300$-1000$">300$-1000$</button>
                            </div>
                        </form>
                    </section>

                    <!--Colors Section-->
                    <section class="filter-section">
                        <h3>Filter by color</h3>
                        <span class="clear clearChecks">Clear colors</span>
                        <label>
                            <div class="icheckbox checked" style="position: relative;"><input type="checkbox" name="colors" value="black" id="color_0" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                            Black (12)</label>
                        <br>
                        <label>
                            <div class="icheckbox" style="position: relative;"><input type="checkbox" name="colors" value="white" id="color_1" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                            White (1)</label>
                        <br>
                        <label>
                            <div class="icheckbox" style="position: relative;"><input type="checkbox" name="colors" value="green" id="color_2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                            Green  (34)</label>
                        <br>
                        <label>
                            <div class="icheckbox" style="position: relative;"><input type="checkbox" name="colors" value="blue" id="color_3" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                            Blue (23)</label>
                        <br>
                        <label>
                            <div class="icheckbox" style="position: relative;"><input type="checkbox" name="colors" value="red" id="color_4" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                            Red (12)</label>


                    </section>

                    <!--Colors Section-->
                    <section class="filter-section">
                        <h3>Filter by size</h3>
                        <span class="clear clearChecks">Clear size</span>
                        <label>
                            <div class="icheckbox checked" style="position: relative;"><input type="checkbox" name="sizes" value="small" id="size_0" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                            Small (12)</label>
                        <br>
                        <label>
                            <div class="icheckbox" style="position: relative;"><input type="checkbox" name="sizes" value="white" id="size_1" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                            Medium (34)</label>
                        <br>
                        <label>
                            <div class="icheckbox" style="position: relative;"><input type="checkbox" name="sizes" value="green" id="size_2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                            Large (11)</label>
                        <br>
                        <label>
                            <div class="icheckbox" style="position: relative;"><input type="checkbox" name="sizes" value="blue" id="size_3" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                            Extra large (1)</label>
                        <br>
                        <label>
                            <div class="icheckbox" style="position: relative;"><input type="checkbox" name="sizes" value="red" id="size_4" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                            Superman (0)</label>
                    </section>


                </div></div>

    <div  style="" id="container" class="js-masonry col-lg-9 col-md-9 col-sm-8" data-masonry-options='{ "gutter": 5, "columnWidth": 300, "itemSelector": ".item-tile" }'>
        @foreach($products as $product)
            <div class="item-tile" data-tag="<?php echo $product->subcategory->id;?>">
                <div class="tile">

                    <div class="price-label">CHF {{$product->price}}</div>


                    <div class="footer">
                        <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                    src="{{ asset($product->thumbnail) }}" class="img-responsive"><span>{{$product->title}}</span></a>

                        <div class="tools">
                            <div class="rating">
                                <div class="ratings">
                                    <div class="rating-box">

                                        <div class="rating" style="width:{{$product->rating_cache*20}}%"></div>
                                    </div>
                                </div>
                            </div>

                            <!--Add To Cart Button-->
                            {!! Form::open(array('method' => 'POST', 'route' => array('add_cart', $product->id), 'class'=>'formCart')) !!}
                            <button type="submit" class="add-cart-btn" style="border:none">
                                <span>To cart</span><i class="icon-shopping-cart"></i></button>

                            {!! Form::close() !!}
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
                            {!! Form::open(array('method' => 'POST', 'route' => array('add_wishlist', $product->id), 'class'=>'formCart')) !!}
                            <button type="submit" class="wishlist-btn" id="cartBtn"
                                    style="background: none;border:none;">
                                <div class="hover-state">Wishlist</div>
                                <i class="fa fa-plus"></i>
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
            <!--Tile-->
        @endforeach

    </div>
</div>
        </div>


</div><!--Page Content Close-->

<script>


    $('input:checkbox').on('change',function(){
        this.setAttribute("checked", "checked");

    });


            $(document).ready(function(){

                $('.category').on('change', function(){
                    var category_list = [];
                    $('#filters input:checked').each(function(){
                        var category = $(this).val();
                        category_list.push(category); //Push each check item's value into an array
                    });

                    if(category_list.length == 0)
                        $('.item-tile').fadeIn();
                    else {
                        $('.item-tile').each(function () {
                            var item = $(this).attr('data-tag');
                            if (jQuery.inArray(item, category_list) > -1) //Check if data-tag's value is in array
                                $(this).fadeIn('slow');
                            else
                                $(this).hide();
                        });
                    }
                })
            })
</script>



