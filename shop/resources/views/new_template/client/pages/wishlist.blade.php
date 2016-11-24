@extends('new_template.client.layouts.default')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('common/breadcrumbs')
    </div>
    <div class="div-content" style="padding-bottom: 30px;">
        <div class="col-lg-9 col-md-9">

            @if(count(Wishlist::getContent())>0)
                <h2 class="title">Wishlist</h2>
                <table class="items-list">
                    <tr>
                        <th>&nbsp;</th>
                        <th>Product name</th>
                        <th>Product price</th>
                    </tr>
                    <!--Item-->
                    @foreach(Wishlist::getContent() as $product)
                        <?php $prod = \App\Product::where('id', '=', $product->id)->get();?>
                        <?php foreach($prod as $prodid){?>
                            <?php $slug_prod=$prodid->slug;?>
                                    <?php }?>
                        <tr class="item first">
                            <td style="width:20%"><a href="{{ URL::route('product_show',array($slug_prod,$product->id)) }}"><img src="{!! asset($product->attributes->image)!!}" alt="" style="padding:10px;"/></a></td>
                            <td class="name" style="width:30%"><a href="{{ URL::route('product_show',array($slug_prod,$product->id)) }}">{!! $product->name !!}</a></td>
                            <td class="price-value" style="width:10%;">CHF <span style="padding-left: 5px"></span> {!! $product->price !!}</td>

                            <td class="delete" style="width:10%;">
                                <button class="btn-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            </td>

                        </tr>

                    @endforeach

                </table>
            @else
                <div class="page-title">
                    <h2>{{trans('shop.no_products_wishlist')}}</h2>
                </div>
            @endif
        </div>
    </div>


@endsection