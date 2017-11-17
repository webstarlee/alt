@extends('master')
@section('title')
Welcome
@endsection
@section('content')
    <div class="homepage-background-div">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="font-white gallery-background-text">Take your short gallery survey</h3>
                    <h3 class="font-white gallery-background-text">and let us build your</h3>
                    <h3 class="bold font-white gallery-background-text-bottom">dream home</h3>
                </div>
                <div class="col-sm-6">
                    <div class="goto-other-page">
                        <a href="#"><h4 class="bold font-white gallery-background-text text-right">Get more specific</h4>
                        <h3 class="bold font-white gallery-background-text text-right">Live construction estimate</h3>
                        <div class="goto-other-page-arrow-right-div">
                            <img src="{{cdn('assets/images/arrow-right.png')}}" alt="">
                        </div></a>
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
                                    <div class="col-sm-6">
                                        <div class="parent_gallery_img_info-div">
                                            <div class="gallery-single-img-div">
                                                <a href="#tab_1_1" data-toggle="tab" class="gallery-single-img-a"> <img src="{{cdn('assets/images/gallery/gallery_parent1.jpg')}}" alt=""> </a>
                                            </div>
                                            <div class="single-gallery-title-div">
                                                <p class="single-gallery-title bold">Niseko</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="parent_gallery_img_info-div">
                                            <div class="gallery-single-img-div">
                                                <a href="#tab_1_3" data-toggle="tab" class="gallery-single-img-a"> <img src="{{cdn('assets/images/gallery/gallery_parent2.jpg')}}" alt=""> </a>
                                            </div>
                                            <div class="single-gallery-title-div">
                                                <p class="single-gallery-title bold">Lombok</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">

                            <div class="tab-pane" id="tab_1_1">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="child_gallery_img_info-div">
                                            <div class="subGallery-single-img-div">
                                                <a class="subGallery-single-img-a" href="{{route('single_gallery')}}"> <img src="{{cdn('assets/images/gallery/general.jpg')}}" alt=""> </a>
                                            </div>
                                            <div class="child-single-gallery-title-div">
                                                <p class="child-single-gallery-title bold">Gallery 1 <br />GENERAL STYLE</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="child_gallery_img_info-div">
                                            <div class="subGallery-single-img-div">
                                                <a class="subGallery-single-img-a"> <img src="{{cdn('assets/images/gallery/bedroom.jpg')}}" alt=""> </a>
                                            </div>
                                            <div class="child-single-gallery-title-div">
                                                <p class="child-single-gallery-title bold">Gallery 2 <br />BEDROOM STYLE</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_1_3">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="child_gallery_img_info-div">
                                            <div class="subGallery-single-img-div">
                                                <a class="subGallery-single-img-a"> <img src="{{cdn('assets/images/gallery/bathroom.jpg')}}" alt=""> </a>
                                            </div>
                                            <div class="child-single-gallery-title-div">
                                                <p class="child-single-gallery-title bold">Gallery 3 <br />BATHROOM STYLE</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="child_gallery_img_info-div">
                                            <div class="subGallery-single-img-div">
                                                <a class="subGallery-single-img-a"> <img src="{{cdn('assets/images/gallery/outdoor.jpg')}}" alt=""> </a>
                                            </div>
                                            <div class="child-single-gallery-title-div">
                                                <p class="child-single-gallery-title bold">Gallery 4 <br />OUTDOOR STYLE</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
