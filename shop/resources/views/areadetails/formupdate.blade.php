@extends('new')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-9">
                <section class="panel">
                    <header class="panel-heading">
                        Add Areas
                    </header>
                    <div class="panel-body">
                        @include('errors_messages')
                        <?php $area_name="";?>
                        <?php $alias="";?>
                        <?php $description="";?>
                        <?php if(sizeof($type)>0){?>
                        <?php foreach($type as $t){?>
                            <?php $area_name=$t->area_name;?>
                            <?php $alias=$t->area_alias;?>
                            <?php $id=$t->area_id;?>
                            <?php $description=$t->area_description;?>
                            <?php } ?>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url("/updatearea/$alias/$id") }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            <?php }?>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="area_name" value="<?php echo $area_name;?>">
                                </div>

                            </div>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Alias*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="area_alias" value="<?php echo $alias; ?>">
                                </div>

                            </div>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Description*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="area_description" value="<?php echo $description;?>">
                                </div>

                            </div>

                            <div class="col-sm-1 col-sm-offset-6" style="margin-right:20px;">
                                <button type="submit" class="btn btn-primary">
                                    Update Area
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop