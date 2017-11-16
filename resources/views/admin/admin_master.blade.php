<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>ALT - @yield('title')</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
  <link href="{{cdn('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{cdn('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{cdn('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{cdn('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{cdn('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{cdn('assets/global/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL PLUGINS -->
  @yield('pagelevel_plugin')
  <!-- END PAGE LEVEL PLUGINS -->
  <!-- BEGIN THEME GLOBAL STYLES -->
  <link href="{{cdn('assets/global/css/components-md.css')}}" rel="stylesheet" id="style_components" type="text/css" />
  <link href="{{cdn('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- END THEME GLOBAL STYLES -->
  <!-- BEGIN PAGE LEVEL STYLES -->
  @yield('pagelevel_style')
  <!-- END PAGE LEVEL STYLES -->
  <!-- BEGIN THEME LAYOUT STYLES -->
  <link href="{{cdn('assets/layouts/layout/css/layout.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{cdn('assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
  <link href="{{cdn('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{cdn('css/custom.css')}}" rel="stylesheet" type="text/css" />
  <!-- END THEME LAYOUT STYLES -->
  <link rel="icon" type="image/png" sizes="32x32" href="{{cdn('assets/images/favicon.png')}}">
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
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
  <!-- BEGIN HEADER -->
  <div class="page-header navbar navbar-fixed-top" id="homepage-header-div">
      <!-- BEGIN HEADER INNER -->
      <div class="page-header-inner ">
          <!-- BEGIN LOGO -->
          <div class="page-logo">
              <a href="{{url('/admin')}}" style="margin-left: 5px;">
                  <img src="{{ cdn('assets/images/adminlogo.png') }}" style="width:150px;margin-top:5px;" alt="logo" class="logo-default" /> </a>
              <div class="menu-toggler sidebar-toggler"> </div>
          </div>
          <!-- END LOGO -->
          <!-- BEGIN RESPONSIVE MENU TOGGLER -->
          <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
          <!-- END RESPONSIVE MENU TOGGLER -->
          <!-- BEGIN TOP NAVIGATION MENU -->
          <div class="top-menu">
              <ul class="nav navbar-nav pull-right">
                  <li class="dropdown dropdown-user">
                      <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="padding-left: 5px;padding-bottom: 10px;background-color: #364150;">
                          @if(file_exists('assets/images/avatar/admin'.'/'.Auth::guard('admin')->user()->avatar.'_thumbnail.jpg'))
                            <img alt="" class="img-circle" src="{{ cdn('assets/images/avatar/admin').'/'.Auth::guard('admin')->user()->avatar.'_thumbnail.jpg'}}" />
                          @else
                            <img alt="" class="img-circle" src="{{ cdn('assets/images/avatar/nophoto.jpg') }}" />
                          @endif
                          <span class="username username-hide-on-mobile" style="display: inline-block;"> {{Auth::guard('admin')->user()->name}}</span>
                          <i class="fa fa-angle-down"></i>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-default">
                          <li>
                              <a href="{{ route('admin.profile') }}">
                                  <i class="icon-user"></i> Edit Profile </a>
                          </li>
                          <li>
                              <a href="{{ route('admin.logout') }}">
                                  <i class="icon-key"></i> Log Out
                              </a>
                          </li>
                      </ul>
                  </li>
              </ul>
          </div>
          <!-- END TOP NAVIGATION MENU -->
      </div>
      <!-- END HEADER INNER -->
  </div>
  <!-- END HEADER -->
  <!-- BEGIN HEADER & CONTENT DIVIDER -->
  <div class="clearfix"> </div>
  <!-- END HEADER & CONTENT DIVIDER -->
  <!-- BEGIN CONTAINER -->
  <div class="page-container">
      <!-- BEGIN SIDEBAR -->
      <div class="page-sidebar-wrapper">
          <!-- BEGIN SIDEBAR -->
          <div class="page-sidebar navbar-collapse collapse" id="page-sidebar-height">
              <!-- BEGIN SIDEBAR MENU -->
              <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                  <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                  <li class="sidebar-toggler-wrapper hide">
                      <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                      <div class="sidebar-toggler"> </div>
                      <!-- END SIDEBAR TOGGLER BUTTON -->
                  </li>
                  <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                  <li class="sidebar-search-wrapper">
                      <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                      <form class="sidebar-search  sidebar-search-bordered" action="page_general_search_3.html" method="POST">
                          <a href="javascript:;" class="remove">
                              <i class="icon-close"></i>
                          </a>
                          <div class="input-group">
                              <input type="text" style="color:#969696" class="form-control" placeholder="Search...">
                              <span class="input-group-btn">
                                  <a href="javascript:;" class="btn submit">
                                      <i class="icon-magnifier"></i>
                                  </a>
                              </span>
                          </div>
                      </form>
                      <!-- END RESPONSIVE QUICK SEARCH FORM -->
                  </li>
                  <li class="nav-item start @if(Route::current()->uri=='admin')open active @endif">
                      <a href="{{ route('admin.dashboard') }}" class="nav-link nav-toggle">
                          <i class="icon-home"></i>
                          <span class="title">DashBoard</span>
                          @if(Route::current()->uri=='admin')
                          <span class="selected"></span>
                          @endif
                      </a>
                  </li>
                  <li class="nav-item @if(Route::current()->uri=='admin/pages')open active @endif">
                      <a href="{{ route('admin.pages') }}" class="nav-link nav-toggle">
                          <i class="icon-layers"></i>
                          <span class="title">Pages Management</span>
                          @if(Route::current()->uri=='admin/pages')
                          <span class="selected"></span>
                          @endif
                      </a>
                  </li>
                  <li class="nav-item @if(Route::current()->uri=='admin/user-management')open active @endif">
                      <a href="{{ route('admin.user_management') }}" class="nav-link nav-toggle">
                          <i class="icon-users"></i>
                          <span class="title">User Management</span>
                          @if(Route::current()->uri=='admin/user-management')
                          <span class="selected"></span>
                          @endif
                      </a>
                  </li>
              </ul>
      </div>
      <!-- END SIDEBAR -->
      <!-- BEGIN CONTENT -->
      <div class="page-content-wrapper">
          <!-- BEGIN CONTENT BODY -->
          <div class="page-content">
              @yield('content')
          </div>
          <!-- END CONTENT BODY -->
      </div>
      <!-- END CONTENT -->
  </div>
  <!-- END CONTAINER -->
  <!-- BEGIN CORE PLUGINS -->
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
  <!-- END THEME GLOBAL SCRIPTS -->
  <!-- BEGIN PAGE LEVEL SCRIPTS -->
  @yield('pagelevel_script_script')
  <!-- END PAGE LEVEL SCRIPTS -->
  <!-- BEGIN THEME LAYOUT SCRIPTS -->
  <script src="{{cdn('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
  <script src="{{cdn('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
  <script src="{{cdn('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
  <script src="{{cdn('js/custom.js')}}" type="text/javascript"></script>
  <script>
        window.onload = function () { setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 50); }
  </script>
  <!-- END THEME LAYOUT SCRIPTS -->
</body>
