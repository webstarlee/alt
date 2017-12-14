<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Construction Report</title>
        {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
        <link href="{{cdn('assets/global/css/components-md.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{cdn('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/layouts/layout/css/layout.css')}}" rel="stylesheet" type="text/css" />
        {{-- <link href="{{cdn('assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" /> --}}
        <link href="{{cdn('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('css/custom.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="icon" type="image/png" sizes="32x32" href="{{cdn('assets/images/favicon.png')}}">
        <link href="{{cdn('css/frontend.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('css/estimate.css')}}" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/png" sizes="32x32" href="{{cdn('assets/images/favicon.png')}}">
        <style type="text/css" >
            .dotted-line::before {
                content: "";
                height: 1px;
                border-top: 2px dashed #bbbbbb;
                width: 50%;
                position: absolute;
                top: calc( 50% - 7px);
                left: 0;
            }
            .dotted-line::after {
                content: "";
                height: 1px;
                border-top: 2px dashed #bbbbbb;
                width: 50%;
                position: absolute;
                top: calc( 50% - 7px);
                right: 5px;
                z-index: -1;
            }
            .dotted-line-last::before {
                content: "";
                height: 1px;
                border-top: 2px dashed #bbbbbb;
                width: 50%;
                position: absolute;
                top: calc( 50% - 7px);
                left: 0;
            }
            .dotted-line-number::after {
                content: "";
                height: 1px;
                border-top: 2px dashed #bbbbbb;
                width: 50%;
                position: absolute;
                top: calc( 50% - 7px);
                right: 5px;
                z-index: -1;
            }
            .dotted-line-vertical::before {
                content: "";
                height: 195px;
                border-left: 2px dashed #bbbbbb;
                width: 1px;
                position: absolute;
                top: 90px;
                left: 0px;
                z-index: -1;
            }
            .dotted-line-fourth::before {
                content: "";
                height: 1px;
                border-top: 2px dashed #bbbbbb;
                width: 50%;
                position: absolute;
                top: calc( 50% - 7px);
                left: 0;
            }
            .dotted-line-fourth::after {
                content: "";
                height: 1px;
                border-top: 2px dashed #bbbbbb;
                width: 50%;
                position: absolute;
                top: calc( 50% - 7px);
                right: 5px;
                z-index: -1;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2 style="padding-bottom: 20px;text-align: center;color: #d40014;" class="bold">Survey Report</span></h2>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-2" style="padding-top: 20px;margin-bottom: 20px;">
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
                            <span class="survey-calculator-span-pdf">Base Cost:</span>
                        </div>
                        <div class="col-xs-6">
                            <span class="survey-calculator-span-pdf">US$ {{Auth::user()->survey_cost}} per <img style="width: 17px;height: 17px;margin-top: -7px;" src="{{cdn('assets/images/components/m2.svg')}}" alt=""></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="survey-calculator-span-pdf">Size Calculator:</span>
                        </div>
                        <div class="col-xs-6">
                            <span class="survey-calculator-span-pdf">@if($total_result_count > 0) {{$total_square_size}} @else 0 @endif <img style="width: 17px;height: 17px;margin-top: -7px;" src="{{cdn('assets/images/components/m2.svg')}}" alt=""></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="survey-calculator-span-pdf">Construction Estimate:</span>
                        </div>
                        <div class="col-xs-6">
                            <span class="survey-calculator-span-pdf">US$ @if($total_result_count > 0) {{number_format($total_money)}} @else 0 @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <div class="survey-img-container">
                        @foreach ($quetions as $quetion)
                            @if ($quetion->type == 0)
                                <?php
                                    $optionsA = \App\SurveyAnswer1::where('question_id', $quetion->id)->orderBy('size', 'ASC')->get();
                                    $option_count = \App\SurveyAnswer1::where('question_id', $quetion->id)->count();
                                    $current_option_result_count = \App\UserOptionA::where('question_id', $quetion->id)->where('user_id', Auth::user()->id)->count();
                                    if ($current_option_result_count > 0) {
                                        $current_option_result = \App\UserOptionA::where('survey_option1_results.question_id', $quetion->id)->where('user_id', Auth::user()->id)
                                        ->join('survey_option1', 'survey_option1.id', '=', 'survey_option1_results.option_id')
                                        ->select('survey_option1_results.*', 'survey_option1.title')->first();
                                    }
                                    $array_acount = 0;
                                ?>
                                <?php if ($current_option_result_count>0): ?>
                                    <div class="row optiona-question-container">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="bold text-center question-title-text" style="color: #d40014;">{{$quetion->title}}</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <div class="single-survey-img-contain">
                                                                <div class="survey-select-number survey-print-circle-img">
                                                                    <img src="{{cdn('assets/images/components/print_null.png')}}" style="width: 100%;height:100%;" alt="">
                                                                    <h2 class="bold text-center">{{$current_option_result->number}}</h2>
                                                                    <h3 class="bold text-center">{{$current_option_result->title}}</h3>
                                                                </div>
                                                                <h3 class="bold text-center survey-circle-title-text">Number</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            @foreach ($optionsA as $option)
                                                                <?php if ($current_option_result->option_id == $option->id): ?>
                                                                    <div class="single-survey-img-contain optiona_img_item ">
                                                                        <img class="img-responsive" style="border-radius: 50%;" src="{{cdn('assets/images/survey/'.$option->img_name.'_thumbnail.jpg')}}">
                                                                        <h3 class="bold text-center survey-circle-title-text" data-value="{{$option->title}}">{{$option->title}}</h3>
                                                                    </div>
                                                                <?php endif; ?>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="comment-container-div">
                                                        <div class="row">
                                                            <div class="col-xs-11 col-xs-offset-1">
                                                                @foreach ($comments as $comment)
                                                                    @if ($comment->question_id == $quetion->id && $comment->user_id == Auth::user()->id)
                                                                        <div class="single-user-comment-contain">
                                                                            <img class="comment-user-img tooltips" data-placement="bottom" data-original-title="{{$comment->first_name}} {{$comment->last_name}}" src="{{cdn('assets/images/avatar/'.$comment->avatar.'_thumbnail.jpg')}}">
                                                                            <span class="single-user-comment-text">{{$comment->comment}}</span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            @elseif ($quetion->type == 1)
                                <?php
                                    $optionsB = \App\SurveyAnswer2::where('question_id', $quetion->id)->get();
                                    $option_count = \App\SurveyAnswer2::where('question_id', $quetion->id)->count();
                                    $current_optionb_result_count = \App\UserOptionB::where('question_id', $quetion->id)->where('user_id', Auth::user()->id)->count();
                                    if ($current_optionb_result_count > 0) {
                                        $current_optionb_result = \App\UserOptionB::where('question_id', $quetion->id)->where('user_id', Auth::user()->id)->first();
                                        $selected_size = $current_optionb_result->size_id;
                                        $selected_img = explode(',', $current_optionb_result->img_ids);
                                        if ($selected_size != "") {
                                            $current_optionb_result_size = \App\UserOptionB::where('survey_option2_results.question_id', $quetion->id)->where('user_id', Auth::user()->id)
                                            ->join('survey_option2_size', 'survey_option2_size.id', '=', 'survey_option2_results.size_id')
                                            ->select('survey_option2_results.*', 'survey_option2_size.title', 'survey_option2_size.size')->first();
                                        }
                                    }
                                    $array_acount = 0;
                                ?>
                                <?php if ($current_optionb_result_count > 0): ?>
                                    <div class="row optionb-question-container">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="bold text-center question-title-text" style="color: #d40014;">{{$quetion->title}}</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="single-survey-img-contain optionb_size_select_text_item">
                                                        <div class="survey-select-number survey-print-circle-img">
                                                            <h2 class="bold text-center survey-number-text current-optiona-size-number">
                                                                <?php if ($selected_size != ""): ?>
                                                                    {{$current_optionb_result_size->title}}
                                                                <?php else: ?>
                                                                    Not Selected
                                                                <?php endif; ?>
                                                            </h2>
                                                            <h3 class="bold text-center survey-size-text current-optiona-image-type" @if ($selected_size != "") style="display: block;" @else style="display: none;" @endif>
                                                                <span>@if ( $selected_size != "") {{$current_optionb_result_size->size}} @endif</span> <img style="width: 17px;height: 17px;margin-top: -7px;" src="{{cdn('assets/images/components/m2.svg')}}" alt="">
                                                            </h3>
                                                        </div>
                                                        <h3 class="bold text-center survey-circle-title-text">Size</h3>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row optiona-image-contain__div" style="text-align: center;">
                                                        @foreach ($optionsB as $option)
                                                            <?php if (in_array($option->id, $selected_img)): ?>
                                                                <div class="single-survey-img-contain optionb_img_item" style="display: inline-block;margin-left: 15px;margin-right: 15px;">
                                                                    <img class="img-responsive" style="border-radius: 50%;" src="{{cdn('assets/images/survey/'.$option->img_name.'_thumbnail.jpg')}}">
                                                                    <h3 class="bold text-center survey-circle-title-text">{{$option->title}}</h3>
                                                                </div>
                                                            <?php endif; ?>
                                                        @endforeach
                                                    </div>
                                                    <div class="comment-container-div">
                                                        <div class="row">
                                                            <div class="col-sm-11 col-sm-offset-1 col-xs-12" id="comment_container_{{$quetion->id}}">
                                                                @foreach ($comments as $comment)
                                                                    @if ($comment->question_id == $quetion->id && $comment->user_id == Auth::user()->id)
                                                                        <div class="single-user-comment-contain" id="single_user_comment_{{$comment->id}}">
                                                                            <img class="comment-user-img tooltips" data-placement="bottom" data-original-title="{{$comment->first_name}} {{$comment->last_name}}" src="{{cdn('assets/images/avatar/'.$comment->avatar.'_thumbnail.jpg')}}">
                                                                            <span class="single-user-comment-text">{{$comment->comment}}</span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            @endif
                        @endforeach
                    </div>
                </div>
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
        <script src="{{cdn('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/pages/scripts/components-bootstrap-switch.js')}}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{cdn('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/pages/scripts/components-select2.js')}}" type="text/javascript"></script>
        <script src="{{cdn('js/custom.js')}}" type="text/javascript"></script>
        <script src="{{cdn('js/frontend.js')}}" type="text/javascript"></script>
    </body>
</html>
