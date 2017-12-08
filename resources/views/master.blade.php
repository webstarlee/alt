<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Alt - @yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/animate-css/animate.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/node-waves/waves.css')}}" rel="stylesheet" />
        {{-- <link href="{{cdn('assets/global/plugins/jquery.mobile-1.4.5.min.css')}}" rel="stylesheet" type="text/css" /> --}}
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
        {{-- <link href="{{cdn('assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" /> --}}
        <link href="{{cdn('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('css/custom.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="icon" type="image/png" sizes="32x32" href="{{cdn('assets/images/favicon.png')}}">
        <link href="{{cdn('css/frontend.css')}}" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/png" sizes="32x32" href="{{cdn('assets/images/favicon.png')}}">
        @yield('custom_style')
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

        <div class="templatemo-top-menu">
            <div class="container">
                <!-- Static navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="{{route('home')}}" class="navbar-brand">
                                <img src="{{cdn('assets/images/components/logo_black.svg')}}" class="animated fadeInDown" alt="alt Template" />
                            </a>
                            <div class="survey-calculator-container__div animated fadeInDown">
                                <?php
                                    $total_result_count = \App\UserOptionA::where('user_id', Auth::user()->id)->count();
                                    if ($total_result_count > 0) {
                                        $total_results = \App\UserOptionA::where('user_id', Auth::user()->id)
                                        ->join('survey_option1', 'survey_option1.id', '=', 'survey_option1_results.option_id')
                                        ->select('survey_option1_results.*', 'survey_option1.size')->get();
                                        $total_square_size = 0;
                                        foreach ($total_results as $total_result) {
                                            $number = $total_result->number;
                                            $size = $total_result->size;

                                            $current_size = $number * $size;
                                            $total_square_size += $current_size;
                                        }
                                        $total_money = $total_square_size * 800;
                                    }
                                ?>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <span class=" survey-calculator-span">Base Cost:</span>
                                    </div>
                                    <div class="col-xs-6">
                                        <select class="survey-calculator form-control survey-calculator-usd-select" id="survey_money_per_meter">
                                            <option value="800">US$ 800 per &#x33a1;</option>
                                            <option value="900">US$ 900 per &#x33a1;</option>
                                            <option value="1000">US$ 1000 per &#x33a1;</option>
                                            <option value="1100">US$ 1100 per &#x33a1;</option>
                                            <option value="1200">US$ 1200 per &#x33a1;</option>
                                            <option value="1300">US$ 1300 per &#x33a1;</option>
                                            <option value="1400">US$ 1400 per &#x33a1;</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <span class=" survey-calculator-span">Size Calculator:</span>
                                    </div>
                                    <div class="col-xs-6">
                                        <span><span id="total_survey_square_size">@if($total_result_count > 0) {{$total_square_size}} @else 0 @endif</span> &#x33a1;</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <span class=" survey-calculator-span">Construction Estimate:</span>
                                    </div>
                                    <div class="col-xs-6">
                                        <span class="">US$ <span id="total_survey_money">@if($total_result_count > 0) {{number_format($total_money)}} @else 0 @endif</span></span>
                                    </div>
                                </div>
                                <div class="calculator_open_close_btn" id="surcey_calculator_on_off_btn_id"></div>
                            </div>
                        </div>
                        <div class="top-menu">
                            <ul class="nav navbar-nav pull-right">
                                <li class="dropdown dropdown-user">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="padding-left: 5px;padding-bottom: 10px;background-color: #fff;">
                                        @if(file_exists('assets/images/avatar'.'/'.Auth::user()->avatar.'_thumbnail.jpg'))
                                          <img alt="" class="img-circle animated fadeInDown" src="{{ cdn('assets/images/avatar').'/'.Auth::user()->avatar.'_thumbnail.jpg'}}" />
                                        @else
                                          <img alt="" class="img-circle animated fadeInDown" src="{{ cdn('assets/images/avatar/nophoto.jpg') }}" />
                                        @endif
                                        <span class="username username-hide-on-mobile" style="display: inline-block;"> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-default">
                                        <li>
                                            <a href="{{route('home')}}">
                                                <i class="icon-home"></i> Home </a>
                                        </li>
                                        <li>
                                            <a href="{{route('user.profile.view')}}">
                                                <i class="icon-user"></i> Edit Profile </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}">
                                                <i class="icon-key"></i> Log Out
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div><!--/.container-fluid -->
                </div><!--/.navbar -->
            </div> <!-- /container -->
        </div>
        <div class="content-div">
            @yield('content')
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
        <script src="{{cdn('assets/global/plugins/hammer.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/jquery.touchSwipe.min.js')}}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/node-waves/waves.js')}}"></script>
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
        <script src="{{cdn('assets/pages/scripts/components-select2.js')}}" type="text/javascript"></script>
        <script src="{{cdn('js/custom.js')}}" type="text/javascript"></script>
        <script src="{{cdn('js/frontend.js')}}" type="text/javascript"></script>
        @yield('custom_script')
        <script>
              window.onload = function () { setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 50); }
              Waves.init();
              $('#surcey_calculator_on_off_btn_id').on('click', function(){
                  $('.survey-calculator-container__div').toggleClass('open');
              })
        </script>
    </body>
</html>
