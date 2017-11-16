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
        <section class="welcome-background">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="welcome-logo-div">
                            <img class="welcome-logo-img" src="{{cdn('assets/images/logo.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <a href="#" class="btn green-jungle bold uppercase welcome-facebook-login">Login with facebook</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <a href="{{route('login')}}" class="btn bold uppercase welcome-email-login">Login with Email</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <a href="{{ route('register') }}" class="btn bold uppercase welcome-register">Register Now</a>
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
    <script>
          window.onload = function () { setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 50); }
    </script>
</html>
