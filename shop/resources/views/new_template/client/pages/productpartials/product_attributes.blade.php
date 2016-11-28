<?php $category_id=$product->category_id;?>


<?php if(sizeof($product_attributes)>0){?>
<?php
$rows = 2;
$totalCount = count($product_attributes);
$rowCount = $totalCount / $rows;
$firstList = $product_attributes->slice(0, $rowCount);
$secondList = $product_attributes->slice($rowCount, $totalCount);?>
<table style="float:left">
    <?php $current_attr = "";?>
    <?php $half=0;?>
    <?php $i=0;?>
    <?php $product_attributes2 = $product_attributes;
    foreach($firstList as $pa)
    {

    if($pa->attribute->name != $current_attr)
    {

    $current_attr = $pa->attribute->name;?>
    <tr><td style="padding-right:10px;"><b><?php  echo $pa->attribute->name; ?>:</b></td><?php
        $pa2_arr = array();

        foreach($product_attributes2 as $pa1){
            if($current_attr == $pa1->attribute->name)
                $pa2_arr[] = $pa1->value;
        }?>
        <td><?php echo implode(",", $pa2_arr);?></td>

    </tr>
    <?php

    }

    }?>
</table>

<div class="col-sm-6">
    <table>
        <?php foreach($secondList as $pa)
        {

        if($pa->attribute->name != $current_attr)
        {

        $current_attr = $pa->attribute->name;?>
        <tr><td style="padding-right:10px;"><b><?php  echo $pa->attribute->name; ?>:</b></td><?php
            $pa2_arr = array();

            foreach($product_attributes2 as $pa1){
                if($current_attr == $pa1->attribute->name)
                    $pa2_arr[] = $pa1->value;
            }?>
            <td><?php echo implode(",", $pa2_arr);?></td>

        </tr>
        <?php

        }

        }?>


    </table>
    <?php } else {?>
    <h2>No Specifications yet!!!</h2>
<?php } ?>

</div>