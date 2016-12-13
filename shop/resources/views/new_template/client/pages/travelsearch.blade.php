@extends('new_template.client.layouts.default')
@section('content')

    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
        <div class="user-profile-top h2-custom" style=" margin-top: 10px; background: #dadadc">
            <div class="user-profile-top h2-custom" style="background: #dadadc">
                <h2 style="padding-top:20px;text-align: left;">{{ Lang::get('app.People')}}</h2>
                <h4>Dardan Ismajli (4)</h4>
                <h2 style="padding-top:20px;text-align: left;">{{ Lang::get('app.Type')}}</h2>
                <form>
                    <div>
                        <label><input type="checkbox" /> Label text</label>
                    </div><div>
                        <label><input type="checkbox" /> Label text</label>
                    </div><div>
                        <label><input type="checkbox" /> Label text</label>
                    </div><div>
                        <label><input type="checkbox" /> Label text</label>
                    </div><div>
                        <label><input type="checkbox" /> Label text</label>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
    </div>
    <div class="col-md-9">
        <div class="row search-profile" id="default-filter1">

            <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12 no-padding">
                <div class="col-md-1 col-sm-1 col-xs-1 col-lg-1 filter-range-price no-padding">
                    <span class="lbl-price">Prix:</span>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5 col-lg-5 filter-range-price">
                    <input type="text" class="form-control from-range" id="frompricehome">
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 filter-range-price no-padding">

                <div class="col-md-1 col-sm-1 col-xs-1 col-lg-1 filter-range-price no-padding">
                    <span class="lbl-price">Prix:</span>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5 col-lg-5 filter-range-price">
                    <input type="text" class="form-control from-range" id="frompricehome">
                </div>
                <span style="float:left;">-</span>

                <div class="col-md-5 col-sm-5 col-xs-5 col-lg-5 filter-range-price">
                    <input type="text" class="form-control to-range" id="topricehome">
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-9">
        <div class="row profile-products" style="margin-top: 10px;">
            <h2 style="padding-top:0px;text-align: left;">{{ Lang::get('app.Shop')}}</h2>

            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <img src="https://1.bp.blogspot.com/-aFQ-W_KTFWQ/V6BdtpSUy6I/AAAAAAAAAH4/xD_U-BYItSsNvk1UGfROqLBzzU1h32oXQCLcB/s320/4-diwali-greeting-cards-by-ajay-acharya.jpg" alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <div class="caption">
                        <h3>Bootstrap Thumbnail Customization</h3>
                        <p class="card-description"><strong>Bootstrap Thumbnail</strong> Customization Example. Here are customized <strong>bootstrap cards</strong>. We just apply some box shadow and remove border radius.</p>
                        <p>Lieux <span style="color: #E28D33">Kosova</span></p>
                        <a href="#" class="my-btn" role="button">Button</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <img src="https://1.bp.blogspot.com/-aFQ-W_KTFWQ/V6BdtpSUy6I/AAAAAAAAAH4/xD_U-BYItSsNvk1UGfROqLBzzU1h32oXQCLcB/s320/4-diwali-greeting-cards-by-ajay-acharya.jpg" alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <div class="caption">
                        <h3>Bootstrap Thumbnail Customization</h3>
                        <p class="card-description"><strong>Bootstrap Thumbnail</strong> Customization Example. Here are customized <strong>bootstrap cards</strong>. We just apply some box shadow and remove border radius.</p>
                        <p>Lieux <span style="color: #E28D33">Kosova</span></p>
                        <a href="#" class="my-btn" role="button">Button</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <img src="https://1.bp.blogspot.com/-aFQ-W_KTFWQ/V6BdtpSUy6I/AAAAAAAAAH4/xD_U-BYItSsNvk1UGfROqLBzzU1h32oXQCLcB/s320/4-diwali-greeting-cards-by-ajay-acharya.jpg" alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <div class="caption">
                        <h3>Bootstrap Thumbnail Customization</h3>
                        <p class="card-description"><strong>Bootstrap Thumbnail</strong> Customization Example. Here are customized <strong>bootstrap cards</strong>. We just apply some box shadow and remove border radius.</p>
                        <p>Lieux <span style="color: #E28D33">Kosova</span></p>
                        <a href="#" class="my-btn" role="button">Button</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <img src="https://1.bp.blogspot.com/-aFQ-W_KTFWQ/V6BdtpSUy6I/AAAAAAAAAH4/xD_U-BYItSsNvk1UGfROqLBzzU1h32oXQCLcB/s320/4-diwali-greeting-cards-by-ajay-acharya.jpg" alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <div class="caption">
                        <h3>Bootstrap Thumbnail Customization</h3>
                        <p class="card-description"><strong>Bootstrap Thumbnail</strong> Customization Example. Here are customized <strong>bootstrap cards</strong>. We just apply some box shadow and remove border radius.</p>
                        <p>Lieux <span style="color: #E28D33">Kosova</span></p>
                        <a href="#" class="my-btn" role="button">Button</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <img src="https://1.bp.blogspot.com/-aFQ-W_KTFWQ/V6BdtpSUy6I/AAAAAAAAAH4/xD_U-BYItSsNvk1UGfROqLBzzU1h32oXQCLcB/s320/4-diwali-greeting-cards-by-ajay-acharya.jpg" alt="Bootstrap Thumbnail: Beautiful Bootstrap Thumbnail like Material Design Cards">
                    <div class="caption">
                        <h3>Bootstrap Thumbnail Customization</h3>
                        <p class="card-description"><strong>Bootstrap Thumbnail</strong> Customization Example. Here are customized <strong>bootstrap cards</strong>. We just apply some box shadow and remove border radius.</p>
                        <p>Lieux <span style="color: #E28D33">Kosova</span></p>
                        <a href="#" class="my-btn" role="button">Button</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
<style>
    .my-btn {
        color: #ffffff;
        background-color: #1BBD1B;
        border-color: #0B6902;
        padding: 10px 83px;
        margin-left: -12px;
    }

    .my-btn:hover,
    .my-btn:focus,
    .my-btn:active,
    .my-btn.active,
    .open .dropdown-toggle.my-btn {
        color: #ffffff;
        background-color: #26B510;
        border-color: #0B6902;
    }

    .my-btn:active,
    .my-btn.active,
    .open .dropdown-toggle.my-btn {
        background-image: none;
    }

    .my-btn.disabled,
    .my-btn[disabled],
    fieldset[disabled] .my-btn,
    .my-btn.disabled:hover,
    .my-btn[disabled]:hover,
    fieldset[disabled] .my-btn:hover,
    .my-btn.disabled:focus,
    .my-btn[disabled]:focus,
    fieldset[disabled] .my-btn:focus,
    .my-btn.disabled:active,
    .my-btn[disabled]:active,
    fieldset[disabled] .my-btn:active,
    .my-btn.disabled.active,
    .my-btn[disabled].active,
    fieldset[disabled] .my-btn.active {
        background-color: #1BBD1B;
        border-color: #0B6902;
    }

    .my-btn .badge {
        color: #1BBD1B;
        background-color: #ffffff;
    }
</style>