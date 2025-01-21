  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Notice Board</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <!-- form start -->
              <form method="post" action="" enctype="multipart/form-data">
                <!--CSRF is Outputs a hidden <input> element with the name _token and the value of this token OR token with every POST, PUT, PATCH, or DELETE request -->
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Title </span></label>
                    <input type="text" name="title" value="{{ old('title', $getRecord->title) }}" class="form-control" placeholder="Enter Title">
                  </div>

                  <div class="form-group">
                    <label>Notice Date </label>
                    <input type="date" name="notice_date" value="{{ old('notice_date', $getRecord->notice_date) }}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Publish Date </label>
                    <input type="date" name="publish_date" value="{{ old('publish_date', $getRecord->publish_date) }}" class="form-control">
                  </div>
                  @php
                    $message_to_teacher = $getRecord->getMessageToStudent($getRecord->id, 2);
                    $message_to_student = $getRecord->getMessageToStudent($getRecord->id, 3);
                    $message_to_parent = $getRecord->getMessageToStudent($getRecord->id, 4);
                  @endphp
                  <div class="form-group">
                    <label style="display: block;">Message To </span></label>
                    <label style="margin-right: 25px;">
                      <input {{ !empty($message_to_teacher) ? 'checked' : '' }} type="checkbox" value="2" name="message_to[]"> Teacher
                    </label>
                    <label style="margin-right: 25px;">
                      <input {{ !empty($message_to_student) ? 'checked' : '' }} type="checkbox" value="3" name="message_to[]"> Student
                    </label>
                    <label>
                      <input {{ !empty($message_to_parent) ? 'checked' : '' }} type="checkbox" value="4" name="message_to[]"> Parent
                    </label>
                  </div>
                  <div class="form-group">
                    <label>Message </label>
                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px">{{ old('message', $getRecord->message) }}</textarea>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  @endsection

  @section('script')
  <script src="{{ url('public/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script type="text/javascript">
  $(function () {
    $('#compose-textarea').summernote({
      height: 200,
      
    });
  });
  </script>
  @endsection