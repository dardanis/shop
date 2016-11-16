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
            <?php
            $gender="";
            $name="";
            $lastname="";
            $profession="";
            $siteactivity="";
            $username="";
            $email="";
            $activity_society="";
            $phone="";
            $street="";
            $optional_street="";
            $zip="";
            $location="";
            $payment="";

            ?>
            <?php $user_id=\App\User::find(Auth::user()->id);?>
            <?php $adress = \Illuminate\Support\Facades\DB::table('contact_infos')->where('user_id', '=', $user_id['id'])->get();?>
            <?php if(sizeof($adress)>0){?>
                 <?php foreach($adress as $a){
                $gender=$a->gender;
                $name=$a->name;
                $lastname=$a->last_name;
                $profession=$a->profession;
                $siteactivity=$a->activity_site;
                $username=$a->username;
                $email=$a->email;
                $activity_society=$a->activity_society;
                $phone=$a->phone;
                $street=$a->street;
                $optional_street=$a->optional_street;
                $zip=$a->zip;
                $location=$a->location;
                $payment=$a->payment;
                ?>
                  <?php }?>
                <?php } ?>
            <div  class="col-md-12" style="padding-left: 0px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"> {{ Lang::get("app.Address")}}</div>
                    </div>
                    <div class="panel-body" >
                        @if( Session::has( 'success' ))
                            <div class="alert alert-success">{{ Session::get( 'success' ) }}</div>
                            @elseif( Session::has( 'warning' ))
                            {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
                        @endif

                        {!! Form::open(array('route' =>array('storecontact'),'files'=>true,'class'=>'form-horizontal tasi-form')) !!}
                        @include('errors/form')
                        <?php if(sizeof($adress)>0){?>
                            <div class="col-md-2 col-sm-2"></div>
                            <div class="form-group">
                                <input type="radio" name="gender" value="male" style="margin-bottom: 3px;" <?php if($gender="male"){ echo "checked";}?>/><span style="margin-right:20px;" >{{ Lang::get('app.Male') }}</span>
                                <input type="radio" name="gender" value="female" style="margin-bottom: 3px;" <?php if($gender="female"){ echo "checked";}?> /><span>{{ Lang::get('app.Female') }}</span>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Name') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px;">
                                    {!! Form::text('name', $name, array('class' => 'form-control','id'=>'name')) !!}
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Last Name') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('last_name', $lastname, array('class' => 'form-control','id'=>'last_name')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Profession') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('profession', $profession, array('class' => 'form-control','id'=>'address')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Activity on the site') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    <select name="activity_site" class="form-control">
                                        <option value="">{{ Lang::get('app.Select activity') }}</option>
                                        <option value="<?php echo $siteactivity;?>" <?php if($siteactivity=="enterprise"){ echo "selected"; } ?>>{{ Lang::get('app.Enterprise') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Username') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('username', $username, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Social Activity') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    <select name="activity_society" class="form-control">
                                        <option value="">{{ Lang::get('app.Select Social Activity') }}</option>
                                        <option value="<?php echo $activity_society;?>" <?php if($activity_society=="commercial"){ echo "selected"; } ?>>{{Lang::get('app.Commercial')}}</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Telephone') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('phone', $phone, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Email') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('email', $email, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Street') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('street', $street, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Other Street') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('optional_street', $optional_street, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Zip') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('zip', $zip, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Lccation') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('location', $location, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Payment') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    <select name="payment" class="form-control">
                                        <option value="">{{ Lang::get('app.Select Payment type') }}</option>
                                        <option value="<?php echo $payment;?>" <?php if($payment=="suisse"){ echo "selected"; } ?>>{{Lang::get('app.Suisse')}}</option>
                                    </select>
                                </div>
                            </div>
                        <?php } else {?>
                            <div class="col-md-2 col-sm-2"></div>
                            <div class="form-group">
                                <input type="radio" name="gender" value="male" style="margin-bottom: 3px;"/><span style="margin-right:20px;">{{ Lang::get('app.Male') }}</span>
                                <input type="radio" name="gender" value="female" style="margin-bottom: 3px;"/><span>{{ Lang::get('app.Female') }}</span>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Name') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px;">
                                    {!! Form::text('name', $name, array('class' => 'form-control','id'=>'name')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Last Name') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('last_name', $lastname, array('class' => 'form-control','id'=>'last_name')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Profession') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('profession', $profession, array('class' => 'form-control','id'=>'address')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Activity on the site') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                   <select name="activity_site" class="form-control">
                                       <option value="">{{ Lang::get('app.Select activity') }}</option>
                                       <option value="enterprise">{{ Lang::get('app.Enterprise') }}</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Username') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('username', $username, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Social Activity') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    <select name="activity_society" class="form-control">
                                        <option value="">{{ Lang::get('app.Select Social Activity') }}</option>
                                        <option value="commercial">{{ Lang::get('app.Commercial') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Telephone') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('phone', $phone, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Email') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('email', $email, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Street') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('street', $street, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Other Street') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('optional_street', $optional_street, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Zip') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('zip', $zip, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Lccation') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    {!! Form::text('location', $location, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label col-md-2 col-sm-2">{{ Lang::get('app.Payment') }}</div>
                                <div class="col-sm-5" style="padding-left: 0px">
                                    <select name="payment" class="form-control">
                                        <option value="">{{ Lang::get('app.Select Payment type') }}</option>
                                        <option value="suisse">{{ Lang::get('app.Suisse') }}</option>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">

                                <input type="hidden" id="token" value="{{ csrf_token() }}">
                            <div class="col-md-3">
                                {!! Form::submit(Lang::get('app.Save'), array('class' => 'btn btn-secondary')) !!}
                            </div>
                                <div class="col-md-3" style="float:right">
                                    {!! Form::submit(Lang::get('app.Save'), array('class' => 'btn btn-success')) !!}
                                </div>

                            </div>
                        </div>

                        {!! Form::close() !!}

        </div>
    </div>
@stop