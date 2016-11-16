@extends('new')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                @include('common/menucategory')
        </div>
            <div class="col-md-9">
                <section class="panel">
                    <header class="panel-heading">
                        {{trans('shop.edit_category')}}
                    </header>
                    <div class="panel-body">
                        {!! Form::model($category, array('class'=>'form-horizontal tasi-form','method' => 'PATCH', 'route' => array('category_update', $category->id))) !!}
                        @include('errors_messages')
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 col-sm-2 control-label">{{trans('shop.name')}}</label>

                            <div class="col-sm-10">
                                {!! Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Please insert your postt title here...')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('type_id', trans('Type') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-lg-10">
                                {!! Form::select('type_id',$type,Input::old('type_id'),array('class' => 'form-control','id'=>'type')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-sm-2 control-label">
                                {{ Lang::get('app.Use default search form')}}

                            </div>
                            <div class="col-lg-10">
                                <input type="checkbox" name="default_search_form"/>
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
    </div>
@endsection
