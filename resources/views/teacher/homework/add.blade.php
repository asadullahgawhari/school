  @extends('layouts.app')

  @section('style')
    <style type="text/css">

    </style>
  @endsection
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Homework</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('_message')
            <div class="card card-primary">
              <!-- form start -->
              <form method="post" action="" enctype="multipart/form-data">
                <!--CSRF is Outputs a hidden <input> element with the name _token and the value of this token OR token with every POST, PUT, PATCH, or DELETE request -->
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Class <span style="color:red;">*</span></label>
                    <select class="form-control" id="getClass" name="class_id" required>
                      <option value="">Select Class</option>
                      @foreach($getClass as $class)
                        <option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Subject <span style="color:red;">*</span></label>
                    <select class="form-control" id="getSubject" name="subject_id" required>
                      <option value="">Select Subject</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Homework Date <span style="color:red;">*</span></label>
                    <input type="date" class="form-control" name="homework_date" required>
                  </div>
                  <div class="form-group">
                    <label>Submission Date <span style="color:red;">*</span></label>
                    <input type="date" class="form-control" name="submission_date" required>
                  </div>
                  <div class="form-group">
                    <label>Document </label>
                    <input type="file" class="form-control" name="document_file">
                  </div>
                  <div class="form-group">
                    <label>Description </label>
                    <textarea id="compose-textarea" name="description" required class="form-control" style="height: 300px"></textarea>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
      height: 225,
    });

    $('#getClass').change(function() {
      var class_id = $(this).val();
      
      $.ajax({
        type: "POST",
        url: "{{ url('teacher/ajax_get_subject') }}",
        data: {
          "_token": "{{ csrf_token() }}",
          class_id : class_id,
        },
        dataType: "json",
        success: function(data) {
          $('#getSubject').html(data.success);
          // alert(data.message);
        },
      });

    });

  });
  </script>
  @endsection