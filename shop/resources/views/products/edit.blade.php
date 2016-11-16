

<?php $user = App\User::find(Auth::user()->id);
$user_role = $user['role']['name']; ?>
@extends($user_role=='admin' ? 'new' : 'new_template.client.layouts.default')

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

                <li class="completed"><a href="/edit/<?php echo $slug;?>/<?php echo $id;?>" style="color:#E28D33 !important;">{{ Lang::get('app.Basic Info') }}</a></li>
                <li class="completed"><a href="/product/product_attributes/<?php echo $slug;?>/<?php echo $id;?>">{{ Lang::get('app.Extra Info')  }}</a></li>
                <li class="completed"><a href="/product/images/<?php echo $slug;?>/<?php echo $id;?>">{{ Lang::get('app.Gallery') }}</a></li>
                <li class="completed"><a href="/product/create/adress/<?php echo $slug;?>/<?php echo $id;?>">{{ Lang::get('app.Adress') }}</a></li>
            </ul>

        </div>
        <div class="row profile-products">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"> {{ Lang::get("app.Edit Product")}}</div>
                    </div>
                <div class="panel-body" >
                    @if( Session::has( 'success' ))
                        <div class="alert alert-success">{{ Session::get( 'success' ) }}</div>
                        @elseif( Session::has( 'warning' ))
                        {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
                    @endif

                        {!! Form::model($product, array('class'=>'form-horizontal tasi-form','method' => 'PATCH','files'=>true ,'route' => array('product_put',$product->slug, $product->id))) !!}
                        @include('errors/form')
                        @include('common/producteditform',['SubmitbuttonText'=>Lang::get('app.Save')])
                        {!! Form::close() !!}
                    </div>
</div>

    </div>



    </div>
</div>
    @stop
<style>
    .usernav .glyphicon{
        padding-top: 0px !important;
    }
</style>
