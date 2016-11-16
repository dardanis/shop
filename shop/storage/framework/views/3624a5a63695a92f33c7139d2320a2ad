
<style>
    .selected_category{
        color:#E28D33;
    }
</style>
<?php if(isset($_GET['user_id'])){?>
<?php $user_id=$_GET['user_id'];?>
<?php }  else {?>
<?php    $userprofile = App\User::find(Auth::user()->id);?>
<?php $user_id=$user['id'];?>
<?php }?>
<ul class="toplinks">
    <li><a href="/viewprofile?user_id=<?php echo $user_id;?>" class="basic-top-link">Accueil</a></li>
    <li><a href="/myshop?user_id=<?php echo $user_id;?>" class="myshop">Shop</a></li>
    <li><a href="#">Photos</a></li>
    <li><a href="#">Videos</a></li>

</ul>


