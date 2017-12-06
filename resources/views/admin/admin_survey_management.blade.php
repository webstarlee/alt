@extends('admin.admin_master')
@section('title')
Survey Management
@endsection
@section('pagelevel_plugin')
<link href="{{ cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{cdn('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{cdn('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
  <!-- BEGIN PAGE TITLE-->

  <!-- END PAGE TITLE-->
  <!-- END PAGE HEADER-->
  <div class="m-heading-1 border-green m-bordered">
      <h3>Survey Management page</h3>
      <p> In this page ...<br />1 . You can Add, Edit and delete the Questions.<br />
  </div>
  <div class="row">
      <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption font-dark">
                      <i class="icon-settings font-dark"></i>
                      <span class="caption-subject bold uppercase"> Question management</span>
                  </div>
              </div>
              <div class="portlet-body">
                  <div class="table-toolbar">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="btn-group">
                                  <a data-toggle="modal" href="#add-new-question" class="btn green">
                                      <i class="fa fa-plus"></i>Add Question
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <table class="table table-striped table-bordered table-hover table-checkable order-column" id="survery_mange">
                      <thead>
                          <tr>
                              <th style="text-align: left;padding: 8px 10px;"> Question Title </th>
                              <th style="text-align: left;padding: 8px 10px;"> Question Type </th>
                              <th> Action </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($questions as $question)
                            <tr class="odd gradeX" id="questionlist_{{$question->id}}">
                                <td style="text-align: left;padding: 8px 10px;vertical-align: middle;">{{$question->title}}</td>
                                <td style="text-align: left;padding: 8px 10px;vertical-align: middle;">
                                    @if ($question->type == 0)
                                        First Type
                                    @elseif ($question->type == 1)
                                        Second Type
                                    @endif
                                </td>
                                <td align='center'>
                                    <a type="button" onclick="edit_question({{$question->id}})" class="btn btn-sm btn-default green user-managebutton-size">Edit</a>
                                    <a type="button" onclick="delete_question({{$question->id}})" class="btn btn-sm btn-default red-flamingo user-managebutton-size">Delete</a>
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
  <div class="row">
      <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption font-dark">
                      <i class="icon-settings font-dark"></i>
                      <span class="caption-subject bold uppercase"> Survey Option A</span>
                  </div>
              </div>
              <div class="portlet-body">
                  <div class="table-toolbar">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="btn-group">
                                  <a data-toggle="modal" href="#add-new-option1" class="btn green">
                                      <i class="fa fa-plus"></i>Add Option
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <table class="table table-striped table-bordered table-hover table-checkable order-column" id="survery_option1_manage">
                      <thead>
                          <tr>
                              <th style="display:none;">
                                  <input type="checkbox" class="group-checkable" data-set="#gallery_category .checkboxes" />
                              </th>
                              <th style="text-align: left;padding: 8px 10px;"> Image </th>
                              <th style="text-align: left;padding: 8px 10px;"> Title </th>
                              <th style="text-align: left;padding: 8px 10px;"> Size </th>
                              <th style="text-align: left;padding: 8px 10px;"> Question Title </th>
                              <th> Action </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($optionA as $option)
                            <tr class="odd gradeX" id="answerlist_{{$option->id}}">
                                <td style="vertical-align:middle;display:none;"><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td style="text-align: center;vertical-align: middle;">
                                    <img style="width:100%;max-width:150px;min-width:150px;" src="{{cdn('assets/images/survey').'/'.$option->img_name.'_thumbnail.jpg'}}" />
                                </td>
                                <td style="text-align: center;padding: 8px 10px;vertical-align: middle;">{{$option->title}}</td>
                                <td style="text-align: center;padding: 8px 10px;vertical-align: middle;">{{$option->size}}</td>
                                <td style="text-align: center;padding: 8px 10px;vertical-align: middle;">{{$option->question_name}}</td>
                                <td align='center' style="vertical-align:middle;">
                                    <a type="button" onclick="edit_answer({{$option->id}})" class="btn btn-sm btn-default green user-managebutton-size">Edit</a>
                                    <a type="button" onclick="delete_answer({{$option->id}})" class="btn btn-sm btn-default red-flamingo user-managebutton-size">Delete</a>
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
  <div class="row">
      <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption font-dark">
                      <i class="icon-settings font-dark"></i>
                      <span class="caption-subject bold uppercase"> Survey Option B</span>
                  </div>
              </div>
              <div class="portlet-body">
                  <div class="row">
                      <div class="col-lg-6">
                          <div class="table-toolbar">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="btn-group">
                                          <a data-toggle="modal" href="#add-new-option2-other" class="btn green">
                                              <i class="fa fa-plus"></i>Add Other Option
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <table class="table table-striped table-bordered table-hover table-checkable order-column" id="survery_option2_other_manage">
                              <thead>
                                  <tr>
                                      <th style="display:none;">
                                          <input type="checkbox" class="group-checkable" data-set="#gallery_category .checkboxes" />
                                      </th>
                                      <th style="text-align: left;padding: 8px 10px;"> Image </th>
                                      <th style="text-align: left;padding: 8px 10px;"> Title </th>
                                      <th style="text-align: left;padding: 8px 10px;"> Question Title </th>
                                      <th> Action </th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($optionB as $option)
                                    <tr class="odd gradeX" id="optionother_list_{{$option->id}}">
                                        <td style="vertical-align:middle;display: none;"><input type="checkbox" class="checkboxes" value="1" /></td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <img style="width:100%;max-width:150px;min-width:150px;" src="{{cdn('assets/images/survey').'/'.$option->img_name.'_thumbnail.jpg'}}" />
                                        </td>
                                        <td style="text-align: center;padding: 8px 10px;vertical-align: middle;">{{$option->title}}</td>
                                        <td style="text-align: center;padding: 8px 10px;vertical-align: middle;">{{$option->question_name}}</td>
                                        <td align='center' style="vertical-align:middle;">
                                            <a type="button" onclick="edit_option_other({{$option->id}})" class="btn btn-sm btn-default green user-managebutton-size">Edit</a>
                                            <a type="button" onclick="delete_option_other({{$option->id}})" class="btn btn-sm btn-default red-flamingo user-managebutton-size">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                      <div class="col-lg-6">
                          <div class="table-toolbar survey-other-option-toolbar">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="btn-group">
                                          <a data-toggle="modal" href="#add-new-option2-size" class="btn green">
                                              <i class="fa fa-plus"></i>Add Size Option
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <table class="table table-striped table-bordered table-hover table-checkable order-column" id="survery_option2_size_manage">
                              <thead>
                                  <tr>
                                      <th style="display:none;">
                                          <input type="checkbox" class="group-checkable" data-set="#gallery_category .checkboxes" />
                                      </th>
                                      <th style="text-align: left;padding: 8px 10px;"> Title </th>
                                      <th style="text-align: left;padding: 8px 10px;"> Size </th>
                                      <th style="text-align: left;padding: 8px 10px;"> Question Title </th>
                                      <th> Action </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($optionB_size as $option_size)
                                      <tr class="odd gradeX" id="optionsize_list_{{$option_size->id}}">
                                          <td style="vertical-align:middle;display: none;"><input type="checkbox" class="checkboxes" value="1" /></td>
                                          <td style="text-align: center;padding: 8px 10px;vertical-align: middle;">{{$option_size->title}}</td>
                                          <td style="text-align: center;padding: 8px 10px;vertical-align: middle;">{{$option_size->size}}</td>
                                          <td style="text-align: center;padding: 8px 10px;vertical-align: middle;">{{$option_size->question_name}}</td>
                                          <td align='center' style="vertical-align:middle;">
                                              <a type="button" onclick="edit_option_size({{$option_size->id}})" class="btn btn-sm btn-default green user-managebutton-size">Edit</a>
                                              <a type="button" onclick="delete_option_size({{$option_size->id}})" class="btn btn-sm btn-default red-flamingo user-managebutton-size">Delete</a>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
      </div>
  </div>
  <div id="add-new-question" class="modal fade" tabindex="-1" data-backdrop="static">
      <div class="modal-dialog">
          <div class="modal-content">
              {{ Form::open(['route' => 'question.add', 'class' => 'schedule-delete-user-form', 'id' => 'schedule-delete-user-form', 'method' => 'post']) }}
                  <div class="modal-header">
                      <h3 class="bold text-center">Add New Question</h3>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="">Question Title</label>
                          <input class="form-control" type="text" name="question_title" required/>
                      </div>
                      <div class="form-group">
                          <label for="">Question Type</label>
                          <select name="question_type" id="question_type" class="select2-survey form-control" data-placeholder="Select Question Type" required>
                              <option value=""></option>
                              <option value="0">First Question Type</option>
                              <option value="1">Second Question Type</option>
                          </select>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-dafault" data-dismiss="modal">Close</button>
                      {!! Form::submit('Add', ['class' => 'btn btn-success', 'id' => 'delete-user-confirm-btn']) !!}
                  </div>
              {{ Form::close() }}
          </div>
      </div>
  </div>
  <div id="edit-question" class="modal fade" tabindex="-1" data-backdrop="static">
      <div class="modal-dialog">
          <div class="modal-content">
              {{ Form::open(['route' => 'question.edit', 'class' => 'schedule-delete-user-form', 'id' => 'schedule-delete-user-form', 'method' => 'post']) }}
                  <input type="hidden" id="_question_id" name="_question_id" value="" />
                  <div class="modal-header">
                      <h3 class="bold text-center">Edit Question</h3>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="">Question Title</label>
                          <input class="form-control" type="text" id="_question_title" name="_question_title" required/>
                      </div>
                      <div class="form-group">
                          <label for="">Question Type</label>
                          <select name="_question_type" id="_question_type" class="form-control" data-placeholder="Select Question Type" required>
                              <option value=""></option>
                              <option value="0">First Question Type</option>
                              <option value="1">Second Question Type</option>
                          </select>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-dafault" data-dismiss="modal">Close</button>
                      {!! Form::submit('Update', ['class' => 'btn btn-success', 'id' => 'delete-user-confirm-btn']) !!}
                  </div>
              {{ Form::close() }}
          </div>
      </div>
  </div>
  <div id="add-new-option1" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
      <div class="modal-dialog">
          <div class="modal-content">
              <form action="{{route('admin.answer.add')}}" class="register-form" method="post" enctype="multipart/form-data">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                      <h2 class="modal-title text-center">Add New Option A</h2>
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
                                                  <img id="style_edit_img" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                              <div>
                                                  <span class="btn default btn-file">
                                                      <span class="fileinput-new"> Select image </span>
                                                      <span class="fileinput-exists"> Change </span>
                                                      <input type="file" name="answer_img" required> </span>
                                                  <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                           <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Answer Title" id="answer_title" name="answer_title" required/>
                                       </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Answer Size" id="answer_size" name="answer_size" required/>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          {{ Form::label('select', 'Select Question') }}
                                          <select name="question_id" id="question_id" class="select2-survey form-control" data-placeholder="Select Question" required>
                                              <option value=""></option>
                                              @foreach ($questions as $question)
                                                  @if ($question->type == 0)
                                                      <option value="{{$question->id}}">{{$question->title}}</option>
                                                  @endif
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
      </div>
  </div>
  <div id="edit-option1" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
      <div class="modal-dialog">
          <div class="modal-content">
              <form action="{{route('admin.answer.edit')}}" class="register-form" method="post" enctype="multipart/form-data">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                      <h2 class="modal-title text-center">Add New Answer</h2>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-12">
                              {{ csrf_field() }}
                              <input type="hidden" id="_answer_id" name="_answer_id" value="" />
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <div class="fileinput fileinput-new" data-provides="fileinput" style="display:block; text-align:center;">
                                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                  <img id="answer-edit-img" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                              <div>
                                                  <span class="btn default btn-file">
                                                      <span class="fileinput-new"> Select image </span>
                                                      <span class="fileinput-exists"> Change </span>
                                                      <input type="file" name="_answer_img"> </span>
                                                  <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                           <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Answer Title" id="_answer_title" name="_answer_title" required/>
                                       </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Answer Size" id="_answer_size" name="_answer_size" required/>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label for=""> Select Question</label>
                                          <select name="_answer_question_id" id="_answer_question_id" class="form-control" data-placeholder="Select Question" required>
                                              <option value=""></option>
                                              @foreach ($questions as $question)
                                                  <option value="{{$question->id}}">{{$question->title}}</option>
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
      </div>
  </div>
  <div id="add-new-option2-other" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
      <div class="modal-dialog">
          <div class="modal-content">
              <form action="{{route('admin.optionb.other.add')}}" class="register-form" method="post" enctype="multipart/form-data">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                      <h2 class="modal-title text-center">Add New Option B</h2>
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
                                                  <img id="style_edit_img" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                              <div>
                                                  <span class="btn default btn-file">
                                                      <span class="fileinput-new"> Select image </span>
                                                      <span class="fileinput-exists"> Change </span>
                                                      <input type="file" name="optionb_img" required> </span>
                                                  <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                           <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Answer Title" id="other_option_title" name="answer_title" required/>
                                       </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label for=""> Select Question</label>
                                          <select name="question_id" id="question_id" class="select2-survey form-control" data-placeholder="Select Question" required>
                                              <option value=""></option>
                                              @foreach ($questions as $question)
                                                  @if ($question->type == 1)
                                                      <option value="{{$question->id}}">{{$question->title}}</option>
                                                  @endif
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
      </div>
  </div>
  <div id="edit-option2-other" class="modal fade" data-backdrop="static" tabindex="-1" data-width="560">
      <div class="modal-dialog">
          <div class="modal-content">
              <form action="{{route('admin.optionb.other.edit')}}" class="register-form" method="post" enctype="multipart/form-data">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                      <h2 class="modal-title text-center">Add New Option B</h2>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-12">
                              {{ csrf_field() }}
                              <input type="hidden" name="_optionb_other_id" id="_optionb_other_id" value="">
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <div class="fileinput fileinput-new" data-provides="fileinput" style="display:block; text-align:center;">
                                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                  <img id="_optionb-other-edit-img" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                              <div>
                                                  <span class="btn default btn-file">
                                                      <span class="fileinput-new"> Select image </span>
                                                      <span class="fileinput-exists"> Change </span>
                                                      <input type="file" name="_optionb_img"> </span>
                                                  <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                           <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Answer Title" id="_other_option_title" name="_answer_title" required/>
                                       </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label for=""> Select Question</label>
                                          <select name="_optionb_other_question_id" id="_optionb_other_question_id" class="form-control" data-placeholder="Select Question" required>
                                              <option value=""></option>
                                              @foreach ($questions as $question)
                                                  @if ($question->type == 1)
                                                      <option value="{{$question->id}}">{{$question->title}}</option>
                                                  @endif
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
      </div>
  </div>
  <div id="add-new-option2-size" class="modal fade" tabindex="-1" data-backdrop="static">
      <div class="modal-dialog">
          <div class="modal-content">
              {{ Form::open(['route' => 'admin.optionb.size.add', 'class' => 'schedule-delete-user-form', 'id' => 'schedule-delete-user-form', 'method' => 'post']) }}
                  <div class="modal-header">
                      <h3 class="bold text-center">Add New Option B Size</h3>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                   <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Title" id="size_option_title" name="size_option_title" required/>
                               </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                   <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Size" id="size_option_size" name="size_option_size" required/>
                               </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for=""> Select Question</label>
                                  <select name="optionb_size_question_id" id="optionb_size_question_id" class="select2-survey form-control" data-placeholder="Select Question" required>
                                      <option value=""></option>
                                      @foreach ($questions as $question)
                                          @if ($question->type == 1)
                                              <option value="{{$question->id}}">{{$question->title}}</option>
                                          @endif
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-dafault" data-dismiss="modal">Close</button>
                      {!! Form::submit('Add', ['class' => 'btn btn-success', 'id' => 'delete-user-confirm-btn']) !!}
                  </div>
              {{ Form::close() }}
          </div>
      </div>
  </div>
  <div id="edit-option2-size" class="modal fade" tabindex="-1" data-backdrop="static">
      <div class="modal-dialog">
          <div class="modal-content">
              {{ Form::open(['route' => 'admin.optionb.size.edit', 'class' => 'schedule-delete-user-form', 'id' => 'schedule-delete-user-form', 'method' => 'post']) }}
                  <div class="modal-header">
                      <h3 class="bold text-center">Add New Option B Size</h3>
                  </div>
                  <div class="modal-body">
                      <input type="hidden" name="current_optionsize_id" id="current_optionsize_id" value="">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                   <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Title" id="_size_option_title" name="_size_option_title" required/>
                               </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                   <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Size" id="_size_option_size" name="_size_option_size" required/>
                               </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for=""> Select Question</label>
                                  <select name="_optionb_size_question_id" id="_optionb_size_question_id" class="form-control" data-placeholder="Select Question" required>
                                      @foreach ($questions as $question)
                                          @if ($question->type == 1)
                                              <option value="{{$question->id}}">{{$question->title}}</option>
                                          @endif
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-dafault" data-dismiss="modal">Cancel</button>
                      {!! Form::submit('Proceed', ['class' => 'btn btn-success', 'id' => 'delete-user-confirm-btn']) !!}
                  </div>
              {{ Form::close() }}
          </div>
      </div>
  </div>
@endsection
@section('pagelevel_script')
<script src="{{ cdn('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
@section('custom_script')
<script src="{{ cdn('assets/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>
<script src="{{cdn('assets/pages/scripts/components-select2.js')}}" type="text/javascript"></script>
<script>
    var BASEURL = "{{url('admin')}}";

    function delete_question(id){
        var delete_url = BASEURL+"/question-delete/"+id;
        swal({
          title: "Are you sure?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete Question!",
          cancelButtonText: "No, cancel plx!",
          closeOnConfirm: false,
          closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: delete_url,
                    type: 'get',
                    success: function(result){
                        swal("Deleted!", "Question has been deleted.", "success");
                        $("#questionlist_"+ id).remove();
                    },
                    error: function(result){
                        console.log(error);
                    }
                });
            } else {
                swal("Cancelled", "Question is safe :)", "error");
            }
        });
    };

    function edit_question(id) {
      var get_data_url = BASEURL+"/question-edit/"+id;

      $.ajax({
          url: get_data_url,
          type: 'get',
          success: function(result){
              console.log(result);
              $('#_question_title').val(result.title);
              $('#_question_id').val(result.id);
              $('#_question_type').val(result.type);
              $('#edit-question').modal('show');
          },
          error: function(result){
              console.log(error);
          }
      });
    }

    function edit_answer(id) {
      var get_data_url = BASEURL+"/answer-edit/"+id;

      var base_img_url = "{{cdn('assets/images/survey/')}}";

      $.ajax({
          url: get_data_url,
          type: 'get',
          success: function(result){
              console.log(result);
              $('#answer-edit-img').attr('src', base_img_url+'/'+result.img_name+'_thumbnail.jpg')
              $('#_answer_title').val(result.title);
              $('#_answer_size').val(result.size);
              $('#_answer_question_id').val(result.question_id);
              $('#_answer_id').val(result.id);
              $('#edit-option1').modal('show');
          },
          error: function(result){
              console.log(error);
          }
      });
    }

    function delete_answer (id){
        var delete_url = BASEURL+"/answer-delete/"+id;
        swal({
          title: "Are you sure?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete Answer!",
          cancelButtonText: "No, cancel plx!",
          closeOnConfirm: false,
          closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: delete_url,
                    type: 'get',
                    success: function(result){
                        swal("Deleted!", "Answer has been deleted.", "success");
                        $("#answerlist_"+ id).remove();
                    },
                    error: function(result){
                        console.log(error);
                    }
                });
            } else {
                swal("Cancelled", "Answer is safe :)", "error");
            }
        });
    };

    function edit_option_other(id) {
      var get_data_url = BASEURL+"/optionb-other-edit/"+id;

      var base_img_url = "{{cdn('assets/images/survey/')}}";

      $.ajax({
          url: get_data_url,
          type: 'get',
          success: function(result){
              console.log(result);
              $('#edit-option2-other #_optionb-other-edit-img').attr('src', base_img_url+'/'+result.img_name+'_thumbnail.jpg')
              $('#edit-option2-other #_other_option_title').val(result.title);
              $('#edit-option2-other #_optionb_other_question_id').val(result.question_id);
              $('#edit-option2-other #_optionb_other_id').val(result.id);
              $('#edit-option2-other').modal('show');
          },
          error: function(result){
              console.log(error);
          }
      });
    }

    function delete_option_other (id){
        var delete_url = BASEURL+"/optionb-other-delete/"+id;
        swal({
          title: "Are you sure?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete Answer!",
          cancelButtonText: "No, cancel plx!",
          closeOnConfirm: false,
          closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: delete_url,
                    type: 'get',
                    success: function(result){
                        swal("Deleted!", "Option B has been deleted.", "success");
                        $("#optionother_list_"+ id).remove();
                    },
                    error: function(result){
                        console.log(error);
                    }
                });
            } else {
                swal("Cancelled", "Option B is safe :)", "error");
            }
        });
    };

    function edit_option_size(id) {
      var get_data_url = BASEURL+"/optionb-size-edit/"+id;

      $.ajax({
          url: get_data_url,
          type: 'get',
          success: function(result){
              console.log(result);
              $('#edit-option2-size #_size_option_title').val(result.title);
              $('#edit-option2-size #_size_option_size').val(result.size);
              $('#edit-option2-size #_optionb_size_question_id').val(result.question_id);
              $('#edit-option2-size #current_optionsize_id').val(result.id);
              $('#edit-option2-size ').modal('show');
          },
          error: function(result){
              console.log(error);
          }
      });
    }

    function delete_option_size (id){
        var delete_url = BASEURL+"/optionb-size-delete/"+id;
        swal({
          title: "Are you sure?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete OptionB Size!",
          cancelButtonText: "No, cancel plx!",
          closeOnConfirm: false,
          closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: delete_url,
                    type: 'get',
                    success: function(result){
                        swal("Deleted!", "OptionB Size has been deleted.", "success");
                        $("#optionsize_list_"+ id).remove();
                    },
                    error: function(result){
                        console.log(error);
                    }
                });
            } else {
                swal("Cancelled", "OptionB Size is safe :)", "error");
            }
        });
    };
</script>
@endsection
