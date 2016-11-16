@include('new_template.client.layouts.default')
<div class="page-content">



    <div class="container">
        <div class="col-md-12">
            <h2 style="padding-top:20px;"><?php echo $alias;?></h2>
            <section class="row">
                <?php $count=0;?>
                <div class="filters col-md-12" style="padding:0px">
                    <ul id="categories1" style="list-style:none; padding: 0px" class="col-md-12">
                        @foreach ($sub->chunk(3) as $chunk)
                            <li class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                @foreach ($chunk as $product)
                                    <?php  $count++;?>
                                    <input type="checkbox" value="<?php echo $product->id;?>" id="<?php echo $count;?>"  />
                                    {{$product->name}}<br/>
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </div>

    <hr>
    <div class="container">

        <div class="filters-mobile col-lg-3 col-md-3 col-sm-3">
            <h3>{{ Lang::get('app.Filters') }}</h3>
            <div id="slider-range"></div>
            <div id="slider-container" style="width:80%;"><br/>
                <p>
                    <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
                </p>
            </div>
            <?php $categories=\App\Category::whereHas('translations', function($q) use ($alias)
            {
                $q->where('slug', 'like', '%'.$alias.'%');

            })->get()?>
            <?php foreach($categories as $c){?>
                 <?php $attributes= \Illuminate\Support\Facades\DB::table('attributes')->where('category_id', '=',$c->id)->get();?>
                <?php }?>

                    <!--Colors Section-->
            <div class="filters1" style="margin-top: 52px;">
                <ul id="categories" style="padding-left: 0px">
                    <?php foreach($attributes as $a){?>
                    <section class="filter-section attributes <?php echo $a->sub_category_id;?>" id="filter-attributes">



                        <h3>Filter by <?php echo $a->name;?></h3>
                        <?php $attributes_list= \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=',$a->id)->get();?>
                        <?php foreach($attributes_list as $al){?>
                        <li style="list-style:none;margin-bottom:1px;">
                            <input type="checkbox" name="<?php echo $a->name;?>" value="<?php echo $al->item_value;?>"/>
                            <?php echo $al->item_value;?></li>
                        <?php } ?>
                    </section>

                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="catalog-grid col-md-9" style="width:75%">

            <h2 class="primary-color">{{ Lang::get('app.Products') }}</h2>
            <div class="row products ">
                <?php $count=200;?>
                <div id="computers">
                    @foreach($products1 as $product)
                    <?php $count=$count+30;?>
                    <?php $prod_attributes= \Illuminate\Support\Facades\DB::table('product_attributes')->where('product_id', '=',$product->id)->get();?>
                            <!--Tile-->
                    <div class="col-tile col-lg-4 col-md-4 col-sm-6 <?php foreach($prod_attributes as $pa){?><?php echo $pa->value;?> <?php }?><?php echo $product->subcategory->id;?>" data-price="<?php echo round($product->price);?>">

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
                                        <span>{{ Lang::get('app.To cart') }}</span><i class="icon-shopping-cart"></i></button>

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
                                        <div class="hover-state">{{ Lang::get('app.Wishlist') }}</div>
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

    </div><!-- end of row-->
</div><!-- end of container -->
</div><!-- end of page content -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>


    var minPrice =10;
    if ($("input:checkbox:checked").length == 0) {

        $(".col-tile").show();
    }

    $('input:checkbox').click(function(e){

        if($(this).is(":checked")) {

            this.setAttribute("checked", "");
        }else{
            this.removeAttribute("checked");
            if ($("input:checkbox:checked").length == 0) {

                $(".col-tile").show();
            }

        }



    });
    var category_list = [];
    $('.attributes input:checkbox').on('change', function(){
        var classes = $('.filters input:checkbox:checked').val();

        var category = $(this).val();
        category_list.push(category,classes); //Push each check item's value into an array
        console.log('attributes',category_list);



    })
    $(function () {


        var maxPrice = 1000,
                $filter_lists = $(".filters ul"),
                $filter_lists1 = $(".filters1 ul"),
                $filter_checkboxes = $(".filters :checkbox"),
                $filter_checkboxes1 = $(".filters1 :checkbox"),
                $items = $(".col-tile");

        $filter_checkboxes.click(filterSystem);
        $filter_checkboxes1.click(filterSystem1);

        $('#slider-container').slider({
            range: true,
            min: minPrice,
            max: maxPrice,
            values: [minPrice, maxPrice],
            slide: function (event, ui) {
                $("#amount").val("CHF " + ui.values[0] + " - CHF " + ui.values[1]);
                minPrice = ui.values[0];
                maxPrice = ui.values[1];
                filterSystem();
                filterSystem1();
            }
        });
        $("#amount").val("CHF " + minPrice + " - CHF " + maxPrice);

        function filterSlider(elem) {
            var price = parseInt($(elem).data("price"), 10);
            console.log(price);
            return price >= minPrice && price <= maxPrice;
        }

        function filterCheckboxes1(elem) {
            var $elem = $(elem),
                    passAllFilters = true;


            $filter_lists1.each(function () {

                var classes = $(this).find(':checkbox:checked').map(function () {
                    return $(this).val();
                }).get();

                if ($(".filters1 input:checkbox:checked").length == 0) {
                    filterSystem();
                }
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
        function filterCheckboxes(elem) {
            var $elem = $(elem),
                    passAllFilters = true;


            $filter_lists.each(function () {

                var classes = $(this).find(':checkbox:checked').map(function () {
                    return $(this).val();
                }).get();
                if ($("input:checkbox:checked").length == 0) {

                    $(".col-tile").show();
                }

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
        function filterSystem1() {

            $items.hide().filter(function () {
                return filterSlider(this) && filterCheckboxes1(this)&& filterCheckboxes(this);
            }).show();
        }


    });



</script>


