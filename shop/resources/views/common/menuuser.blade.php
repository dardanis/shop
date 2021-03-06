<div class="container">
<div class="col-md-12">
    <div class="row step">

        <div id="div1" class="col-md-2 step-tab" href="{{ url("/edit/$product->slug/$product->id") }}" onclick="location.href='{{ url("/edit/$product->slug/$product->id") }}'">
            <span class="fa fa-cog"></span>
            <p>{{ Lang::get('app.Basic info') }}</p>
        </div>
        <?php $typealias = \Illuminate\Support\Facades\DB::table('products')->where('id', '=', $product->id)->get();?>
        <?php foreach($typealias as $talias){?>
        <?php $type_id=$talias->type_id;?>
        <?php } ?>
        <?php $typealiasid = \Illuminate\Support\Facades\DB::table('product_types')->where('id', '=', $type_id)->get();?>
        <?php foreach($typealiasid as $talias){?>
        <?php $type_alias=$talias->alias;?>
        <?php } ?>
        <?php if($type_alias=="shop"){?>
        <div class="col-md-2 step-tab" href="{{ url("/shopfields/$product->slug/$product->id") }}" onclick="location.href='{{ url("/shopfields/$product->slug/$product->id") }}'">
            <span class="fa fa-cog"></span>
            <p>{{ Lang::get('app.Shop data') }}</p>
        </div>
        <?php } ?>

        <div class="">
            <div class="col-md-2 step-tab" href="{{ url("product/create/adress/$product->slug/$product->id") }}" onclick="location.href='{{ url("product/create/adress/$product->slug/$product->id") }}'">
                <span class="fa fa-map-marker"></span>
                <p>{{ Lang::get('app.Address') }}</p>
            </div>
            <?php $pictures=\App\Product::with('pictures')->find($product->id)->pictures; ?>
            <?php if(sizeof($pictures)>0){?>


            <div class="col-md-2 step-tab" href="{{ url("product/images/edit/$product->slug/$product->id") }}" onclick="location.href='{{ url("product/images/edit/$product->slug/$product->id") }}'">
                <span class="fa fa-image"></span>
                <p>{{ Lang::get('app.Images') }}</p>
            </div>
            <?php }else {?>
            <div class="col-md-2 step-tab" href="{{ url("product/images/$product->slug/$product->id") }}" onclick="location.href='{{ url("product/images/$product->slug/$product->id") }}'">
                <span class="fa fa-image"></span>
                <p>{{ Lang::get('app.Images') }}</p>
            </div>
            <?php } ?>

            <div class="col-md-2 step-tab" href="{{ url("product/product_attributes/$product->slug/$product->id") }}" onclick="location.href='{{ url("product/product_attributes/$product->slug/$product->id") }}'">
                <span class="fa fa-th-list"></span>
                <p>{{ Lang::get('app.Product Attributes') }}</p>
            </div>
            <div class="col-md-2 step-tab" href=" {{ URL::route('product_show',array($product->slug,$product->id)) }}" onclick="location.href=' {{ URL::route('product_show',array($product->slug,$product->id)) }}'">
                <span class="fa fa-eye"></span>
                <p>{{ Lang::get('app.View Item') }}</p>
            </div>


            {{--<div id="last" class="col-md-2 step-tab" href="" onclick="location.href=''">
                <span class="fa fa-cloud-upload"></span>

                <p>Publish
                </p>
            </div>

            <div id="last" class="col-md-2 step-tab">

                <p><a style="color:#5CB85C;display:block" target="_blank" href="">
                        <span class="fa fa-eye" style="color:#5CB85C"></span><br> Preview</a></p>
            </div>--}}
        </div>
    </div>
</div>
</div>
<style>
    .nav-tabs li {
        width:100%;
    }
    .nav > li > a:hover, .nav > li > a:focus{
        background-color: #e74c3c !important;
    }
    .nav-tabs>li>a:hover{
        border-color:#e74c3c;
    }
    .nav>li>a:hover, .nav>li>a:focus{
        background-color: #e74c3c !important;
    }
    .nav-tabs>li>a:hover{
        border-color:#e74c3c;
    }
    .nav>li>a:hover, .nav>li>a:focus{
        background-color: #e74c3c !important;
    }
    .nav-tabs>li>a{
        border-radius: 0px;
    }
    #sidebar {
        width: 210px;
        /* height: 100%; */
        position: inherit;
        background: #2a3542;
        float: left;
    }


    .hiddenStepInfo {
        display: none;
    }

    .activeStepInfo {
        display: block !important;
    }

    .underline {
        text-decoration: underline;
    }

    .step {
        margin-top: 27px;
    }

    .setup-content {
        margin-top: 30px
    }

    .setup-content .tabbable-line > .nav-tabs > li.active {
        border-bottom: 4px solid #F3565D;
        position: relative;
    }

    .setup-content .tabbable-line > .nav-tabs > li.open, .tabbable-line > .nav-tabs > li:hover {
        border-bottom: 4px solid #fbcdcf;
    }

    .progress {
        position: relative;
        height: 25px;
    }

    .progress > .progress-type {
        position: absolute;
        left: 0px;
        font-weight: 800;
        padding: 3px 30px 2px 10px;
        color: rgb(255, 255, 255);
        background-color: rgba(25, 25, 25, 0.2);
    }

    .progress > .progress-completed {
        position: absolute;
        right: 0px;
        font-weight: 800;
        padding: 3px 10px 2px;
    }

    .step {
        text-align: center;
    }

    .step .step-tab {
        background-color: #fff;
        border: 1px solid #C0C0C0;
        border-right: none;
    }

    .step .step-tab:last-child {
        border: 1px solid #C0C0C0;
    }

    .step .disabled-menu {
        background-color: #dedede;
    }

    .step .step-tab:first-child {

    }

    .step .step-tab:last-child {
        border-radius: 0 5px 5px 0;
    }

    .step .step-tab:nth-child(5) {
        border-right: 1px solid #C0C0C0;
    }

    .step .step-tab:hover {
        color: #2ba8db;
        cursor: pointer;
    }

    .step .activestep {
        color: black;
        height: 105px;
        /* margin-top: -7px; */
        padding-top: 7px;
        border-left: 1px solid #2ba8db !important;
        border-right: 1px solid #2ba8db !important;
        border-top: 1px solid #2ba8db !important;
        border-bottom: 1px solid #2ba8db !important;
        vertical-align: central;
    }

    .step .fa {
        padding-top: 15px;
        font-size: 40px;
    }

    .well {
        background-color: #FFFFFF;
        border: 1px solid #C0C0C0;
    }

</style>
