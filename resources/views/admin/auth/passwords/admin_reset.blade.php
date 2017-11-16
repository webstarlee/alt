@extends('admin.auth.admin_master')
@section('title')
Admin Reset Password
@endsection
@section('content')
<form class="login-form" action="{{ url('admin/password-reset') }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="token" value="{{ $token }}">
    <h3 class="form-title font-green">Admin Password Reset</h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> Enter any username and password. </span>
    </div>
    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" name="email" required />
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" id="register_password" autocomplete="off" placeholder="Password" name="password" required />
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password Confirm</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password Confirm" name="password_confirmation" required />
    </div>
    <div class="form-actions">
        <button type="submit" class="btn green uppercase">Submit</button>
    </div>
</form>
@endsection
