
<?php $user = App\User::find(Auth::user()->id);
$user_role = $user['role']['name']; ?>

        <?php $cat_id=$_GET['cat_id'];?>
{!! Form::open(array('route' => "add_event",'files'=>true,'class'=>'form-horizontal tasi-form','data-parsley-validate')) !!}
<!-- <div class="form-group">
    {!! Form::label('type_id', trans('Type') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-lg-10">

        {!! Form::select('type_id',[null=>'Please Select one type']+$type,'', array(
'class'                         => 'form-control',
'name'                          =>'type_id',
'placeholder'                   => '',
'required',
'id'                            => 'type-scratch',
'data-parsley-required-message' => 'Type is required',
'data-parsley-trigger'          => 'change focusout',

)) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('category', trans('shop.category') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-lg-10">
        {!! Form::select('category_id',[null=>'Please Select one category']+$category, '', array(
'class'                         => 'form-control',
'placeholder'                   => '',
'required',
'id'                            => 'first-scratch',
'data-parsley-required-message' => 'Category Name is required',
'data-parsley-trigger'          => 'change focusout',

)) !!}

    </div>
</div> -->
<input type="hidden" name="category_id" value="<?php echo $cat_id;?>"/>
<?php  $type_category = \App\Category::where('id', '=', $category_id)->get();
foreach($type_category as $tc){
    $type_name = App\product_type::where('id', '=', $tc->type_id)->get();

}
foreach($type_name as $tn){
    $type_id= $tn->id;
}
?>
<input type="hidden" name="type_id" value="<?php echo $type_id;?>"/>


<div class="form-group">
    {!! Form::label('front_thumbnail', trans('shop.front_thumbnail') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-sm-10">
        <div class="fileupload-new-first thumbnail img-responsive" style="width: 200px;">
            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="preview" src="#"/>
        </div>
        <input onchange="readURL(this)" ; class="parsley-error" placeholder="" required="required" id="imgfile" data-parsley-required-message="Front image is required" data-parsley-trigger="change focusout" name="image" type="file" data-parsley-id="14">

    </div>
</div>

<div class="form-group">
    {!! Form::label('title', trans('shop.title') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-sm-10">
        {!! Form::text('title', null, [
       'class'                         => 'form-control',
       'placeholder'                   => 'Please insert your title here..',
       'required',
       'id'                            => '',
       'data-parsley-required-message' => 'Title Name is required',
       'data-parsley-trigger'          => 'change focusout',


   ]) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('teaser', trans('shop.teaser') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-sm-10">
        {!! Form::text('teaser', null, [
       'class'                         => 'form-control',
       'placeholder'                   => 'Please insert short description here..',
       'required',
       'id'                            => '',
       'data-parsley-required-message' => 'Teaser is required',
       'data-parsley-trigger'          => 'change focusout',


   ]) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('description', trans('shop.description') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
    <div class="col-sm-10">
        {!! Form::textarea('description', null, [
'class'                         => 'form-control',
'name'=>'description',
'placeholder'                   => 'Please insert your descripion here..',
'id'                            => '',
'data-parsley-required-message' => 'Description is required',
'data-parsley-trigger'          => 'change focusout',
'style'=>'width:90%'

]) !!}

    </div>
</div>

<div class="form-group">
  <div class="col-sm-2 control-label">
    {{ trans('shop.Date')}}
  </div>
  <div class="col-sm-10">
    <input type="text" name="event_date" class="form-control" id="datepicker">

    </div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>

<script>
    // initialize input widgets first
 $(function() {
   $('#timeformatExample1').timepicker();
     $('#timeformatExample2').timepicker();
 });
</script>
  <p id="datepairExample">
    <div class="col-sm-2 control-label">
      {{ trans('shop.Time')}}
    </div>
   <div class="col-md-5"> 
       <span class="from">{{ trans('shop.Time from')}}</span>
      <input name="time_from" id="timeformatExample1" type="text" class="time ui-timepicker-input form-control" autocomplete="off">
    </div>
    <div class="col-md-5"> 
      <span class="to">{{ trans('shop.Time to')}}</span>
  <input name="time_to" id="timeformatExample2" type="text" class="time ui-timepicker-input form-control" autocomplete="off">
   </div>

</p>


<div class="form-group">
    <div class="col-sm-offset-8">
        <input type="hidden" id="token" value="{{ csrf_token() }}">
        <div class="col-md-6" id="">

        </div>

    </div>
</div>



<style>
    #description_ifr{
        width:90% !important;
    }
    .col-lg-10{
        margin-bottom:15px;
    }
    .col-sm-10{
        margin-bottom: 15px;;
    }
</style>