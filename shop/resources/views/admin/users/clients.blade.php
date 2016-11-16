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
                {{trans('shop.client_users')}} {!! link_to_route('create_users', trans('shop.add_user'), array(), array('class' => 'btn btn-primary btn-xs')) !!}
            </header>
            <?php $user=\App\User::find(Auth::user()->id);?>
            <?php $issuperadmin=$user['is_superadmin'];?>
            <div class="panel-body">
                @if( Session::has( 'success' ))
                    <div class="alert alert-success">{{ Session::get( 'success' ) }}</div>
                    @elseif( Session::has( 'warning' ))
                    {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
                @endif
                  <div class="adv-table">
                      <table  class="display table table-bordered table-striped" id="example">
                        <thead>
                        <tr>
                            <th>{{trans('shop.id')}}</th>
                            <th>{{trans('shop.username')}}</th>
                            <th>{{trans('shop.email')}}</th>
                            <th>{{trans('shop.role')}}</th>
                            <th>{{trans('shop.created_at')}}</th>
                            <th>{{trans('shop.edit')}}</th>
                            <th>{{trans('shop.delete')}}</th>
                            <?php if($issuperadmin==1){?>
                            <th>{{ Lang::get('app.Status') }}</th>
                            <?php } ?>
                            <th>{{ Lang::get('app.Receive Emails')}}</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $u)
                            <?php  $user_role=$u['role_id'];?>
                            <?php  $receive_emails=$u['receive_emails'];?>
                       <tr >
                          <td>{{$u->id}}</td>
                          <td >{{$u->username}}</td>
                          <td >{{$u->email}}</td>
                          <td ><span class="label label-success">{{$u->role->name}}</span></td>
                          <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($u->created_at))->diffForHumans() }}</span></td>
                          <td >{!! link_to_route('edit_users', trans('shop.edit'), array($u->name), array('class' => 'btn btn-warning btn-xs')) !!}</td>
                          <td >
                            {!! Form::open(array('method' => 'DELETE', 'route' => array('admin.users.delete', $u->id))) !!}
                            {!! Form::submit(trans('shop.delete'), array('class' => 'btn btn-danger btn-xs')) !!}
                            {!! Form::close() !!}
                          </td>
                           <?php if($user_role==1){?>
                           <td>

                               {!! Form::open(array('method' => 'Patch', 'route' => array('removeadmin', $u->id))) !!}
                               {!! Form::submit(Lang::get('app.Remove as admin'), array('class' => 'btn btn-danger btn-xs')) !!}
                               {!! Form::close() !!}
                           </td>
                           <?php }else { ?>
                           <td >
                               {!! Form::open(array('method' => 'Patch', 'route' => array('isadmin', $u->id))) !!}
                               {!! Form::submit(Lang::get('app.Make admin'), array('class' => 'btn btn-success btn-xs')) !!}
                               {!! Form::close() !!}
                           </td>
                           <?php } ?>
                           <?php if($receive_emails==1){?>
                           <td>
                               {!! Form::open(array('method' => 'Patch', 'route' => array('rmvreceiveemails', $u->id))) !!}
                               {!! Form::submit(Lang::get('app.Remove to Receive emails'), array('class' => 'btn btn-danger btn-xs')) !!}
                               {!! Form::close() !!}
                           </td>
                           <?php }else {?>
                           <td>
                               {!! Form::open(array('method' => 'Patch', 'route' => array('receiveemails', $u->id))) !!}
                               {!! Form::submit(Lang::get('app.Receive emails'), array('class' => 'btn btn-success btn-xs')) !!}
                               {!! Form::close() !!}
                           </td>
                           <?php } ?>
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