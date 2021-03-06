<!DOCTYPE html>
<html lang="en">
<head>
    @include('new_template.client.includes.head')

</head>

<body>


<header class="header-auth">
    @include('new_template.client.includes.header')

</header>

<div class="container">
    <div class="col-md-12 main-div-auth">
    @yield('content')
    </div>
</div>

<!-- include js files -->

<script src="{{ asset('/js/libs/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('/js/libs/jquery-ui-1.10.4.custom.min.js') }}"></script>
<script src="{{ asset('/js/libs/jquery.easing.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('/js/dropzone.js') }}"></script>
<script src="{{ asset('/js/upload.js') }}"></script>
<script src="{{ asset('/js/review.js ') }}"></script>
<script src="{{ asset('/js/photopreview.js ') }}"></script>


</body>
</html>
<?php $detect = new Mobile_Detect;?>
<?php if($detect->isMobile() || $detect->isTablet()){?>
<style>
    header.header-auth{
        height:464px;
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
   header.header-auth{
        height:200px;
    }
    .profile-left{
        padding-left: 0px;

    }
    .main-content{
        background:white;
        height:137px;
        width: 100%;

    }
    .searchcategory .glyphicon {
        height: 0px;
    }
    .search-div .glyphicon {
        color: #E28D33;
        height: 0px;;
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
        padding-top: 20px;
    }
</style>