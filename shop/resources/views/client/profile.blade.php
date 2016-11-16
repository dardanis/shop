@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
    @include('common/breadcrumbs')
    </div>
    <div class="col-md-3 profile-left">

        @include('common.left_myaccount')
    </div>
    <div class="col-md-9">

            <div class="row profile-products">
               @include('products.partial_all_products')
            </div>

    </div>

@stop
<style>

</style>
