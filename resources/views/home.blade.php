@extends('master')
@section('title')
Welcome
@endsection
@section('content')
    <div class="homepage-background-div">
        <div class="description-container-div">
        </div>
        <div class="menu-container-div">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="description-text-div animated bounceInRight">
                            <p class="font-white description-text" >Take our short gallery survey add let us build your</p>
                            <p class="font-white bold description-text">Dream home</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-button-right-div pull-right animated bounceInLeft">
                            <a href="#"><img src="{{cdn('assets/images/components/goto_estimate.svg')}}" class="menu-estimate" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="user-img-gallery-parent-div">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="img-gallery-select-div">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="parent_gallery_img_info-div">
                                            <div class="gallery-single-img-div left-img">
                                                <a href="#tab_1_1" data-toggle="tab" class="gallery-single-img-a"> <img src="{{cdn('assets/images/gallery/category/'.$category1->category_img.'_thumbnail.jpg')}}" alt=""> </a>
                                            </div>
                                            <div class="single-gallery-title-div">
                                                <p class="single-gallery-title bold">{{$category1->category_name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="parent_gallery_img_info-div">
                                            <div class="gallery-single-img-div right-img">
                                                <a href="#tab_1_3" data-toggle="tab" class="gallery-single-img-a"> <img src="{{cdn('assets/images/gallery/category/'.$category2->category_img.'_thumbnail.jpg')}}" alt=""> </a>
                                            </div>
                                            <div class="single-gallery-title-div">
                                                <p class="single-gallery-title bold">{{$category2->category_name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">

                            <div class="tab-pane" id="tab_1_1">
                                <?php
                                    $style1_passed_count = 0;
                                    // $isexist_passed = 0;
                                    $all_style = 0;
                                    $count_style_number = 0;
                                    foreach ($gallery_style1 as $gallery_style) {
                                        $all_style += 1;
                                        // $allery_style_user_passed = explode(',', $gallery_style->style_completed_user);
                                        // if(in_array(Auth::user()->id, $allery_style_user_passed)) {
                                        //     $isexist_passed = 2;
                                        // }
                                    }
                                ?>
                                @foreach ($gallery_style1 as $gallery_style)
                                    <?php
                                        $count_style_number += 1;
                                        $allery_style_user_passed = explode(',', $gallery_style->style_completed_user);
                                        if(in_array(Auth::user()->id, $allery_style_user_passed)) {
                                            $style1_passed_count = 2;
                                        }
                                        else {
                                            $style1_passed_count -= 1;
                                        }
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="child_gallery_img_info-div">
                                                <div class="subGallery-single-img-div
                                                <?php
                                                    if($count_style_number ==1){
                                                        if ($style1_passed_count == 2) {
                                                            echo "passed-img";
                                                        }
                                                        else {
                                                            echo "current-img";
                                                        }
                                                    }
                                                    else if($count_style_number == $all_style) {
                                                        if($style1_passed_count == 2) {
                                                            echo "last-style";
                                                        }
                                                        else if($style1_passed_count == 1) {
                                                            echo "current-img";
                                                        }
                                                    }
                                                    else {
                                                        if($style1_passed_count == 2) {
                                                            echo "passed-img";
                                                        }
                                                        else if($style1_passed_count == 1) {
                                                            echo "current-img";
                                                        }
                                                    }
                                                ?>" >
                                                    <a class="subGallery-single-img-a"
                                                    <?php
                                                        if($count_style_number ==1){
                                                            if ($style1_passed_count == 2) {
                                                                echo 'href="'.url('view-selection/'.$gallery_style->id).'"';
                                                            }
                                                            else {
                                                                echo 'href="'.url('gallery/'.$gallery_style->id).'"';
                                                            }
                                                        }
                                                        else if($count_style_number == $all_style) {
                                                            if($style1_passed_count == 2) {
                                                                echo 'href="'.url('view-selection/'.$gallery_style->id).'"';
                                                            }
                                                            else if($style1_passed_count == 1) {
                                                                echo 'href="'.url('gallery/'.$gallery_style->id).'"';
                                                            }
                                                        }
                                                        else {
                                                            if($style1_passed_count == 2) {
                                                                echo 'href="'.url('view-selection/'.$gallery_style->id).'"';
                                                            }
                                                            else if($style1_passed_count == 1) {
                                                                echo 'href="'.url('gallery/'.$gallery_style->id).'"';
                                                            }
                                                        }
                                                    ?>> <img src="{{cdn('assets/images/gallery/style/'.$gallery_style->style_img.'_thumbnail.jpg')}}" alt=""> </a>
                                                </div>
                                                <div class="child-single-gallery-title-div">
                                                    <p class="child-single-gallery-title bold">{{$gallery_style->style_title}} <br />{{$gallery_style->style_name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="tab-pane" id="tab_1_3">
                                <?php
                                    $style1_passed_count1 = 0;
                                    // $isexist_passed1 = 0;
                                    $all_style1 = 0;
                                    $count_style_number1 = 0;
                                    foreach ($gallery_style2 as $gallery_style) {
                                        $all_style1 += 1;
                                        // $allery_style_user_passed = explode(',', $gallery_style->style_completed_user);
                                        // if(in_array(Auth::user()->id, $allery_style_user_passed)) {
                                        //     $isexist_passed = 2;
                                        // }
                                    }
                                ?>
                                @foreach ($gallery_style2 as $gallery_style)
                                    <?php
                                        $count_style_number1 += 1;
                                        $allery_style_user_passed = explode(',', $gallery_style->style_completed_user);
                                        if(in_array(Auth::user()->id, $allery_style_user_passed)) {
                                            $style1_passed_count1 = 2;
                                        }
                                        else {
                                            $style1_passed_count1 -= 1;
                                        }
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="child_gallery_img_info-div">
                                                <div class="subGallery-single-img-div
                                                <?php
                                                    if($count_style_number1 ==1){
                                                        if ($style1_passed_count1 == 2) {
                                                            echo "passed-img";
                                                        }
                                                        else {
                                                            echo "current-img";
                                                        }
                                                    }
                                                    else if($count_style_number1 == $all_style1) {
                                                        if($style1_passed_count1 == 2) {
                                                            echo "last-style";
                                                        }
                                                        else if($style1_passed_count1 == 1) {
                                                            echo "current-img";
                                                        }
                                                    }
                                                    else {
                                                        if($style1_passed_count1 == 2) {
                                                            echo "passed-img";
                                                        }
                                                        else if($style1_passed_count1 == 1) {
                                                            echo "current-img";
                                                        }
                                                    }
                                                ?>">
                                                    <a class="subGallery-single-img-a"
                                                    <?php
                                                        if($count_style_number1 ==1){
                                                            if ($style1_passed_count1 == 2) {
                                                                echo 'href="'.url('view-selection/'.$gallery_style->id).'"';
                                                            }
                                                            else {
                                                                echo 'href="'.url('gallery/'.$gallery_style->id).'"';
                                                            }
                                                        }
                                                        else if($count_style_number1 == $all_style) {
                                                            if($style1_passed_count1 == 2) {
                                                                echo 'href="'.url('view-selection/'.$gallery_style->id).'"';
                                                            }
                                                            else if($style1_passed_count1 == 1) {
                                                                echo 'href="'.url('gallery/'.$gallery_style->id).'"';
                                                            }
                                                        }
                                                        else {
                                                            if($style1_passed_count1 == 2) {
                                                                echo 'href="'.url('view-selection/'.$gallery_style->id).'"';
                                                            }
                                                            else if($style1_passed_count1 == 1) {
                                                                echo 'href="'.url('gallery/'.$gallery_style->id).'"';
                                                            }
                                                        }
                                                    ?>
                                                    > <img src="{{cdn('assets/images/gallery/style/'.$gallery_style->style_img.'_thumbnail.jpg')}}" alt=""> </a>
                                                </div>
                                                <div class="child-single-gallery-title-div">
                                                    <p class="child-single-gallery-title bold">{{$gallery_style->style_title}} <br />{{$gallery_style->style_name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
