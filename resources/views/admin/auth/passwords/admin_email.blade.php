@extends('admin.auth.admin_auth_master')
@section('title')
Admin Forget Password
@endsection
@section('content')
    <form class="forget-form" action="{{ route('admin.password.email') }}" method="post">
        {{ csrf_field() }}
        <h3 class="">Forget Password ?</h3>
        <p> Enter your email below to reset password. </p>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
        <div class="form-actions">
            <a href="{{ route('admin.login') }}" class="btn btn-default">Back</a>
            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
        </div>
    </form>
@endsection
