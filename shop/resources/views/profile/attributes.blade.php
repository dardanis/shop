
<?php $subsub=array();?>
        <?php $attributes=array();?>
<?php if(isset($_GET['subcategory'])){?>
<?php $subsub = \Illuminate\Support\Facades\DB::table('subcategories')->where('parent_sub_category_id', '=', $_GET['subcategory'])->get();?>
<?php $attributes = \Illuminate\Support\Facades\DB::table('attributes')->where('sub_category_id', '=', $_GET['subcategory'])->get();?>
<?php }?>

<?php if(sizeof($attributes)>0){?>

<?php foreach($attributes as $a){?>
<?php if($a->data_type=="list" && $a->gui_type=="checkbox" || $a->gui_type=="dropdown" || $a->gui_type=="radio"){?>
<h2 style="margin-top: 20px;"><?php echo $a->name;?></h2>
<ul style="margin-bottom: 20px;overflow: auto;">
<?php $attributeslist = \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=', $a->id)->get();?>
        <?php foreach($attributeslist as $al){?>
    <li style="width:100%;">
        <input style="width:25px; height:25px;" type="checkbox" value="<?php echo $al->item_value;?>" name="attribute_value[]"/><span style="padding-left:20px;"><?php echo $al->item_value;?></span>
        <?php } ?>
    </li>
</ul><br/>
<?php } ?>
<?php } }?>



