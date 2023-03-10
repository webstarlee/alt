@extends('master')
@section('title')
Gallery Report
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
            @foreach ($report_galleries as $report_gallerie)
                <?php
                    $like_img_count = 0;
                    foreach ($report_gallerie['images'] as $image) {
                        foreach ($like_images as $like_image) {
                            if ($image->id == $like_image->image_id) {
                                if ($like_image->like_type > 1) {
                                    $like_img_count += 1;
                                }
                            }
                        }
                    }
                ?>
                @if ($like_img_count > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-center style-text-h2">Your Selection <span class="bold">{{$report_gallerie['style_name']}}</span></h2>
                            <div class="row">
                                <div id="aniimated-thumbnials" class="list-unstyled clearfix">
                                    @foreach ($report_gallerie['images'] as $image)
                                        <?php
                                            $current_image_status = 0;
                                            foreach ($like_images as $like_image) {
                                                if ($image->id == $like_image->image_id) {
                                                    if ($like_image->like_type == 2) {
                                                        $current_image_status = 2;
                                                    }
                                                    elseif ($like_image->like_type == 3) {
                                                        $current_image_status = 3;
                                                    }
                                                    elseif ($like_image->like_type == 1) {
                                                        $current_image_status = 1;
                                                    }
                                                }
                                            }
                                        ?>
                                        @if ($current_image_status > 1)
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 text-center">
                                                <div class="selection-image-container">
                                                    <input type="hidden" name="" id="current_img_id" value="{{$image->id}}">
                                                    <img class="img-responsive thumbnail" src="{{cdn('assets/images/gallery/'.$image->gallery_img.'_thumbnail.jpg')}}">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div id="single_img_selection_view" class="modal fade" data-backdrop="static" tabindex="-1" data-width="500">
        <div class="modal-header">
            <h2 class="modal-title text-center bold stmpe-heder-txt">View Your Selection</h2>
        </div>
        <div class="modal-body text-center">
            <div class="selection-view-img-container"></div>
            <div class="img-comment_container" id="selection-img-comment_container"></div>
        </div>
        <div class="modal-footer text-center" id="gallery-img-add-close" style="text-align:center;">
            <button type="button" data-dismiss="modal" class="btn dark">Close</button>
        </div>
    </div>
@endsection
@section('pagelevel_script')
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
@endsection
@section('custom_script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.selection-image-container').each(function() {
                $(this).mouseover(function() {
                    $(this).find('.status').addClass('hovered');
                }).mouseout(function() {
                    $(this).find('.status').removeClass('hovered');
                }).on('click', function() {
                    var img_id = $(this).find('#current_img_id').val();
                    var img_base_url = "{{url('get-selection_img')}}";
                    var get_img_data_url = img_base_url+"/"+img_id;

                    $.ajax({
                        url: get_img_data_url,
                        type: 'get',
                        success: function(result){
                            $('#selection-img-comment_container').html("");
                            if (result.like_type < 3 || result.like_type == "undefine") {
                                var image_url = "{{cdn('assets/images/gallery')}}" ;
                                image_url = image_url+"/"+result.img_name+"_thumbnail.jpg";

                                var img_html = '<img src="'+image_url+'" class="stamp-img" alt="">';
                                if (result.comment) {
                                    // var comment_body = "Comment : " + result.comment;
                                    $('#selection-img-comment_container').html("Comment : " + result.comment);
                                }

                                $('.selection-view-img-container').html(img_html);
                                $('#single_img_selection_view').modal('show');
                            }else if (result.like_type == 3) {
                                var image_url = "{{cdn('assets/images/gallery')}}" ;
                                image_url = image_url+"/"+result.img_name+"_thumbnail.jpg";

                                var img_html = '<img src="'+image_url+'" class="stamp-img" alt="">';

                                $('.selection-view-img-container').html(img_html);

                                if (result.comment) {
                                    // var comment_body = "Comment : " + result.comment;
                                    $('#selection-img-comment_container').html("Comment : " + result.comment);
                                }

                                result.stamp_datas.forEach(function(stamp) {
                                    var final_left = "calc("+stamp.pos_left+"% - 12px)";
                                    var final_top = "calc("+stamp.pos_top+"% - 10px)";
                                    var heart_img_url = null;
                                    var current_heart_type = stamp.stamp_status;

                                    if (current_heart_type == 1) {
                                        heart_img_url = "{{cdn('assets/images/components/heart.svg')}}";
                                    }
                                    else if (current_heart_type == 0) {
                                        heart_img_url = "{{cdn('assets/images/components/broken_heart.svg')}}";
                                    }

                                    var heart_img_html = '<img class="stam-heart" src="'+heart_img_url+'" style="width: 25px;position:absolute;top: '+final_top+';left: '+final_left+'"></i>';
                                    $('.selection-view-img-container').append(heart_img_html);
                                })
                                $('#single_img_selection_view').modal('show');
                            }
                        },
                        error: function(result){
                            console.log(error);
                        }
                    });
                })
            });
        });
    </script>
@endsection
