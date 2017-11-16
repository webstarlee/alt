@extends('admin.admin_master')
@section('title')
film Management
@endsection
@section('pagelevel_plugin')
<link href="{{ cdn('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
  <!-- BEGIN PAGE TITLE-->

  <!-- END PAGE TITLE-->
  <!-- END PAGE HEADER-->
  <div class="m-heading-1 border-green m-bordered">
      <h3>Film Management page</h3>
      <p> In this page ...<br />You can <a data-toggle="modal" href="#responsive">add</a> , edit and delete the films.<br />
  </div>
  <div class="row">
      <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption font-dark">
                      <i class="icon-settings font-dark"></i>
                      <span class="caption-subject bold uppercase"> Film management</span>
                  </div>
              </div>
              <div class="portlet-body">
                  <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                      <thead>
                          <tr>
                              <th>
                                  <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                              </th>
                              <th> Film Title </th>
                              <th> Film Type </th>
                              <th> Film Url </th>
                              {{-- <th> Film Type </th> --}}
                              <th> Action </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($films as $film)
                            <tr class="odd gradeX" id="userlist_{{$film->id}}">
                                <td>
                                    <input type="checkbox" class="checkboxes" value="1" />
                                </td>
                                <td style="cursor:pointer;" data-toggle="modal" href="#film_preview" onclick="preview_film('{{$film->film_url}}')"> {{$film->film_name}} </td>
                                <td> {{$film->film_type}} </td>
                                <td> {{$film->film_url}} </td>
                                <td align='center'>
                                    <a type="button" data-toggle="modal" href="#responsive_1" onclick="edit_film({{$film->id}},'{{$film->film_url_dev}}','{{$film->film_name}}','{{$film->film_type}}')" class="btn btn-sm btn-default green user-managebutton-size">Edit</a>
                                    <a type="button" onclick="delete_film({{$film->id}})" class="btn btn-sm btn-default red-flamingo user-managebutton-size">Delete</a>
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
  <div id="responsive" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
      <form action="{{ route('admin.add_film') }}" class="register-form" method="post">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h2 class="modal-title text-center">New Film</h2>
              <br />
              <h4 class="modal-title text-center">Enter detail below to add new film</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      {{ csrf_field() }}
                      <div class="row">
                          <div class="col-sm-12">
                              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Film Title" name="name" required/>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <label class="film-front-url">https://youtu.be/</label>
                              <input class="form-control form-control-solid placeholder-no-fix form-group" style="padding-left:125px;" type="text" autocomplete="off" placeholder="Youtube url" name="url" required/>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Film type" name="ftype" required/>
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
  <div id="responsive_1" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
      <form action="{{ route('admin.edit_film') }}" class="register-form" method="post">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h2 class="modal-title text-center">Edit Film</h2>
              <br />
              <h4 class="modal-title text-center">Enter detail below to edit film</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      {{ csrf_field() }}
                      <input type="hidden" id="for-edit-film-id" name="film_id" />
                      <div class="row">
                          <div class="col-sm-12">
                              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" id="for-edit-film-name" autocomplete="off" placeholder="Film Title" name="name" required/>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <label class="film-front-url">https://youtu.be/</label>
                              <input class="form-control form-control-solid placeholder-no-fix form-group" style="padding-left:125px;" id="for-edit-film-url" type="text" autocomplete="off" placeholder="Youtube url" name="url" required/>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <input class="form-control form-control-solid placeholder-no-fix form-group" id="for-edit-film-type" type="text" autocomplete="off" placeholder="Film type" name="ftype" required/>
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
  <div id="film_preview" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
      <div class="film-embeded-div" style="width: 100%;">
      </div>
      <div class="modal-footer text-center" style="text-align:center;">
          <button type="button" data-dismiss="modal" onclick="break_video()" class="btn dark">Close</button>
      </div>
  </div>
@endsection
@section('pagelevel_script')
<script src="{{ cdn('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
@endsection
@section('pagelevel_script_script')
<script src="{{ cdn('assets/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>
<script>

  function delete_film(id){
    url = "{{ route('admin.film_delete') }}";
    swal({
      title: "Are you sure?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete film!",
      cancelButtonText: "No, cancel plx!",
      closeOnConfirm: false,
      closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
          axios.post(url, {film_id:id})
          .then(function (response) {
              $("#userlist_"+ id).remove();
              swal("Deleted!", "Your imaginary file has been deleted.", "success");
          })
          .catch(function (error) {
            console.log(error);
          });
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
  };

  function edit_film(id,url,name,type){
      $('#for-edit-film-id').val(id);
      $('#for-edit-film-name').val(name);
      $('#for-edit-film-url').val(url);
      $('#for-edit-film-type').val(type);
  }
</script>
@endsection
