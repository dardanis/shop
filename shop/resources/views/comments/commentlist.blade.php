
<?php         $comments=\App\Comments::where('offer_id','=',$o->id)->get();?>
<?php if(sizeof($comments)>0){?>
<?php foreach($comments as $c){?>
        <div class="col-md-12">
<?php  $user=\App\User::where('id','=',$c->user_id)->get()->first();?>
<img src="{{$user->profile}}" alt="" id="preview_profile" src="#" style="width:50px;height:50px;float:left;margin-right: 10px;" />
    <p>
        <span style="" class="user-commented"><?php echo $user->name;?> <?php echo $user->lastname;?></span><br/>
        <span class="comment-date"><?php echo $c->created_at; ?></span>
      </p>
        </div>
<div class="col-md-12 user-comment">
  <span class="comment-p"><?php echo $c->comment;?></span>
</div>
<?php } ?>
<?php } ?>
