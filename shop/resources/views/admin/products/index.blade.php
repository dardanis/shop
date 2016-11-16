@extends('new')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{trans('shop.products')}}
            </header>
            <div class="panel-body">
            @include('errors_messages')
                  <div class="adv-table">
                      <table  class="display table table-bordered table-striped" id="productadmin">
                        <thead>
                        <tr>
                            <th>{{trans('app.product_title')}}</th>
                            <th>{{trans('shop.price')}}</th>
                            <th>{{trans('shop.category')}}</th>
                            <th>{{trans('shop.user')}}</th>
                            <th>{{trans('shop.created_at')}}</th>
                            <th>{{trans('shop.approve')}}</th>
                            <th>{{trans('shop.edit')}}</th>
                            <th>{{trans('shop.delete')}}</th>
                            <th>{{Lang::get('app.View')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                       <tr>
                        <td >{{$product->title}}</td>
                        <td >{{$product->price}}</td>
                        <td ><label class="label label-default">{{$product->category->name}}</label></td>
                        <td ><label class="label label-default">{{$product->user->name}}</label></td>
                        <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($product->created_at))->diffForHumans() }}</span></td>
                        <td>
                          @if($product->status != 0)
                            {!! Form::open(array('method' => 'PATCH', 'route' => array('admin_product_spam', $product->id))) !!}
                            {!! Form::submit(trans('shop.warn_user'), array('class' => 'btn btn-warning btn-xs')) !!}
                            {!! Form::close() !!}
                          @else
                            {!! Form::open(array('method' => 'PATCH', 'route' => array('admin_product_approve', $product->id))) !!}
                            {!! Form::submit(trans('shop.approve'), array('class' => 'btn btn-success btn-xs')) !!}
                            {!! Form::close() !!}
                          @endif
                        </td>

                            <td><a href="{{"/edit/$product->slug/$product->id"}}" class="btn btn-warning btn-xs">Edit</a></td>
                        <td>
                            {!! Form::open(array('method' => 'DELETE', 'route' => array('admin_product_delete', $product->id))) !!}
                            {!! Form::submit(trans('shop.delete'), array('class' => 'btn btn-danger btn-xs')) !!}
                            {!! Form::close() !!}
                          </td>
                           <td><a href="{{ URL::route('product_show',array($product->slug,$product->id)) }}" class="btn btn-default btn-xs" target="_blank">View</a></td>
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
              $('#productadmin').dataTable();
          } );
      </script>
@endsection