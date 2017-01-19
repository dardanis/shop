@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
        <div class="user-profile-top h2-custom" style=" margin-top: 10px; background: #dadadc">
            <div class="user-profile-top h2-custom" style="background: #dadadc">
                <h2 style="padding-top:20px;text-align: left;">{{ Lang::get('app.People')}}</h2>
                <h4>Dardan Ismajli (4)</h4>
                <h2 style="padding-top:20px;text-align: left;">{{ Lang::get('app.Type')}}</h2>
                <form>
                    <div>
                        <label><input type="checkbox" /> Label text</label>
                    </div><div>
                        <label><input type="checkbox" /> Label text</label>
                    </div><div>
                        <label><input type="checkbox" /> Label text</label>
                    </div><div>
                        <label><input type="checkbox" /> Label text</label>
                    </div><div>
                        <label><input type="checkbox" /> Label text</label>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
    </div>
    <div class="col-md-9">
        <div class="row profile-products" style="margin-top: 10px;">
            <h2 style="padding-top:0px;text-align: left;">{{ Lang::get('app.Shop')}}</h2>
            @foreach($friends as $friend)
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <img src="{{$friend->profile}}">

                    <div class="caption">
                        <h4>{{$friend->name}}</h4>
                    </div>
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
        margin:0;
        vertical-align: bottom;
        position: relative;
        top: -1px;
        *overflow: hidden;
    }
</style>