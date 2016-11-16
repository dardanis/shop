@extends('new')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{trans('shop.subscription_plans')}} {!! link_to_route('plan_add', 'Add Plan', array(), array('class' => 'btn btn-primary btn-xs')) !!}
            </header>
            <div class="panel-body">
                @include('errors_messages')
                  <div class="adv-table">
                      <table  class="display table table-bordered table-striped" id="example2">
                        <thead>
                        <tr>
                            <th>{{trans('shop.id')}}</th>
                            <th>{{trans('shop.name')}}</th>
                            <th>{{trans('shop.amount')}}</th>
                            <th>{{trans('shop.interval')}}</th>
                            <th>{{trans('shop.edit')}}</th>
                            <th>{{trans('shop.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plans->data as $plan)
                       <tr >
                        <td >{{$plan->id}}</td>
                        <td >{{$plan->name}}</td>
                        <td ><label class="label label-default">{{$plan->amount/100}}</label></td>
                        <td ><label class="label label-default">{{$plan->interval}}</label></td>
                        <td>{!! link_to_route('edit_plans', trans('shop.edit'), array($plan->id), array('class' => 'btn btn-warning btn-xs')) !!}</td>
                          <td><a class="delete-object"
                             href="#"
                             data-toggle="modal"
                             data-href="{!! action('StripeController@destroy', $plan->id) !!}"
                             data-href-target="#delete-object"
                             data-target=".delete-modal">
                              <i class="fa fa fa-trash-o"></i> &nbsp; Delete
                          </a></td>
                        </tr>
                        @endforeach
                        </tfoot>
                      </table>
                  </div>
            </div>
        </section>
    </div>
        <div class="modal fade delete-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"/>
                    <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Warning!!!</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this plan?</p>
                </div>
                <div class="modal-footer">
                    <form id="delete-form" method="POST" action="{!! action('StripeController@destroy', '*-*') !!}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-danger" value="YES"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
  <script src="{{ asset('/js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('/js/DT_bootstrap.js') }}"></script>
  <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example2').dataTable( {
                  
              } );
          } );
      </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('a.delete-object').click(function () {
                $('#delete-form').attr('action', $(this).attr('data-href'));
            });
        });
    </script>
@endsection 