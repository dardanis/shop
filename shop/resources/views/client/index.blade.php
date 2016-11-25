{{--@extends('new_template.client.layouts.user_settings')--}}
@section('style')
    <link href="{{ asset('/css/demo_page.css') }}" />
    <link href="{{ asset('/css/demo_table.css') }}" />
    <link href="{{ asset('/css/DT_bootstrap.css') }}" />
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{trans('shop.products')}} {!! link_to_route('products_add', trans('shop.add_product'), array(), array('class' => 'btn btn-primary btn-xs')) !!}
            </header>
            <div class="panel-body">
                  <div class="adv-table">
                      <table  class="display table table-bordered table-striped" id="example">
                        <thead>
                        <tr>
                            <th>{{trans('shop.product_title')}}</th>
                            <th>{{trans('shop.price')}}</th>
                            <th>{{trans('shop.category')}}</th>
                            <th>{{trans('shop.user')}}</th>
                            <th>{{trans('shop.created_at')}}</th>
                            <th>{{trans('shop.edit')}}</th>
                            <th>{{trans('shop.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)

                       <tr style="@if($product->status==0)background-color:#E53935;color:#fff;@endif">
                          <td >{{$product->title}}</td>
                          <td >{{$product->price}}</td>
                          <td ><label class="label label-default">{{$product->category->name}}</label></td>
                          <td ><label class="label label-default">{{$product->user->name}}</label></td>
                          <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($product->created_at))->diffForHumans() }}</span></td>
                          <td>{!! link_to_route('product_edit', 'Edit', array($product->slug), array('class' => 'btn btn-warning btn-xs')) !!}</td>
                          <td>
                            {!! Form::open(array('method' => 'DELETE', 'route' => array('client_product_delete', $product->id))) !!}
                            {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}
                            {!! Form::close() !!}
                          </td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
                  </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
  <script src="{{ asset('/js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('/js/DT_bootstrap.js') }}"></script>
  <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example').dataTable( {
                  "aaSorting": [[ 4, "desc" ]]
              } );
          } );
      </script>
@endsection