@extends('new')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                  Add Form Name

                </header>
                <div class="panel-body">
                    {!! link_to_route('formnameadd', Lang::get('app.Add Form Name'),'', array('class' => 'btn btn-success btn-xs')) !!}
                    @include('errors_messages')
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="example">
                            <thead>
                            <th>{{Lang::get('app.id')}}</th>
                            <th>{{lang::get('app.Name')}}</th>
                            <th>{{Lang::get('app.Category')}}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($groupname as $s)

                                <tr >
                                    <td>{{$s->id}}</td>
                                    <td >{{$s->group_name}}</td>
                                    <?php  $category_id=$s->category_id;?>
                                    <?php $categoryid=\App\Category::whereHas('translations', function($q) use ($category_id)
                                    {
                                        $q->where('category_id', '=',$category_id);

                                    })->get();?>
                                    <td >
                                    <?php foreach($categoryid as $c){?>
                                    <?php echo $c->name;?>
                                    <?php } ?>
                                    </td>
                                    <td><span class="label label-info">{{ Carbon::createFromTimestamp(strtotime($s->created_at))->diffForHumans() }}</span></td>
                                    <td>{!! link_to_route('formnameedit', trans('shop.edit'), array($s->id), array('class' => 'btn btn-warning btn-xs')) !!}</td>
                                    <td>
                                        {!! Form::open(array('method' => 'DELETE', 'route' => array('formnamedelete', $s->id))) !!}
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