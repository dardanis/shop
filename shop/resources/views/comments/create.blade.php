<div class="row profile-products">
    <div class="col-md-12">
        <div class="panel-body" style="padding: 0px;">
            <?php if(isset($_GET['user_id'])){?>
                <?php $user_id=$_GET['user_id'];?>
                <form class="form-horizontal" role="form" method="POST" action='{{ url("/comments/storecomments?user_id=$user_id") }}' enctype="multipart/form-data">
                <?php }else {?>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/comments/storecomments?') }} " enctype="multipart/form-data">
                <?php } ?>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" name="comment" class="form-control" placeholder="Put a comment here"/>
                <input type="hidden" name="offer_id" value="<?php echo $o->id;?>"/>
                <div class="col-sm-6 col-sm-offset-6" style="margin-right:20px;margin-top: 20px;">
                    <button type="submit" class="btn btn-success">
                        {{ Lang::get('app.Comment') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
