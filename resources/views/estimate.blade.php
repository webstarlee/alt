@extends('master')
@section('title')
Welcome
@endsection
@section('pagelevel_plugin')
<link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
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
                                                                @if ($comment->question_id == $quetion->id)
                                                                    <div class="single-user-comment-contain" id="single_user_comment_{{$comment->id}}">
                                                                        <img class="comment-user-img tooltips" data-placement="bottom" data-original-title="{{$comment->first_name}} {{$comment->last_name}}" src="{{cdn('assets/images/avatar/'.$comment->avatar.'_thumbnail.jpg')}}">
                                                                        <span class="single-user-comment-text">{{$comment->comment}} @if ($comment->user_id == Auth::user()->id) <a href="#" onclick="delete_own_comment({{$comment->id}})" class="delete-comment-btn"><i class="fa fa-close font-red-sunglo"></i></a> @endif </span>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-8 col-sm-offset-1 col-xs-9">
                                                            <div class="form-group">
                                                                <input class="form-control question_comment" type="text" name="question_comment" placeholder="Comment:"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-3">
                                                            <a class="btn green question-comment-save-btn" style="width: 100%;"><i class="fa fa-floppy-o" style="font-size: 10pt;"></i> <span class="survey-commnet-mobile-hide">Save</span></a>
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
                                                        <input type="hidden" class="current-optionb-size-id" value="">
                                                        <h2 class="bold text-center survey-number-text current-optiona-size-number">Select</h2>
                                                        <h3 class="bold text-center survey-size-text current-optiona-image-type" style="display: none;"><span>30</span> &#x33a1;</h3>
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
                                                                <img class="img-responsive single-survey-img jello" src="{{cdn('assets/images/survey/'.$option->img_name.'_thumbnail.jpg')}}">
                                                                <h3 class="bold text-center survey-circle-title-text">{{$option->title}}</h3>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="comment-container-div">
                                                    <div class="row">
                                                        <div class="col-sm-8 col-sm-offset-1 col-xs-9">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="user-comment-question" placeholder="Comment:"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-3">
                                                            <a class="btn green" style="width: 100%;"><i class="fa fa-floppy-o" style="font-size: 10pt;"></i> <span class="survey-commnet-mobile-hide">Save</span></a>
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

    <div class="optiona-size-number-select-container__div">
        <div class="optiona-size-container">
            <div class="container optiona-size__container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="optiona-size-round-div optiona-current-size-number">
                                    <span class="bold optiona-number-span" id="optiona-current-selected-number">0</span>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row" id="optiona-select-number-input-container">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                                <a onclick="set_optiona_number(1)" class="optiona-set-number-a">
                                                    <div class="optiona-size-round-div" id="optiona-size-number_1">
                                                        <span class="bold optiona-number-span">1</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                                <a onclick="set_optiona_number(2)" class="optiona-set-number-a">
                                                    <div class="optiona-size-round-div" id="optiona-size-number_2">
                                                        <span class="bold optiona-number-span">2</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                                <a onclick="set_optiona_number(3)" class="optiona-set-number-a">
                                                    <div class="optiona-size-round-div" id="optiona-size-number_3">
                                                        <span class="bold optiona-number-span">3</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                                <a onclick="set_optiona_number(4)" class="optiona-set-number-a">
                                                    <div class="optiona-size-round-div" id="optiona-size-number_4">
                                                        <span class="bold optiona-number-span">4</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="optiona-size-round-div user-input-div" id="optiona-size-user-input-show">
                                            <span class="bold optiona-number-span">...</span>
                                            <div class="user-input-form">
                                                <form class="optiona-user-input-form" action="" method="post">
                                                    <div class="form-group">
                                                        <label for="">Enter Number</label>
                                                        <input class="form-control" type="text" name="user_input_number" id="user_input_number" required/>
                                                    </div>
                                                    <button type="submit" class="btn green">Confirm</button>
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
            <div class="optiona-size-container__close-div"></div>
        </div>
    </div>

    <div class="optionb-size-number-select-container__div">
        <div class="optiona-size-container">
            <div class="container optiona-size__container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="optiona-size-round-div optiona-current-size-number">
                                    <span class="bold optionb-size-span" id="optionb-current-selected-size-text"></span>
                                    <span class="bold optionb-number-span" id="optionb-current-selected-size-number" style="display: none;"> <span>15</span> &#x33a1;</span>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row" id="optionb-select-size-container">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="optiona-size-container__close-div"></div>
        </div>
    </div>
@endsection
@section('pagelevel_script')
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
@endsection
@section('custom_script')
    <script type="text/javascript">
        var optiona_size_div = $('.optiona-size-number-select-container__div');
        var optionA_nRow = null;
        var optionA_current_size = null;

        // $('.optiona-size-container__close-div').on('click', function() {
        //     optiona_size_div.fadeOut(400);
        // });

        $('.optiona_size_number_item').on('click', function() {
            var $this = $(this);
            optionA_nRow = $this.parents('.optiona-question-container')[0];
            optionA_current_size = $this.find('.current-optiona-size-number-hidden').val();
            open_select_div();
        });

        function remove_active() {

            $('#optiona-select-number-input-container .optiona-size-round-div').each(function() {
                var $this = $(this);
                if ($this.hasClass("active")) {
                    $this.removeClass('active');
                }
            });
            $('#optiona-size-user-input-show').removeClass('active');
        }

        function remove_img_active(img_div) {
            $(img_div).find('img.single-survey-img').each(function() {
                var $this = $(this);
                // console.log($that);
                if($this.hasClass('active')){
                    $this.removeClass('active');
                }
            });
        }

        function open_select_div() {
            remove_active();
            if (optionA_current_size) {
                optiona_size_div.find('#optiona-current-selected-number').html(optionA_current_size);
            }
            else {
                optiona_size_div.find('#optiona-current-selected-number').html(0);
            }

            if (optionA_current_size < 5) {
                optiona_size_div.find('#optiona-size-number_'+optionA_current_size).addClass('active');
            }

            optiona_size_div.fadeIn(400);
        }

        function set_optiona_number(number) {

            remove_active();

            $(optionA_nRow).find('.current-optiona-size-number-hidden').val(number);
            $(optionA_nRow).find('.current-optiona-size-number').html(number);

            optiona_size_div.fadeOut(400);
            optiona_status_save();
        }

        $('#optiona-size-user-input-show').on('click', function() {
            remove_active();
            $(this).addClass('active');
        });

        $('form.optiona-user-input-form').submit(function(e){
            e.preventDefault();
            var $that = $(this);
            var inputed_number = $that.find('#user_input_number').val();
            set_optiona_number(inputed_number);
            // console.log(inputed_number);
        });

        $('.optiona_img_item').on('click', function() {
            var $this = $(this);
            optionA_nRow = $this.parents('.optiona-question-container')[0];
            var allimg_div = $this.parents('.optiona-image-contain__div')[0];
            remove_img_active(allimg_div);
            $this.find('.single-survey-img').addClass('active');
            var optiona_img_id = $this.find('.survey-circle-title-value').val();
            var optiona_img_title = $this.find('.survey-circle-title-text').data('value');
            $(optionA_nRow).find('.current-optiona-image-type-hidden').val(optiona_img_id);
            $(optionA_nRow).find('.current-optiona-image-type').html(optiona_img_title);
            optiona_status_save();
        });

        function optiona_status_save() {
            var optionaSize = $(optionA_nRow).find('.current-optiona-size-number-hidden').val();
            var questionId = $(optionA_nRow).find('.current-question-id-hidden').val();
            var optionaId = $(optionA_nRow).find('.current-optiona-image-type-hidden').val();
            var optiona_save_url = "{{route('save.survey.optiona')}}";

            if (optionaSize != "" && questionId != "" && optionaId != "") {
                // console.log("not null");
                axios.post(optiona_save_url, {option_size:optionaSize, question_id:questionId, option_id:optionaId}).then(function (response) {
                    // console.log(response);
                    reset_calculator_status();
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }


        var optionB_size_div = $('.optionb-size-number-select-container__div');
        var optionB_nRow = null;
        var optionB_current_size = null;

        function show_size_form(id) {
            optionB_nRow = $('#optionb-question-row_'+id)[0];

            var current_size_id = $(optionB_nRow).find('.current-optionb-size-id').val();

            var url = "{{url('get-single-question')}}";
            var final_url = url+"/"+id;

            $.ajax({
                url: final_url,
                type: 'get',
                success: function(result){
                    var size_html = "";
                    optionB_size_div.find('#optionb-current-selected-size-text').html("Select");
                    optionB_size_div.find('#optionb-current-selected-size-number').css({'display' : 'none'});

                    result.forEach (function(size) {
                        if (current_size_id != null && current_size_id == size.id) {

                            optionB_size_div.find('#optionb-current-selected-size-text').html(size.title);
                            optionB_size_div.find('#optionb-current-selected-size-number').css({'display' : 'block'});
                            optionB_size_div.find('#optionb-current-selected-size-number>span').html(size.size);

                            size_html += '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">'
                                        +'<a id="optionb-size-select-'+size.id+'" class="optionb-set-number-a">'
                                        +'<div onclick="set_optionb_size('+size.id+')" class="optiona-size-round-div active">'
                                        +'<span class="bold optionb-size-span" data-value="'+size.title+'">'+size.title+'</span>'
                                        +'<span class="bold optionb-number-span" data-value="'+size.size+'">'+size.size+' &#x33a1;</span>'
                                        +'</div></a></div>';
                        }else {
                            size_html += '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">'
                                        +'<a id="optionb-size-select-'+size.id+'" class="optionb-set-number-a">'
                                        +'<div onclick="set_optionb_size('+size.id+')" class="optiona-size-round-div">'
                                        +'<span class="bold optionb-size-span" data-value="'+size.title+'">'+size.title+'</span>'
                                        +'<span class="bold optionb-number-span" data-value="'+size.size+'">'+size.size+' &#x33a1;</span>'
                                        +'</div></a></div>';
                        }
                    })
                    optionB_size_div.find('#optionb-select-size-container').html(size_html);
                    optionB_size_div.fadeIn(400);

                },
                error: function(result){
                    console.log(error);
                }
            });
        }

        function set_optionb_size(size_id) {
            optionB_size_div.find('.optiona-size-round-div').each( function() {
                var $this = $(this);
                if ($this.hasClass('active')) {
                    $this.removeClass('active');
                }
            });
            var current_round_circle = optionB_size_div.find('#optionb-size-select-'+ size_id+'>.optiona-size-round-div');
            current_round_circle.addClass('active');

            var size_text = current_round_circle.find('.optionb-size-span').data('value');
            var size_number = current_round_circle.find('.optionb-number-span').data('value');

            $(optionB_nRow).find('.current-optionb-size-id').val(size_id);
            $(optionB_nRow).find('.current-optiona-size-number').html(size_text);
            $(optionB_nRow).find('.current-optiona-image-type>span').html(size_number);
            $(optionB_nRow).find('.current-optiona-image-type').css({'display': 'block'});

            optionB_size_div.fadeOut(400);
        }

        $('.optionb_img_item').on('click', function() {
            var $this = $(this);
            // console.log($this);
            $this.find('img.single-survey-img').toggleClass('active');
        });

        $('.question-comment-save-btn').on('click', function() {
            var $this = $(this);
            optionA_nRow = $this.parents('.optiona-question-container')[0];
            var questionId = $(optionA_nRow).find('.current-question-id-hidden').val();
            var userComment = $(optionA_nRow).find('.question_comment').val();
            var comment_save_url = "{{route('save.question.comment')}}";

            if (userComment != "") {
                axios.post(comment_save_url, {question_id:questionId, comment:userComment}).then(function (response) {
                    $(optionA_nRow).find('.question_comment').val("");
                    var img_url = "{{cdn('assets/images/avatar')}}" ;
                    img_url = img_url+"/"+response.data['avatar']+"_thumbnail.jpg";
                    var new_comment_html = '<div class="single-user-comment-contain" id="single_user_comment_'+response.data['id']+'">'
                    +'<img class="comment-user-img tooltips" data-placement="bottom" data-original-title="'+response.data['first_name']+' '+response.data['last_name']+'" src="'+img_url+'">'
                    +'<span class="single-user-comment-text">'+response.data['comment']+'<a href="#" onclick="delete_own_comment('+response.data['id']+')" class="delete-comment-btn"><i class="fa fa-close font-red-sunglo"></i></a></span></div>';

                    var comment_contain_div = $(optionA_nRow).find('#comment_container_'+questionId).prepend(new_comment_html);

                    // console.log(new_comment_html);
                }).catch(function (error) {
                    console.log(error);
                });
            }
        });

        function delete_own_comment(id) {
            var url = "{{url('delete-own-comment')}}";
            var final_delete_url = url+"/"+id;

            $.ajax({
                url: final_delete_url,
                type: 'get',
                success: function(result){
                    $('#single_user_comment_'+id).remove();
                },
                error: function(result){
                    console.log(error);
                }
            });
        }

        function reset_calculator_status() {
            var current_per_money = $('#survey_money_per_meter').val();
            var calculator_url = "{{url('calculator')}}";
            var calculator_final_url = calculator_url+"/"+current_per_money;
            $.ajax({
                url: calculator_final_url,
                type: 'get',
                success: function(result){
                    // console.log(result.total_square);
                    var result_total_money = result.total_money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#total_survey_square_size').html(result.total_square);
                    $('#total_survey_money').html(result_total_money);
                },
                error: function(result){
                    console.log(error);
                }
            });
            // console.log(current_per_money);
        }
    </script>
@endsection
