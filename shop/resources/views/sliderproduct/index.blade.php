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
                    Sliders {!! link_to_route('createsliderproduct', 'Add Slider', array(), array('class' => 'btn btn-primary btn-xs')) !!}
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="example">
                            <thead>
                            <th>{{ Lang::get('app.Product') }}</th>
                            <th>{{ Lang::get('app.Created At') }}</th>
                            <th>{{ Lang::get('app.Updated At') }}</th>
                           <th></th>
                            </thead>
                            <tbody>
                            <?php foreach($slider as $sliders){?>
                                <tr data-link="row" class="rowlink">
                                    <td><?php echo $sliders->product_id; ?></td>
                                    <td><?php echo $sliders->created_at; ?></td>
                                    <td><?php echo $sliders->updated_at; ?></td>


                                    <td>
                                        {!! Form::open(array('method' => 'DELETE', 'route' => array('deleteslider', $sliders->id))) !!}
                                        {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>

                        <?php  } ?>
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
                "aaSorting": [[ 2, "desc" ]]
            } );
        } );
    </script>
@endsection