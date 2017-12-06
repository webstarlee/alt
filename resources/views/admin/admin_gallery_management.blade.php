@extends('admin.admin_master')
@section('title')
Gallery Management
@endsection
@section('pagelevel_plugin')
    <link href="{{ cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span>{{ session('status') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span>{{ session('error') }}</span>
        </div>
    @endif
  <div class="m-heading-1 border-green m-bordered">
      <h3>Gallery Management page</h3>
      <p> In this page ...<br />You can add and edit the Gallery, Category and Gallery Styles.<br />
  </div>
  <div class="row">
      <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption font-dark">
                      <i class="icon-settings font-dark"></i>
                      <span class="caption-subject bold uppercase"> Category management</span>
                  </div>
              </div>
              <div class="portlet-body">
                  <div class="toolbar"><button type="button" data-toggle="modal" href="#add_new_category" class="btn green" id="any_button">Add Category</button></div>
                  <table class="table table-striped table-bordered table-hover table-checkable order-column" id="gallery_category">
                      <thead>
                          <tr>
                              <th>
                                  <input type="checkbox" class="group-checkable" data-set="#gallery_category .checkboxes" />
                              </th>
                              <th> Category Image </th>
                              <th> Category Title </th>
                              <th> Action </th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($categories as $category)
                              <tr>
                                  <td style="vertical-align:middle;"><input type="checkbox" class="checkboxes" value="1" /></td>
                                  <td style="cursor:pointer;text-align:center;vertical-align:middle;">
                                        <img style="width:100%;max-width:150px;min-width:150px;" src="{{cdn('assets/images/gallery/category').'/'.$category->category_img.'_thumbnail.jpg'}}" />
                                  </td>
                                  <td style="vertical-align:middle;">{{$category->category_name}}</td>
                                  <td align='center' style="vertical-align:middle;">
                                      <a onclick="edit_category({{$category->id}})" class="btn btn-sm btn-default green" style="width:75px;margin-bottom:5px;">Edit</a>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
      </div>
      <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption font-dark">
                      <i class="icon-settings font-dark"></i>
                      <span class="caption-subject bold uppercase"> Gallery Style management</span>
                  </div>
              </div>
              <div class="portlet-body">
                  <div class="toolbar">
                      <button type="button" data-toggle="modal" href="#add_new_style" class="btn green">Add Style</button>
                  </div>
                  <table class="table table-striped table-bordered table-hover table-checkable order-column" id="gallery_style">
                      <thead>
                          <tr>
                              <th>
                                  <input type="checkbox" class="group-checkable" data-set="#gallery_style .checkboxes" />
                              </th>
                              <th> Style Image </th>
                              <th> Style Title </th>
                              <th> Style Name </th>
                              <th> Style Category </th>
                              <th> Action </th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($gallery_styles as $gallery_style)
                              <tr>
                                  <td style="vertical-align:middle;"><input type="checkbox" class="checkboxes" value="1" /></td>
                                  <td style="cursor:pointer;text-align:center;vertical-align:middle;">
                                        <a href="{{url('admin/gallery-single-view/'.$gallery_style->id)}}"><img style="width:100%;max-width:150px;min-width:150px;" src="{{cdn('assets/images/gallery/style').'/'.$gallery_style->style_img.'_thumbnail.jpg'}}" /></a>
                                  </td>
                                  <td style="vertical-align:middle;">{{$gallery_style->style_title}}</td>
                                  <td style="vertical-align:middle;">{{$gallery_style->style_name}}</td>
                                  <td style="vertical-align:middle;">{{$gallery_style->category_name}}</td>
                                  <td align='center' style="vertical-align:middle;">
                                      <a onclick="edit_category({{$gallery_style->id}})" class="btn btn-sm btn-default green" style="width:75px;margin-bottom:5px;">Edit</a>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
      </div>
  </div>
  <div id="add_new_category" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
      <form action="{{route('admin.gallery.add.category')}}" class="register-form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h2 class="modal-title text-center">New Category</h2>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      {{ csrf_field() }}
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <div class="fileinput fileinput-new" data-provides="fileinput" style="display:block; text-align:center;">
                                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                      <div>
                                          <span class="btn default btn-file">
                                              <span class="fileinput-new"> Select image </span>
                                              <span class="fileinput-exists"> Change </span>
                                              <input type="file" name="category_img" required> </span>
                                          <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Category name" name="category_name" required/>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer text-center" style="text-align:center;">
              <button type="button" data-dismiss="modal" class="btn dark">Cancel</button>
              <button type="submit" class="btn green">Proceed</button>
          </div>
      </form>
  </div>

  <div id="edit_single_category" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
      <form action="{{route('admin.gallery.edit.category')}}" class="register-form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h2 class="modal-title text-center">Edit Category</h2>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      {{ csrf_field() }}
                      <input type="hidden" name="category_id" id="category_id" value="">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <div class="fileinput fileinput-new" data-provides="fileinput" style="display:block; text-align:center;">
                                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                          <img id="category_edit_img" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                      <div>
                                          <span class="btn default btn-file">
                                              <span class="fileinput-new"> Select image </span>
                                              <span class="fileinput-exists"> Change </span>
                                              <input type="file" name="_category_img"> </span>
                                          <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Category name" id="_category_name" name="_category_name" required/>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer text-center" style="text-align:center;">
              <button type="button" data-dismiss="modal" class="btn dark">Cancel</button>
              <button type="submit" class="btn green">Proceed</button>
          </div>
      </form>
  </div>

  <div id="add_new_style" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
      <form action="{{route('admin.gallery.add.style')}}" class="register-form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h2 class="modal-title text-center">New Style</h2>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      {{ csrf_field() }}
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <div class="fileinput fileinput-new" data-provides="fileinput" style="display:block; text-align:center;">
                                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                      <div>
                                          <span class="btn default btn-file">
                                              <span class="fileinput-new"> Select image </span>
                                              <span class="fileinput-exists"> Change </span>
                                              <input type="file" name="style_img" required> </span>
                                          <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                   <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Style name" name="style_name" required/>
                               </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Style Title" name="style_title" required/>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for=""> Select Category</label>
                                  <select name="style_category" class="select2 form-control" placeholder="Select Category" required>
                                      <option value=""></option>
                                      @foreach ($categories as $category)
                                          <option value="{{$category->id}}">{{$category->category_name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer text-center" style="text-align:center;">
              <button type="button" data-dismiss="modal" class="btn dark">Cancel</button>
              <button type="submit" class="btn green">Proceed</button>
          </div>
      </form>
  </div>

  <div id="edit_single_style" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
      <form action="{{route('admin.gallery.edit.style')}}" class="register-form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h2 class="modal-title text-center">Edit Style</h2>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      {{ csrf_field() }}
                      <input type="hidden" name="style_id" id="style_id" value="">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <div class="fileinput fileinput-new" data-provides="fileinput" style="display:block; text-align:center;">
                                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                          <img id="style_edit_img" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                      <div>
                                          <span class="btn default btn-file">
                                              <span class="fileinput-new"> Select image </span>
                                              <span class="fileinput-exists"> Change </span>
                                              <input type="file" name="_style_img"> </span>
                                          <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                   <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Style name" id="_style_name" name="_style_name" required/>
                               </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Style Title" id="_style_title" name="_style_title" required/>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for=""> Select Category</label>
                                  <select name="_style_category" id="_style_category" class="select2 form-control" placeholder="Select Category" required>
                                      <option value=""></option>
                                      @foreach ($categories as $category)
                                          <option value="{{$category->id}}">{{$category->category_name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer text-center" style="text-align:center;">
              <button type="button" data-dismiss="modal" class="btn dark">Cancel</button>
              <button type="submit" class="btn green">Proceed</button>
          </div>
      </form>
  </div>
@endsection
@section('pagelevel_script')
<script src="{{ cdn('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
@endsection
@section('pagelevel_script_script')
<script src="{{ cdn('assets/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>
@endsection
@section('custom_script')
<script>

    var BASEURL = "{{ url('/admin') }}";

    function edit_category(id) {
        var get_data_url = BASEURL+"/get-single-category-data/"+id;

        var base_img_url = "{{cdn('assets/images/gallery/category/')}}";

        $.ajax({
            url: get_data_url,
            type: 'get',
            success: function(result){
                console.log(result);
                $('#category_edit_img').attr('src', base_img_url+'/'+result.category_img+'_thumbnail.jpg')
                $('#_category_name').val(result.category_name);
                $('#category_id').val(result.id);
                $('#edit_single_category').modal('show');
            },
            error: function(result){
                console.log(error);
            }
        });
    }

    function edit_category(id) {
        var get_data_url = BASEURL+"/get-single-style-data/"+id;

        var base_img_url = "{{cdn('assets/images/gallery/style/')}}";

        $.ajax({
            url: get_data_url,
            type: 'get',
            success: function(result){
                console.log(result);
                $('#style_edit_img').attr('src', base_img_url+'/'+result.style_img+'_thumbnail.jpg')
                $('#_style_name').val(result.style_name);
                $('#_style_title').val(result.style_title);
                $('#_style_category').val(result.category_id);
                $('#style_id').val(result.id);
                $('#edit_single_style').modal('show');
            },
            error: function(result){
                console.log(error);
            }
        });
    }
</script>
@endsection
