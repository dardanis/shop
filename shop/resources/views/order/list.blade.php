@extends('new_template.client.layouts.default')
@section('content')
    <div class="container">
    <div class="page-content">



            <div class="row">
                <br/>
                <div class="col-md-12">
                <h2>My Orders</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="col-sm-4">Name</th>
                            <th class="col-sm-2">Price</th>
                            <th class="col-sm-2">Date</th>
                        </tr>
                        </thead>
                        <?php $product=array();?>
                            <?php $ordersitesm=array();?>
                        <?php foreach($orders as $o){?>
                        <?php $ordersitesm = \Illuminate\Support\Facades\DB::table('order_items')->where('order_id', '=',$o->id)->get();?>
                        @foreach($ordersitesm as $oi)
                            <?php $product_id=$oi->product_id;?>
                            <?php
                            $product=\App\Product::whereHas('translations', function($q) use ($product_id)
                            {
                                $q->where('product_id', '=',$product_id);

                            })->get();?>
                                @foreach($product as $item)
                                    <tr>
                                        <td>{{$item->title}}</td>
                                        <td>$ {{ $item->price }}</td>
                                        <td><?php echo $oi->created_at;?></td>
                                    </tr>
                                @endforeach
                        @endforeach


                        <?php }?>


                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection