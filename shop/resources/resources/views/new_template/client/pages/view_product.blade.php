<?php $template="";?>
        <?php if(isset($_GET['template'])){?>
        <?php $template=$_GET['template'];?>
<?php } ?>

<?php if($template=="usetemplate"){?>

@include('new_template.client.pages.productpartials.viewproduct_with_template')

<?php } else if($template=="secondsteptemplate"){?>
@include('new_template.client.pages.productpartials.viewproduct_with_secondtemplate')
<?php } else {?>
@include('new_template.client.pages.productpartials.viewproduct_no_template')
        <?php } ?>
