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
                    Translations {!! link_to_route('translation_add', 'Add Translation', array(), array('class' => 'btn btn-primary btn-xs')) !!}
                </header>
                <div class="panel-body">
                    @include('errors_messages')
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="example">
                            <thead>
                            <th>ID</th>
                            <th>Label</th>
                            <th>Description</th>
                            <th>DE</th>
                            <th>EN</th>
                            <th>FR</th>
                            <th>Date Created</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </thead>
                            <tbody>
                            @foreach($translation as $t)
                                <tr data-link="row" class="rowlink">
                                    <td>{{$t->id}}</td>
                                    <td>{{$t->label}}</td>
                                    <td>{{$t->description}}</td>
                                    <td>{{$t->de}}</td>
                                    <td>{{$t->en}}</td>
                                    <td>{{$t->fr}}</td>
                                    <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($t->created_at))->diffForHumans() }}</span></td>

                                    <td>{!! link_to_route('translation_edit', trans('shop.edit'), array($t->id), array('class' => 'btn btn-warning btn-xs')) !!}</td>

                                    <td>
                                        {!! Form::open(array('method' => 'DELETE', 'route' => array('translation_delete', $t->id))) !!}
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