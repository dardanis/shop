
@extends('new_template.client.layouts.home')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('common/breadcrumbs')
    </div>
    <div class="div-content" style="padding-bottom: 30px;">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->

            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <?php $SliderProduct1=DB::table('slider_products')->skip(0)->take(4)->get();?>
                    <?php $products1=array();?>
                    <?php foreach($SliderProduct1 as $sp1){?>

                    <?php $product_id=$sp1->product_id; ?>
                    <?php   $products1=\App\Product::whereHas('translations', function($q) use ($product_id)
                    {

                        $q->where('product_id', '=', $product_id);

                    })->get();?>

                    <?php foreach($products1 as $product){?>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="items">


                            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                        src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>
                            <div class="item-content">
                                <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                    <p class="title">{{$product->title}}</p>
                                </a>
                                <p class="p-price"><span class="price">Price</span><?php if($product->price!="0.00"){?>CHF {{$product->price}}<?php } ?></p>
                                <p class="p-price"><span class="discount">Discount</span><span class="discount-value"><?php if($product->price!="0.00"){?>CHF {{$product->price}}<?php } ?></span></p>
                                <p><span class="price">{{ Lang::get('app.Availability') }}: <?php echo $product->availability; ?></span></p>
                            </div>

                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                </div>
                <div class="item">
                    <?php $SliderProduct2=DB::table('slider_products')->skip(3)->take(3)->get();?>
                    <?php $products2=array();?>
                    <?php foreach($SliderProduct2 as $sp1){?>

                    <?php $product_id=$sp1->product_id; ?>
                    <?php   $products2=\App\Product::whereHas('translations', function($q) use ($product_id)
                    {

                        $q->where('product_id', '=', $product_id);

                    })->get();?>

                    <?php foreach($products2 as $product){?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="items">
                            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                        src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>
                            <div class="item-content">
                                <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                    <p class="title">{{$product->title}}</p>
                                </a>
                                <p class="p-price"><span class="price">Price</span><?php if($product->price!="0.00"){?>CHF {{$product->price}}<?php } ?></p>
                                <p class="p-price"><span class="discount">Discount</span><span class="discount-value"><?php if($product->price!="0.00"){?>CHF {{$product->price}}<?php } ?></span></p>
                                <p><span class="price">{{ Lang::get('app.Availability') }}: <?php echo $product->availability; ?></span></p>
                            </div>

                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>


                </div>
                <div class="item">
                    <?php $SliderProduct3=DB::table('slider_products')->skip(6)->take(3)->get();?>
                    <?php $products2=array();?>
                    <?php foreach($SliderProduct3 as $sp1){?>

                    <?php $product_id=$sp1->product_id; ?>
                    <?php   $products2=\App\Product::whereHas('translations', function($q) use ($product_id)
                    {

                        $q->where('product_id', '=', $product_id);

                    })->get();?>

                    <?php foreach($products2 as $product){?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="items">
                            <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}"><img
                                        src="{{ asset($product->thumbnail) }}" class="img-responsive"></a>
                            <div class="item-content">
                                <a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                    <p class="title">{{$product->title}}</p>
                                </a>
                                <p class="p-price"><span class="price">Price</span><?php if($product->price!="0.00"){?>CHF {{$product->price}}<?php } ?></p>
                                <p class="p-price"><span class="discount">Discount</span><span class="discount-value"><?php if($product->price!="0.00"){?>CHF {{$product->price}}<?php } ?></span></p>
                                <p><span class="price">{{ Lang::get('app.Availability') }}: <?php echo $product->availability; ?></span></p>
                            </div>

                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>


                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> </div>
    </div>

    <div class="div-content">
        <div class="col-md-12">

            <div class="div-content-category">
                <h2 class="title-category">{{Lang::get('app.Events')}}</h2>
                @include('new_template/client/pages/partialshome/events')

            </div>
        </div>
    </div>


@stop
