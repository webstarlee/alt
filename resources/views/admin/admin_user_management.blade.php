@extends('admin.admin_master')
@section('title')
User Management
@endsection
@section('pagelevel_plugin')
<link href="{{ cdn('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
  <!-- BEGIN PAGE TITLE-->

  <!-- END PAGE TITLE-->
  <!-- END PAGE HEADER-->
  <div class="m-heading-1 border-green m-bordered">
      <h3>User Management page</h3>
      <p> In this page ...<br />1 . You can edit and delete the users.<br />
  </div>
  <div class="row">
      <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption font-dark">
                      <i class="icon-settings font-dark"></i>
                      <span class="caption-subject bold uppercase"> User management</span>
                  </div>
              </div>
              <div class="portlet-body">
                  <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                      <thead>
                          <tr>
                              <th>
                                  <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                              </th>
                              <th> User Name </th>
                              <th> Email </th>
                              <th> Action </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                            <tr class="odd gradeX" id="userlist_{{$user->id}}">
                                <td>
                                    <input type="checkbox" class="checkboxes" value="1" />
                                </td>
                                <td> {{$user->first_name}} {{$user->last_name}} </td>
                                <td>
                                    <a href="mailto:{{$user->email}}"> {{$user->email}} </a>
                                </td>
                                <td align='center'>
                                    <a type="button" onclick="delete_user({{$user->id}})" class="btn btn-sm btn-default red-flamingo user-managebutton-size">Delete</a>
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
@endsection
@section('pagelevel_script')
<script src="{{ cdn('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endsection
@section('pagelevel_script_script')
<script src="{{ cdn('assets/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>
<script>
  function delete_user(id){
    url = "{{ route('admin.user_delete') }}";
    swal({
      title: "Are you sure?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete user!",
      cancelButtonText: "No, cancel plx!",
      closeOnConfirm: false,
      closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
          axios.post(url, {user_id:id})
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
</script>
@endsection
