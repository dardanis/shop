@extends('new')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-9 col-sm-5">
                        <div class="tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href='#'><span class="glyphicon glyphicon-cog"></span>Basic
                                        Info</a></li>
                            </ul>
                        </div>
                        <!-- /tabbable -->
                    </div>
                    <!-- /col -->
                </div>
                <!-- /row -->
            </div>
            <div class="col-md-9">
                <section class="panel">
                    <header class="panel-heading">
                        {{trans('shop.add_category')}}
                    </header>
                    <div class="panel-body">
                        @include('errors_messages')
                        {!! Form::open(array('route' => 'store_category','files'=>true,'class'=>'form-horizontal tasi-form')) !!}


                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('type_id', trans('Type') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                                <div class="col-lg-10">

                                    {!! Form::select('type_id',[null=>'Please Select one type']+$type,'', array(
                            'class'                         => 'form-control',
                            'name'                          =>'type_id',
                            'placeholder'                   => '',
                            'required',
                            'id'                            => '',
                            'data-parsley-required-message' => 'Type is required',
                            'data-parsley-trigger'          => 'change focusout',

                            )) !!}
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-2 col-sm-2 control-label">
                                {{ Lang::get('app.Use default search form')}}

                            </div>
                            <div class="col-lg-10">
                                <input type="checkbox" name="default_search_form" value="0"/>
                            </div>
                        </div>
                            <div class="col-sm-1 col-sm-offset-6" style="margin-right:20px;">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('shop.add_category')}}
                                </button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </section>


            </div>
        </div>
    </div>

@stop