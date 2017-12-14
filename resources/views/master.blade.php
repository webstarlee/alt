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
        <link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
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
                                    $total_result_b_count = \App\UserOptionB::where('user_id', Auth::user()->id)->count();
                                    $total_square_size = 0;
                                    if ($total_result_count > 0) {
                                        $total_results = \App\UserOptionA::where('user_id', Auth::user()->id)
                                        ->join('survey_option1', 'survey_option1.id', '=', 'survey_option1_results.option_id')
                                        ->select('survey_option1_results.*', 'survey_option1.size')->get();
                                        foreach ($total_results as $total_result) {
                                            $number = $total_result->number;
                                            $size = $total_result->size;

                                            $current_size = $number * $size;
                                            $total_square_size += $current_size;
                                        }
                                    }

                                    if ($total_result_b_count > 0) {
                                        $total_b_results = \App\UserOptionB::where('user_id', Auth::user()->id)->get();
                                        foreach ($total_b_results as $total_b_result) {
                                            if ($total_b_result->size_id != "") {
                                                $option_size = \App\SurveyAnswerSize::find($total_b_result->size_id);
                                                $total_square_size += $option_size->size;
                                            }
                                        }
                                    }

                                    $total_money = 0;
                                    if (Auth::user()->survey_cost) {
                                        $total_money = $total_square_size * Auth::user()->survey_cost;
                                    }
                                    else {
                                        $total_money = $total_square_size * 100;
                                    }
                                ?>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <span class=" survey-calculator-span">Base Cost:</span>
                                    </div>
                                    <div class="col-xs-6">
                                        <select class="survey-calculator form-control survey-calculator-usd-select" id="survey_money_per_meter">
                                            @for ($i=100; $i < 2100; $i+=100)
                                                <option value="{{$i}}" @if(Auth::user()->survey_cost == $i) selected @endif >US$ {{$i}} per &#x33a1;</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <span class=" survey-calculator-span">Size Calculator:</span>
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="hidden" name="" id="total_survey_square_size_hidden" value="{{$total_square_size}}">
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
                                <div class="calculator_open_close_btn" id="surcey_calculator_on_off_btn_id"><i class="fa fa-chevron-down"></i></div>
                            </div>
                        </div>
                        <div class="top-menu">
                            <ul class="nav navbar-nav pull-right">
                                <li class="dropdown dropdown-user">
                                    <a href="javascript:;" class="dropdown-toggle animated fadeInDown" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="padding-left: 5px;padding-bottom: 10px;background-color: #fff;">
                                        @if(file_exists('assets/images/avatar'.'/'.Auth::user()->avatar.'_thumbnail.jpg'))
                                          <img alt="" class="img-circle" src="{{ cdn('assets/images/avatar').'/'.Auth::user()->avatar.'_thumbnail.jpg'}}" />
                                        @else
                                          <img alt="" class="img-circle" src="{{ cdn('assets/images/avatar/nophoto.jpg') }}" />
                                        @endif
                                        <span class="username username-hide-on-mobile" style="display: inline-block;"> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-default">
                                        <li>
                                            <a href="{{route('home')}}">
                                                <i class="icon-home"></i> Home </a>
                                        </li>
                                        <li><a href="#user-report-form" data-toggle="modal"><i class="icon-docs"></i> Report </a></li>
                                        <li>
                                            <a href="{{route('user.profile.view')}}">
                                                <i class="icon-user"></i> Edit Profile </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}">
                                                <i class="icon-logout"></i> Log Out
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

        <div id="user-report-form" class="modal fade" tabindex="-1" data-backdrop="static">
            <div class="modal-body text-center">
                <button type="button" class="btn btn-dafault" data-dismiss="modal">Close</button>
                <a href="{{route('report.gallery')}}" target="_blank" class="btn green">Gallery Report</a>
                <a href="{{route('report.construction')}}" target="_blank" class="btn green">Construction Report</a>
            </div>
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
        <script src="{{cdn('assets/global/plugins/axios.min.js')}}"></script>
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
              });

              $('#survey_money_per_meter').on('change', function() {

                  var current_per_money = $('#survey_money_per_meter').val();
                  var current_square = $('#total_survey_square_size_hidden').val();
                  var result_total_money = current_square * current_per_money;
                  result_total_money = result_total_money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  $('#total_survey_money').html(result_total_money);

                  var cost_set_url = "{{url('set-survey-cost')}}";
                  var final_cost_set_url = cost_set_url+"/"+current_per_money;
                  $.ajax({
                      url: final_cost_set_url,
                      type: 'get',
                      success: function(result){
                          console.log(result);
                      },
                      error: function(error){
                          console.log(error);
                      }
                  });
              })
        </script>
    </body>
</html>
