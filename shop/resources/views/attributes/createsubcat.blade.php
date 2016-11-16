<?php $user = App\User::find(Auth::user()->id);
$user_role = $user['role']['name']; ?>
@extends($user_role=='admin' ? 'new' : 'new_template.client.layouts.user_backend')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                @include('common/subcategorymenu')
            </div>
            <div class="col-md-9">
                <div class="panel">
                    <header class="panel-heading">
                        {{trans('shop.product_attributes')}}
                    </header>
                    <div class="panel-body">
                        {!! Form::open(['url' => route("subcatattributes",array($sub->slug,$sub->id)), 'class' => 'form-horizontal', 'files'=>true, 'id'=>'real-dropzone']) !!}

                        @include('errors/form')


                        <div class="form-group">
                            {!! Form::label('name', trans('shop.attribute_name') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-sm-10">
                                {!! Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Please insert Name...')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('group_id', Lang::get('app.Form Name') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-lg-10">
                                {!! Form::select('group_id',[null=>'Form Name']+$group_name, '', array(
                        'class'                         => 'form-control',
                        'placeholder'                   => ''

                        )) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('data_type', trans('shop.input_data_type') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-sm-10">
                                {!!  Form::select('data_type',[null=>'Please Select Data Type']+array( 'list'=>'list','integer' => 'integer', 'string' => 'string','datetime' => 'datetime'),'' ,array('class' => 'form-control','id'=>'data-type'))!!}
                            </div>
                        </div>
                        <?php $count_item=0; ?>
                        <div class="form-group">
                            <div id="list-attributes" style="display:none">
                                <div class="col-sm-2 col-md-2"></div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" placeholder="Enter values" name="attribute_item[]"/>
                                </div>
                                <div id="add-dynamic-items">
                                </div>
                                <div class="col-md-3">
                                    <input type="button" value="+" id="btn-list-attributes" class="btn btn-default"/>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            {!! Form::label('gui_type', trans('shop.gui_type') . ' *', ['class' => 'col-sm-2 col-sm-2 control-label' ])!!}
                            <div class="col-sm-10">
                                {!!  Form::select('gui_type',[null=>'Please Select GUI Type']+array( 'textbox' => 'textbox', 'checkbox' => 'checkbox','radio' => 'radio','dropdown'=>'dropdown'),'' ,array('class' => 'form-control','id'=>'gui-type'))!!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-6">
                                <input type="hidden" id="token" value="{{ csrf_token() }}">

                                <div class="col-md-3">

                                    {!! Form::submit("Save", array('class' => 'btn btn-success')) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! link_to_route('categoriesindex', trans('shop.cancel'), array(), array('class' => 'btn btn-danger admin'))!!}
                                </div>
                            </div>

                        </div>


                        {!! Form::close() !!}






                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

<style>
    .div-attribute {
        border: 1px solid gray;
        padding: 10px;
        margin-bottom: 30px;
    }
    .otheroptions{
        clear:left;
    }
</style>

@section('scripts')
    <script>
        $(document).ready(function(){

        })
    </script>
@endsection