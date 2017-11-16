@extends('auth.authMaster')
@section('title')
Register
@endsection
@section('pagelevel_style')

@endsection
@section('content')
    <div class="login-content">
        <h1>Alt User Register</h1>
        <form action="{{ url('register') }}" class="Register-form" method="post">
            @if (session('status'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>{{ session('status') }}</span>
                </div>
            @endif
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="Email" name="email" required/>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="First Name" name="f_name" required/>
                        </div>
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Last Name" name="l_name" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" id="register_password" type="password" autocomplete="off" placeholder="Password" name="password" required/> </div>
                <div class="col-sm-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password Confirm" name="password_confirmation" required/> </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="rem-password" style="margin-bottom:20px;">
                        <label style="cursor:pointer;"><input type="checkbox" name="tnc" class="rem-checkbox" /> I agree to the </label> <a class="site-terms-service-btn" href="" target="_blank">Terms of Service</a> and <a class="site-privacy-policy-btn" href="" target="_blank"> Privacy Policy </a>
                        <div id="register_tnc_error"> </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 text-left" style="margin-bottom:20px;">
                    <a class="btn grey" href="{{url('login-page')}}">Back to Login Page</a>
                </div>
                <div class="col-sm-4 text-right">
                    <button class="btn blue" type="submit">Proceed</button>
                </div>
            </div>
        </form>
    </div>
@endsection
