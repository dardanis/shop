
<?php $userprofile=array();?>

<?php if(isset($_GET['user_id'])){?>

<?php $userprofile=App\User::find($_GET['user_id']);?>
<?php }  else {?>
<?php    $userprofile = App\User::find(Auth::user()->id);?>
<?php $user_id=$userprofile['id'];?>
<?php }?>
<div class="col-md-2 col-sm-312 col-xs-12 image-user">
    <?php if($userprofile->profile==""){?>
    <img src="images/profile-default.png" class="">
    <?php } else {?>
    <img src="/{{$userprofile->profile}}" />
    <?php } ?>
</div>
<div class="col-md-3 col-sm-3 col-xs-3">
    <h2><?php echo $userprofile->name;?><span style="padding-left: 10px;"><?php echo $userprofile->lastname;?></span></h2>
    <p class="user-type">Commercial</p>
    <table style="width:100%;">
        <tbody><tr>
            <td>
                <span class="glyphicon glyphicon-plus plus-green" aria-hidden="true"></span>
            </td>
            <td class="text-blue-11">
                <a href="#">S'aboner</a>
            </td>
            <td>
                9'132'654
            </td>
        </tr>
        <tr>
            <td>
                <span class="glyphicon glyphicon-plus plus-green" aria-hidden="true"></span>
            </td>
            <td class="text-blue-11">
                <a href="#">Newsfeed</a>
            </td>
            <td>
                9'132'654
            </td>
        </tr>
        </tbody></table>
    <br>

</div>