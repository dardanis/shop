
@extends('new')

@section('content')
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{trans('shop.users_stats')}}
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">{{trans('shop.this_week')}} <button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;">{{$w_no}}</button> </a>
                    </li>
                    <li><a href="#profile" data-toggle="tab">{{trans('shop.this_month')}}<button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;">{{$m_no}}</button></a>
                    </li>
                    <li><a href="#messages" data-toggle="tab">{{trans('shop.all_users')}} <button class="btn btn-circle-micro btn-info sm" style="padding:1px 7px;border-radius:17px;">{{$a_no}}</button></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                        <table class="table table-hover">
						<thead>
							<th>{{trans('shop.name')}}</th>
							<th>{{trans('shop.lastname')}}</th>
							<th>{{trans('shop.username')}}</th>
							<th>{{trans('shop.email')}}</th>
							<th>{{trans('shop.role')}}</th>
							<th>{{trans('shop.created_at')}}</th>
						</thead>
						<tbody>
						@foreach($wusers as $wu)
			        	<tr >
			              <td >{{$wu->name}}</td>
			              <td >{{$wu->lastname}}</td>
			              <td>{{$wu->username}}</td>
			              <td>{{$wu->email}}</td> 
			              <td ><span class="label label-success">{{$wu->role->name}}</span></td>
			              <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($wu->created_at))->diffForHumans() }}</span></td>

			              </tr>  
			             @endforeach
			          	</tbody>
			          </table>
                    </div>
                    <div class="tab-pane fade" id="profile">
                    <table class="table table-hover">
						<thead>
							<th>{{trans('shop.name')}}</th>
							<th>{{trans('shop.lastname')}}</th>
							<th>{{trans('shop.username')}}</th>
							<th>{{trans('shop.email')}}</th>
							<th>{{trans('shop.role')}}</th>
							<th>{{trans('shop.created_at')}}</th>
						</thead>
						<tbody>
						@foreach($musers as $m)
			        	<tr >
			              <td >{{$m->name}}</td>
			              <td >{{$m->lastname}}</td>
			              <td>{{$m->username}}</td>
			              <td>{{$m->email}}</td> 
			              <td ><span class="label label-success">{{$m->role->name}}</span></td>
			              <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($m->created_at))->diffForHumans() }}</span></td>
			            </tr>
			            @endforeach
			          	</tbody>
			          </table>
                    </div>
                    <div class="tab-pane fade" id="messages">
                    <table class="table table-hover">
						<thead>
							<th>{{trans('shop.name')}}</th>
							<th>{{trans('shop.lastname')}}</th>
							<th>{{trans('shop.username')}}</th>
							<th>{{trans('shop.email')}}</th>
							<th>{{trans('shop.role')}}</th>
							<th>{{trans('shop.created_at')}}</th>
						</thead>
						<tbody>
						@foreach($ausers as $a)
			        	<tr >
			             <td >{{$a->name}}</td>
			              <td >{{$a->lastname}}</td>
			              <td>{{$a->username}}</td>
			              <td>{{$a->email}}</td> 
			              <td ><span class="label label-success">{{$a->role->name}}</span></td>
			              <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($a->created_at))->diffForHumans() }}</span></td>
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