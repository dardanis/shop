@extends('new')

@section('content')
    <div class="row" style="margin-top: 100px">
        <div class="col-lg-12">
            <div class="col-md-3">
                @include('common/menu')
            </div>
            <div class="col-md-9">
                <section class="panel">
                    <header class="panel-heading">
                        {{trans('shop.edit_product')}}
                    </header>
                    <div class="panel-body">
                        {!! Form::model($product, array('class'=>'form-horizontal tasi-form','method' => 'PATCH','files'=>true ,'route' => array('admin_product_put', $product->id))) !!}
                        @include('errors/form')
                        @include('common/producteditform',['SubmitbuttonText'=>trans('shop.save')])

                        {!! Form::close() !!}


                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

