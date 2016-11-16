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
                        Edit Type
                    </header>
                    <div class="panel-body">
                        @include('errors_messages')
                        <?php $type_name="";?>
                        <?php $alias="";?>
                        <?php if(sizeof($type)>0){?>
                        <?php foreach($type as $t){?>
                            <?php $type_name=$t->name;?>
                            <?php $alias=$t->alias;?>
                            <?php $id=$t->id;?>
                            <?php $sort_order=$t->sort_order;?>
                            <?php $header_color=$t->header_color;?>
                             <?php $background_color=$t->background_color;?>
                                <?php $text_color=$t->text_color;?>
                            <?php } ?>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url("/updatetype/$alias/$id") }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            <?php }?>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="name" value="<?php echo $type_name;?>">
                                </div>

                            </div>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Alias*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="alias" value="<?php echo $alias; ?>">
                                </div>

                            </div>
                            <div class="form-group @if($errors->has('sort_order')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Sort Order*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="sort_order" value="<?php echo $sort_order;?>">
                                </div>

                            </div>
                            <div class="form-group @if($errors->has('sort_order')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Header Color*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="header_color" id="header_color" value="<?php echo $header_color;?>">
                                </div>

                            </div>
                            <div class="form-group @if($errors->has('sort_order')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Background Color*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="background_color" id="background_color" value="<?php echo $background_color;?>">
                                </div>

                            </div>

                            <div class="form-group @if($errors->has('sort_order')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Text Color*</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="text_color" id="text_color" value="<?php echo $text_color;?>">
                                </div>

                            </div>
                            <div class="col-sm-1 col-sm-offset-6" style="margin-right:20px;">
                                <button type="submit" class="btn btn-primary">
                                    Edit Type
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop