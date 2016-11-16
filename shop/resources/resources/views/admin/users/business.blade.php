@extends('new')

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
                {{trans('shop.business_users')}} {!! link_to_route('create_users', trans('shop.add_user'), array(), array('class' => 'btn btn-primary btn-xs')) !!}
            </header>
            <div class="panel-body">
                  <div class="adv-table">
                      <table  class="display table table-bordered table-striped" id="example">
                        <thead>
                        <tr>
                            <th>{{trans('shop.id')}}</th>
                            <th>{{trans('shop.username')}}</th>
                            <th>{{trans('shop.email')}}</th>
                            <th>{{trans('shop.role')}}</th>
                            <th>{{trans('shop.created_at')}}</th>
                            <th>{{trans('shop.subscription')}}</th>
                            <th>{{trans('shop.subscrition_end')}}</th>
                            <th>{{trans('shop.edit')}}</th>
                            <th>{{trans('shop.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $u)
                       <tr >
                          <td>{{$u->id}}</td>
                          <td >{{$u->username}}</td>
                          <td >{{$u->email}}</td>
                          <td ><span class="label label-success">{{$u->role->name}}</span></td>
                          <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($u->created_at))->diffForHumans() }}</span></td>
                          <td>{{$u->stripe_plan}}</td>
                          <td>{{$u->subscription_ends_at}}</td>
                          <td >{!! link_to_route('edit_users', trans('shop.edit'), array($u->name), array('class' => 'btn btn-warning btn-xs')) !!}</td>
                          <td >
                            {!! Form::open(array('method' => 'DELETE', 'route' => array('admin.users.delete', $u->id))) !!}
                            {!! Form::submit(trans('shop.delete'), array('class' => 'btn btn-danger btn-xs')) !!}
                            {!! Form::close() !!}
                          </td>
                        </tr>
                        @endforeach
                        </tfoot>
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