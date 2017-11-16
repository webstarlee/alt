@extends('admin.admin_master')
@section('title')
Pages
@endsection
@section('pagelevel_plugin')
<link href="{{ cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.cs') }}s" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/bootstrap-summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('pagelevel_style')
<link href="{{ cdn('assets/pages/css/profile-2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
.changepassword-form .form-control.has-error {
  border: 2px solid #ed6b75 !important;
}
.changepassword-form .form-control.valid {
    border: 1px solid #a0a9b4 !important;
}
</style>
@endsection
@section('content')
  <!-- BEGIN PAGE TITLE-->
  <h3 class="page-title"> Pages
  </h3>
  <!-- END PAGE TITLE-->
  <!-- END PAGE HEADER-->
  <div class="profile">
      <div class="tabbable-line tabbable-full-width">
          <div class="tab-content">
              <div class="tab-pane active" id="tab_1_6">
                  <div class="row">
                      <div class="col-md-3">
                          <ul class="ver-inline-menu tabbable margin-bottom-10">
                              <li class="active">
                                  <a data-toggle="tab" href="#tab_1">
                                      <i class="fa fa-briefcase"></i> Terms Of Service </a>
                                  <span class="after"> </span>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_2">
                                      <i class="fa fa-group"></i> Privacy Policy </a>
                              </li>
                              {{-- <li>
                                  <a data-toggle="tab" href="#tab_3">
                                      <i class="fa fa-leaf"></i> About Us </a>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_4">
                                      <i class="fa fa-leaf"></i> How it works </a>
                              </li> --}}
                          </ul>
                      </div>
                      <div class="col-md-9">
                          <div class="tab-content">
                              <div id="tab_1" class="tab-pane active">
                                  <div id="accordion1" class="panel-group">
                                    <form class="form-horizontal form-bordered" id="terms-form" action="{{ route('admin.update_terms') }}" method="POST" enctype="multipart/form-data">
                                      <div class="alert alert-success" style="display:none">Save successfully</div>
                                      {{ csrf_field() }}
                                      <div class="form-body">
                                          <div class="form-group last">
                                              <div class="col-md-12">
                                                  <div name="summernote" id="summernote_1"> </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-actions">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <button type="submit" class="btn green">Save Change</button>
                                              </div>
                                          </div>
                                      </div>
                                    </form>
                                  </div>
                              </div>
                              <div id="tab_2" class="tab-pane">
                                  <div id="accordion2" class="panel-group">
                                    <form class="form-horizontal form-bordered" id="privacy-form" action="{{ route('admin.update_privacy')  }}" method="POST" enctype="multipart/form-data">
                                      <div class="alert alert-success" style="display:none">Save successfully</div>
                                      {{ csrf_field() }}
                                      <div class="form-body">
                                          <div class="form-group last">
                                              <div class="col-md-12">
                                                  <div name="summernote" id="summernote_2"> </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-actions">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <button type="submit" class="btn green">Save Change</button>
                                              </div>
                                          </div>
                                      </div>
                                    </form>
                                  </div>
                              </div>
                              <div id="tab_3" class="tab-pane">
                                  <div id="accordion3" class="panel-group">
                                    <form class="form-horizontal form-bordered" id="about-us-form" action="{{ route('admin.update_aboutus') }}" method="POST" enctype="multipart/form-data" >
                                      <div class="alert alert-success" style="display:none">Save successfully</div>
                                      {{ csrf_field() }}
                                      <div class="form-body">
                                          <div class="form-group last">
                                              <div class="col-md-12">
                                                  <div name="summernote" id="summernote_3"> </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-actions">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <button type="submit" class="btn green">Save Change</button>
                                              </div>
                                          </div>
                                      </div>
                                    </form>
                                  </div>
                              </div>
                              <div id="tab_4" class="tab-pane">
                                  <div id="accordion3" class="panel-group">
                                    <form class="form-horizontal form-bordered" id="how-it-work-form" action="{{ route('admin.update_howitwork') }}" method="POST" enctype="multipart/form-data" >
                                      <div class="alert alert-success" style="display:none">Save successfully</div>
                                      {{ csrf_field() }}
                                      <div class="form-body">
                                          <div class="form-group last">
                                              <div class="col-md-12">
                                                  <div name="summernote" id="summernote_4"> </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-actions">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <button type="submit" class="btn green">Save Change</button>
                                              </div>
                                          </div>
                                      </div>
                                    </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!--end tab-pane-->
          </div>
      </div>
  </div>
@endsection
@section('pagelevel_script')
<script src="{{ cdn('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-markdown/lib/markdown.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/pages/scripts/components-editors.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/pages/scripts/login-5.js') }}" type="text/javascript"></script>
<script>
  var getservicedataUrl = "{{ route('admin.get_page_info') }}";
  $.get(getservicedataUrl, function (data) {
     $('#terms-form').find('div.panel-body').html(data[0]['terms_use']);
     $('#privacy-form').find('div.panel-body').html(data[0]['privacy_policy']);
     $('#about-us-form').find('div.panel-body').html(data[0]['about_us']);
     $('#how-it-work-form').find('div.panel-body').html(data[0]['how_it_work']);
 });
</script>
@endsection
