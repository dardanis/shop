
@extends('new_template.client.layouts.default')

@section('content')
<?php if(isset($_GET['user_id'])){?>
<?php $user_id=$_GET['user_id'];?>
<?php }  else {?>
<?php    $user = App\User::find(Auth::user()->id);?>
<?php $user_id=$user['id'];?>
<?php }?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('common/breadcrumbs')
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 user-profile-top">
        @include('hisprofile/topuserprofile')

    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 user-profile-top">
        @include('hisprofile/top_links')
    </div>
    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
        <div class="user-profile-categories user-profile-top h2-custom">
            <div class="col-md-12 searchcategory" style="margin-bottom:10px;">
                <div class="form-group" style="margin-top: 20px;">

                    <input type="text" class="form-control seach-keyword" placeholder="keyword" style="width:80%;">


                    <button type="button" class="btn btn-default btn-search">
                        <span class="glyphicon glyphicon-search" style="color:#E28D33"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="user-profile-top h2-custom">
            <div class="user-profile-top h2-custom">
                <h2 style="padding-top:20px;text-align: center;">{{ Lang::get('app.Categories')}}</h2>
                @include('hisprofile/leftcategories')
            </div>
        </div>


    </div>


        <!--Catalog Single Item-->
        <div class="col-md-9">
            @include('common/default_filterhome1')
            <div class="row profile-products">
                <div class="col-lg-6 col-md-6 product-view">
                    @include('new_template/client/pages/productpartials/product_gallery')
                </div>
                <div class="col-lg-6 col-md-6" style="padding-left:20px;">
                    @include('new_template/client/pages/productpartials/product_data')
                </div>
                <!--Product Gallery-->

            </div>
            <!-- product attributes -->
            <div class="row profile-products" style="margin-top: 20px;">
                @include('new_template/client/pages/productpartials/product_attributes')
            </div>
        </div>

@stop
