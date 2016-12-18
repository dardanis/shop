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

        <div class="user-profile-top h2-custom">


            <h2 style="padding-top:20px;text-align: center;">{{ Lang::get('app.Informations')}}</h2>
            <p style="margin-left: 10px;">{{ Lang::get('app.Adresse') }}: </p>
            <div class="profile-informations" style="margin-left: 20px;">




            </div>
            <p  style="margin-left: 10px;"> {{ Lang::get('app.Contact') }}:</p>
            <div class="profile-informations"  style="margin-left: 20px;">




            </div>
        </div>
        <div class="user-profile-top h2-custom">
          @include('profile/products_left')
        </div>

    </div>
    <div class="col-md-9">
        @include('offers/create')
        @include('profile/listoffers')
        </div>
    </div>
    @stop
<style>
    .basic-top-link{
        color:#E28D33 !important;
    }
</style>
