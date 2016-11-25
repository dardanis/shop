@extends('new_template.client.layouts.default')
@section('content')
    <style>
        body {
            margin: 30px;
            padding: 0;
            background: #ddd;
            font-family: Arial, Helvetica, sans-serif;
        }

        .title {
            width: 100%;
            max-width: 854px;
            margin: 0 auto;
        }

        .caption {
            width: 100%;
            max-width: 854px;
            margin: 0 auto;
            padding: 20px 0;
        }

        .vid-main-wrapper {
            width: 100%;
            max-width: 1100px;
            min-width: 440px;
            background: #fff;
            margin: 0 auto;
        }

        /*  VIDEO PLAYER CONTAINER
       ############################### */
        .vid-container {
            position: relative;
            padding-bottom: 52%;
            padding-top: 30px;
            height: 0;
            width: 70%;
            float: left;
        }

        .vid-container iframe,
        .vid-container object,
        .vid-container embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            min-height: 360px;
        }

        /*  VIDEOS PLAYLIST
         ############################### */
        .vid-list-container {
            width: 30%;
            height: 360px;
            overflow: hidden;
            float: right;
        }

        .vid-list-container:hover, .vid-list-container:focus {
            overflow-y: auto;
        }

        ol#vid-list {
            margin: 0;
            padding: 0;
            background: #222;
        }

        ol#vid-list li {
            list-style: none;
        }

        ol#vid-list li a {
            text-decoration: none;
            background-color: #222;
            height: 55px;
            display: block;
            padding: 10px;
        }

        ol#vid-list li a:hover {
            background-color: #666666
        }

        .vid-thumb {
            float: left;
            margin-right: 8px;
        }

        .active-vid {
            background: #3A3A3A;
        }

        #vid-list .desc {
            color: #CACACA;
            font-size: 13px;
            margin-top: 5px;
        }

        @media (max-width: 624px) {
            body {
                margin: 15px;
            }

            .caption {
                margin-top: 40px;
            }

            .vid-list-container {
                padding-bottom: 20px;
            }

        }
    </style>
    <div class="div-content">
        <div class="col-md-12">
            <div class="vid-main-wrapper clearfix">

                <!-- THE YOUTUBE PLAYER -->
                <div class="vid-container">
                    <iframe id="vid_frame" src="http://www.youtube.com/embed/cOSEOYi9JS4?rel=0&showinfo=0&autohide=1"
                            frameborder="0" width="460" height="215"></iframe>
                </div>

                <!-- THE PLAYLIST -->
                <div class="vid-list-container">
                    @foreach($video as $vid)
                        <ol id="vid-list">
                            <li>
                                <a href="javascript:void();"
                                   onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/{{$vid->url}}?autoplay=1&rel=0&showinfo=0&autohide=1'">
                                    <span class="vid-thumb"><img width=72 src="{{$vid->thumbnail}}"/></span>

                                    <div class="desc">{{$vid->description}}</div>
                                </a>
                            </li>
                        </ol>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <div class="div-content">
        <div class="col-md-12">

            <div class="div-content-category">
                <h2 class="title-category">Other Video</h2>
                @foreach($video as $vid)
                    <div class="items col-md-4 col-xs-6">
                        <div class="title">
                            <p>{{$vid->title}}</p>
                        </div>
                        <iframe width="300" height="200" src="https://www.youtube.com/embed/{{ $vid->url }}"
                                frameborder="0" allowfullscreen></iframe>
                        <div class="caption">
                            <p>{{$vid->description}}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
<script>
    /*JS FOR SCROLLING THE ROW OF THUMBNAILS*/
    $(document).ready(function () {
        $('.vid-item').each(function (index) {
            $(this).on('click', function () {
                var current_index = index + 1;
                $('.vid-item .thumb').removeClass('active');
                $('.vid-item:nth-child(' + current_index + ') .thumb').addClass('active');
            });
        });
    });
</script>