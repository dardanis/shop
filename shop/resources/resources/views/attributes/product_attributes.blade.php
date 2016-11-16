
@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('common/breadcrumbs')
    </div>
    <div class="col-md-3 profile-left">
        @include('common.left_myaccount')
    </div>
    <?php $attributes = \Illuminate\Support\Facades\DB::table('attributes')->where('category_id', '=', $product->category_id)->get();?>
    <div class="col-md-9">

        <?php if(sizeof($attributes)>0){?>
            <div class="row" style="margin-bottom:20px;">
                <ul class="progressbar">
                    <li class="completed"><a href="/edit/<?php echo $slug;?>/<?php echo $id;?>">{{ Lang::get('app.Basic Info') }}</a></li>
                    <li class="completed"><a href="/product/product_attributes/<?php echo $slug;?>/<?php echo $id;?>" style="color:#E28D33 !important;">{{ Lang::get('app.Extra Info')  }}</a></li>
                    <li class="completed"><a href="/product/images/<?php echo $slug;?>/<?php echo $id;?>" >{{ Lang::get('app.Gallery') }}</a></li>
                    <li class="completed"><a href="/product/create/adress/<?php echo $slug;?>/<?php echo $id;?>">{{ Lang::get('app.Adress') }}</a></li>

                </ul>
            </div>
            <?php } else {?>
                <div class="row" style="margin-bottom:20px;">
                    <ul class="progressbar">
                        <li class="completed">{{ Lang::get('app.Basic Info') }}</li>
                        <li class="active">{{ Lang::get('app.Extra Info')  }}</li>
                        <li>{{ Lang::get('app.Gallery') }}</li>
                        <li>{{ Lang::get('app.View Item') }}</li>
                    </ul>
                </div>
            <?php } ?>
    <div class="row profile-products" style="margin-top:20px;">
<?php $groupformname= \Illuminate\Support\Facades\DB::table('group_form_namings')->where('category_id', '=',$product->category_id)->get();?>

{!! Form::open(['url' => route("add_p",array($slug,$id)), 'class' => 'form-horizontal', 'files'=>true, 'id'=>'real-dropzone']) !!}

<input type="hidden" id="token" value="{{ csrf_token() }}">
<?php foreach($groupformname as $gfn){?>


    <h3><?php echo $gfn->group_name;?></h3><br/>
    <?php $group_id=$gfn->id;?>
    <div class="col-md-12">
        <?php $attributes = \Illuminate\Support\Facades\DB::table('attributes')->where('category_id', '=', $product->category_id)->where('group_id','=',$group_id)->get();?>


        <?php $counter=-1;?>
        <?php foreach($attributes as $a)
        {?>

        <?php $attribute_id="";?>

        <?php if($a->gui_type == "textbox" && $a->data_type=="string")
        {?>
        <?php  $product_attributes_text = \Illuminate\Support\Facades\DB::table('product_attributes')->where('attribute_id', '=',$a->id)->where('product_id','=',$product->id)->get();?>

        <?php $value_text="";?>

        <?php foreach($product_attributes_text as $pat){?>
                                            <?php $value_text=$pat->value;?>
                                    <?php }?>

            <div class="col-sm-1 col-md-1 control-label"><?php echo $a->name; ?></div>
            <div class="col-sm-3">
                {!! Form::text('name', $value_text, array('class' => 'form-control', 'placeholder' => "Please insert $a->name",'name'=>"text_attribute[$a->id]")) !!}<br/>
            </div>

        <?php } ?>
        <?php if($a->gui_type == "textbox" && $a->data_type=="datetime")
        {?>
        <?php  $product_attributes_text = \Illuminate\Support\Facades\DB::table('product_attributes')->where('attribute_id', '=',$a->id)->where('product_id','=',$id)->get();?>

        <?php $value_text="";?>

        <?php foreach($product_attributes_text as $pat){?>
                                            <?php $value_text=$pat->value;?>
                                    <?php }?>

            <div class="col-sm-1 col-md-1 control-label"><?php echo $a->name; ?></div>
            <div class="col-sm-3" style="padding:0px;">

                <div class="input-group date form_datetime col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    {!! Form::text('datetime', $value_text, array('class' => 'form-control', 'placeholder' => '','name'=>"text_attribute[$a->id]",'id'=>'datepicker')) !!}

                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>


        </div>
        <?php } ?>
        <?php if($a->gui_type == "radio" && $a->data_type=="list")
        {?>

        <?php  $attributes_lists1 = \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=', $a->id)->get();?>
        <?php  $product_attributes_radio = \Illuminate\Support\Facades\DB::table('product_attributes')->where('attribute_id', '=',$a->id)->where('product_id','=',$id)->get();?>
        <?php $value_radio_checked="";?>

        <?php foreach($product_attributes_radio as $par){?>
                                            <?php  $value_radio_checked=$par->value;?>
                                            <?php  $attribute_radio_checked=$par->attribute_id;?>
                                            <?php }?>


            <div class="col-sm-1 col-md-1 control-label"><?php echo $a->name; ?></div>
            <div class="col-sm-3" style="padding:0px;">
                <ul>
                    <?php foreach($attributes_lists1 as $al)
                    {?>

                    <?php if($al->item_value==$value_radio_checked && $al->parent_attribute_id==$attribute_radio_checked){?>
                    <li><input type="radio" name="radio_attribute[<?php echo $al->parent_attribute_id;?>]" value="<?php echo $al->item_value;?>" checked /><span class="radio-chk-text" style="padding-left:5px;"><?php echo $al->item_value;?></span></li>
                    <?php } else { ?>
                    <li><input type="radio" name="radio_attribute[<?php echo $al->parent_attribute_id;?>]" value="<?php echo $al->item_value;?>" /><span class="radio-chk-text" style="padding-left:5px;"><?php echo $al->item_value;?></span></li>
                    <?php } ?>
                    <?php } ?>
                </ul>
            </div>

        <?php } ?>
        <?php  $attributes_lists1 = \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=', $a->id)->get();?>

        <?php if($a->gui_type == "checkbox" && $a->data_type=="list")
        {?>


            <div class="col-sm-1 col-md-1 control-label"><?php echo $a->name; ?></div>
            <div class="col-sm-3" style="padding:0px;">
                <ul>
                    <?php foreach($attributes_lists1 as $al)
                    {?>

                    <?php $counter++;?>
                    <?php  $product_attributes_checkbox = \Illuminate\Support\Facades\DB::table('product_attributes')->where('attribute_id', '=',$a->id)->where('product_id','=',$id)->get();?>
                    <?php $value_checkbox_checked="";?>
                    <?php $checked="";?>
                    <?php foreach($product_attributes_checkbox as $par){?>

                                            <?php    $value_checkbox_checked=$par->value;?>
                                            <?php  $attribute_checkbox_checked=$par->attribute_id;?>
                                            <?php if($al->item_value==$value_checkbox_checked && $al->parent_attribute_id==$attribute_checkbox_checked){?>
                                                        <?php   $checked="checked";?>
                                            <?php } ?>
                                            <?php }?>

                    <li style="list-style:none"><input type="checkbox" name="checkbox_attribute[<?php echo $counter;?>][attribute_value]" value="<?php echo $al->item_value;?>" <?php echo $checked;?> /><span class="radio-chk-text" style="padding-left:5px;"><?php echo $al->item_value;?></span></li>
                    <input type="hidden" name="hidden_checkbox_attribute[<?php echo $counter;?>][attribute_id]" value="<?php echo $al->parent_attribute_id;?>"/>

                    <?php } ?>
                </ul>
            </div>

        <?php } ?>

        <?php if($a->gui_type == "dropdown" && $a->data_type=="list")
        {?>

        <?php  $attributes_lists1 = \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=', $a->id)->get();?>
        <?php  $product_attributes_select= \Illuminate\Support\Facades\DB::table('product_attributes')->where('attribute_id', '=',$a->id)->where('product_id','=',$id)->get();?>
        <?php $value_select_checked="";?>
        <?php $attribute_select_checked="";?>

        <?php foreach($product_attributes_select as $pas){?>
                                            <?php  $value_select_checked=$pas->value;?>
                                            <?php  $attribute_select_checked=$pas->attribute_id;?>
                                            <?php }?>
        <?php if($a->name=="Marke"){?>

            <div class="col-sm-1 col-md-1 control-label"><?php echo $a->name; ?></div>
            <div class="col-sm-3" style="padding:0px;">
                <select class="form-control" name="select_attribute[<?php echo $a->id;?>]" id="marke">
                    <?php if(sizeof($product_attributes_select)>0){?>

                                    <?php } else {?>
                    <option>Select Item</option>
                    <?php } ?>
                    <?php foreach($attributes_lists1 as $al)
                    {?>
                    <?php if($al->item_value==$value_select_checked && $al->parent_attribute_id==$attribute_select_checked){?>

                    <option selected><?php echo $al->item_value;?></option>
                    <?php } else { ?>

                    <option><?php echo $al->item_value;?></option>
                    <?php } ?>

                    <?php } ?>
                </select>
            </div>

        <?php } else if ($a->name=="Model"){ ?>

            <div class="col-sm-1 col-md-1 control-label"><?php echo $a->name; ?></div>
            <div class="col-sm-3" style="padding:0px;">
                <select class="form-control" name="select_attribute[<?php echo $a->id;?>]" id="model">
                    <?php if(sizeof($product_attributes_select)>0){?>

                                    <?php } else {?>
                    <option>Select Item</option>
                    <?php } ?>
                    <?php foreach($attributes_lists1 as $al)
                    {?>
                    <?php if($al->item_value==$value_select_checked && $al->parent_attribute_id==$attribute_select_checked){?>

                    <option selected><?php echo $al->item_value;?></option>
                    <?php } else { ?>

                    <option><?php echo $al->item_value;?></option>
                    <?php } ?>

                    <?php } ?>
                </select>
            </div>

        <?php } else { ?>

            <div class="col-sm-1 col-md-1 control-label"><?php echo $a->name; ?></div>
            <div class="col-sm-3" style="padding:0px;">
                <select class="form-control" name="select_attribute[<?php echo $a->id;?>]">
                    <?php if(sizeof($product_attributes_select)>0){?>

                                    <?php } else {?>
                    <option>Select Item</option>
                    <?php } ?>
                    <?php foreach($attributes_lists1 as $al)
                    {?>
                    <?php if($al->item_value==$value_select_checked && $al->parent_attribute_id==$attribute_select_checked){?>

                    <option selected><?php echo $al->item_value;?></option>
                    <?php } else { ?>

                    <option><?php echo $al->item_value;?></option>
                    <?php } ?>

                    <?php } ?>
                </select>
            </div>

        <?php } ?>
        <?php } ?>
        <?php }?>
        <?php $categoryProduct = \Illuminate\Support\Facades\DB::table('products')->where('id', '=',$id)->get();?>
        <?php foreach($categoryProduct as $cp){?>
                        <?php $category_id=$cp->category_id;?>


                        <?php }?>

    </div>




</div>



<?php } ?>
            <?php $categoryattribute=array();?>
            <?php $categoryattribute=\Illuminate\Support\Facades\DB::table('attributes')->where('category_id', '=',$product->category_id)->get();?>

        <?php if(sizeof($categoryattribute)==0){?>
                <p>{{ Lang::get('app.There are no attributes to fill up') }}</p>
            <?php }?>
        </div>
    <br/>
    <div class="col-md-offset-6 col-md-6">
        <div class="form-group">
            <div class="col-md-6">
                <a href="/profile" class="btn btn-default btn-default-links">{{ Lang::get('app.Cancel') }}</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">
                    {{ Lang::get('app.Next') }}
                </button>
            </div>
        </div>
    </div>

{!! Form::close() !!}
@stop






<link  media="screen" rel="stylesheet" href="{{ asset('/css/bootstrap-datetimepicker.css') }}">
<link  media="screen" rel="stylesheet" href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}">



<style>
    input[type=radio], input[type=checkbox] {
    width:15px;  height:15px;
    }
</style>