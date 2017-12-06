@extends('master')
@section('title')
Welcome
@endsection
@section('pagelevel_plugin')
    <link href="{{ cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('custom_style')
    <link href="{{cdn('css/profile.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="homepage-background-div profile"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div style="width: 100%;position: relative;">
                    <div class="user-profile-container-div zoomIn">
                        <div class="card hovercard">
                            <div class="useravatar">
                                @if(file_exists('assets/images/avatar/'.'/'.Auth::user()->avatar.'_thumbnail.jpg'))
                                  <img alt=""  src="{{ cdn('assets/images/avatar/').'/'.Auth::user()->avatar.'_thumbnail.jpg'}}" />
                                @else
                                  <img alt="" src="{{ cdn('assets/images/avatar/nophoto.jpg') }}" />
                                @endif
                            </div>
                            <div class="card-info"> <span class="card-title">{{Auth::user()->first_name}} &nbsp; {{Auth::user()->last_name}}</span></div>
                        </div>
                        <div class="tab-controller-container">
                            <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                                <div class="btn-group" role="group">
                                    <button type="button" id="stars" class="btn green" href="#tab1" data-toggle="tab">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        <div class="hidden-xs">Basic Info</div>
                                    </button>
                                </div>
                                <div class="btn-group" role="group">
                                    <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab">
                                        <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                        <div class="hidden-xs">User Photo</div>
                                    </button>
                                </div>
                                <div class="btn-group" role="group">
                                    <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab">
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                        <div class="hidden-xs">Password</div>
                                    </button>
                                </div>
                            </div>
                            <div class="tab-container">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        <button class="close" data-close="alert"></button>
                                        <span>{{ session('status') }}</span>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        <button class="close" data-close="alert"></button>
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1">
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2">
                                                <form role="form" action="{{route('profile.change.basic')}}" style="margin-bottom:20px;"  method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <label class="control-label">First Name</label>
                                                                <input type="text" placeholder="John" class="form-control" name="first_name" value="{{Auth::user()->first_name}}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Last Name</label>
                                                                <input type="text" placeholder="Dae" class="form-control" name="last_name" value="{{Auth::user()->last_name}}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div style="margin-top:25px;">
                                                                    <button type="submit" class="btn green"> Save Changes </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2">
                                                <form role="form" action="{{route('profile.change.email')}}" style="margin-bottom:20px;"  method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <label class="control-label">Email Address</label>
                                                                <input type="email" placeholder="John" class="form-control" name="email" value="{{Auth::user()->email}}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div style="margin-top:25px;">
                                                                    <button type="submit" class="btn green"> Save Changes </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade in" id="tab2">
                                        <div class="row">
                                            <div class="col-sm-4 col-sm-offset-4 text-center">
                                                <form action="{{route('profile.change.avatar')}}" role="form" method="post" class="user-avartar-upload-form" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> Select image </span>
                                                                    <span class="fileinput-exists"> Change </span>
                                                                    <input type="file" name="user_image" required>
                                                                </span>
                                                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <button class="btn green" type="submit"> Save Changes </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade in" id="tab3">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <form action="{{route('profile.change.password')}}" class="changepassword-form" method="post" enctype="multipart/form-data" >
                                                    <div class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button>
                                                        <span>Enter correct data. </span>
                                                    </div>
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label class="control-label">Current Password</label>
                                                        <input type="password" class="form-control" name="current_password" required /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">New Password</label>
                                                        <input type="password" autocomplete="off" class="form-control" id="change_password" name="password" required /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Re-type New Password</label>
                                                        <input type="password" autocomplete="off" class="form-control" name="password_confirmation" required /> </div>
                                                    <div class="margin-top-10 text-center">
                                                        <button type="submit" class="btn green"> Save Changes </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('pagelevel_script')
    <script src="{{cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@endsection
@section('pagelevel_script_script')
    <script src="{{cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
@endsection
@section('custom_script')
    <script src="{{cdn('js/profile.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(window).on('load',function () {
            setTimeout(function () { $('.user-profile-container-div').addClass('animated'); }, 50);
        });
    </script>
@endsection
