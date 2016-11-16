@extends('new')
<?php foreach($type as $t){?>
                            <?php $type_name=$t->name;?>
                            <?php $alias=$t->alias;?>
                            <?php $id=$t->id;?>
                            <?php $sort_order=$t->sort_order;?>
                            <?php } ?>
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                @include('common/menutype',array("type_name"=>$type_name,"alias"=>$alias,"id"=>$id))
            </div>
            <div class="col-md-9">
                <section class="panel">
                    <header class="panel-heading">
                       Areas on  <?php echo $alias;?> type
                    </header>
                    <div class="panel-body">
                        @include('errors_messages')

                        <form class="form-horizontal" role="form" method="POST" action="{{ url("/areatypessave/$alias/$id") }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <?php $count=0;?>
                            <?php foreach($areas as $area){?>
                            <?php $count++;?>
                            <input style="margin-right:10px;margin-bottom:20px;" type="checkbox" name="areaname[]" value="<?php echo $area->area_id;?>"><?php echo $area->area_name;?><br/>
                            <?php }?>



                            <div class="col-sm-1 col-sm-offset-6" style="margin-right:20px;">
                                <button type="submit" class="btn btn-primary">
                                    Save Areas
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop