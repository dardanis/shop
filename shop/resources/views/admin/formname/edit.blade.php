@extends('new')

@section('content')
    <div class="row">
        <div class="col-lg-12">


                <section class="panel">
                    <header class="panel-heading">
                        {{trans('shop.edit')}}
                    </header>
                    <div class="panel-body">
                        {!! Form::model($formname, array('class'=>'form-horizontal tasi-form','method' => 'put', 'route' => array('formnameupdate', $id))) !!}
                        @include('errors_messages')
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}</label>
                            <div class="col-sm-4">
                                <input type="text" name="group_name" value="<?php echo $name;?>" class="form-control"/>
                                <input type="hidden" name="form_id" value="<?php echo $id;?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('category', trans('shop.category') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-lg-4">
                                {!! Form::select('category_id',$category,Input::old('category_id'),array('class' => 'form-control','id'=>'first')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-10">
                                {!! Form::submit(trans('shop.save'), array('class' => 'btn btn-success')) !!}
                                {!! link_to_route('categoriesindex', trans('shop.cancel'), array(), array('class' => 'btn btn-danger'))!!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </div>
@endsection
