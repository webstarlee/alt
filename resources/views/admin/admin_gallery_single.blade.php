@extends('admin.admin_master')
@section('title')
Gallery
@endsection
@section('pagelevel_plugin')
    <link href="{{cdn('assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{cdn('assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{cdn('assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{cdn('assets/global/plugins/light-gallery/css/lightgallery.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" /> --}}
@endsection
@section('content')
    <div class="page-bar">
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <a href="{{route('admin.gallery.view')}}"class="btn green btn-sm"> Back to Lists </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> {{$current_style->style_title}} <label class="font-red-sunglo bold uppercase">( {{$current_style->style_name}} )</label>  </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="toolbar">
                        <button type="button" data-toggle="modal" href="#add_new_images" class="btn green" style="margin-bottom: 20px;">Add New Images</button>
                    </div>
                    <div class="row">
                        <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                            @foreach ($images as $image)
                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 text-center">
                                    <a href="{{cdn('assets/images/gallery/'.$image->gallery_img.'.jpg')}}" data-sub-html="Just Empty">
                                        <img class="img-responsive thumbnail" src="{{cdn('assets/images/gallery/'.$image->gallery_img.'_thumbnail.jpg')}}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="add_new_images" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title text-center">New Images</h2>
                </div>
                <div class="modal-body">
                    <form id="fileupload" action="{{route('admin.gallery.add.images')}}" method="post" enctype="multipart/form-data">
                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                        {{ csrf_field() }}
                        <input type="hidden" name="style_id" value="{{$current_style->id}}">
                        <div class="row fileupload-buttonbar">
                            <div class="col-lg-12 text-center">
                                <!-- The fileinput-button span is used to style the file input field as button -->
                                <span class="btn green fileinput-button">
                                    <i class="fa fa-plus"></i>
                                    <span> Add files... </span>
                                    <input type="file" name="files[]" multiple=""> </span>
                                <button type="submit" class="btn blue start" id="gallery-img-upload-start-button">
                                    <i class="fa fa-upload"></i>
                                    <span> Start upload </span>
                                </button>
                                <button type="reset" class="btn warning cancel">
                                    <i class="fa fa-ban-circle"></i>
                                    <span> Cancel upload </span>
                                </button>
                                <!-- The global file processing state -->
                                <span class="fileupload-process"> </span>
                            </div>
                            <!-- The global progress information -->
                            <div class="col-lg-5 fileupload-progress fade">
                                <!-- The global progress bar -->
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                                </div>
                                <!-- The extended global progress information -->
                                <div class="progress-extended"> &nbsp; </div>
                            </div>
                        </div>
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped clearfix">
                            <tbody class="files"> </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer text-center" id="gallery-img-add-close" style="text-align:center;">
                    <button type="button" data-dismiss="modal" onclick="cancel_button_cind()" class="btn dark cancel">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
            <td style="vertical-align: middle;">
                <span class="preview"></span>
            </td>
            <td style="vertical-align: middle;">
                <p class="size">Processing...</p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
            </td>
            <td style="vertical-align: middle;text-align:right;"> {% if (!i && !o.options.autoUpload) { %}
                <button class="btn blue start" disabled>
                    <i class="fa fa-upload"></i>
                    <span>Start</span>
                </button> {% } %} {% if (!i) { %}
                <button class="btn red cancel">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                </button> {% } %} </td>
        </tr> {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">

        {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
            <td style="vertical-align: middle;">
                <span class="preview"><img style="width:80px;height:50px;" src="{{cdn('{%=file.thumbnailUrl%}')}}"></span>
            </td>
            <td style="vertical-align: middle;">
                <p class="name"><span>{%=file.name%}</span></p>
            </td>
            <td style="vertical-align: middle;text-align:right;">
                <button class="btn yellow cancel btn-sm">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                </button>
            </td>
        </tr> {% } %}

    </script>
@endsection
@section('pagelevel_script')
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js')}}" type="text/javascript"></script>
    <script src="{{cdn('assets/global/plugins/light-gallery/js/lightgallery-all.js')}}" type="text/javascript"></script>
    {{-- <script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
    <script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script> --}}
@endsection
@section('pagelevel_script_script')
    <script src="{{cdn('assets/pages/scripts/form-fileupload.js')}}" type="text/javascript"></script>
@endsection
@section('custom_script')
    <script type="text/javascript">
        $(function () {
            $('#aniimated-thumbnials').lightGallery({
                thumbnail: true,
                selector: 'a'
            });
        });
        function cancel_button_cind() {
            $('.fileupload-buttonbar>div>button.cancel').click();
        }

        $('#gallery-img-upload-start-button').on('click', function(){
            var reload_button = '<button type="button" onclick="reload_page()" class="btn dark">Close</button>';
            $('#gallery-img-add-close').html(reload_button);
        });

        function reload_page() {
            location.reload();
        }
    </script>
@endsection
