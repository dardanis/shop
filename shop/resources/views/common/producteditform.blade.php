

<?php $user = App\User::find(Auth::user()->id);
$user_role = $user['role']['name']; ?>
<div class="form-group">
    <div class="col-sm-offset-8">
        <input type="hidden" id="token" value="{{ csrf_token() }}">

    </div>
</div>

<div class="form-group">
    {!! Form::label('sub_category', trans('shop.sub_category') . '', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-lg-10">
        {!! Form::select('subcategory_id',$subcategories, Input::old('subcategory_id'), array('class' => 'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('Sub sub category',Lang::get('app.Sub Sub category') .'', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-lg-10">
        {!! Form::select('sub_sub_category_id',$subsubcategory, Input::old('sub_sub_category_id'), array('class' => 'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('title', trans('shop.title') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-sm-10">
        {!! Form::text('title', Input::old('title'),array('class' => 'form-control', 'placeholder' => 'Please insert your title here...')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('teaser', trans('shop.teaser') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-sm-10">
        {!! Form::text('title', Input::old('teaser'),array('class' => 'form-control', 'placeholder' => 'Please insert your title here...')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', trans('shop.description') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-sm-10">
        {!! Form::textarea('description', Input::old('description'),array('class' => 'form-control','id'=>'mytextarea')) !!}
    </div>
</div>

<div class="form-group last">
    {!! Form::label('front_thumbnail', trans('shop.front_thumbnail') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-md-10">
        <div class="fileupload-new thumbnail" style="width: 100px;">
            <img src="{{ asset($product->thumbnail) }}" alt="" id="preview" src="#" class="img-responsive"/>
        </div>
        <input id="imgfile" name="thumbnail_front" type="file" onchange="readURL(this)" value="<?php $product->thumbnail;?>" ;/>

    </div>
</div>

<div class="form-group">
    {!! Form::label('search_keywords', trans('shop.search_keywords') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-sm-10">
        {!! Form::text('search_keywords', Input::old('search_keywords'),array('class' => 'form-control', 'placeholder' => 'Please insert tags for better search, sepereated by commas...')) !!}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-8">
        <input type="hidden" id="token" value="{{ csrf_token() }}">
        <div class="col-md-6">
            {!! Form::submit($SubmitbuttonText, array('class' => 'btn btn-success')) !!}
        </div>

    </div>
</div>

