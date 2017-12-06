@extends('master')
@section('title')
Welcome
@endsection
@section('pagelevel_plugin')
<link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="homepage-background-div" style="height: 25vh;">
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
    <div class="gallery-img-container-div">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-toolbar">
                        <div class="btn-group pull-right">
                            <a href="{{url('reset_selection/'.$current_style->id)}}" id="selection_reset_btn" class="btn green btn-sm"> RESET YOUR SELECTION </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center style-text-h2"><span class="bold">{{$current_style->style_title}}</span> {{$current_style->style_name}} </h2>
                    <div class="row">
                        <div id="aniimated-thumbnials" class="list-unstyled clearfix">
                            @foreach ($images as $image)
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 text-center">
                                    <div class="selection-image-container">
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
                                        @if ($current_image_status == 3)
                                            <div class="status selection_love">Love!</div>
                                        @elseif ($current_image_status == 2)
                                            <div class="status selection_like">Like!</div>
                                        @elseif ($current_image_status == 1)
                                            <div class="status selection_dislike">Dislike!</div>
                                        @endif
                                        <input type="hidden" name="" id="current_img_id" value="{{$image->id}}">
                                        <img class="img-responsive thumbnail" src="{{cdn('assets/images/gallery/'.$image->gallery_img.'_thumbnail.jpg')}}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="single_img_selection_view" class="modal fade" data-backdrop="static" tabindex="-1" data-width="500">
        <div class="modal-header">
            <h2 class="modal-title text-center bold stmpe-heder-txt">View Your Selection</h2>
        </div>
        <div class="modal-body text-center">
            <div class="selection-view-img-container"></div>
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
                            console.log(result);
                            if (result.like_type < 3 || result.like_type == "undefine") {
                                var image_url = "{{cdn('assets/images/gallery')}}" ;
                                image_url = image_url+"/"+result.img_name+"_thumbnail.jpg";

                                var img_html = '<img src="'+image_url+'" class="stamp-img" alt="">';

                                $('.selection-view-img-container').html(img_html);
                                $('#single_img_selection_view').modal('show');
                            }else if (result.like_type == 3) {
                                var image_url = "{{cdn('assets/images/gallery')}}" ;
                                image_url = image_url+"/"+result.img_name+"_thumbnail.jpg";

                                var img_html = '<img src="'+image_url+'" class="stamp-img" alt="">';

                                $('.selection-view-img-container').html(img_html);

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

            $(('#selection_reset_btn')).on('click', function(e) {
                e.preventDefault();
                var $this = $(this);
                swal({
                  title: "Are you sure?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#0ed2d0",
                  confirmButtonText: "Yes, Reset!",
                  cancelButtonText: "No, cancel!",
                  closeOnConfirm: true,
                  closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {
                        console.log($this.attr('href'));
                        window.location = $this.attr('href');
                    } else {

                    }
                });
            })
        });
    </script>
@endsection
