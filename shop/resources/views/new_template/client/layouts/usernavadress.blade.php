
<!DOCTYPE html>
<html lang="en">
<head>
@include('new_template.client.includes.head')
</head>
<body class="cms-index-index cms-home-page">
<header>
    @include('new_template.client.includes.header')
</header>
<div class="container">

<div class="page-content" style="margin-bottom: 0px">

        <div class="row ">

            <div class="col-md-12 col-xs-12">
                <ul class="dashboard-link-list" style="padding-left:0px ">
                    <li style="float:left"><a href="{{ route('myprofile') }}" title="My Profile"><i class="fa fa-user"></i><span>{{ Lang::get('app.My Profile') }}</span></a></li>
                    <li style="float:left"><a href="{{ url('client/c_products') }}" title="My Products"><i class="fa fa-list"></i><span>{{ Lang::get('app.My Products') }}</span></a></li>
                    <li style="float:left"><a href="{{ url('alladresess') }}" title="My Adressess"><i class="fa fa-list"></i><span>{{ Lang::get('app.My Adresses') }}</span></a></li>
                    <li style="float:left"><a href="{{ url('client/add/product') }}" title="Add Product"><i class="fa fa-plus"></i><span>{{ Lang::get('app.Add Product') }}</span></a></li>

                </ul>
            </div>
        </div>
    </div>
</div>

@yield('content')
<style>

    .profile-image-box a{
        display:block;


    }
    .profile-image-box{
        border:1px solid #dedede;
        padding:20px;
        margin:30px 20px;;
    }
    .profile-image-box a img{
        min-hegiht:200px
    }
    ul.dashboard-link-list{
        margin-top:30px;
    }
    ul.dashboard-link-list li {
        overflow: hidden;
        padding-bottom: 10px;
    }

    ul.dashboard-link-list li a {
        display: block;
        overflow: hidden;
        font: 600 16px/20px "Open Sans", sans-serif;
        color: #555454;
        text-shadow: 0px 1px white;
        text-transform: uppercase;
        text-decoration: none;
        position: relative;
        border: 1px solid;
        border-color: #cacaca #b7b7b7 #9a9a9a #b7b7b7;
        background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgi…pZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiIC8+PC9zdmc+IA==');
        background-size: 100%;
        background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #f7f7f7), color-stop(100%, #ededed));
        background-image: -moz-linear-gradient(#f7f7f7, #ededed);
        background-image: -webkit-linear-gradient(#f7f7f7, #ededed);
        background-image: linear-gradient(#f7f7f7, #ededed);
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
    }

    ul.dashboard-link-list li a i {
        font-size: 25px;
        color:#2ba8db;
        position: absolute;
        left: 0;
        top: 0;
        width: 52px;
        height: 100%;
        padding: 10px 0 0 0;
        text-align: center;
        border: 1px solid #fff;
        -moz-border-radius-topleft: 4px;
        -webkit-border-top-left-radius: 4px;
        border-top-left-radius: 4px;
        -moz-border-radius-bottomleft: 4px;
        -webkit-border-bottom-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    ul.dashboard-link-list li a span {
        display: block;
        padding: 13px 15px 15px 17px;
        overflow: hidden;
        border: 1px solid;
        margin-left: 52px;
        border-color: #fff #fff #fff #c8c8c8;
        -moz-border-radius-topright: 5px;
        -webkit-border-top-right-radius: 5px;
        border-top-right-radius: 5px;
        -moz-border-radius-bottomright: 5px;
        -webkit-border-bottom-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

</style>
<script>


    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -33.8688, lng: 151.2195 },
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });


        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {

                if (place.geometry.viewport) {
                    document.getElementById('lat').value = place.geometry.location.lat();
                    document.getElementById('lng').value = place.geometry.location.lng();
                    document.getElementById('address').value = places[0].formatted_address;

                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"></script>
<script src="{{ asset('/js/libs/jquery-1.11.1.min.js') }}"></script>


<script>
    var checkUrl=function()
    {  var found=false;
        $(".step-tab").each(function(){
            var href=$(this).attr("href");
            var url=window.location.href;
            url=url.replace('add-room','room');
            url=url.replace('edit-room','room');
            url=url.replace('manage-price','price');
            if (url.indexOf(href) > -1 && !found) {
                //  console.log("found it");
                $(this).addClass("activestep");
                //$(this).closest(".parent").addClass("active");
                found=true;
            }
            else{//console.log("notFound")
            }
        })
        if(found==false)
        {
            $(".start").addClass("activestep");
        }

    }
    checkUrl();
    $(".disabled-menu .step-tab").removeAttr("onclick");
    $(".disabled-menu .step-tab").removeAttr("href");
    $(".disabled-menu ").removeAttr("onclick");
    $(".disabled-menu").removeAttr("href");
    $(".disabled-menu").on("click",function(){
        $("#upgrade").modal("show");
    })
</script>
<!-- include js files -->







@yield('scripts')
</body>
</html>


