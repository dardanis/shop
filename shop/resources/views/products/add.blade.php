
<?php $user = App\User::find(Auth::user()->id);?>
<?php $category_id=$_GET['cat_id'];?>

@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
      @include('common/breadcrumbs')
    </div>

    <div class="col-md-3 profile-left">
        @include('common.left_myaccount')
    </div>
    <div class="col-md-9">

        <div class="row" style="margin-bottom:20px;">
            <ul class="progressbar">
                <li class="active">{{ Lang::get('app.Basic Info') }}</li>
                <li>{{ Lang::get('app.Extra Info')  }}</li>
                <li>{{ Lang::get('app.Gallery') }}</li>
                <li>{{ Lang::get('app.Adress') }}</li>

            </ul>

        </div>
        <div class="row profile-products">

            <div class="col-md-12">

                <div class="panel-body" >
                    @include('errors/form')
                    @include('common/productaddform')
                    <style>
                        #description_ifr{
                            width:90% !important;
                        }
                    </style>

                </div>
            </div>


        </div>


        <div class="col-md-offset-6 col-md-6 margin-top-20">
            <div class="col-md-6">
                <a href="/profile" class="btn btn-default btn-default-links">{{ Lang::get('app.Cancel') }}</a>

            </div>

            <div class="col-md-6">
            {!! Form::submit(Lang::get('app.Save'), array('class' => 'btn btn-success')) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@stop

<style>


    .profile-left .title-tab{
        color:#153e64;
        font-weight: bold;;
    }
    .active{

    }
    .profile-products
</style>
