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
                    Types {!! link_to_route('types_create', 'Add Type', array(), array('class' => 'btn btn-primary btn-xs')) !!}
                </header>
                <div class="panel-body">
                    @include('errors_messages')
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="example">
                            <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </thead>
                            <tbody>
                            @foreach($type as $t)
                                <tr data-link="row" class="rowlink">
                                    <td>{{$t->id}}</td>
                                    <td>{{$t->name}}</td>
                                    <td>{{$t->sort_order}}</td>
                                    <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($t->created_at))->diffForHumans() }}</span></td>

                                    <td>{!! link_to_route('edit_type', trans('shop.edit'), array($t->alias,$t->id), array('class' => 'btn btn-warning btn-xs')) !!}</td>

                                    <td>
                                        {!! Form::open(array('method' => 'DELETE', 'route' => array('delete_type', $t->id))) !!}
                                        {!! Form::submit(trans('shop.delete'), array('class' => 'btn btn-danger btn-xs')) !!}
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
        @endsection

        @section('scripts')
            <script src="{{ asset('/js/jquery.dataTables.js') }}"></script>
            <script src="{{ asset('/js/DT_bootstrap.js') }}"></script>
            <script type="text/javascript" charset="utf-8">
                $(document).ready(function() {
                    $('#example').dataTable( {
                        "aaSorting": [[ 2, "desc" ]]
                    } );
                } );
            </script>
@endsection