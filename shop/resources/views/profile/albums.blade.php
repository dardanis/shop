@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
        <div class="user-profile-top h2-custom" style=" margin-top: 10px; background: #dadadc">
            <div class="user-profile-top h2-custom" style="background: #dadadc">
                <h2 style="padding-top:20px;text-align: left;">{{ Lang::get('app.People')}}</h2>

                <div class="left-tabs type-tab">
                    <p class="title-tab">{{ Lang::get("app.Albums") }}</p>
                    <ul>
                        @foreach($albums as $album)
                        <li class="add-product-cat">

                            <a href='{{ action('ProfileController@album', [$album->id]) }}' style="color:blue">{{$album->name}}</a>
                            <a href="{{ action('ProfileController@getAddImage', [$album->id])}}" title="Add Image">
                                        <span class="glyphicon glyphicon-plus plus-red" aria-hidden="true"
                                              style="float:right;margin-right:20px;"></span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
    </div>
    <div class="col-md-9">
        <div class="row profile-products" style="margin-top: 10px;">
            <h2 style="padding-top:0px;text-align: left;">{{ Lang::get('app.Shop')}}</h2>
            @foreach($albums as $album)
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <img src="{{$album->image}}">

                    {{--<div class="caption">--}}
                        {{--<h4>{{''}}</h4>--}}
                    {{--</div>--}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
@stop
<style>
    label {
        display: block;
        padding-left: 15px;
        text-indent: -15px;
    }

    input {
        width: 13px;
        height: 13px;
        padding: 0;
        margin: 0;
        vertical-align: bottom;
        position: relative;
        top: -1px;
        *overflow: hidden;
    }
</style>