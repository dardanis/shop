
<style>
    .selected_category{
        color:#E28D33;
    }
</style>
<ul class="toplinks">
    <li><a href="/viewprofile" class="">Accueil</a></li>
    <li><a href="/myshop" class="myshop">Shop</a></li>
    <li><a href="{{action('ProfileController@showImage')}}">Photos</a></li>
    <li><a href="{{action('ProfileController@showVideo')}}">Videos</a></li>

</ul>
<p class="text-green-15 right" style="">
    {{--<a href="#" class="text-green-15 right" style="padding-left: 10px;text-decoration:none;" id="show-offer-create">--}}
        {{--{{ Lang::get('app.Ajouter un titre') }} +--}}
    {{--</a>--}}

</p>

<?php

?>


