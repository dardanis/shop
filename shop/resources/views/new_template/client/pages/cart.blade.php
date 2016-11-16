@extends('new_template.client.layouts.default')
@section('content')
    <div class="container">

            <div class="div-content-other">
                <div class="row">
                    @if(count(Cart::getContent())>0)
                    <!--Items List-->
                    <div class="col-lg-9 col-md-9">
                        <h2 class="title">{{trans('shop.shoping_cart')}}</h2>
                        <table class="items-list">
                            <tr>
                                <th class="hidden-table" rowspan="1">&nbsp;</th>
                                <th rowspan="1"><span class="nobr">{{trans('shop.product_name')}}</span></th>
                                <th colspan="1" class="a-left hidden-table"><span class="nobr">{{trans('shop.unit_price')}}</span></th>
                                <th class="a-left" rowspan="1">{{trans('shop.qty')}}</th>

                                <th class="a-left" rowspan="1">&nbsp;</th>
                            </tr>
                            <!--Item-->
                            @foreach(Cart::getContent() as $product)
                                <?php $prod = \App\Product::where('id', '=', $product->id)->get();?>
                            <?php foreach($prod as $prodid){?>
                            <?php $slug_prod=$prodid->slug;?>
                                    <?php }?>
                            <tr class="item">
                                <td class="thumb"><a href="{{ URL::route('product_show',array($slug_prod,$product->id)) }}"><img src="{!! asset($product->attributes->image)!!}" alt="<?php echo $prodid->title;?>" style="padding:10px;"/></a></td>
                                <td class="name"><a href="{{ URL::route('product_show',array($slug_prod,$product->id)) }}">{!! $product->name !!}</a></td>
                                <td class="total">CHF {{ $product->price }}</td>
                                <td class="qnt-count">
                                    <input class="quantity form-control" type="text" value="<?php echo $product->quantity;?>">
                                </td>

                                {!! Form::open(array('method' => 'DELETE', 'route' => array('cart.delete', $product->id))) !!}
                                <td><button class="btn-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td>
                                {!! Form::close() !!}
                            </tr>
                          @endforeach

                        </table>
                    </div>

                    <!--Sidebar-->
                    <div class="col-lg-3 col-md-3" style="margin-top:30px;">
                        <h3 style="font-weight:bold;">Cart totals</h3>

                            <div class="cart-totals">
                                <table>
                                    <tbody><tr>
                                        <td>Cart subtotal</td>
                                        <td class="total align-r">CHF {!! Cart::getSubTotal()!!}</td>
                                    </tr>
                                    <tr class="devider">
                                        <td>Shipping</td>
                                        <td class="align-r">Free shipping</td>
                                    </tr>
                                    <tr>
                                        <td>Order total</td>
                                        <td class="total align-r">CHF {!! Cart::getSubTotal()!!}</td>
                                    </tr>
                                    </tbody></table>
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
            </div>
                    <div class="col-md-9">
                        <div class="col-md-6">
                            <a href="/">
                                <button onClick="setLocation('/')" class="btn btn-success btn-block forward" title="Continue Shopping" type="button">{{trans('shop.continue_shopping')}}<i style="padding-left:5px;"class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-3">
                        <a href="{{ URL::route('clear_cart') }}">
                            <button style="background:#ffaa00;"id="empty_cart_button" class="btn btn-success btn-block forward" title="Clear Cart" value="empty_cart" name="update_cart_action" type="submit">{{trans('shop.clear_cart')}}<i style="padding-left:5px;"class="" aria-hidden="true"></i>
                            </button>
                        </a>
                       </div>
                    </div>
                    @else
                        <div class="page-title">
                            <h2>No Products in cart</h2>
                        </div>
                    @endif
               </div>
                </div>

        </div>


@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {
            var action;
            $(".number-spinner button").mousedown(function () {
                btn = $(this);
                input = btn.closest('.number-spinner').find('input');
                btn.closest('.number-spinner').find('button').prop("disabled", false);

                if (btn.attr('data-dir') == 'up') {
                    action = setInterval(function(){
                        if ( input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max')) ) {
                            input.val(parseInt(input.val())+1);
                        }else{
                            btn.prop("disabled", true);
                            clearInterval(action);
                        }
                    }, 50);
                } else {
                    action = setInterval(function(){
                        if ( input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min')) ) {
                            input.val(parseInt(input.val())-1);
                        }else{
                            btn.prop("disabled", true);
                            clearInterval(action);
                        }
                    }, 50);
                }
            }).mouseup(function(){
                clearInterval(action);
            });
        });
    </script>

@endsection
<style>
    .stripe-button-el{
        width:100%;
        background-image:linear-gradient(#8ab03a,#8ab03a) !important;
    }
    .stripe-button-el span{
        background:#8ab03a !important;
    }
    .button>.inner>button{
        background: #8ab03a !important;
    }
</style>