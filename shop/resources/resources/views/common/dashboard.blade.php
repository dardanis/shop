
<?php $user = App\User::find(Auth::user()->id);
$user_role = $user['role']['name']; ?>
@extends('new_template.client.layouts.default')

@section('content')
    <div class="container">

<div class="page-content ">
    <div class="main container">

    <div class="clearfix"></div>

    <div class="col-md-6 col-xs-12">
        <ul class="dashboard-link-list">
            <li><a href="{{ route('myprofile') }}" title="My Profile"><i class="fa fa-user"></i><span>{{ Lang::get('app.My Profile')}}</span></a></li>
            <li><a href="{{ url('client/c_products') }}" title="My Products"><i class="fa fa-list"></i><span>{{ Lang::get('app.My Products')}}</span></a></li>
            <li><a href="{{ url('client/add/product') }}" title="Add Product"><i class="fa fa-plus"></i><span>{{ Lang::get('app.Add Product')}}</span></a></li>
            <li><a href="{{ url('wishlist') }}" title="My Wishlist"><i class="fa fa-heart"></i><span>{{ Lang::get('app.My Wishlist')}}</span></a></li>
            <li><a href="{{ url('alladresess') }}" title="My Adresses"><i class="fa fa-heart"></i><span>{{ Lang::get('app.My Adresess')}}</span></a></li>
        </ul>
    </div>
    <div class="col-md-3 col-xs-12">
        <div class="profile-image-box text-center">

            <img src="{{$user->profile}}" alt="" id="preview_profile" src="#" style="max-height: 190px;max-width: 173px;" class="" />
            <a href="{{ route('myprofile') }}" class="btn btn-primary" style="margin-right: 0px;border-radius:0px;max-width:180px;margin:0 auto;">
                {{ Lang::get('app.Profile') }} </a>
            <?php $email = Auth::user()->email;?>
            <?php $username=Auth::user()->username;?>
            <?php $name=Auth::user()->name;?>
            <?php $lastname=Auth::user()->lastname;?>
            <p><?php echo $name;?><span style="padding-left: 5px"><?php echo $lastname; ?></span></p>
            <p><?php echo $email;?>, <?php echo $username; ?></p>
        </div>
    </div>
</div>
    </div>
        </div>
    @endsection
<style>

    .profile-image-box a{
        display:block;


    }
    .profile-image-box{
        border:1px solid #dedede;
        padding:20px;
        margin:30px 20px;;
    }
    .profile-image-box a img{
        min-hegiht:200px
    }
    ul.dashboard-link-list{
        margin-top:30px;
    }
    ul.dashboard-link-list li {
        overflow: hidden;
        padding-bottom: 10px;
    }

    ul.dashboard-link-list li a {
        display: block;
        overflow: hidden;
        font: 600 16px/20px "Open Sans", sans-serif;
        color: #555454;
        text-shadow: 0px 1px white;
        text-transform: uppercase;
        text-decoration: none;
        position: relative;
        border: 1px solid;
        border-color: #cacaca #b7b7b7 #9a9a9a #b7b7b7;
        background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgi…pZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiIC8+PC9zdmc+IA==');
        background-size: 100%;
        background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #f7f7f7), color-stop(100%, #ededed));
        background-image: -moz-linear-gradient(#f7f7f7, #ededed);
        background-image: -webkit-linear-gradient(#f7f7f7, #ededed);
        background-image: linear-gradient(#f7f7f7, #ededed);
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
    }

    ul.dashboard-link-list li a i {
        font-size: 25px;
        color: #2ba8db;
        position: absolute;
        left: 0;
        top: 0;
        width: 52px;
        height: 100%;
        padding: 10px 0 0 0;
        text-align: center;
        border: 1px solid #fff;
        -moz-border-radius-topleft: 4px;
        -webkit-border-top-left-radius: 4px;
        border-top-left-radius: 4px;
        -moz-border-radius-bottomleft: 4px;
        -webkit-border-bottom-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    ul.dashboard-link-list li a span {
        display: block;
        padding: 13px 15px 15px 17px;
        overflow: hidden;
        border: 1px solid;
        margin-left: 52px;
        border-color: #fff #fff #fff #c8c8c8;
        -moz-border-radius-topright: 5px;
        -webkit-border-top-right-radius: 5px;
        border-top-right-radius: 5px;
        -moz-border-radius-bottomright: 5px;
        -webkit-border-bottom-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

</style>