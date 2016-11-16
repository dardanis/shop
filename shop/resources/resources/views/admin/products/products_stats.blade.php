
@extends('new')

@section('content')
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{trans('shop.prod_stats')}}
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">{{trans('shop.this_week')}}<button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;">{{$p_no}}</button> </a>
                    </li>
                    <li><a href="#profile" data-toggle="tab">{{trans('shop.this_month')}}<button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;">{{$monthlyproducts}}</button></a>
                    </li>
                    <li><a href="#messages" data-toggle="tab">{{trans('shop.all_products')}} <button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;">{{$all}}</button></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                        <table class="table table-hover">
						<thead>
							<th>{{trans('shop.title')}}</th>
							<th>{{trans('shop.category')}}</th>
							<th>{{trans('shop.price')}}</th>
							<th>{{trans('shop.user')}}</th>
							<th>{{trans('shop.created_at')}}</th>
						</thead>
						<tbody>
						@foreach($w_products as $wp)
			        	<tr >
			              <td >{{$wp->title}}</td>
			              <td ><span class="label label-default
			              ">{{$wp->category->name}}</span></td>
			              <td>{{$wp->price}}</td>
			              <td ><span class="label label-success">{{$wp->user->name}}</span></td>
			              <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($wp->created_at))->diffForHumans() }}</span></td>

			              </tr>  
			             @endforeach
			          	</tbody>
			          </table>
                    </div>
                    <div class="tab-pane fade" id="profile">
                    <table class="table table-hover">
						<thead>
							<th>{{trans('shop.title')}}</th>
							<th>{{trans('shop.category')}}</th>
							<th>{{trans('shop.price')}}</th>
							<th>{{trans('shop.user')}}</th>
							<th>{{trans('shop.created_at')}}</th>
						</thead>
						<tbody>
						@foreach($m_products as $mp)
			        	<tr >
			              <td >{{$mp->title}}</td>
			              <td ><span class="label label-default">{{$mp->category->name}}</span></td>
			              <td>{{$mp->price}}</td>
			              <td ><span class="label label-success">{{$mp->user->name}}</span></td>
			              <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($mp->created_at))->diffForHumans() }}</span></td>

			              </tr>  
			             @endforeach
			          	</tbody>
			          </table>
                    </div>
                    <div class="tab-pane fade" id="messages">
                    <table class="table table-hover">
						<thead>
							<th>{{trans('shop.title')}}</th>
							<th>{{trans('shop.category')}}</th>
							<th>{{trans('shop.price')}}</th>
							<th>{{trans('shop.user')}}</th>
							<th>{{trans('shop.created_at')}}</th>
						</thead>
						<tbody>
						@foreach($allproducts as $ap)
			        	<tr >
			              <td >{{$ap->title}}</td>
			              <td ><span class="label label-default">{{$ap->category->name}}</span></td>
			              <td>{{$ap->price}}</td>
			              <td ><span class="label label-success">{{$ap->user->name}}</span></td>
			              <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($ap->created_at))->diffForHumans() }}</span></td>

			              </tr>  
			             @endforeach
			          	</tbody>
			          </table>   
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    </div>                   

@stop