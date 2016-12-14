<div class="col-md-2 col-sm-312 col-xs-12 image-user">
    <?php if($user->profile == ""){?>
    <img src="images/profile-default.png" class="">
    <?php } else {?>
    <img src="/img/users/{!! $user->id !!}/{!! $user->profile!!}"/>
    <?php } ?>
    <form method="post"
          action="{{action('ProfileController@updateProfileImage', $user->id)}}"
          id="image-upload-form"
          class="col-xs-12"
          enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>

        <div class="fullRelLeft upload-images-container">
            <span class="btn btn-default btn-file">Browse <input id="photo" type="file" name="image"></span>
            <input id="image-upload-form" type="submit" class="btn btn-primary hidden"/>
        </div>
    </form>
</div>
<div class="col-md-3 col-sm-3 col-xs-3">
    <h2><?php echo $user->name;?><span style="padding-left: 10px;"><?php echo $user->lastname;?></span></h2>

    <p class="user-type">Commercial</p>
    <table style="width:100%;">
        <tbody>
        <tr>
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
        </tbody>
    </table>
    <br>

</div>
<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
</style>
<script>
    $('#photo').change(function () {
        $('#image-upload-form').submit();
    });
</script>