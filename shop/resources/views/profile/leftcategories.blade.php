<?php $querycategory_id="";?>
<?php if(isset($_GET['cat_id'])){?>
<?php $querycategory_id=$_GET['cat_id'];?>
<?php } ?>

<ul>
<?php foreach($category as $c){?>
     <li style="width:100%;color:#6ADAA2;">

<?php
$category_id=$c->id;
$products=\App\Product::whereHas('translations', function($q) use ($category_id)
{
    $q->where('category_id', '=', $category_id);

})->get();?>
    <a href="#" class="toggle-category" id="<?php echo $c->id;?>" style="color:#6ADAA2;text-decoration: none;font-size:20px;">-</a> <a style="color:#6ADAA2" href="{{ route('productscategory') }}?cat_id=<?php echo $c->id;?>"><?php echo $c->name;?></a><span style="float:right">(<?php echo sizeof($products);?>)</span>
<style>
    .toggle_subcategory{
        display:none;
    }
    #toggle_subcategory_<?php echo $querycategory_id;?>{
        display: block;

    }
</style>
    <ul class="toggle_subcategory" id="toggle_subcategory_<?php echo $c->id;?>" style="padding-left: 20px;">

                <?php $subcategory=\App\Subcategory::whereHas('translations', function($q) use ($category_id)
                {
                    $q->where('category_id', '=', $category_id);

                })->get();?>

                <?php foreach($subcategory as $sc){?>
                <?php $sub_category_id=$sc->id;?>
                        <!-- get all subcategories from main category -- >
                    <?php $productssubcategory=\App\Product::whereHas('translations', function($q) use ($sub_category_id)
                    {
                    $q->where('subcategory_id', '=', $sub_category_id);

                    })->get();?>
                    <!-- get all subsub from sub category -->
                    <?php $subsubcategory=\App\Subcategory::whereHas('translations', function($q) use ($sub_category_id)
                    {
                        $q->where('parent_sub_category_id', '=', $sub_category_id);

                    })->get();?>

                    <!-- if category has products -->
                    <?php if(sizeof($productssubcategory)>0)
                    {?>
                            <?php if(isset($_GET['subcategory'])){?>
                            <!-- if category is selected make it selected -->
                                    <?php if($sc->id==$_GET['subcategory']){?>
                                        <li>
                                            <a class="sub-open" href="{{ route('productscategory') }}?cat_id=<?php echo $c->id;?>&&subcategory=<?php echo $sc->id;?>" style="color:rgb(106, 218, 162);"><?php echo $sc->name;?></a><span style="float:right;">(<?php echo sizeof($productssubcategory);?>)</span>
                                        </li>
                                     <?php } else { ?>
                                              <li style="width:100%;">
                                                <a  href="{{ route('productscategory') }}?cat_id=<?php echo $c->id;?>&&subcategory=<?php echo $sc->id;?>" style="color:rgb(106, 218, 162);"><?php echo $sc->name;?></a><span style="float:right;">(<?php echo sizeof($productssubcategory);?>)</span>
                                            </li>
                                     <?php  }?>
                            <?php } else {?>
                                    <li>
                                        <a href="{{ route('productscategory') }}?cat_id=<?php echo $c->id;?>&&subcategory=<?php echo $sc->id;?>" style="color:rgb(106, 218, 162);"><?php echo $sc->name;?></a><span style="float:right;">(<?php echo sizeof($productssubcategory);?>)</span>
                                    </li>
                                    <?php } ?>
                                        <ul>

                                            <?php foreach($subsubcategory as $ssc)
                                            {?>
                                                <?php $subsub=$ssc->id;?>
                                                <?php $productssubsub=\App\Product::whereHas('translations', function($q) use ($subsub)
                                                {
                                                    $q->where('sub_sub_category_id', '=', $subsub);

                                                })->get();?>
                                                <?php $getsubsub="";?>
                                                <?php if(isset($_GET['subsub'])){?>
                                                            <?php $getsubsub=$_GET['subsub'];?>
                                                        <?php } ?>
                                                <?php if($ssc->id==$getsubsub){?>

                                                <li style="width:100%;padding:0px;">
                                                    <a  class="sub-open" href="{{ route('productscategory') }}?cat_id=<?php echo $c->id;?>&&subcategory=<?php echo $sc->id;?>&&subsub=<?php echo $ssc->id;?>" style="color:rgb(106, 218, 162);"><?php echo $ssc->name;?></a><span style="float:right;">(<?php echo sizeof($productssubsub);?>)</span>
                                                </li>
                                                <?php } else { ?>
                                                <li style="width:100%;padding:0px;">
                                                    <a  href="{{ route('productscategory') }}?cat_id=<?php echo $c->id;?>&&subcategory=<?php echo $sc->id;?>&&subsub=<?php echo $ssc->id;?>" style="color:rgb(106, 218, 162);"><?php echo $ssc->name;?></a><span style="float:right;">(<?php echo sizeof($productssubsub);?>)</span>
                                                </li>
                                                <?php  }?>
                                            <?php }?>
                                        </ul>
                    <?php } ?>
                    <?php } ?>
            </ul>
        </li>

<?php } ?>

</ul>
