@extends('new')
@section('style')
    <link href="{{ asset('/css/demo_page.css') }}" />
    <link href="{{ asset('/css/demo_table.css') }}" />
    <link href="{{ asset('/css/DT_bootstrap.css') }}" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                @include('common/menucategory')
            </div>
            <div class="col-md-9">
            <section class="panel">

                <div class="panel-body">
                    @include('errors_messages')
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="example">
                            <thead>
                            <th>{{trans('shop.id')}}</th>
                            <th>{{ Lang::get('app.Name')}}</th>
                            <th></th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($attributes as $attr)
                                <tr data-link="row" class="rowlink">
                                    <td>{{ $attr->id}}</td>
                                    <td>{{ $attr->name }}</td>
                                    <td>
                                        {!! link_to_route('editcatattributes',trans('shop.Edit'), array($attr->id), array('class' => 'btn btn-success btn-xs col-md-3')) !!}
                                    </td>
                                    <td>
                                        {!! Form::open(array('method' => 'DELETE', 'route' => array('delete_attributes', $attr->id))) !!}
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
                    $('#example').dataTable({
                        "iDisplayLength": 500,
                    });
                } );
            </script>
@endsection