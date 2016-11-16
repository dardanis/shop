<script src="{{ asset('/js/tinymce.min.js') }}"></script>
<script type="text/javascript">
    window.ParsleyConfig = {
        errorsWrapper: '<div></div>',
        errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>'
    };

    tinymce.init({
        selector         : "textarea",
        //theme : "advanced",
        plugins      : "jbimages table link autolink charmap print preview searchreplace code",
        toolbar      : "undo redo | bold italic underline charmap searchreplace | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect table | link code | jbimages preview",
        // menubar          : true,
        //relative_urls    : false

    });
</script>
<?php $user = App\User::find(Auth::user()->id);
$user_role = $user['role']['name']; ?>
@extends($user_role=='admin' ? 'new' : 'new_template.client.layouts.usernav')

@section('content')
    <div class="container" >
    <div class="page-content" style="overflow: auto;margin-top:0px;">


        <div class="col-lg-8">
            <div  class="col-md-12" style="padding-left: 0px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"> {{ Lang::get("app.Add Product from example")}}</div>

                    </div><!-- End of Panel Heading -->
                    <div class="panel-body" >
                        {!! Form::open(array('route' => 'add_product','files'=>true,'class'=>'form-horizontal tasi-form','data-parsley-validate')) !!}
                        @include('errors/form')

                        <?php $user = App\User::find(Auth::user()->id);
                        $user_role = $user['role']['name']; ?>

                        <div class="form-group">
                            {!! Form::label('type_id', trans('Type') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-lg-10">

                                {!! Form::select('type_id',[null=>'Please Select one type']+$type,'', array(
                        'class'                         => 'form-control',
                        'name'                          =>'type_id',
                        'placeholder'                   => '',
                        'required',
                       'id'                            => 'type',
                        'data-parsley-required-message' => 'Type is required',
                        'data-parsley-trigger'          => 'change focusout',

                        )) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('category', trans('shop.category') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-lg-10">
                                {!! Form::select('category_id',[null=>'Please Select one category'], '', array(
                        'class'                         => 'form-control',
                        'placeholder'                   => '',
                        'required',
                        'id'                            => 'first',
                        'data-parsley-required-message' => 'Category Name is required',
                        'data-parsley-trigger'          => 'change focusout',

                        )) !!}

                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('sub_category', trans('shop.sub_category') . '', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-lg-10">
                                {!! Form::select('subcategory_id',[null=>'Please Select sub category'],"", array(
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Select sub category',
                        'required',
                        'id'                            => 'second',
                        'data-parsley-required-message' => 'Sub Category Name is required',
                        'data-parsley-trigger'          => 'change focusout',

                        )) !!}

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4">
                                <input type="hidden" id="token" value="{{ csrf_token() }}">
                                <div class="col-md-6" id="">

                                        <button type="submit" class="btn btn-success" id="btn-findproducts">
                                           {{Lang::get('app.Check existing items')}}
                                        </button>

                                </div>

                            </div>
                        </div>



                        <style>
                            #description_ifr{
                                width:90% !important;
                            }
                        </style>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>

            <div  class="col-md-12" style="padding-left: 0px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"> {{ Lang::get("app.Add Product")}}</div>

                    </div><!-- End of Panel Heading -->
                    <div class="panel-body" >
                        {!! Form::open(array('route' => 'add_product','files'=>true,'class'=>'form-horizontal tasi-form','data-parsley-validate')) !!}
                        @include('errors/form')
                        @include('common/productaddform',['SubmitbuttonText'=>Lang::get('app.Save')])
                        {!! Form::close() !!}


                        <style>
                            #description_ifr{
                                width:90% !important;
                            }
                        </style>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="loading-div">
                <img id="loading" src="/images/loading.gif" id="img" style="display:none"/>
            </div>
            <div class="col-md-12" id="getproducts">

            </div>
        </div>
    </div>

    </div>


@endsection

<style>
#loading-div{
    float:left;
    width:100px;
    height:100px;
    right:10px;
    position:absolute;
}
</style>
