<?php
$adressline="";
$web="";
$mobile="";
$tel="";
$email="";
$lat="";
$lon="";
$name="";
?>
<?php $user_id=\App\User::find(Auth::user()->id);?>
<?php $adress = \Illuminate\Support\Facades\DB::table('product_user_adresses')->where('product_id', '=', $product->id)->get();?>
<?php if(sizeof($adress)>0){?>
<?php echo "has adress"; ?>
                 <?php foreach($adress as $a){
    $adressline=$a->adress_line;
    $web=$a->web;
    $mobile=$a->mobile;
    $tel=$a->tel;
    $email=$a->email;
    $lat=$a->lat;
    $lon=$a->lon;
    $name=$a->name;
    ?>
                  <?php }?>

                <?php } else { ?>


             <?php $prodadress = \Illuminate\Support\Facades\DB::table('product_adresses')->where('user_id', '=', $user_id['id'])->where('default_adress','=',1)->get();?>

                <?php foreach($prodadress as $a){
    $adressline=$a->adress_line;
    $web=$a->web;
    $mobile=$a->mobile;
    $tel=$a->tel;
    $email=$a->email;
    $lat=$a->lat;
    $lon=$a->lon;
    $name=$a->name;
    ?>
            <?php }?>

            <?php  } ?>


<div  class="col-md-12" style="padding-left: 0px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"> {{ Lang::get("app.Address")}}</div>
        </div>
        <div class="panel-body" >
            @if( Session::has( 'success' ))
                <div class="alert alert-success">{{ Session::get( 'success' ) }}</div>
                @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
            @endif

            {!! Form::open(array('route' =>array('storeadress',$product->slug, $product->id."?template=secondsteptemplate"),'files'=>true,'class'=>'form-horizontal tasi-form')) !!}
            @include('errors/form')
            <?php if(sizeof($adress)>0){?>
                <div class="form-group">
                    <label class="col-sm-2 col-md-2 control-label" >{{Lang::get('app.Adress Name')}}</label>
                    <div class="col-sm-5" style="padding-left: 0px;">
                        {!! Form::text('Name', $name, array('class' => 'form-control','id'=>'name')) !!}
                    </div>

                </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">{{trans('shop.mapping_product')}}</label>
                <input id="pac-input" class="controls" type="text" placeholder="Search Box">

                <div class="col-sm-5" id="map" style="height:300px;">
                    {{trans('shop.map')}}
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <div id="markerStatus"><i>{{trans('shop.marker')}}</i></div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('latitude', trans('shop.latitude') . ' *', ['class' => 'col-sm-4 col-sm-4 control-label' ])!!}
                        <div class="col-sm-7">
                            {!! Form::text('lat', $lat, array('class' => 'form-control','id'=>'lat')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('longitude', trans('shop.longitude') . ' *', ['class' => 'col-sm-4 col-sm-4 control-label' ])!!}
                        <div class="col-sm-7">
                            {!! Form::text('lon', $lon, array('class' => 'form-control','id'=>'lng')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('address', trans('shop.address') . ' *', ['class' => 'col-sm-4 col-sm-4 control-label' ])!!}
                        <div class="col-sm-7">
                            {!! Form::text('adress_line', $adressline, array('class' => 'form-control','id'=>'address')) !!}
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group">
                {!! Form::label('tel','Tel *', ['class' => 'col-md-2 col-sm-2 control-label' ])!!}
                <div class="col-sm-5" style="padding-left: 0px">
                    {!! Form::text('tel', $tel, array('class' => 'form-control','id'=>'address','style'=>'margin-left:0px')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('mobile','Mobile *', ['class' => 'col-md-2 col-sm-2 control-label' ])!!}
                <div class="col-sm-5" style="padding-left: 0px">
                    {!! Form::text('mobile', $mobile, array('class' => 'form-control','id'=>'address','style'=>'margin-left:0px')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('email','Email *', ['class' => 'col-md-2 col-sm-2 control-label' ])!!}
                <div class="col-sm-5" style="padding-left: 0px">
                    {!! Form::text('email', $email, array('class' => 'form-control','id'=>'address','style'=>'margin-left:0px')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('web','Web *', ['class' => 'col-md-2 col-sm-2 control-label' ])!!}
                <div class="col-sm-5" style="padding-left: 0px">
                    {!! Form::text('web', $web, array('class' => 'form-control','id'=>'address','style'=>'margin-left:0px')) !!}
                </div>
            </div>
            <?php } else {?>
                <div class="form-group">
                    <label class="col-sm-2 col-md-2 control-label" >{{Lang::get('app.Adress Name')}}</label>
                    <div class="col-sm-5" style="padding-left: 0px;">
                        {!! Form::text('Name', $name, array('class' => 'form-control','id'=>'name')) !!}
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">{{trans('shop.mapping_product')}}</label>
                    <input id="pac-input" class="controls" type="text" placeholder="Search Box">

                    <div class="col-sm-5" id="map" style="height:300px;">
                        {{trans('shop.map')}}
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <div id="markerStatus"><i>{{trans('shop.marker')}}</i></div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('latitude', trans('shop.latitude') . ' *', ['class' => 'col-sm-4 col-sm-4 control-label' ])!!}
                            <div class="col-sm-7">
                                {!! Form::text('lat', $lat, array('class' => 'form-control','id'=>'lat')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('longitude', trans('shop.longitude') . ' *', ['class' => 'col-sm-4 col-sm-4 control-label' ])!!}
                            <div class="col-sm-7">
                                {!! Form::text('lon', $lon, array('class' => 'form-control','id'=>'lng')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('address', trans('shop.address') . ' *', ['class' => 'col-sm-4 col-sm-4 control-label' ])!!}
                            <div class="col-sm-7">
                                {!! Form::text('adress_line', $adressline, array('class' => 'form-control','id'=>'address')) !!}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('tel','Tel *', ['class' => 'col-md-2 col-sm-2 control-label' ])!!}
                    <div class="col-sm-5" style="padding-left: 0px">
                        {!! Form::text('tel', $tel, array('class' => 'form-control','id'=>'address','style'=>'margin-left:0px')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('mobile','Mobile *', ['class' => 'col-md-2 col-sm-2 control-label' ])!!}
                    <div class="col-sm-5" style="padding-left: 0px">
                        {!! Form::text('mobile', $mobile, array('class' => 'form-control','id'=>'address','style'=>'margin-left:0px')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email','Email *', ['class' => 'col-md-2 col-sm-2 control-label' ])!!}
                    <div class="col-sm-5" style="padding-left: 0px">
                        {!! Form::text('email', $email, array('class' => 'form-control','id'=>'address','style'=>'margin-left:0px')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('web','Web *', ['class' => 'col-md-2 col-sm-2 control-label' ])!!}
                    <div class="col-sm-5" style="padding-left: 0px">
                        {!! Form::text('web', $web, array('class' => 'form-control','id'=>'address','style'=>'margin-left:0px')) !!}
                    </div>
                </div>

            <?php } ?>
            <div class="form-group">
                <div class="col-sm-offset-8">
                    <input type="hidden" id="token" value="{{ csrf_token() }}">

                    <div class="col-md-3">
                        {!! Form::submit(Lang::get('app.Save'), array('class' => 'btn btn-success')) !!}
                    </div>

                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
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