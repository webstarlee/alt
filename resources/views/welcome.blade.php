<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welcome</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/animate-css/animate.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="{{cdn('assets/layouts/layout/css/layout.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/css/components-md.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{cdn('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('css/welcome.css')}}" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/png" sizes="32x32" href="{{cdn('assets/images/favicon.png')}}">
    </head>
    <body>
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <section class="welcome-background" id="large-header">
            <div class="welcome-foreground-img"></div>
            <div class="welcome-background-img"></div>
            <img src="{{cdn('assets/images/lamp.png')}}" class="welcome-lamp-img" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="welcome-logo-div">
                            <img class="welcome-logo-img revealOnScroll " data-animation="bounceInDown" src="{{cdn('assets/images/origine_logo.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <a href="{{route('login')}}" class="btn green-jungle bold uppercase welcome-email-login revealOnScroll " data-timeout="200" data-animation="bounceInLeft">Login with Email</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <a href="{{ route('register') }}" class="btn green-jungle bold uppercase welcome-register revealOnScroll " data-timeout="300" data-animation="bounceInLeft">Register Now</a>
                    </div>
                </div>
            </div>
        </section>
    </body>

    <script src="{{cdn('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
    <!---->
    <script src="{{cdn('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('js/jquery.ripples-min.js')}}" type="text/javascript"></script>
    <script>
        window.onload = function () {
            setTimeout(function () {
                $('.page-loader-wrapper').fadeOut();
                $(".revealOnScroll").each(function () {
                    var $this = $(this);
                    if ($this.data('timeout')) {
                        window.setTimeout(function(){
                            $this.addClass('animated ' + $this.data('animation'));
                        }, parseInt($this.data('timeout'),10));
                    } else {
                        $this.addClass('animated ' + $this.data('animation'));
                    }
                });
            }, 50); }

            var lFollowX = 0,
            lFollowY = 0,
            x = 0,
            x1 = 0,
            x2 = 0,
            y = 0,
            y1 = 0,
            y2 = 0,
            friction = 1 / 30;
            friction1 = 1 / 50;
            friction2 = 1 / 30;

            function moveBackground() {
              x += (lFollowX - x) * friction;
              y += (lFollowY - y) * friction;
              x1 += (lFollowX - x) * friction1;
              y1 += (lFollowY - y) * friction1;

              translate = 'translate(' + x + 'px, ' + y + 'px) scale(1.1)';
              translate1 = 'translate(' + x1 + 'px, ' + y1 + 'px) scale(1.1)';
              translate2 = 'translate(' + x2 + 'px, ' + y2 + 'px) scale(1.1)';

              $('.welcome-background-img').css({
                '-webit-transform': translate,
                '-moz-transform': translate,
                'transform': translate
              });

              $('.welcome-foreground-img').css({
                '-webit-transform': translate1,
                '-moz-transform': translate1,
                'transform': translate1
              });

              $('.welcome-lamp-img').css({
                '-webit-transform': translate1,
                '-moz-transform': translate1,
                'transform': translate1
              });

              window.requestAnimationFrame(moveBackground);
            }

            $(window).on('mousemove click', function(e) {

              var lMouseX = Math.max(-100, Math.min(100, $(window).width() / 2 - e.clientX));
              var lMouseY = Math.max(-100, Math.min(100, $(window).height() / 2 - e.clientY));
              lFollowX = (20 * lMouseX) / 100; // 100 : 12 = lMouxeX : lFollow
              lFollowY = (10 * lMouseY) / 100;

            });

            var isMobile = {
                Android: function() {
                    return navigator.userAgent.match(/Android/i);
                },
                BlackBerry: function() {
                    return navigator.userAgent.match(/BlackBerry/i);
                },
                iOS: function() {
                    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
                },
                Opera: function() {
                    return navigator.userAgent.match(/Opera Mini/i);
                },
                Windows: function() {
                    return navigator.userAgent.match(/IEMobile/i);
                },
                any: function() {
                    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
                }
            };

            if( isMobile.any() == null) {
                moveBackground();
            }

            $(document).ready(function() {
            	try {
            		$('body').ripples({
            			resolution: 256,
            			dropRadius: 20, //px
            			perturbance: 0.05,
            		});
            	}
            	catch (e) {
            		$('.error').show().text(e);
            	}
            });
    </script>
</html>
