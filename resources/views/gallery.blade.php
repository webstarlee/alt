@extends('master')
@section('title')
like image
@endsection
@section('content')
    <?php $check_exist_image = 0; ?>
    @foreach ($images as $image)
        <?php $check_exist_image += 1; ?>
    @endforeach
    <div class="homepage-background-div" style="height: 25vh;min-height: 150px;">
        <div class="description-container-div">
        </div>
        <div class="menu-container-div">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="menu-button-gotoHome-div animated bounceInRight">
                            @if ($check_exist_image > 0)
                                <a href="{{url('save-like-status/'.$current_style->id)}}"><img src="{{cdn('assets/images/components/alt_gotoHome_button.svg')}}" class="menu-estimate" alt=""></a>
                            @else
                                <a href="{{url('home')}}"><img src="{{cdn('assets/images/components/alt_gotoHome_button.svg')}}" class="menu-estimate" alt=""></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="description-text-summary-div animated bounceInLeft">
                            <p class="font-white summary-text text-right" >{{$current_style->style_title}}</p>
                            <p class="font-white bold your-selection-text text-right">{{$current_style->style_name}}</p>
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
                    <h2 class="text-center style-text-h2"><span class="bold">{{$current_style->style_title}}</span> {{$current_style->style_name}} </h2>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="gallery-like-container-div">
                                <?php $image_count = 0; ?>
                                @foreach ($images as $image)
                                    <?php $image_count += 1; ?>
                                    <div class="buddy" @if ($image_count == 1) style="display: block;" @endif>
                                        <input type="hidden" name="" class="image_id" value="{{$image->id}}">
                                        <a class="image-stamp">
                                            <img class="avatar" src="{{cdn('assets/images/gallery/'.$image->gallery_img.'_thumbnail.jpg')}}" alt="">
                                        </a>
                                    </div>
                                @endforeach
                                @if ($image_count > 0)
                                    <div class="gallery-like-group-button-container">
                                        <div class="gallery-like-button-container">
                                            <a href="#" id="like-btn">
                                                <div class="gallery-like-button">
                                                    <i class="fa fa-heart"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="gallery-like-text-alert-container">
                                        <h3 class="bold" style="font-size: 18px;">Love this? <br /> <small class="bold">Click the image to tell us more.</small> </h3>
                                    </div>
                                    <div class="gallery-unlike-group-button-container">
                                        <div class="gallery-unlike-button-container">
                                            <a href="#" id="unlike-btn">
                                                <div class="gallery-unlike-button">
                                                    <i class="fa fa-close"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="gallery-back-button-container">
                                            <a href="#" id="back-btn">
                                                <div class="gallery-back-button">
                                                    <i class="fa fa-rotate-left"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="image_comment_stamp" class="modal fade" data-backdrop="static" tabindex="-1" data-width="500">
        <div class="modal-header">
            <h2 class="modal-title text-center bold stmpe-heder-txt">Show us what you like</h2>
        </div>
        <div class="modal-body text-center">
            <input type="hidden" name="stamp_image_id" id="stamp_image_id" value="">
            <div class="stamp-img-div">
            </div>
            <div class="select-stamp-type-container">
                <h5 class="sbold">Select a Heart - Click the Image</h5>
                <div class="heart-stamp-div" id="stamp-heart-img">
                    <img src="{{cdn('assets/images/components/heart.svg')}}" salt="">
                </div>
                <div class="heart-stamp-div" id="stamp-breadk-heart-img">
                    <img src="{{cdn('assets/images/components/broken_heart.svg')}}" alt="">
                </div>
            </div>
            <div class="row gallery-img-comment">
                <div class="col-xs-12">
                    <input class="form-control" type="text" id="gallery_comment" name="gallery_comment" placeholder="Comment:"/>
                </div>
            </div>
        </div>
        <div class="modal-footer text-center" id="gallery-img-add-close" style="text-align:center;">
            <button type="button" id="img-stamp-cancel-button" class="btn dark">Go Back</button>
            <button type="button" id="img-stamp-save-button" class="btn green">Save and Close</button>
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
            var gallery_style_id = {{$current_style->id}} ;
            var current_window_width = $(window).width();

            if (current_window_width > 530) {
                $('.gallery-like-container-div').css({'height': '530px'});
            }
            else {
                $('.gallery-like-container-div').css({'height': current_window_width-20});
            }

            $(window).on('resize', function(){
                var current_budy_height = $('.buddy').height();
                current_window_width = $(window).width();
                if (current_budy_height != null) {
                    if (current_window_width > 530) {
	                $('.gallery-like-container-div').css({'height': '530px'});
	            }
	            else {
	                $('.gallery-like-container-div').css({'height': current_window_width-20});
	            }
                }
                else{
                    $('.gallery-like-container-div').css({'height': 200});
                }
            });

            var current_buddy = null;

            $('#like-btn').mouseover(function() {
                set_status("like");
            });

            $('#like-btn').mousedown(function() {
                if(set_status("like"))
                {
                    var current_img_id = current_buddy.find('.image_id').val();
                    set_like_images(current_img_id, 2);
                }
            });
            $('#like-btn').mouseout(function() {
                if(current_buddy.find('.status.like').length > 0) {
                    current_buddy.find('.status.like').remove();
                }
            });

            $('#unlike-btn').mouseover(function() {
                set_status("unlike");
            });
            $('#unlike-btn').mousedown(function() {
                if(set_status("unlike")){
                    var current_img_id = current_buddy.find('.image_id').val();
                    set_like_images(current_img_id, 1);
                }
            });
            $('#unlike-btn').mouseout(function() {
                if(current_buddy.find('.status.dislike').length > 0) {
                    current_buddy.find('.status.dislike').remove();
                }
            });

            $('#back-btn').on('click', function() {
                $(".buddy").each(function() {
                    var $this = $(this);
                    if($this.css('display') == 'block') {
                        current_buddy = $(this);
                        if (current_buddy.prev('.buddy').length > 0) {
                            current_buddy.delay(100).fadeOut(400);
                            current_buddy.prev().removeClass('rotate-left rotate-right').fadeIn(1);
                            if(current_buddy.prev().find('.status.dislike').length > 0) {
                                current_buddy.prev().find('.status.dislike').remove();
                            }
                            if(current_buddy.prev().find('.status.like').length > 0) {
                                current_buddy.prev().find('.status.like').remove();
                            }
                        }
                    }
                })
            });

            $('#info-btn').on('click', function() {
                $(".buddy").each(function() {
                    var $this = $(this);
                    if($this.css('display') == 'block') {
                        current_buddy = $(this);
                        var image_id = $this.find('.image_id').val();
                        view_stamp(image_id);
                    }
                })
            });

            function set_status(status) {
                $(".buddy").each(function() {
                    var $this = $(this);
                    if($this.css('display') == 'block') {
                        current_buddy = $(this);
                        if (status == "like") {
                            $(this).append('<div class="status like">Like!</div>');
                        }
                        else if (status == "unlike") {
                            $(this).append('<div class="status dislike">Dislike!</div>');
                        }
                    }
                })

                return true;
            }

            $(".buddy").each(function() {

                var swipe = new Hammer(this);
                // detect swipe and call to a function
                swipe.on('swiperight swipeleft press', function(e) {
                    // e.preventDefault();
                    e.gesture.srcEvent.preventDefault();
                    if (e.type == 'swipeleft') {
                        current_buddy = $(this);
                        var current_img_id = current_buddy.find('.image_id').val();
                        set_like_images(current_img_id, 1);
                    // }
                    } else if (e.type == 'swiperight') {
                        current_buddy = $(this);
                        var current_img_id = current_buddy.find('.image_id').val();
                        set_like_images(current_img_id, 2);
                    }
                    else if (e.type == 'press') {
                        console.log("Hello");
                    }

                });
            });

            function set_like_images (image_id, status) {
                var goto_home_url = "{{url('/save-like-status')}}";
                var set_image_like_url = "{{url('/like-images')}}";
                var user_id = <?php echo Auth::user()->id; ?> ;

                if (status == 2) {
                    current_buddy.addClass('rotate-left').delay(1000).fadeOut(400);
                    $('.buddy').find('.status').remove();
                    current_buddy.append('<div class="status like">Like!</div>');
                    if (current_buddy.next('.buddy').length > 0) {
                        current_buddy.next().removeClass('rotate-left rotate-right').fadeIn(400);
                    }else {
                        setTimeout(function () {
                            var congratulation_text = "<p class='bold uppercase text-center'> You are set for all images </p>"+
                                                    "<a href='"+goto_home_url+"/"+gallery_style_id+"'><p class='bold uppercase text-center'>save and back to home</p></a>"+
                                                    "<a href='javascript: location.reload();'><p class='bold uppercase text-center'>Or Reset status</p></a>";
                            $('.gallery-like-container-div').css({'height': '200px!important'});
                            $('.gallery-like-container-div').html(congratulation_text);
                        }, 450);
                    }
                }
                else if (status == 1) {
                    current_buddy.addClass('rotate-right').delay(1000).fadeOut(400);
                    $('.buddy').find('.status').remove();
                    current_buddy.append('<div class="status dislike">Dislike!</div>');
                    if (current_buddy.next('.buddy').length > 0) {
                        current_buddy.next().removeClass('rotate-left rotate-right').fadeIn(400);
                    }else {
                        setTimeout(function () {
                            var congratulation_text = "<p class='bold uppercase text-center'> You are set for all images </p>"+
                                                    "<a href='"+goto_home_url+"/"+gallery_style_id+"'><p class='bold uppercase text-center'>save and back to home</p></a>"+
                                                    "<a href='javascript: location.reload();'><p class='bold uppercase text-center'>Or Reset status</p></a>";
                            $('.gallery-like-container-div').css({'height': '200px!important'});
                            $('.gallery-like-container-div').html(congratulation_text);
                        }, 450);
                    }
                }
                axios.post(set_image_like_url, {imageId:image_id, useId:user_id, status:status}).then(function (response) {
                    console.log("success");
                }).catch(function (error) {
                    console.log(error);
                });
            }

            $('a.image-stamp').each(function() {
                var $this = $(this);
                var clickdetect = 0;
                var image_id = $this.parent().find('.image_id').val();
                $this.mousedown(function(){
                    clickdetect = 1;
                    // console.log(clickdetect);
                }).mousemove(function(){
                    if (clickdetect > 0) {
                        clickdetect += 1;
                    }
                    // console.log(clickdetect);
                }).mouseup(function(){
                    if (clickdetect < 5) {
                        view_stamp(image_id);
                        clickdetect = 0;
                    }
                })
            });

            function view_stamp(id) {
                var base_img_url = "{{url('get-stamp-img')}}";

                var get_data_url = base_img_url+"/"+id;

                $.ajax({
                    url: get_data_url,
                    type: 'get',
                    success: function(result){
                        var image_url = "{{cdn('assets/images/gallery')}}" ;
                        image_url = image_url+"/"+result.gallery_img+"_thumbnail.jpg";

                        var img_html = '<img src="'+image_url+'" class="stamp-img" alt="">';

                        // console.log(image_url);
                        var exist_img_already_check = $('.stamp-img-div').find('.stamp-img');
                        $('#stamp_image_id').val(result.id);

                        $('.stamp-img-div').html(img_html);
                        $('#image_comment_stamp').modal('show');
                    },
                    error: function(result){
                        console.log(error);
                    }
                });
            }

            var check_is_click_for_stamp = 0;
            var current_heart_type = null;
            var stamp_position_array = [];

            $('.stamp-img-div').mousedown(function(e){
                if (e.which == 1) {
                    check_is_click_for_stamp = 1;
                }
            }).mousemove(function(e){
                if (check_is_click_for_stamp > 0 && e.which == 1) {
                    check_is_click_for_stamp += 1;
                }
            }).mouseup(function(e){
                if(check_is_click_for_stamp < 5 && e.which == 1) {
                    var $this = $(this);
                    var current_pos_x = e.offsetX;
                    var current_pos_y = e.offsetY;
                    var origin_img_width = $this.width();
                    var origin_img_height = $this.height();

                    var percent_x = current_pos_x / origin_img_width * 100;
                    var percent_y = current_pos_y / origin_img_height * 100;

                    var final_left = "calc("+percent_x+"% - 12px)";
                    var final_top = "calc("+percent_y+"% - 10px)";

                    var heart_img_url = null;
                    if (current_heart_type != null) {
                        if (current_heart_type == 1) {
                            heart_img_url = "{{cdn('assets/images/components/heart.svg')}}";
                        }
                        else if (current_heart_type == 0) {
                            heart_img_url = "{{cdn('assets/images/components/broken_heart.svg')}}";
                        }
                    }
                    else {
                        alert('please select heart type');
                    }

                    if (current_heart_type != null && heart_img_url != null) {
                        var heart_img_html = '<img class="stam-heart" src="'+heart_img_url+'" style="width: 25px;position:absolute;top: '+final_top+';left: '+final_left+'"></i>';
                        $this.append(heart_img_html);

                        stamp_position_array.push({'love_type': current_heart_type, 'top': percent_y, 'left': percent_x});

                        // console.log(stamp_position_array);
                    }
                }
            });

            $('#stamp-heart-img').on('click', function(){
                $(this).parent().find('.active').each(function() {
                    $(this).removeClass('active');
                });
                current_heart_type = 1;
                $(this).addClass('active');
            });

            $('#stamp-breadk-heart-img').on('click', function(){
                $(this).parent().find('.active').each(function() {
                    $(this).removeClass('active');
                });
                current_heart_type = 0;
                $(this).addClass('active');
            });

            $('#img-stamp-cancel-button').on('click', function() {
                stamp_position_array = [];
                $('#stamp-heart-img').parent().find('.active').each(function() {
                    $(this).removeClass('active');
                });
                $('#image_comment_stamp').modal('hide');
            });

            $('#img-stamp-save-button').on('click', function() {
                console.log(stamp_position_array);
                if ((typeof stamp_position_array !== 'undefined' && stamp_position_array.length > 0) || $('#gallery_comment').val() != "" ) {
                    if (typeof stamp_position_array !== 'undefined' && stamp_position_array.length > 0 ) {
                        save_image_stamps();
                    }

                    if ($('#gallery_comment').val() != "") {
                        save_image_comment();
                    }
                    var image_id = $('#stamp_image_id').val();
                    set_status("like");
                    $('#image_comment_stamp').modal('hide');
                    set_like_images(image_id, 3);
                    current_buddy.addClass('rotate-left').delay(400).fadeOut(1);
                    $('.buddy').find('.status').remove();
                    current_buddy.append('<div class="status like">Like!</div>');
                    if (current_buddy.next('.buddy').length > 0) {
                        current_buddy.next().removeClass('rotate-left rotate-right').fadeIn(400);
                    }else {
                        setTimeout(function () {
                            var congratulation_text = "<p class='bold uppercase text-center'> You are set for all images </p>"+
                                                    "<a href='"+goto_home_url+"/"+gallery_style_id+"'><p class='bold uppercase text-center'>save and back to home</p></a>"+
                                                    "<a href='javascript: location.reload();'><p class='bold uppercase text-center'>Or Reset status</p></a>";
                            $('.gallery-like-container-div').css({'height': '200px!important'});
                            $('.gallery-like-container-div').html(congratulation_text);
                        }, 450);
                    }
                }
            });

            function save_image_stamps() {
                var save_image_stamp_url = "{{url('/save_stamps')}}";
                // console.log(stamp_position_array);
                var image_id = $('#stamp_image_id').val();
                axios.post(save_image_stamp_url, {imageId: image_id,stamp_data: stamp_position_array}).then(function (response) {
                    // console.log(stamp_position_array);

                    stamp_position_array = [];
                    $('#stamp-heart-img').parent().find('.active').each(function() {
                        $(this).removeClass('active');
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            }
            function save_image_comment(){
                var gallery_comment = $('#gallery_comment').val();
                var save_image_comment_url = "{{route('save.gallery.comment')}}";
                // console.log(stamp_position_array);
                var image_id = $('#stamp_image_id').val();
                if (gallery_comment != "") {
                    axios.post(save_image_comment_url, {imageId: image_id, img_comment: gallery_comment}).then(function (response) {
                        console.log(response);
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            };
        });
    </script>
@endsection
