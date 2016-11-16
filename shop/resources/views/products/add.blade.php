
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



        <div class="col-md-3" style="margin-top:20px;">
            {!! Form::submit(Lang::get('app.Cancel'), array('class' => 'btn btn-secondary','style'=>'border:1px solid gray')) !!}
        </div>

        <div class="col-md-3" style="margin-top:20px;float:right">
        {!! Form::submit(Lang::get('app.Save'), array('class' => 'btn btn-success')) !!}
        </div>
        {!! Form::close() !!}
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
