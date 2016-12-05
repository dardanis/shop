@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        {{--        @include('common/breadcrumbs')--}}
    </div>

    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
        <div class="user-profile-top h2-custom">
            <div class="user-profile-top h2-custom">
                <h2 style="padding-top:20px;text-align: center;">{{ Lang::get('app.Categories')}}</h2>
            </div>
        </div>

    </div>
    <div class="col-md-9">
        <div id="loading"></div>
        <div class="row profile-products">
            <div class="h2-custom">
                <h2>Car news</h2>

                <p>Bla bla bla</p>
                <img src="http://www.hdcarwallpapers.com/thumbs/tron_style_lamborghini_aventador-t2.jpg"
                     class="img-thumbnail" alt="Cinque Terre" width="504" height="504">
            </div><br>
            <div class="form-group" style="display: inline">
                <div class="col-md-6">
                <textarea class="form-control" rows="5" id="comment"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                {{--                @include('comments/commentlist')--}}
                @include('comments/create')
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="comments-list" style="position: absolute; margin-left: 518px;margin-top: -451px;
">
                        <div class="media">
                            <p class="pull-right">
                                <small>5 days ago</small>
                            </p>
                            <a class="media-left" href="#">
                                <img src="http://lorempixel.com/40/40/people/1/">
                            </a>

                            <div class="media-body">
                                <h4 class="media-heading user_name">Dardan Ismajli</h4>
                                Wow! this is really great.
                            </div>
                        </div>
                        <div class="media" style="width: 432px;">
                            <p class="pull-right">
                                <small>5 days ago</small>
                            </p>
                            <a class="media-left" href="#">
                                <img src="http://lorempixel.com/40/40/people/2/">
                            </a>

                            <div class="media-body">

                                <h4 class="media-heading user_name">Feride</h4>
                                Wow! this is really great.

                            </div>
                        </div>
                    </div>
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