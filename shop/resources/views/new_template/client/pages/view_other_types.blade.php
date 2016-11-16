<?php $template="";?>
<?php if(isset($_GET['template'])){?>
        <?php $template=$_GET['template'];?>
<?php } ?>

<?php if($template=="usetemplate"){?>

@include('new_template.client.pages.othertypepartials.view_item_with_template')

<?php } else if($template=="secondsteptemplate"){?>
@include('new_template.client.pages.othertypepartials.view_item_no_template_owner')
<?php } else {?>
@include('new_template.client.pages.othertypepartials.view_item_no_template')
<?php } ?>
