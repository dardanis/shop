@extends('new_business')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Product edit
            </header>
            <div class="panel-body">
				{!! Form::model($product, array('class'=>'form-horizontal tasi-form','method' => 'PATCH','files'=>true ,'route' => array('product_put_2', $product->id))) !!}
					@if($errors->any())
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</div>
					@endif
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Category</label>
				 	<div class="col-lg-10">
					{!! Form::select('category_id',$categories,Input::old('category_id'),array('class' => 'form-control','id'=>'first')) !!}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Sub category</label>
				 	<div class="col-lg-10">
					{!! Form::select('subcategory_id',$subcategories, Input::old('subcategory_id'), array('class' => 'form-control','id' => 'second')) !!}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Title</label>			
					<div class="col-sm-10">
					{!! Form::text('title', Input::old('title'),array('class' => 'form-control', 'placeholder' => 'Please insert your title here...')) !!}
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Description</label>			
					<div class="col-sm-10">
					{!! Form::textarea('description', Input::old('description'),array('class' => 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-2 col-sm-2 control-label">Price</label>
                    <div class="col-sm-10">
					{!! Form::text('price', Input::old('price'), array('class' => 'form-control', 'placeholder' => 'Please insert price here...')) !!}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Choose image</label>		
					<div class="col-sm-10">										
   						<div class="fileupload-new thumbnail" style="width: 200px; height: 200px;">
                              <img src="{{ asset($product->thumbnail) }}" alt="" id="preview" src="#"/>
                        </div>
                        	<input id="imgfile" name="image" type="file" onchange="readURL(this)"; /> 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Images</label>		
					<div class="col-sm-10">
						@foreach($product->images as $img)								
						<div class="box"><img src="{{ asset($img->image) }}" width="75" height="75" border="0" class="avatar"/>
						    <a href="#" id="{{$img->id}}" class="delete">x</a>
						    <div class="clear"></div>
						</div>
						@endforeach
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Mapping product</label>
					<input id="pac-input" class="controls" type="text" placeholder="Search Box">
					<div class="col-sm-5" id="map" style="height:300px;">
						MAP
					</div>
					<div class="col-sm-5">
						<div class="form-group">
							<div id="markerStatus"><i>Click and drag the marker.</i></div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Latitude</label>
		                    <div class="col-sm-10">
							{!! Form::text('lat', Input::old('lat'), array('class' => 'form-control','id'=>'lat')) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Longtitude</label>
		                    <div class="col-sm-10">
							{!! Form::text('lng', Input::old('lng'), array('class' => 'form-control','id'=>'lng')) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Address</label>
		                    <div class="col-sm-10">
							{!! Form::text('address',Input::old('address'), array('class' => 'form-control','id'=>'address')) !!}
							</div>
						</div>
					</div>
				</div>			
				<div class="form-group">			
					<div class="col-sm-offset-10">
					<input type="hidden" id="token" value="{{ csrf_token() }}">
					{!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
					{!! link_to_route('business_products', 'Cancel', array(), array('class' => 'btn btn-danger'))!!}
					{!! Form::close() !!}
					</div>
				</div>
			</div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
	<script src="{{ asset('/js/map_edit.js') }}"></script>
	<script type="text/javascript">


$(function() {
$(".delete").click(function() {
$('#load').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var token=$('#token').val();
	
$.ajax({
   type: "POST",
   url: "/deleteimage",
   data: {'_token':token,'id': id },
   cache: false,
   success: function(response){
   	if(response==1){
   		commentContainer.slideUp('slow', function() {$(this).remove();});
   	}
	
  }
   
 });

return false;
	});
});


</script>
@endsection