@extends('new_template.client.layouts.default')
@section('content')
  <div class="page-content">
    <br/>
    <br/>
  <section class="main-container col1-layout">
    <div class="main container">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">{{trans('shop.signup')}}</div>
          <div class="panel-body">

            @if (count($errors) > 0)
              <div class="alert alert-danger">
                <strong>{{trans('shop.whoops')}}</strong> {{trans('shop.input_error')}}<br><br>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            @if(\Illuminate\Support\Facades\Session::has('confirm_email'))
              <div class="alert alert-success">{{ \Illuminate\Support\Facades\Session::get('confirm_email') }}</div>
            @endif
            <div id="checkout-step-billing" class="step a-item">
              <form class="form-horizontal" role="form" method="POST" action="register">
                <p class="require"><em class="required">* </em>{{trans('shop.required')}}</p>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset class="group-select">
                  <ul>
                    <li id="billing-new-address-form">
                      <fieldset>
                        <ul>
                          <li>
                            <div class="customer-name">
                              <div class="input-box name-firstname">
                                <label for="billing:firstname">{{trans('shop.first_name')}}<span class="required">*</span></label>
                                <br />
                                <input type="text" id="billing:firstname" name="name" value="{{ old('name') }}" title="First Name" class="input-text form-control" />
                              </div>
                              <div class="input-box name-lastname">
                                <label for="billing:lastname">{{trans('shop.last_name')}}<span class="required">*</span> </label>
                                <br />
                                <input type="text" id="billing:lastname" name="lastname" value="{{ old('lastname') }}" title="Last Name" class="input-text form-control" />
                              </div>
                            </div>
                          </li>
                          <li>
                            <label for="billing:street1">{{trans('shop.email_address')}} <span class="required">*</span></label>
                            <br />
                            <input type="text" title="Email" name="email" value="{{ old('email') }}" id="billing:street1  street1" class="input-text form-control" />
                          </li>
                          <li>
                            <label for="billing:street1">{{trans('shop.username')}}<span class="required">*</span></label>
                            <br />
                            <input type="text" title="Username" name="username" value="{{ old('username') }}" id="billing:street2 street2" class="input-text form-control" />
                          </li>

                          <li id="register-customer-password">
                            <div class="input-box">
                              <label for="billing:customer_password">{{trans('shop.password')}} <span class="required">*</span></label>
                              <br />
                              <input type="password" name="password" id="billing:customer_password" title="Password" class="input-text form-control" />
                            </div>
                            <div class="input-box">
                              <label for="billing:confirm_password">{{trans('shop.confirm_password')}}<span class="required">*</span></label>
                              <br />
                              <input type="password" name="password_confirmation" title="Confirm Password" id="billing:confirm_password" class="input-text form-control" />
                            </div>
                          </li>
                          <li>
                            <button type="submit" class="btn btn-success" onClick="billing.save()"><span>Register</span></button>
                          </li>
                        </ul>
                      </fieldset>
                    </li>
                  </ul>


                </fieldset>
              </form>
            </div>
            </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  </div>
@endsection
