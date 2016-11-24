@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('common/breadcrumbs')
    </div>
    <div class="col-md-3 profile-left">
        @include('common.left_myaccount')
    </div>
    <div class="col-md-9">
        <div class="row search-profile">

            <div class="col-md-9">
                <span class="left-keyword" style="width:10%;">Keyword</span>
                <input type="text" class="form-control seach-keyword" placeholder="keyword" style="width:30%;"/>

                <select class="form-control seach-category" style="width:10%;">
                    <option selected>Auto</option>
                    <option>Technology</option>
                    <option>Clothes</option>
                </select>

                <button type="button" class="btn btn-default btn-search " style="width:5%;">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>

        </div>
        <div class="row profile-products">
            @include('products.product_by_category')
    </div>

</div>
    @stop
