<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Gallery Report</title>
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
        <link href="{{cdn('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/global/plugins/node-waves/waves.css')}}" rel="stylesheet" />
        <link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
        {{-- <link href="{{cdn('assets/global/plugins/jquery.mobile-1.4.5.min.css')}}" rel="stylesheet" type="text/css" /> --}}
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="{{cdn('assets/global/css/components-md.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{cdn('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('assets/layouts/layout/css/layout.css')}}" rel="stylesheet" type="text/css" />
        {{-- <link href="{{cdn('assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" /> --}}
        <link href="{{cdn('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{cdn('css/custom.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="icon" type="image/png" sizes="32x32" href="{{cdn('assets/images/favicon.png')}}">
        <link href="{{cdn('css/frontend.css')}}" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/png" sizes="32x32" href="{{cdn('assets/images/favicon.png')}}">
    </head>
    <body>
        <div class="container">
            <h2 style="padding-bottom: 20px;text-align: center;color: #d40014;" class="bold">Gallery Report</span></h2>
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
                            <h2 style="padding-bottom: 10px;text-align: center;">Your Selection <span class="bold">{{$report_gallerie['style_name']}}</span></h2>
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
                                            <div class="col-xs-3 text-center">
                                                <div style="width: 100%;display: inline-block;position: relative;cursor: pointer;margin-bottom: 20px;">
                                                    <input type="hidden" name="" id="current_img_id" value="{{$image->id}}">
                                                    <img style="margin-bottom: 0;max-width: 160px;margin: 0 auto;width: 100%;border-radius: 100%;" src="{{cdn('assets/images/gallery/'.$image->gallery_img.'_thumbnail.jpg')}}">
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

        <script src="{{cdn('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/hammer.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/jquery.touchSwipe.min.js')}}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/global/plugins/node-waves/waves.js')}}"></script>
        <script src="{{cdn('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/pages/scripts/components-bootstrap-switch.js')}}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{cdn('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{cdn('assets/pages/scripts/components-select2.js')}}" type="text/javascript"></script>
        <script src="{{cdn('js/custom.js')}}" type="text/javascript"></script>
        <script src="{{cdn('js/frontend.js')}}" type="text/javascript"></script>
    </body>
</html>
