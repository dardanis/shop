@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('common/breadcrumbs')
    </div>

    @foreach($product as $pro)
        <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
            <div class="user-profile-top h2-custom" style=" margin-top: 10px;">
                <div class="user-profile-top h2-custom">
                    <h2 style="padding-top:20px;text-align: center;">{{ Lang::get('app.People')}}</h2>
                </div>
            </div>

        </div>

        <div class="col-md-9">
            <div id="loading"></div>
            <div class="row profile-products" style="margin-top: 10px;">
                <div class="h2-custom">
                    <h2>Car news</h2>

                    <p>bla bla</p>
                    <img src="{{$pro->thumbnail}}"
                         class="img-thumbnail" alt="Cinque Terre" width="504" height="504">
                </div>
                <br>

                <div class="form-group" style="display: inline">
                    <div class="col-md-6">
                        <textarea class="form-control" rows="5" id="comment"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    {{--                @include('comments/create')--}}
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
                                    <img src="http://www.wpclipart.com/signs_symbol/icons_oversized/male_user_icon.png"
                                         width="55" height="55">
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
                                    <img src="http://www.wpclipart.com/signs_symbol/icons_oversized/male_user_icon.png"
                                         width="55" height="55">
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
    @endforeach
@stop
<style>
    .myshop {
        color: #E28D33 !important;
    }
</style>