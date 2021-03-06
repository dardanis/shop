


            <?php $counter=-1;?>
                    <?php

                $attributes = \Illuminate\Support\Facades\DB::table('attributes')->where('category_id', '=', $category_id)->where('group_id','=',$group_id)->get();
                $attributes_lists=array();
                foreach($attributes as $a){
                    $attributes_lists = \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=', $a->id)->get();

                }
                    $id="";
                $product_attributes = \Illuminate\Support\Facades\DB::table('product_attributes')->where('product_id', '=',$id)->get();
                $categories=\App\Category::with('translations','subcategories')->whereHas('products', function($q){
                    $q->where('status','!=',0);
                })->get();?>
            <?php foreach($attributes as $a)
            {?>

            <?php $attribute_id="";?>

            <?php if($a->gui_type == "textbox" && $a->data_type=="string")
            {?>
            <?php  $product_attributes_text = \Illuminate\Support\Facades\DB::table('product_attributes')->where('attribute_id', '=',$a->id)->where('product_id','=',$id)->get();?>

            <?php $value_text="";?>

            <?php foreach($product_attributes_text as $pat){?>
                                            <?php $value_text=$pat->value;?>
                                    <?php }?>
            <div class="form-group">
                <div class="col-sm-2 col-sm-2 control-label"><?php echo $a->name; ?></div>
                <div class="col-sm-3">
                    {!! Form::text('name', $value_text, array('class' => 'form-control', 'placeholder' => 'Please insert Name...','name'=>"text_attribute[$a->id]")) !!}
                </div>

            </div>
            <?php } ?>
            <?php if($a->gui_type == "textbox" && $a->data_type=="datetime")
            {?>
            <?php  $product_attributes_text = \Illuminate\Support\Facades\DB::table('product_attributes')->where('attribute_id', '=',$a->id)->where('product_id','=',$id)->get();?>

            <?php $value_text="";?>

            <?php foreach($product_attributes_text as $pat){?>
                                            <?php $value_text=$pat->value;?>
                                    <?php }?>
            <div class="form-group">
                <span style="float:left;margin-left:10px;"><?php echo $a->name; ?></span>
                <div class="col-sm-3" style="padding:0px;">

                    <div class="input-group date form_datetime col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                        {!! Form::text('datetime', $value_text, array('class' => 'form-control', 'placeholder' => '','name'=>"text_attribute[$a->id]",'id'=>'datepicker')) !!}

                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
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

            <div class="form-group">
                <span style="float:left;margin-left:10px;"><?php echo $a->name; ?></span>
                <div class="col-sm-3" style="padding:0px;">
                    <ul>
                        <?php foreach($attributes_lists1 as $al)
                        {?>

                        <?php if($al->item_value==$value_radio_checked && $al->parent_attribute_id==$attribute_radio_checked){?>
                        <li><input type="radio" name="radio_attribute[<?php echo $al->parent_attribute_id;?>]" value="<?php echo $al->item_value;?>" checked /><span class="radio-chk-text" style="padding-left:5px;">><?php echo $al->item_value;?></span></li>
                        <?php } else { ?>
                        <li><input type="radio" name="radio_attribute[<?php echo $al->parent_attribute_id;?>]" value="<?php echo $al->item_value;?>" /><span class="radio-chk-text" style="padding-left:5px;">><?php echo $al->item_value;?></span></li>
                        <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php } ?>
            <?php  $attributes_lists1 = \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=', $a->id)->get();?>

            <?php if($a->gui_type == "checkbox" && $a->data_type=="list")
            {?>

            <div class="form-group">
                <div class="col-md-2">
                 <span style="float:left;margin-left:10px;"><?php echo $a->name; ?></span>
                </div>
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
            <div class="form-group">
                <div class="col-md-2">
                    <span style="float:left;margin-left:10px;"><?php echo $a->name; ?></span>
                </div>
                <div class="col-sm-3" >
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
            </div>
            <?php } ?>
            <?php }?>
            <?php $categoryProduct = \Illuminate\Support\Facades\DB::table('products')->where('id', '=',$id)->get();?>
            <?php foreach($categoryProduct as $cp){?>
                        <?php $category_id=$cp->category_id;?>


                        <?php }?>
            <?php $categoryattribute=\Illuminate\Support\Facades\DB::table('attributes')->where('category_id', '=',$category_id)->get();?>

            <?php if(sizeof($categoryattribute)>0){?>


            <?php } else{?>
            <h2>{{ Lang::get("app.There are no extra fields available")}}!!!</h2>
            <?php } ?>



