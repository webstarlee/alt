@extends('auth.authMaster')
@section('title')
Login
@endsection
@section('pagelevel_style')

@endsection
@section('content')
    <div class="login-content">
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form class="forget-form" action="javascript:;" method="post">
            <h3 class="font-green">Forgot Password ?</h3>
            <p> Enter your e-mail address below to reset your password. </p>
            <div class="form-group">
                <input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
            <div class="form-actions">
                <a class="btn grey btn-default" href="{{url('login-page')}}">Back</a>
                <button type="submit" class="btn blue btn-success uppercase pull-right">Submit</button>
            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->
    </div>
@endsection
