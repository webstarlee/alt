@extends('admin.auth.admin_auth_master')
@section('title')
Admin login
@endsection
@section('content')
<form class="login-form" action="{{ url('admin/login') }}" method="post">
  {{ csrf_field() }}
    <h3 class="form-title font-green">Admin</h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> Enter email and password. </span>
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" name="email" required /> </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required /> </div>
    <div class="form-actions">
        <button type="submit" class="btn green uppercase">Login</button>
        <label class="rememberme check"><input type="checkbox" name="remember" value="1" />Remember</label>
        <a href="{{ route('admin.password.request') }}" class="forget-password">Forgot Password?</a>
    </div>
</form>
@endsection
