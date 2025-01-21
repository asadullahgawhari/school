  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Notice Board</h1>
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
                    <label>Title <span style="color:red;">*</span></label>
                    <input type="text" name="title" required value="{{ old('title') }}" class="form-control" placeholder="Enter Title">
                  </div>

                  <div class="form-group">
                    <label>Notice Date <span style="color:red;">*</span></label>
                    <input type="date" name="notice_date" required value="{{ old('notice_date') }}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Publish Date <span style="color:red;">*</span></label>
                    <input type="date" name="publish_date" required value="{{ old('publish_date') }}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label style="display: block;">Message To </label>
                    <label style="margin-right: 25px;"><input type="checkbox" value="2" name="message_to[]"> Teacher</label>
                    <label style="margin-right: 25px;"><input type="checkbox" value="3" name="message_to[]"> Student</label>
                    <label><input type="checkbox" value="4" name="message_to[]"> Parent</label>
                  </div>
                  <div class="form-group">
                    <label>Message </label>
                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px"></textarea>
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
      height: 200,
      
    });
  });
  </script>
  @endsection