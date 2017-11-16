@extends('master')
@section('title')
Welcome
@endsection
@section('content')
    <div class="contents-container-div">
        <div class="contents-intro-image-embeded-div">
            <a href="http://ifundfilms.com/iFundFilms-Intro.mp3" class="goto-intro-audio"><img class="menu-title-social-image" src="{{cdn('assets/images/components/recorded_message.png')}}" /></a>
        </div>
        <h3 class="text-center contents-amount-labels-custom">
            <font color="#663300">amount raised: </font> <font size="6" color="#008000">$288,387.00</font><font color="#008000"> </font>
        </h3>
    </div>
@endsection
