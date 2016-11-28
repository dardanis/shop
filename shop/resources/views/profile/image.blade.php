<?php    $user = App\User::find(Auth::user()->id);?>

@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('common/breadcrumbs')
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 user-profile-top">
        @include('profile/topuserprofile')

    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 user-profile-top">
        @include('profile/top_links')
    </div>
    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">

        <div class="user-profile-top h2-custom">

            <?php $addressinfo=\App\ContactInfo::where('user_id','=',$user->id)->get();?>

            <h2 style="padding-top:20px;text-align: center;">{{ Lang::get('app.Informations')}}</h2>
            <p style="margin-left: 10px;">{{ Lang::get('app.Adresse') }}: </p>
            <div class="profile-informations" style="margin-left: 20px;">
                <?php foreach($addressinfo as $ai){?>
                <p style="font-weight:bold;"><?php echo $ai->street;?> <br/>
                    <?php echo $ai->zip;?><br/>
                    <?php echo $ai->location;?><br/>
                    <?php echo $ai->payment;?>


                </p>
                <?php } ?>

            </div>
            <p  style="margin-left: 10px;"> {{ Lang::get('app.Contact') }}:</p>
            <div class="profile-informations"  style="margin-left: 20px;">
                <?php foreach($addressinfo as $ai){?>
                <p style="font-weight:bold;"><?php echo $ai->name; ?> <?php echo $ai->last_name;?> <br/>
                    <?php echo $ai->profession;?><br/>
                    <?php echo $ai->email;?><br/>

                </p>
                <?php } ?>

            </div>
        </div>
        <div class="user-profile-top h2-custom">
            @include('profile/products_left')
        </div>

    </div>
    <div class="col-md-9">
        @include('offers/create')
        @include('profile/imagelist')
    </div>
    </div>
@stop
<style>
    .basic-top-link{
        color:#E28D33 !important;
    }
</style>
