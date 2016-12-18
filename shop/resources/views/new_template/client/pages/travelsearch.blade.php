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
        <div class="row search-profile">

            <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12 no-padding">
                <div class="control-group">
                    <label class="control-label" for="input01">Text input</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge">
                        <p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 filter-range-price no-padding">
            <div class=".col-sm-9 no-padding">


                <div class="row">
                    <div class="col-md-1">
                        <label for="username" class="control-label">Arrivee</label>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="username" class="form-control" style="margin-top: -5px"
                               placeholder="09-09-2016" autofocus>
                    </div>

                    <div class="col-md-1">
                        <label for="username" class="control-label">Adults(18+)</label>
                    </div>
                    <div class="col-sm-1">
                        <select id="country" class="form-control"
                                style="margin-top: -5px; padding-right: 0px;margin-left: 22px">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="username" class="control-label" style="margin-left: 46px">Entfans(3-17)</label>
                    </div>
                    <div class="col-sm-1">
                        <select id="country" class="form-control" style="margin-top: -5px; padding-right: 0px">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="username" class="control-label">Bebe(<-2)</label>
                    </div>
                    <div class="col-sm-1">
                        <select id="country" class="form-control" style="padding-right: 0px; margin-left: 15px; margin-top: -6px">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-1">
                        <label for="username" class="control-label">Depart</label>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="username" class="form-control" style="margin-top: -5px"
                               placeholder="10-10-2016" autofocus>
                    </div>

                    <div class="col-md-2">
                        <label for="username" class="control-label">Surface en M2</label>
                    </div>
                    <div class="col-sm-1">
                        <select id="country" class="form-control"
                                style="margin-top: -5px; padding-right: 0px; margin-left: -58px; width: 90px">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="username" class="control-label" style="margin-left: -35px">Nombre de piece</label>
                    </div>
                    <div class="col-sm-1">
                        <select id="country" class="form-control"
                                style="margin-top: -5px; margin-left: -81px; padding-right: 0px">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="username" class="control-label" style="margin-left: -80px">Price</label>
                    </div>
                    <div class="col-sm-1" style="width: 100px">
                        <input type="text" name="username" class="form-control" style="margin-top: -32px;margin-left: -36px"
                               placeholder="" autofocus>
                        <input type="text" name="username" class="form-control" style="margin-top: -35px; margin-left: 56px"
                               placeholder="" autofocus>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        <label for="country" class="col-sm-9 control-label" style="margin-left: 21px">Type d`etablissement</label>
                        <div class="col-sm-3">
                            <select id="country" class="form-control">
                                <option>Selectionnez</option>
                                <option>Bahamas</option>
                                <option>Cambodia</option>
                                <option>Denmark</option>
                                <option>Ecuador</option>
                                <option>Fiji</option>
                                <option>Gabon</option>
                                <option>Haiti</option>
                            </select>
                        </div>
                    </div>
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