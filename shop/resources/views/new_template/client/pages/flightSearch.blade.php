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
                        <label><input type="checkbox"/> Label text</label>
                    </div>
                    <div>
                        <label><input type="checkbox"/> Label text</label>
                    </div>
                    <div>
                        <label><input type="checkbox"/> Label text</label>
                    </div>
                    <div>
                        <label><input type="checkbox"/> Label text</label>
                    </div>
                    <div>
                        <label><input type="checkbox"/> Label text</label>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="col-md-3 col-sm-12 col-lg-3 col-xs-12 profile-left">
    </div>
    <div class="col-md-9">
        <div class="row search-profile">

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 filter-range-price no-padding">
                <div class=".col-sm-9 no-padding">
                    <div class="row">
                        <div class="col-md-1">
                            <label for="username" class="control-label">Type</label>
                        </div>

                        <div class="col-md-3">
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Option 1
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Option 2
                            </label>
                        </div>
                        <div class="col-md-1">
                            <label for="username" class="control-label">Depart</label>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="username" class="form-control" style="margin-top: -5px"
                                   placeholder="Ville" autofocus>
                        </div>
                        <div class="col-md-1">
                            <label for="username" class="control-label">Destination</label>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="username" class="form-control" style="margin-top: -5px"
                                   placeholder="Ville" autofocus>
                        </div>
                    </div>
                    <br>
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
                        <div class="col-sm-3">
                            <select id="country" class="form-control"
                                    style="margin-top: -5px; padding-right: 0px;margin-left: 22px;width: 75px">
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
                            <select id="country" class="form-control"
                                    style="padding-right: 0px; margin-left: 59px; margin-top: -6px">
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
                            <label for="username" class="control-label">Entfans(3-17)</label>
                        </div>
                        <div class="col-sm-3">
                            <select id="country" class="form-control"
                                    style="margin-top: -5px; padding-right: 0px; margin-left: -58px; width: 90px">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-sm-1">

                        </div>
                        <div class="col-md-1">
                            <label for="username" class="control-label" style="margin-left: -80px">Price</label>
                        </div>
                        <div class="col-sm-1" style="width: 100px">
                            <input type="text" name="username" class="form-control"
                                   style="margin-top: -4px;margin-left: -71px"
                                   placeholder="" autofocus>
                            <input type="text" name="username" class="form-control"
                                   style="margin-top: -35px; margin-left: 28px"
                                   placeholder="" autofocus>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="form-group">
                            <label for="country" class="col-sm-9 control-label" style="margin-left: 21px">Type
                                d`etablissement</label>

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

    </div>
    <div class="col-md-9">
        <div class="row profile-products" style="margin-top: 10px;">
            <h2 style="padding-top:0px;text-align: left;">{{ Lang::get('app.Shop')}}</h2>
        </div>
    </div>
@stop
<style>
    label {
        display: block;
        padding-left: 15px;
        text-indent: -15px;
    }

    input {
        width: 13px;
        height: 13px;
        padding: 0;
        margin: 0;
        vertical-align: bottom;
        position: relative;
        top: -1px;
        *overflow: hidden;
    }
</style>