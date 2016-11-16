@extends('new_template.client.layouts.auth')
@section('content')



                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ Lang::get("app.Sign up")}}</div>
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
                            <form class="form-signin" role="form" method="POST" action="register">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <h2 class="form-signin-heading">{{ Lang::get("app.Sign up now")}}</h2>
                                <div class="login-wrap">
                                    <input type="text" id="" name="name" value="{{ old('name') }}" title="First Name" class="form-control" placeholder="Name" /><br/>
                                    <input type="text" id="" name="lastname" value="{{ old('lastname') }}" title="Last Name" class="form-control" placeholder="Last Name" /><br/>
                                    <input type="email" id="" name="email" value="{{ old('email') }}" title="Email" class="form-control" placeholder="Email" /><br/>
                                    <input type="text" id="" name="username" value="{{ old('username') }}" title="Username" class="form-control" placeholder="Username" /><br/>
                                    <input type="password" id="" name="password"  title="Password" class="form-control" placeholder="Password" /><br/>
                                    <input type="password" id="" name="password_confirmation"  title="Confirm Password" class="form-control" placeholder="Confirm password" /><br/>

                                    <button class="btn btn-success" type="submit">{{ Lang::get("app.Register")}}</button><br/><br/>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>


@endsection