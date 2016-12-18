<!DOCTYPE html>
<html lang="en">
<head>
    @include('new_template.client.includes.head')

</head>

<body>


<header>

    @include('new_template.client.includes.header')


</header>

<div class="container">
    @yield('content')
</div>

<!-- include js files -->



</body>
</html>
<?php $detect = new Mobile_Detect;?>
<?php if($detect->isMobile() || $detect->isTablet()){?>
<style>
    header{
        height: 450px;
    }
    .searchdistance{
        padding-bottom: 20px;
    }
    .btn-location{
        width:10%;

    }
    .seach-location{
        width:60%;
    }
    .text-green-15{
        float: left;
        margin-top: 10px;
        margin-left: 10px;
    }
    .profile-left{
        padding-left: 0px;
        padding-right:0px;
    }
    .user-profile-top{
        padding-bottom: 20px;
    }
    .no-padding{
        padding-left: 0px !important;
    }
    .main-content{
        background:white;
        width: 100%;
        height: 400px;
    }
    .navbar-nav{
        margin:0px;
    }
    .navbar-right .open{
        background: #e5dede;
        color: black;
    }
</style>
<?php } else {?>
<style>
    .navbar-header{
        height:10px;
    }
    header{
        height: 174px;
    }
    .profile-left{
        padding-left: 0px;

    }
    .main-content{
        background:white;
        height:137px;
        width: 100%;

    }
</style>
<?php } ?>

<script>
    $(function() {
        $('#locale').change(function() {
            this.form.submit();
        });
    });

</script>

<style>
    .usernav{
        padding-top: 10px;
    }

</style>
