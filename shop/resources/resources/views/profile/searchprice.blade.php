<?php    $user = App\User::find(Auth::user()->id);?>
@extends('new_template.client.layouts.default')
@section('content')
    <?php $detect = new Mobile_Detect;?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <ol class="breadcrumb">
            <li class="active"></li>
        </ol>
        <ol class="breadcrumb">
            <li><a href="#"></a></li>
            <li class="active"></li>
        </ol>
        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
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
            <h2 style="padding-top:20px;text-align: center;">{{ Lang::get('app.Categories')}}</h2>
            @include('profile/leftcategories')
        </div>


    </div>
    <div class="col-md-9">
        @include('common/default_filter')
        <div class="row profile-products products-div" >
            <?php

            $user=\App\User::find(Auth::user()->id);
            $user_id=$user['id'];
            $typesshop=\App\product_type::where('alias','=',"Shop")->get();

            if(sizeof($typesshop)>0){

                foreach($typesshop as $tsh){
                    $type_id=$tsh->id;

                }
                ?>
                <?php  }?>
            <?php
            $product = \App\Product::whereHas('translations', function ($q) use ($type_id,$user_id) {
                $q->where('type_id', '=', $type_id);
                $q->where('user_id', '=', $user_id);
            })->get();?>
            <div class="row">
                <?php foreach($product as $p){?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="items">

                        <a href="{{ URL::route('product_show',array($p->slug,$p->id)) }}"><img
                                    src="{{ asset($p->thumbnail) }}" class="img-responsive"></a>
                        <?php if($p->user_id=$user_id){?>

            <?php } ?>
                        <div class="item-content">
                            <p class="title" style="word-break: break-all;height:40px;">{{ $p->title }}</p>
                            <p class="p-price" style=""><span class="price"><?php if($p->price!=""){?> {{ Lang::get('app.Price') }}<?php }?></span ><span class="price-value"  style="float:right"><?php if($p->price!=""){ echo $p->price;}?></span></p>
                            <p class="p-price"><span class="discount">{{ Lang::get('app.Discount') }}</span><span class="discount-value"  style="float:right">500</span></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>



        </div>
    </div>
@stop






<style>
    .myshop{
        color:#E28D33 !important;
    }
</style>