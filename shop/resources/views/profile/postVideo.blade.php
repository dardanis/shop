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

                                <a href='{{ action('ProfileController@album', [$album->id]) }}'
                                   style="color:blue">{{$album->name}}</a>
                                <a href="{{ action('ProfileController@getAddVideo', [$album->id])}}" title="Add Image">
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

            <div class="fullRelLeft upload-images-container pull-center">
                <form method="post" action="{{ action("ProfileController@postVideo", $album->id) }} " enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>


                    <input type="text" name="video" class="form-control" placeholder="{{ Lang::get('app.Add youtube link') }}" style="margin-top:20px;"/>
                    <input type="text" name="title" class="form-control" placeholder="{{ Lang::get('app.Title') }}" style="margin-top:20px;"/><br>
                    <textarea class="form-control" placeholder="{{ Lang::get('app.Description') }}" name="description"></textarea>

                    <div class="col-sm-6 col-sm-offset-6" style="margin-right:20px;margin-top: 20px;">
                        <button type="submit" class="btn btn-success">
                            {{ Lang::get('app.Save') }}
                        </button>
                    </div>
                </form>
                {{--<input type="file" accept="image/*" onchange="loadFile(event)">--}}

                {{--<form id="form1" runat="server">--}}
                {{--<input type='file' id="imgInp" />--}}
                {{--<img id="blah"/>--}}
                {{--</form>--}}
            </div>

        </div>
    </div>

@stop
<script>
    var loadFile = function (event) {
        var output = document.getElementById('output');

        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>