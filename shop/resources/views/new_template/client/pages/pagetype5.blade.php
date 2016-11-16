@include('new_template.client.layouts.default')
<div class="page-content">

    <section class="cat-tiles">

        <div class="container inner-page-cat">
            <h2><?php echo $alias;?></h2>
            <section class="row" style="margin-left: 20px">
                <?php $count=0;?>
                <div class="filters">
                    <ul id="categories1" style="list-style:none">
                        @foreach ($sub->chunk(3) as $chunk)
                            <li class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                @foreach ($chunk as $product)
                                    <?php  $count++;?>
                                        <input class="filter" filter="category" data="<?php echo $product->id;?>" type="checkbox" id="<?php echo $product->id;?>"/>

                                    {{$product->name}}<br/>
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </section>

    <hr>
    <div class="container">

        <div class="row" style="margin-top: 30px;">
            <div class="filters-mobile col-lg-3 col-md-3 col-sm-3">
                <h3>Filters</h3>
                <div id="slider-container"></div>
                <p>
                    <label for="amount">Price range:</label>
                    <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
                </p>

                <div id="slider-range"></div>
                <?php $categories=\App\Category::whereHas('translations', function($q) use ($alias)
                {
                    $q->where('slug', 'like', '%'.$alias.'%');

                })->get()?>
                <?php foreach($categories as $c){?>
                 <?php $attributes= \Illuminate\Support\Facades\DB::table('attributes')->where('category_id', '=',$c->id)->get();?>
                <?php }?>

                        <!--Colors Section-->
                <div class="filters1" style="margin-top: 52px;">
                    <ul id="categories">
                        <?php foreach($attributes as $a){?>
                        <section class="filter-section attributes <?php echo $a->sub_category_id;?>" id="filter-attributes" style="display:none">



                            <h3>Filter by <?php echo $a->name;?></h3>
                            <?php $attributes_list= \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=',$a->id)->get();?>
                            <?php foreach($attributes_list as $al){?>
                            <li style="list-style:none;margin-bottom:1px;">
                                <input type="checkbox" class="filter" filter="partner" data="<?php echo $al->item_value;?>" name="<?php echo $a->name;?>" value="<?php echo $al->id;?>"/>
                                <?php echo $al->item_value;?></li>
                            <?php } ?>
                        </section>

                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="catalog-grid col-md-9">

                <h2 class="primary-color">Products</h2>
                <div class="row products ">
                    <?php $count=200;?>
                    <div id="computers">
                        @foreach($products as $product)
                        <?php $count=$count+30;?>
                        <?php $prod_attributes= \Illuminate\Support\Facades\DB::table('product_attributes')->where('product_id', '=',$product->id)->get();?>
                                <!--Tile-->
                        <div class="col-tile col-lg-4 col-md-4 col-sm-6 product" partner="<?php foreach($prod_attributes as $pa){?><?php echo $pa->id; echo ",";?> <?php }?>" category="<?php echo $product->subcategory->id;?>" data-price="<?php echo round($product->price);?>">

                            <div class="tile">

                                <?php if($product->price!="0.00"){?><div class="price-label">CHF <?php echo $product->price;?></div><?php } ?>
                                <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                            src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>

                                <div class="footer">
                                    <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                        <span>{{$product->title}}</span>
                                    </a>

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
        </div>
    </div><!-- end of row-->
</div><!-- end of container -->
</div><!-- end of page content -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>

    $('.filters input:checkbox').click(function(e){
        var catid=$(this).attr('id');

        $('.'+catid).toggle();
        })

    $('.filter').click(function() {
        if (!$("input[type='checkbox']").is(":checked")){
            $('.product').show();
        } else {
            $('.product').hide();
            $('.filter').each(function() {
                if($(this).is(':checked')) {
                    var filter = $(this).attr('filter');
                    var data   = $(this).attr('data');
                    $.each($('.product'), function() {
                        var p = $(this);
                        var fs = $(this).attr(filter).split(", ");
                        $.each(fs, function(index, value) {
                            console.log('value: ' + value);
                            if(data == value) {
                                p.show();
                            }
                        });
                    });
                }
            });
        }
    });
    $(function () {
        $('#slider-container').slider({
            range: true,
            min: 10,
            max: 200,
            values: [10, 100],
            create: function() {
                $("#amount").val("10 - 100");
            },
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                var mi = ui.values[0];
                var mx = ui.values[1];
                filterSystem(mi, mx);
            }
        })
    });
    function filterSystem(minPrice, maxPrice) {
        $(".product").hide().filter(function () {
            var price = parseInt($(this).data("price"), 10);
            return price >= minPrice && price <= maxPrice;
        }).show();
    }

</script>


