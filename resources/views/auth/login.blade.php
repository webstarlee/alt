@extends('auth.authMaster')
@section('title')
Login
@endsection
@section('pagelevel_style')

@endsection
@section('content')
    <div class="login-content">
        <h1>User Login</h1>
        <form action="{{ url('login') }}" class="login-form" method="post">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>Enter Your Email and Password. </span>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    {{ session('error') }}
                </div>
            @endif
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" name="email" required/> </div>
                <div class="col-sm-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="password" required/> </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="rem-password">
                        <p style="cursor:pointer;"><input type="checkbox" class="rem-checkbox" id="remember_me" style="cursor:pointer;" /> <label style="cursor:pointer;" for="remember_me">Remember Me</label>
                        </p>
                    </div>
                </div>
                <div class="col-sm-8 text-right">
                    <div class="forgot-password">
                        <a href="{{url('forget-password')}}" class="forget-password">Forgot Password?</a>
                    </div>
                    <button class="btn blue" type="submit">Sign In</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-left">
                    <div class="forgot-password" style="margin-right:0;padding-top:20px;">
                        <label style="font-size:12px;">Don't you have account? </label><a href="{{ route('register') }}" style="font-size:13px;color:#085af5;"> Create New Account</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
