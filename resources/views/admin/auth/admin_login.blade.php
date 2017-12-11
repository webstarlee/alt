@extends('admin.auth.admin_auth_master')
@section('title')
Admin login
@endsection
@section('content')
<form class="login-form" action="{{ url('admin/login') }}" method="post">
  {{ csrf_field() }}
    <h3 class="form-title text-center">Admin</h3>
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
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" name="email" required /> </div>
        </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required /> </div>
        </div>
    <div class="form-actions">
        <label class="checkbox" style="cursor:pointer;">
            <input type="checkbox" name="remember" value="1" /> Remember me </label>
        <button type="submit" class="btn green pull-right"> Login </button>
        <div class="forget-password">
            <h4>Forgot your password ?</h4>
            <p> No worries, click
                <a href="{{ route('admin.password.request') }}"> here </a> to reset your password. </p>
        </div>
    </div>
</form>
@endsection
