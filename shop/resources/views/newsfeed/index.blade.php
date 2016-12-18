@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('common/breadcrumbs')
    </div>

    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
        <div class="user-profile-top h2-custom" style=" margin-top: 10px;">
            <div class="user-profile-top h2-custom">
                <h2 style="padding-top:20px;text-align: center;">{{ Lang::get('app.People')}}</h2>
                <h4>John Doe (4)</h4>
            </div>
        </div>

    </div>
    @foreach($product as $pro)
        <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
        </div>
        <div class="col-md-9">
            <div id="loading"></div>
            <div class="row profile-products" style="margin-top: 10px;">
                <div class="h2-custom">
                    <img src="{{$pro->thumbnail}}"
                         class="img-thumbnail" alt="Cinque Terre" width="504" height="504">
                </div>
                <br>

                <div class="media" style="width: 432px; margin-top: -13px ">
                    <small style="margin-left: 64px;margin-top: 25px;position: absolute;">5 days ago</small>
                    <a class="media-left" href="#">
                        <img src="http://www.wpclipart.com/signs_symbol/icons_oversized/male_user_icon.png"
                             width="55" height="55">
                    </a>

                    <div class="media-body">
                        <h4 class="media-heading user_name">John Doe</h4>
                    </div>
                </div>
                <br>

                <div class="form-group" style="display: inline">
                    <div class="col-md-6">
                        <textarea class="form-control" rows="5" id="comment"
                                  style="margin-right: -38.75px; margin-left: 0px; width: 494px;"></textarea>
                    </div>
                </div>
                <div >
                <span style="margin-top: 117px;margin-left: -473px;position: absolute;"> + Jaime 12`321 Vues 321`321 </span>
                    <a class="bold-11" href='{{ URL::to("/partager") }}'><span style="color: blue; margin-top: 117px;margin-left: -26px;position: absolute;">Partager</span></a>
                </div>
                <div class="col-md-6">
                    <div class="row" style="margin-left: 15px">
                        <div class="col-md-12" style="margin-top: 86px">
                            <textbox name="comment"></textbox>
                            <a style="position: absolute;margin-top: -9px;" href="#">
                                <img src="http://www.wpclipart.com/signs_symbol/icons_oversized/male_user_icon.png"
                                     width="55" height="55">
                            </a>

                            <input class="form-control input-lg" id="inputlg" type="text"
                                   style="margin-left: 59px;width: 376px;">
                            <button id="searchBDir"></button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div>
                        <div class="comments-list pre-scrollable" style="position: absolute; margin-left: 523px;margin-top: -426px;">
                            <div class="media" style="margin-top: 9px">
                                <small style="margin-left: 64px;margin-top: 25px;position: absolute;">5 days ago</small>
                                <a class="media-left" href="#">
                                    <img src="http://www.wpclipart.com/signs_symbol/icons_oversized/male_user_icon.png"
                                         width="55" height="55">
                                </a>

                                <div class="media-body">
                                    <h4 class="media-heading user_name">John Doe</h4>

                                    <p style="margin-top: 35px;margin-left: -62px;">
                                        Wow! this is really great.
                                    </p>
                                </div>
                            </div>
                            <div class="media" style="width: 432px;">
                                <small style="margin-left: 64px;margin-top: 25px;position: absolute;">5 days ago</small>
                                <a class="media-left" href="#">
                                    <img src="http://www.wpclipart.com/signs_symbol/icons_oversized/male_user_icon.png"
                                         width="55" height="55">
                                </a>

                                <div class="media-body">

                                    <h4 class="media-heading user_name">John Doe</h4>

                                    <p style="margin-top: 35px;margin-left: -62px;">
                                        Wow! this is really great.
                                    </p>
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

    .styledTB {
        position: relative;
        display: inline-block;
        height: 40px; /* Arbitrary number */
        width: 400px; /* Arbitrary number */
    }

    .styledTB input {
        width: 85%; /* Arbitrary number */
        height: 100%;
        margin-left: 59px;
        margin-top: -48px;
        padding-right: 40px;
        box-sizing: border-box;
    }

    #searchBDir {
        height: 57%;
        width: 30px; /* Or however long you'd like your button to be, matches padding-right above */
        background-image: url(http://image.flaticon.com/icons/svg/260/260109.svg);
        background-repeat: no-repeat;
        background-position: 50% 50%;
        border: none;
        background-color: transparent;
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%); /* OR margin-top: -20px (Half of the container's height) if you're supporting older browsers */
    }
</style>