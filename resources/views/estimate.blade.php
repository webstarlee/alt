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
                            <a href="#" id="selection_reset_btn" class="btn green btn-sm"> RESET YOUR SELECTION </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="survey-img-container">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="single-survey-img-contain">
                                    <div class="survey-select-number">
                                        <h2 class="bold text-center survey-number-text">0</h2>
                                        <h3 class="bold text-center survey-size-text">Medium</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                        <div class="single-survey-img-contain">
                                            <img class="img-responsive single-survey-img" src="{{cdn('assets/images/gallery/1511937901_8759_thumbnail.jpg')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                        <div class="single-survey-img-contain">
                                            <img class="img-responsive single-survey-img" src="{{cdn('assets/images/gallery/1511937901_8759_thumbnail.jpg')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                        <div class="single-survey-img-contain">
                                            <img class="img-responsive single-survey-img active" src="{{cdn('assets/images/gallery/1511937901_8759_thumbnail.jpg')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                        <div class="single-survey-img-contain">
                                            <img class="img-responsive single-survey-img" src="{{cdn('assets/images/gallery/1511937901_8759_thumbnail.jpg')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                        <div class="single-survey-img-contain">
                                            <img class="img-responsive single-survey-img" src="{{cdn('assets/images/gallery/1511937901_8759_thumbnail.jpg')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                        <div class="single-survey-img-contain">
                                            <img class="img-responsive single-survey-img" src="{{cdn('assets/images/gallery/1511937901_8759_thumbnail.jpg')}}">
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
@section('pagelevel_script')
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
@endsection
@section('custom_script')
    <script type="text/javascript">
    </script>
@endsection
