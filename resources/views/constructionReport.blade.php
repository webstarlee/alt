@extends('master')
@section('title')
Construction Report
@endsection
@section('custom_style')
<link href="{{cdn('css/estimate.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="survey-background-div">
        <div class="survey-background-button-container">
            <div class="description-container-div">
            </div>
            <div class="menu-container-div">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="menu-button-gotoHome-div animated bounceInRight">
                                <a href="{{url('home')}}"><img src="{{cdn('assets/images/components/alt_gotoHome_button.svg')}}" class="menu-estimate" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="description-text-summary-div animated bounceInLeft">
                                <p class="font-white summary-text text-right" >Summary</p>
                                <p class="font-white bold your-selection-text text-right">Your Selection</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="survey-img-container-div">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
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
                                <div class="row optiona-question-container">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3 class="bold text-center question-title-text">{{$quetion->title}}</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 dotted-line-number">
                                                <div class="single-survey-img-contain">
                                                    <div class="survey-select-number optiona_size_number_item">
                                                        <input type="hidden" class="current-optiona-size-number-hidden" value="@if($current_option_result_count>0) {{$current_option_result->number}} @endif">
                                                        <input type="hidden" class="current-optiona-image-type-hidden" value="@if($current_option_result_count>0) {{$current_option_result->option_id}} @endif">
                                                        <input type="hidden" class="current-question-id-hidden" value="{{$quetion->id}}">
                                                        <h2 class="bold text-center survey-number-text current-optiona-size-number">@if($current_option_result_count>0) {{$current_option_result->number}} @else 0 @endif</h2>
                                                        <h3 class="bold text-center survey-size-text current-optiona-image-type">@if($current_option_result_count>0) {{$current_option_result->title}} @endif</h3>
                                                    </div>
                                                    <h3 class="bold text-center survey-circle-title-text">Number</h3>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="row optiona-image-contain__div @if($option_count > 3) dotted-line-vertical @endif">
                                                    @foreach ($optionsA as $option)
                                                        <?php $array_acount += 1; ?>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center @if($array_acount%3 == 0) dotted-line-last @else dotted-line @endif">
                                                            <div class="single-survey-img-contain optiona_img_item ">
                                                                <img class="img-responsive single-survey-img @if($current_option_result_count >0 && $current_option_result->option_id == $option->id) active @endif" src="{{cdn('assets/images/survey/'.$option->img_name.'_thumbnail.jpg')}}">
                                                                <input type="hidden" name="" class="survey-circle-title-value" value="{{$option->id}}">
                                                                <h3 class="bold text-center survey-circle-title-text" data-value="{{$option->title}}">{{$option->title}}</h3>
                                                            </div>
                                                        </div>
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
                                <div class="row optionb-question-container" id="optionb-question-row_{{$quetion->id}}">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3 class="bold text-center question-title-text">{{$quetion->title}}</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 dotted-line-number">
                                                <div class="single-survey-img-contain optionb_size_select_text_item">
                                                    <div class="survey-select-number optionb_size_text_item" onclick="show_size_form({{$quetion->id}})">
                                                        <input type="hidden" class="current-optionb-size-id" value="@if ($current_optionb_result_count > 0 && $selected_size != "") {{$current_optionb_result_size->size_id}} @endif">
                                                        <input type="hidden" class="current-question-id-hidden" value="{{$quetion->id}}">
                                                        <h2 class="bold text-center survey-number-text current-optiona-size-number">
                                                            @if ($current_optionb_result_count > 0 && $selected_size != "")
                                                                {{$current_optionb_result_size->title}}
                                                            @else
                                                                Select
                                                            @endif
                                                        </h2>
                                                        <h3 class="bold text-center survey-size-text current-optiona-image-type" @if ($current_optionb_result_count > 0 && $selected_size != "") style="display: block;" @else style="display: none;" @endif>
                                                            <span>@if ($current_optionb_result_count > 0 && $selected_size != "") {{$current_optionb_result_size->size}} @endif</span> &#x33a1;
                                                        </h3>
                                                    </div>
                                                    <h3 class="bold text-center survey-circle-title-text">Size</h3>
                                                </div>
                                            </div>
                                            <div class="col-sm-9 @if($option_count > 3) dotted-line-vertical @endif">
                                                <div class="row optiona-image-contain__div">
                                                    @foreach ($optionsB as $option)
                                                        <?php $array_acount += 1; ?>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center @if($array_acount%3 == 0) dotted-line-last @elseif($array_acount > 1 && $array_acount%3 == 1) dotted-line-fourth @else dotted-line @endif">
                                                            <div class="single-survey-img-contain optionb_img_item">
                                                                <img class="img-responsive single-survey-img @if ($current_optionb_result_count > 0 && in_array($option->id, $selected_img)) active @endif" data-optionid="{{$option->id}}" src="{{cdn('assets/images/survey/'.$option->img_name.'_thumbnail.jpg')}}">
                                                                <h3 class="bold text-center survey-circle-title-text">{{$option->title}}</h3>
                                                            </div>
                                                        </div>
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
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('pagelevel_script')
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
@endsection
