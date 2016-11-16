@extends('new_template.client.layouts.usernav')

@section('content')
    <div class="container">
    <div class="page-content" style="padding-top: 10px;margin-top:0px;">

                            <h2>{{trans('shop.products')}} </h2>

                        <div class="dashboard">
                            <div class="recent-orders">
                                <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                        <thead>
                                        <tr class="first last">
                                            <th>{{ Lang::get('app.Title')}}</th>
                                            <th>{{ Lang::get('app.Price')}}</th>
                                            <th>{{ Lang::get('app.Category')}}</th>
                                            <th>{{ Lang::get('app.Sub Category')}}</th>
                                            <th>{{trans('shop.created_at')}}</th>
                                            <th>{{ Lang::get('app.View Item') }}</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr class="first odd">
                                                <td>{{$product->title}}</td>
                                                <td>{{$product->price}}</td>
                                                <td><label class="label label-default">{{$product->category->name}}</label></td>
                                                <td><label class="label label-default">{{$product->subcategory->name}}</label></td>
                                                <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($product->created_at))->diffForHumans() }}</span></td>
                                                <td> <a target="_blank" href="{{ URL::route('product_show',array($product->slug,$product->id)) }}">
                                                        <span style="padding:10px;">{{$product->title}}</span>
                                                    </a></td>
                                                <td class="a-center last"><span class="nobr"><a href="{{"/edit/$product->slug/$product->id"}}" class="btn btn-warning btn-xs">Edit</a></span></td>
                                                <td class="a-center last"><span class="nobr"> {!! Form::open(array('method' => 'DELETE', 'route' => array('client_product_delete', $product->id))) !!}
                                                        {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}
                                                        {!! Form::close() !!}</span></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php echo $products->render(); ?>
                        </div>


            </div>
        </div>

@endsection

@section('style')
    <link href="{{ asset('/css/demo_page.css') }}" />
    <link href="{{ asset('/css/demo_table.css') }}" />
    <link href="{{ asset('/css/DT_bootstrap.css') }}" />
@endsection
@section('scripts')
    <script src="{{ asset('/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/js/DT_bootstrap.js') }}"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#adv-table').dataTable( {
                "aaSorting": [[ 0, "desc" ]]
            } );
        } );
    </script>
@endsection