<?php    $user = App\User::find(Auth::user()->id);?>
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
            <div class="panel panel-default">
                <div class="panel-heading">Change profile</div>
                <div class="panel-body">

                    @if(session()->has('success'))
                        <div class="alert alert-success alert-block fade in">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <h4>
                                <strong>Success.</strong>
                            </h4>

                            <p>{!! session('success') !!}</p>
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-block alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <h4>
                                Error
                            </h4>

                            <p>{!! session('error') !!}</p>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel-body bio-graph-info">
                        {!! Form::model($user, array('class'=>'form-horizontal tasi-form','method' => 'PATCH', 'files'=>'true','route' => array('edit_profile'))) !!}
                        <div class="form-group @if($errors->has('avatar')) has-error @endif">
                            <label class="col-sm-2 col-sm-2 control-label">Avatar</label>
                            <div class="col-sm-10">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 200px;">
                                    <img src="{{$user->profile}}" alt="" id="preview_profile" src="#" style="max-height:190px;max-width:180px;" />
                                </div>
                                <input id="profile" name="profile" type="file" onchange="profilechange(this)"; />
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                            <div class="col-sm-6">
                                {!! Form::text('name', $user->name, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('lastname')) has-error @endif">
                            <label class="col-sm-2 col-sm-2 control-label">Last name</label>
                            <div class="col-sm-6">
                                {!! Form::text('lastname', $user->lastname, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('email')) has-error @endif">
                            <label class="col-sm-2 col-sm-2 control-label">Email</label>
                            <div class="col-sm-6">
                                {!! Form::text('email', $user->email, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group @if($errors->has('username')) has-error @endif">
                            <label class="col-sm-2 col-sm-2 control-label">Username</label>
                            <div class="col-sm-6">
                                {!! Form::text('username', $user->username, array('class' => 'form-control')) !!}
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-offset-4 col-lg-6">
                                <div class="col-md-3">
                                <button type="submit" class="btn btn-success">Save</button>
                                </div>
                                <div class="col-md-3">
                                <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div></div>

            </div>
            <div class="row profile-products">

                    <div class="panel panel-default">
                        <div class="panel-heading">Change password</div>
                        <div class="panel-body">

                            {!! Form::model($user, array('class'=>'form-horizontal tasi-form','method' => 'PATCH','route' => array('change_password'))) !!}
                            <div class="form-group @if($errors->has('old_password')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Old password</label>
                                <div class="col-sm-6">
                                    <input type="password"  class="form-control" name="old_password" >
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('password')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">New password</label>
                                <div class="col-sm-6">
                                    <input type="password"  class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('password_again')) has-error @endif">
                                <label class="col-sm-2 col-sm-2 control-label">Confirm password</label>
                                <div class="col-sm-6">
                                    <input type="password"  class="form-control" name="password_again" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-4 col-lg-6">
                                    <div class="col-md-3">
                                    <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    <div class="col-md-3">
                                    <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

            </div>
        </div>
@stop
    <style>
        .profile-tab a{
            color:#E28D33 !important;
        }
    </style>
