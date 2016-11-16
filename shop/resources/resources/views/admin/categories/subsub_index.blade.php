@extends('new')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    {{$subname}} {!! link_to_route('subsubcat', trans('shop.add_subsubcategory'), array($category,$subid), array('class' => 'btn btn-success btn-xs')) !!}
                </header>
                <div class="panel-body">
                    @include('errors_messages')
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="example">
                            <thead>
                            <th>{{trans('shop.id')}}</th>
                            <th>{{trans('shop.subcategory_name')}}</th>
                            <th>{{trans('shop.created_at')}}</th>
                            <th>{{trans('shop.edit')}}</th>
                            <th>{{trans('shop.delete')}}</th>
                            </thead>
                            <tbody>

                                    @foreach($sub as $s)
                                        <tr >
                                            <td>{{$s->id}}</td>
                                            <td>{{$s->name}}</td>
                                            <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($s->created_at))->diffForHumans() }}</span></td>
                                            <td>{!! link_to_route('edit_sub', trans('shop.edit'), array($s->slug,$s->id), array('class' => 'btn btn-warning btn-xs')) !!}</td>
                                            <td>
                                                {!! Form::open(array('method' => 'DELETE', 'route' => array('deleteSubSubcategory', $s->id))) !!}
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
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/js/DT_bootstrap.js') }}"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#example').dataTable( {
                "iDisplayLength": 500,
            } );
        } );
    </script>
@endsection