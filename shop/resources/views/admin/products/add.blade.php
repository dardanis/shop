@extends('new')



@section('content')
    <div class="row" style="margin-top: 100px">
        <div class="col-lg-12">
            <div class="col-lg-3">
                @include('common/menu')
            </div>
            <div class="col-lg-8">
                <div class="panel">
                    <header class="panel-heading">
                        {{trans('shop.add_product')}}
                    </header>
                    <div class="panel-body">
                        {!! Form::open(array('route' => 'add_product','files'=>true,'class'=>'form-horizontal tasi-form')) !!}
                        @include('errors/form')
                        @include('common/productaddform',['SubmitbuttonText'=>trans('shop.next_step')])
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
