

<?php $user = App\User::find(Auth::user()->id);
$user_role = $user['role']['name']; ?>
@extends($user_role=='admin' ? 'new' : 'new_template.client.layouts.default')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('common/breadcrumbs')
    </div>
    <div class="col-md-3 profile-left">
        @include('common.left_myaccount')
    </div>
    <div class="col-md-9">
        <div class="row" style="margin-bottom:20px;">
            <ul class="progressbar">

                <li class="completed"><a href="/edit/<?php echo $slug;?>/<?php echo $id;?>">{{ Lang::get('app.Basic Info') }}</a></li>
                <li class="completed"><a href="/product/product_attributes/<?php echo $slug;?>/<?php echo $id;?>">{{ Lang::get('app.Extra Info')  }}</a></li>
                <li class="completed"><a href="/product/images/<?php echo $slug;?>/<?php echo $id;?>">{{ Lang::get('app.Gallery') }}</a></li>
                <li class="completed"><a href="/product/create/adress/<?php echo $slug;?>/<?php echo $id;?>"  style="color:#E28D33 !important;">{{ Lang::get('app.Adress') }}</a></li>
            </ul>

        </div>
        <div class="row profile-products">
            @include('common/userinfo')
          </div>
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
        <div class="row profile-products" style="margin-top: 20px;">
            <a href="#" class="show-another-adress">{{ Lang::get('app.Add another adress') }}<span class="glyphicon glyphicon-chevron-down address-open" aria-hidden="true" style="padding-top:3px;float:right"></span><span class="glyphicon glyphicon-chevron-up address-close" aria-hidden="true" style="padding-top:3px;float:right"></span></a>
            <div class="panel panel-default" id="add-adress-product">
                <hr/>
                <div class="panel-heading">
                    <div class="panel-title"> {{ Lang::get("app.Edit Product")}}</div>
                </div>
                <div class="panel-body" >

                    {!! Form::open(array('route' =>array('storeadress',$slug, $id),'files'=>true,'class'=>'form-horizontal tasi-form')) !!}
                    @include('errors/form')
                    <?php if(sizeof($adress)>0){?>

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
                        <div class="col-md-offset-6 col-md-6">

                            <div class="form-group">

                                <input type="hidden" id="token" value="{{ csrf_token() }}">
                                <div class="col-md-6">
                                    <a href="/profile" class="btn btn-default btn-default-links">{{ Lang::get('app.Cancel') }}</a>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::submit(Lang::get('app.Save'), array('class' => 'btn btn-success')) !!}
                                </div>

                            </div>
                        </div>
                     </div>

                {!! Form::close() !!}

                </div>
            </div>
        </div>

</div>

@endsection


