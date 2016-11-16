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
    <div class="page-content user-dashboard">
        <br/>
    <div class="container">
        <div  class="col-md-12" style="padding-left: 0px">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title"> {{ Lang::get("app.Add Product")}}</div>

                </div><!-- End of Panel Heading -->
                <div class="panel-body" >
                        {!! Form::open(array('route' => 'add_product','files'=>true,'class'=>'form-horizontal tasi-form','data-parsley-validate')) !!}
                        @include('errors/form')
                        @include('common/productaddform',['SubmitbuttonText'=>Lang::get('app.Next')])
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
    </div>

    </div>


@endsection


