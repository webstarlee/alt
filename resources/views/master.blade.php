<!DOCTYPE html>
<html lang="en">
    <head>
        <title>iFundFilms - @yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="{{cdn('assets/layouts/layout/css/layout.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/css/components-md.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{cdn('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
        @yield('pagelevel_style')
        <link href="{{cdn('css/custom.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('css/frontend.css')}}" rel="stylesheet" type="text/css" />
        <style>
            .form-group.has-error>span {
                color: white!important;
            }
        </style>
        <link rel="icon" type="image/png" sizes="32x32" href="{{cdn('assets/images/components/favicon/fav_ico.png')}}">
    </head>
    <body>
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger custom-alert-danger col-md-4 col-md-offset-4 text-center">
                <button class="close alert-close-custom" data-close="alert"></button>
                {{ session('error') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success custom-alert-danger col-md-4 col-md-offset-4 text-center">
                <button class="close alert-close-custom" data-close="alert"></button>
                {{ session('status') }}
            </div>
        @endif
        <section class="backround-div" id="tabs1-0">
            <div class="container">
                <div class="label-embed-div">
                    <h3 class="font-white text-center label-custom" >
                        become a movie industry investor
                    </h3>
                    <h3 class="font-white text-center label-custom" >
                        for as little as $25
                    </h3>
                    <h1 class="ifund-logo text-center">
                        <span>
                            <font size="7" color="#D4D0CE">iFund</font><font size="7" color="#8B7D73">Films.com</font>
                        </span>
                    </h1>
                </div>
                <div class="col-md-8 col-md-offset-2 join-movie">
                    <h3 class="font-white text-center label-custom-join" >
                        <strong><font face="Times New Roman" color="#D4D0CE" size="7">J</font></strong><font face="Verdana" color="#D4D0CE"><span style="font-size: 14pt">oin the exciting movie industry and earn income</span></font>
                    </h3>
                </div>
            </div>
        </section>
        <section class="" id="tabs1-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="menu-container-div">
                            @if (Auth::check())
                                <h3 class="text-center menu-title-custom"><a class="custom-title-button uppercase" href="{{ route('home') }}">Home</a>
                                    &nbsp; <font color="#663300" face="Symbol"><span style="font-size: 9pt;">ï</span></font> &nbsp;
                                    <a href="{{ route('logout')}}" class="custom-title-button uppercase">log out</a>
                                 </h3>
                            @else
                                <h3 class="text-center menu-title-custom"><a class="custom-title-button uppercase" href="{{ route('home') }}">Home</a>
                                     &nbsp; <font color="#663300" face="Symbol"><span style="font-size: 9pt">ï</span></font> &nbsp;<a class="custom-title-button uppercase" data-toggle="modal" href="#signup-form">Sign up</a>&nbsp; <font color="#663300" face="Symbol"><span style="font-size: 9pt;">ï</span></font> &nbsp;
                                     <a href="{{ route('login')}}" class="custom-title-button uppercase">login</a>
                                 </h3>
                            @endif
                            <div class="menu-labels-embeded-div">
                                <h3 class="text-center uppercase menu-labels-custom"><a class="custom-title-button" href="{{ route('films') }}">our films</a></h3>
                                <h3 class="text-center uppercase menu-labels-custom"><a class="custom-title-button" href="{{ route('distribution') }}">distribution</a></h3>
                                <h3 class="text-center uppercase menu-labels-custom"><a class="custom-title-button">refer a friend</a></h3>
                                <h3 class="text-center uppercase menu-labels-custom"><a class="custom-title-button" href="{{ route('how_this_work') }}">how this works</a></h3>
                                <h3 class="text-center uppercase menu-labels-custom"><a class="custom-title-button">add to facebook</a></h3>
                                <br /><br />
                                <h3 class="text-center uppercase menu-labels-custom"><a class="custom-title-button" href="{{route('submission')}}">Submit screenplay</a></h3>
                                <br /><br /><br />
                                <div class="social-title-image-embeded-div">
                                    <div class="social-button-embeded-div">
                                        <div class="single-button-embeded-div">
                                            <a class="facebook_img"></a>
                                        </div>
                                        <div class="single-button-embeded-div">
                                            <a class="google_img"></a>
                                        </div>
                                        <div class="single-button-embeded-div">
                                            <a class="linkedin_img"></a>
                                        </div>
                                        <div class="single-button-embeded-div">
                                            <a class="youtube_img"></a>
                                        </div>
                                        <div class="single-button-embeded-div">
                                            <a class="twiter_img"></a>
                                        </div>
                                        <div class="single-button-embeded-div">
                                            <a class="mail_img"></a>
                                        </div>
                                        <div class="single-button-embeded-div">
                                            <a class="imdb_img"></a>
                                        </div>
                                    </div>
                                    <img class="menu-title-social-image" src="{{cdn('assets/images/components/social_back.png')}}" />
                                </div>
                            </div>
                        </div>
                        <div class="each-container-separator"></div>
                    </div>
                    <div class="col-md-4">
                        @yield('content')
                        <div class="each-container-separator"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="contents-container-div">
                            <div class="contents-intro-image-embeded-div">
                                <img class="menu-title-social-image" src="{{cdn('assets/images/components/ifundfilms_logo.png')}}" />
                            </div>
                            <h3 class="text-center contents-amount-labels-custom">
                                <p class="custom-p"><span style="font-weight: 400">
                                    <a class="site-terms-labels"><font face="Verdana" style="font-size: 9pt">Terms of Use</font></a>
                                    <font color="#663300" face="Symbol"><span style="font-size: 9pt">ï</span></font>
                                    <a class="site-terms-labels"><font face="Verdana" style="font-size: 9pt">Privacy Policy</font></a>
                                </span></p>
                    			<img class="underline-terms" src="{{cdn('assets/images/components/goldfade.gif')}}" />
                    			<p class="custom-p"><span style="font-weight: 400">
                                    <font face="Verdana"style="font-size: 9pt" color="#663300">
                			             <span style="background-color: #FFFFFF">Copyright @ 2017 iFundFilms.com All Rights Reserved</span>
                                    </font>
                                </span></p>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="signup-form" style="background-color: #8e4c0b;" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
            <form class="register-form signup-form-container-div" action="{{ url('register') }}" method="post">
                {{ csrf_field() }}
                <h3 style="color:#fff;" class="bold">Sign Up with iFundFilms</h3>
                <br />
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" required/> </div>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="email" placeholder="Email" name="email" required /> </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" required/> </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                    <div class="input-icon">
                        <i class="fa fa-check"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="password_confirmation" required/>
                    </div>
                </div>
                <br />
                <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                              <div class="input-icon">
                                  <i class="fa fa-check"></i>
                                  <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="First name" name="f_name" required/>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                              <div class="input-icon">
                                  <i class="fa fa-check"></i>
                                  <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Last Name" name="l_name" required/>
                              </div>
                          </div>
                      </div>
                  </div>
                <div class="form-group">
                    <label style="cursor:pointer;color:#fff;">* Your full name is required for tax purposes on any earnings
                    </label>
                </div>
                <div class="form-group">
                    <label style="cursor:pointer;color:#fff;">
                        <input type="checkbox" name="tnc" /> I agree with
                        <a style="color:#000;font-weight:700;" href="javascript:;"> Terms </a> and
                        <a style="color:#000;font-weight:700;" href="javascript:;"> Condition </a>
                    </label>
                    <div id="register_tnc_error"> </div>
                </div>
                <div class="form-group">
                    <label style="cursor:pointer;color:#fff;">
                        <input type="checkbox" name="tnc" /> Receive updates
                    </label>
                </div>
                <div class="form-actions">
                    <button id="register-back-btn" type="button"data-dismiss="modal" class="btn dark"> cancel </button>
                    <button type="submit" id="register-submit-btn" class="btn green pull-right"> Sign Up </button>
                </div>
            </form>
        </div>
        <script src="{{cdn('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        @yield('pagelevel_script')
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{cdn('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/pages/scripts/components-bootstrap-switch.js')}}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        @yield('pagelevel_script_script')
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{cdn('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/pages/scripts/login-4.js')}}" type="text/javascript"></script>
        <script src="{{cdn('js/custom.js')}}" type="text/javascript"></script>
        <script src="{{cdn('js/onclick.js')}}" type="text/javascript"></script>
        <script>
              window.onload = function () { setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 50); }
        </script>
    </body>
</html>
