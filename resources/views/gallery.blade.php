@extends('master')
@section('title')
Welcome
@endsection
@section('content')
    <div class="homepage-background-div">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="goto-other-page-left">
                        <a href="{{route('home')}}"><h4 class="bold font-white gallery-background-text">Save Selection</h4>
                        <h3 class="bold font-white gallery-background-text">Back Home</h3>
                        <div class="goto-other-page-arrow-left-div">
                            <img src="{{cdn('assets/images/arrow-left.png')}}" alt="">
                        </div></a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h3 class="font-white gallery-background-text text-right">Summary</h3>
                    <h3 class="bold font-white gallery-background-text-bottom text-right">Your Selection</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery-img-container-div">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center"><span class="bold">Your Selection</span> General style</h2>
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#"><img src="{{cdn('assets/images/gallery/bathroom.jpg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#"><img src="{{cdn('assets/images/gallery/bedroom.jpg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#"><img src="{{cdn('assets/images/gallery/gallery_parent1.jpg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#"><img src="{{cdn('assets/images/gallery/gallery_parent2.jpg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#"><img src="{{cdn('assets/images/gallery/general.jpg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#">
                                    <img src="{{cdn('assets/images/gallery/outdoor.jpg')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#"><img src="{{cdn('assets/images/gallery/bathroom.jpg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#"><img src="{{cdn('assets/images/gallery/bedroom.jpg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#"><img src="{{cdn('assets/images/gallery/gallery_parent1.jpg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#"><img src="{{cdn('assets/images/gallery/gallery_parent2.jpg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#"><img src="{{cdn('assets/images/gallery/general.jpg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="gallery-single-img-container-div">
                                <a href="#"><img src="{{cdn('assets/images/gallery/outdoor.jpg')}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
