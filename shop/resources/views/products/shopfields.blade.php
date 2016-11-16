

<?php $user = App\User::find(Auth::user()->id);
$user_role = $user['role']['name']; ?>
@extends($user_role=='admin' ? 'new' : 'new_template.client.layouts.usernav')
@section('content')


    <div class="main-col">
        @include('common/menuuser')
    </div>
    <div class="container">
    <div class="page-content user-dashboard" style="margin-top:0px;overflow: auto;">




            <div  class="col-md-12" style="padding-left: 0px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"> {{ Lang::get("app.Shop data")}}</div>
                    </div>
                    <div class="panel-body" >
                        @if( Session::has( 'success' ))
                            <div class="alert alert-success">{{ Session::get( 'success' ) }}</div>
                            @elseif( Session::has( 'warning' ))
                            {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
                        @endif
                            {!! Form::open(array('route' =>array('storeshopfields',$slug, $product->id),'files'=>true,'class'=>'form-horizontal tasi-form')) !!}
                            @include('errors/form')
                        <?php if(sizeof($product)>0){?>
                            <div class="form-group">
                                {!! Form::label('price', trans('shop.price') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                                <div class="col-sm-10">
                                    {!! Form::text('price', $product->price, array('class' => 'form-control', 'placeholder' => 'Please insert price here...')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('availability', trans('shop.availability') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                                <div class="col-sm-10">
                                    {!! Form::text('availability',$product->availability, array('class' => 'form-control', 'placeholder' => 'Please insert quantity here...')) !!}
                                </div>
                            </div>
                            <?php } else{ ?>


                            <div class="form-group">
                                {!! Form::label('price', trans('shop.price') . '', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                                <div class="col-sm-10">
                                    {!! Form::text('price', null, [
                            'class'                         => 'form-control',
                            'placeholder'                   => 'Please insert price here...',
                            'id'                            => 'price',

                            ]) !!}

                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('availability', trans('shop.availability') . '', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                                <div class="col-sm-10">
                                    {!! Form::text('availability', null, [
                            'class'                         => 'form-control',
                            'placeholder'                   => 'Please quantity here...',
                            'id'                            => 'availability',

                            ]) !!}

                                </div>
                            </div>
                        <?php } ?>
                            <div class="form-group">
                                <div class="col-sm-offset-8">
                                    <div class="col-md-6">

                                        <button type="submit" class="btn btn-success">
                                            Next
                                        </button>

                                    </div>

                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection


