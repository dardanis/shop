<?php $user = App\User::find(Auth::user()->id);
$user_role = $user['role']['name']; ?>
@extends($user_role=='admin' ? 'new' : 'new_template.client.layouts.user_backend')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                @include('common/subcategorymenu')
            </div>
            <div class="col-md-9">
                <div class="panel">
                    <header class="panel-heading">
                        {{trans('shop.product_attributes')}}
                    </header>
                    <div class="panel-body">
                        {!! Form::open(['url' => route("attributessub",array($sub->slug,$sub->id)), 'class' => 'form-horizontal', 'files'=>true, 'id'=>'real-dropzone']) !!}

                        @include('errors/form')


                        <?php $categoryattributes = \Illuminate\Support\Facades\DB::table('attributes')->where('id', '=', $id)->get();?>

                        <?php $count=0; ?>
                        <?php if(sizeof($categoryattributes)>0){?>

                        <?php foreach($categoryattributes as $ca){?>

                        <?php $count++; ?>
                        <?php   $categoryattributeslist = \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=', $ca->id)->get();?>

                        {!! Form::open(['url' => route("editattributes",array($sub->slug,$sub->id)), 'class' => 'form-horizontal', 'files'=>true, 'id'=>'real-dropzone']) !!}
                                <!-- attribute name edit -->
                        <input type="hidden" name="edit_attribute_name" value="1"/>
                        <div class="form-group">
                            {!! Form::label('name', trans('shop.attribute_name') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-sm-10">
                                {!! Form::text('name', $ca->name, array('class' => 'form-control', 'placeholder' => 'Please insert Name...','name'=>"edit_attribute_name_$ca->id")) !!}
                            </div>
                            <input type="hidden" name="id[]" value="<?php echo $ca->id;?>"/>
                        </div>
                        <!-- end of attribute name -->
                        <!-- input data type -->
                        <div class="form-group">
                            {!! Form::label('data_type', trans('shop.input_data_type') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-sm-10">
                                {!!  Form::select('data_type',[$ca->data_type=>$ca->data_type]+array( 'list'=>'list','integer' => 'integer', 'string' => 'string','datetime' => 'datetime'),'' ,array('class' => 'form-control','id'=>'data-type-edit','name'=>"data_type_$ca->id"))!!}
                            </div>
                        </div>
                        <?php if(sizeof($categoryattributeslist)>0){?>
                        <div class="form-group">
                            <div id="list-attributes_edit">
                                <?php foreach($categoryattributeslist as $al)
                                {?>
                                <div class="otheroptions">
                                    <div class="col-sm-2 col-md-2"></div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Enter values" name="attribute_item_edit_<?php echo $al->id;?>" value="<?php echo $al->item_value; ?>" style="margin-top:10px"/>

                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{"/delete/subattributes/$category->slug/$category->id?attribute_id=$al->id"}}"> <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;margin-top:20px"></span></a>
                                    </div>
                                </div>
                                <?php } ?>
                                <div id="add-dynamic-items_edit_<?php echo $ca->id;?>">
                                </div>
                                <div class="col-md-3">
                                    <input type="button" value="+" id="<?php echo $ca->id;?>" class="btn btn-default btn-list-attributes_edit"/>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                                <!-- end of data type attribute -->
                        <!-- gui type -->
                        <div class="form-group">
                            {!! Form::label('gui_type', trans('shop.gui_type') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-sm-10">
                                {!!  Form::select('gui_type',[$ca->gui_type=>$ca->gui_type]+array( 'textbox' => 'textbox', 'checkbox' => 'checkbox','radio' => 'radio','dropdown'=>'dropdown'),'' ,array('class' => 'form-control','id'=>'gui-type','name'=>"gui_type_$ca->id"))!!}
                            </div>
                        </div>
                        <!-- end of gui type -->
                        <div class="form-group">
                            <div class="col-sm-offset-8">
                                <input type="hidden" id="token" value="{{ csrf_token() }}">

                                <div class="col-md-3">
                                    {!! Form::submit("Save", array('class' => 'btn btn-success')) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! link_to_route('categoriesindex', trans('shop.cancel'), array(), array('class' => 'btn btn-danger admin'))!!}
                                </div>
                            </div>
                        </div>

                        {!! Form::close() !!}

                                <!-- end of div bordered-->
                        <?php }?><!-- end of foreach -->
                        <?php } ?>
                        {!! Form::close() !!}






                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

<style>
    .div-attribute {
        border: 1px solid gray;
        padding: 10px;
        margin-bottom: 30px;
    }
    .otheroptions{
        clear:left;
    }
</style>

@section('scripts')
    <script>
        $(document).ready(function(){

        })
    </script>
@endsection