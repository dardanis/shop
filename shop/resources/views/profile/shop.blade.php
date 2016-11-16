<?php    $user = App\User::find(Auth::user()->id);?>



@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('common/breadcrumbs')
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 user-profile-top">
        @include('profile/topuserprofile')

    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 user-profile-top">
        @include('profile/top_links')
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
                @include('profile/leftcategories')
            </div>
        </div>
        <div class="user-profile-top h2-custom">

        </div>

    </div>
    <div class="col-md-9">
        @include('common/default_filterhome1')
        <div class="row profile-products products-div">
            <div id="loading"></div>

            @include('profile/productlist')

        </div>
    </div>
@stop
<style>
    .myshop{
        color:#E28D33 !important;
    }
</style>