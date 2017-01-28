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
            <div class="span8">
                <h3>Adresse :</h3>
                <h6>{{$user->address}}</h6>
                <h6>{{$user->post_code}} {{$user->city}}</h6>
                <h6>{{$user->state}}</h6>
            </div>
            <div class="span8">
                <h3>Contact :</h3>
                <h6>{{$user->name}}  {{$user->lastname}}</h6>
                <h6>{{$user->email}}</h6>

            </div>
        </div>
    </div>

@stop
