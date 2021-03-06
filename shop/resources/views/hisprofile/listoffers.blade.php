<?php if(isset($_GET['user_id'])){?>
            <?php $user_id=$_GET['user_id'];?>
<?php }else{?>
   <?php    $user = App\User::find(Auth::user()->id);?>
  <?php $user_id=$user['id'];?>
<?php } ?>

<?php 	$offers = \App\Offers::whereHas('translations', function ($q) use ($user_id) {
    $q->where('user_id', '=', $user_id);

})->get();?>

<?php foreach($offers as $o){?>
<div class="row profile-products products-div" style="height:auto;margin-bottom:20px;">
    <?php if($o->image_path!=NULL){?>
        <div class="col-md-6">
            <div class="col-md-12">
                <img src="{{ asset($o->image_path) }}" class="img-responsive" style="margin-bottom: 20px;"/>
            </div>
            <div class="col-md-12">

                    <img src="{{$o->user->profile}}" alt="" id="preview_profile" src="#" style="width:50px;height:50px;float:left" />
                    <span class="user-commented"><?php echo $o->user->name;?> <?php echo $o->user->lastname;?></span><br/>
                    <span class="comment-date"><?php echo $o->created_at;?></span>
            </div>
            <div class="col-md-12 offer-description">
                <?php echo $o->description;?>
            </div>
        </div>
    <?php } ?>
    <?php if($o->video!=NULL){?>
    <div class="col-md-6">
        <p>Video Here</p>
    </div>
    <?php } ?>
    <div class="col-md-6">
        @include('comments/commentlist')
        @include('comments/create')
    </div>
</div>

<?php } ?>
