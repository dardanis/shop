@include('new_template.client.layouts.default')
<div class="page-content">
    <section class="cat-tiles">

        <div class="container inner-page-cat">
            <h2><?php echo $alias;?></h2>
            <section class="row" style="margin-left: 20px">
                <!--Category-->
                <?php $count=0;?>
     <div class="filters">
                    @foreach ($sub->chunk(3) as $chunk)
                        <div class="category col-lg-4 col-md-4 col-sm-4 col-xs-6">



                                @foreach ($chunk as $product)
                                    <?php  $count++;?>

                                            <input type="checkbox" name="" class="filter-chk" value="<?php echo $product->id;?>"   style="">
                                            {{$product->name}}

                                        <br>
                                @endforeach

                        </div>
                    @endforeach
                </div>
                </section>
        </div>
    </section>


<!--Catalog Grid-->
<div class="container">

    <div class="row" style="margin-top: 30px;">
        <div class="filters-mobile col-lg-3 col-md-3 col-sm-3">

            <div class="shop-filters">

                <!--Price Section-->
                <section class="filter-section">
                    <div id="slider-range"></div>
                    <div id="slider-container">
                        <p>
                            <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
                        </p>
                    </div>
                </section>
                <?php $categories=\App\Category::whereHas('translations', function($q) use ($alias)
                {
                    $q->where('slug', 'like', '%'.$alias.'%');

                })->get()?>
                <?php foreach($categories as $c){?>
                 <?php $attributes= \Illuminate\Support\Facades\DB::table('attributes')->where('category_id', '=',$c->id)->get();?>
                <?php }?>

                <!--Colors Section-->
                <?php foreach($attributes as $a){?>
                <section class="filter-section attributes" id="filter-attributes">
                    <h3>Filter by <?php echo $a->name;?></h3>
                    <span class="clear clearChecks">Clear <?php echo $a->name;?></span>
                    <div class="filters">
                    <?php $attributes_list= \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=',$a->id)->get();?>
                    <?php foreach($attributes_list as $al){?>

                   <input type="checkbox" name="<?php echo $a->name;?>" value="<?php echo $al->item_value;?>"/>
                    <?php echo $al->item_value;?><br/>
                    <?php } ?>

                    </div>
                </section>
                <?php } ?>

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

        <section class="catalog-grid">
            <div class="container">
                <h2 class="primary-color">Products</h2>
                <div class="row products">
                    @foreach($products as $product)
                    <?php $prod_attributes= \Illuminate\Support\Facades\DB::table('product_attributes')->where('product_id', '=',$product->id)->get();?>
                            <!--Tile-->
                    <div class="tile-col col-lg-3 col-md-4 col-sm-6 <?php foreach($prod_attributes as $pa){?><?php echo $pa->value;?> <?php }?><?php echo $product->subcategory->id;?>" data-tag="" data-price="{{$product->price}}">
                        <div class="tile">

                            <?php if($product->price!="0.00"){?><div class="price-label">CHF {{$product->price}}</div><?php } ?>
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
            </div><!--Page Content Close-->
        </section>
    </div>
</div>


</div><!--Page Content Close-->

<script>
    $('input:checkbox').on('change',function(){
        this.setAttribute("checked", "checked");

    });

    $(function () {
        var minPrice = 12,
                maxPrice =100,
                $filter_lists = $(".filters input"),
                $filter_checkboxes = $(".filters :checkbox"),
                $items = $(".products div.tile-col");

        $filter_checkboxes.click(filterSystem);

        $('#slider-container').slider({
            range: true,
            min: minPrice,
            max: maxPrice,
            values: [minPrice, maxPrice],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                minPrice = ui.values[0];
                maxPrice = ui.values[1];
                filterSystem();
            }
        });
        $("#amount").val("$" + minPrice + " - $" + maxPrice);

        function filterSlider(elem) {
            var price = parseInt($(elem).data("price"), 10);
            console.log(price);
            return price >= minPrice && price <= maxPrice;
        }
        function filterCheckboxes(elem) {
            var $elem = $(elem),
                    passAllFilters = true;
            $filter_lists.each(function () {
                var classes = $(this).find(':checkbox:checked').map(function () {
                    return $(this).val();
                }).get();
                console.log('classes', classes);
                var passThisFilter = false;
                $.each(classes, function (index, item) {
                    if ($elem.hasClass(item)) {
                        console.log('hasClass', item);
                        passThisFilter = true;
                        return false; //stop inner loop
                    }
                });
                if (!passThisFilter) {
                    passAllFilters = false;
                    return false; //stop outer loop
                }
            });
            return passAllFilters;
        }

        function filterSystem() {
            $items.hide().filter(function () {
                return filterSlider(this) && filterCheckboxes(this);
            }).show();
        }
    })

</script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

