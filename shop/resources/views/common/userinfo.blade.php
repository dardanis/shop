
<?php $addressproduct=\App\Product::where('adress_id','!=',0)->where('id','=',$id)->get()->first();?>


<?php if(sizeof($addressproduct)>0){?>
<?php $addressinfo=\App\ContactInfo::where('id','=',$addressproduct->adress_id)->get();?>
<?php } else {?>
    <?php $addressinfo=\App\ContactInfo::where('user_id','=',$user->id)->where('in_products','=',0)->get();?>
<?php }?>
<h2 style="padding-top:20px;text-align: center;">{{ Lang::get('app.Informations')}}</h2>
<p style="margin-left: 10px;">{{ Lang::get('app.Adresse') }}: </p>
<div class="profile-informations" style="margin-left: 20px;">
    <?php foreach($addressinfo as $ai){?>
    <p style="font-weight:bold;"><?php echo $ai->street;?> <br/>
        <?php echo $ai->zip;?><br/>
        <?php echo $ai->location;?><br/>
        <?php echo $ai->payment;?>


    </p>
    <?php } ?>

</div>
<p  style="margin-left: 10px;"> {{ Lang::get('app.Contact') }}:</p>
<div class="profile-informations"  style="margin-left: 20px;">
    <?php foreach($addressinfo as $ai){?>
    <p style="font-weight:bold;"><?php echo $ai->name; ?> <?php echo $ai->last_name;?> <br/>
        <?php echo $ai->profession;?><br/>
        <?php echo $ai->email;?><br/>

    </p>
    <?php } ?>

</div>