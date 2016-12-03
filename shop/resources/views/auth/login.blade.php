@extends('new_template.client.layouts.auth')
@section('content')

                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ Lang::get("app.Sign in")}}</div>
                        <div class="panel-body">
                            @if(Session::has('confirm_email'))
                                <div class="alert alert-success">{{ Session::get('confirm_email') }}</div>
                            @endif
                            <?php if($redirecturl!=""){?>
                                <form class="form-signin" role="form" method="POST" action="login?redirecturl=<?php echo $redirecturl;?>">
                            <?php  } else {?>
        <form class="form-signin" role="form" method="POST" action="login">
            <?php } ?>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h2 class="form-signin-heading">{{ Lang::get("app.Sign in now")}}</h2>
            <div class="login-wrap">
                <input type="text" class="form-control" placeholder="Username or email" name="email" value="{{ old('email') }}" autofocus><br/>
                <input type="password" class="form-control" placeholder="Password" name="password">
                <label class="checkbox" style="padding-left: 39px;">
                    <input type="checkbox"  name="remember"> {{ Lang::get("app.Remember me")}}
                <div class="pull-right">
                    <a  href="/password/email"> {{ Lang::get("app.Forgot Password?")}}</a>
                </div>
                </label>
                <button class="btn btn-success" type="submit">{{ Lang::get("app.Sign in")}}</button><br/><br/>
                <div class="registration">
                    {{ Lang::get("app.Don't have an account yet?")}}
                    <a class="" href="/signup">
                        {{ Lang::get("app.Create an account")}}
                    </a>
                </div>
            </div>

        </form>

        </div>
    </div>
    </div>

@endsection
