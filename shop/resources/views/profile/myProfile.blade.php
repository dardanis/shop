<?php $user = App\User::find(Auth::user()->id); ?>


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
        <div class="user-profile-top h2-custom">
            <div class="user-profile-top h2-custom">
                <h2 style="padding-top:20px;text-align: center;">{{ Lang::get('app.Categories')}}</h2>
                {{--                @include('profile/leftcategories')--}}
            </div>
        </div>

    </div>
    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
    </div>
    <div class="col-md-9">
        <div class="row profile-products">
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail" style="border: 0px">
                    <img class="img-responsive" style="width: 357px"
                         src="http://wallpaper-gallery.net/images/blue-images/blue-images-23.jpg"
                         alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <h4>De: <strong>Kosova</strong></h4>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail" style="border: 0px">
                    <img class="img-responsive" style="width: 357px"
                         src="http://wallpaper-gallery.net/images/blue-images/blue-images-23.jpg"
                         alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <h4>De: <strong>Kosova</strong></h4>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail" style="border: 0px">
                    <img class="img-responsive" style="width: 357px"
                         src="http://wallpaper-gallery.net/images/blue-images/blue-images-23.jpg"
                         alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <h4>De: <strong>Kosova</strong></h4>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail" style="border: 0px">
                    <img class="img-responsive" style="width: 357px"
                         src="http://wallpaper-gallery.net/images/blue-images/blue-images-23.jpg"
                         alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <h4>De: <strong>Kosova</strong></h4>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
    </div>
    <div class="col-md-9">
        <div class="row profile-products">
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail" style="border: 0px">
                    <img class="img-responsive" style="width: 357px"
                         src="http://wallpaper-gallery.net/images/blue-images/blue-images-23.jpg"
                         alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <h4>De: <strong>Kosova</strong></h4>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail" style="border: 0px">
                    <img class="img-responsive" style="width: 357px"
                         src="http://wallpaper-gallery.net/images/blue-images/blue-images-23.jpg"
                         alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <h4>De: <strong>Kosova</strong></h4>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail" style="border: 0px">
                    <img class="img-responsive" style="width: 357px"
                         src="http://wallpaper-gallery.net/images/blue-images/blue-images-23.jpg"
                         alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <h4>De: <strong>Kosova</strong></h4>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail" style="border: 0px">
                    <img class="img-responsive" style="width: 357px"
                         src="http://wallpaper-gallery.net/images/blue-images/blue-images-23.jpg"
                         alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <h4>De: <strong>Kosova</strong></h4>
                </div>
            </div>

            </div>
    </div>
@stop
<style>
    .myshop {
        color: #E28D33 !important;
    }
</style>