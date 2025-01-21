  @extends('layouts.app')

  @section('style')
    <link rel="stylesheet" href="{{ url('public/plugins/select2/css/select2.min.css') }}">
    <style type="text/css">
      .select2-container .select2-selection--single
      {
        height: 40px;
      }
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
            <h1>Send Email</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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
                    <label>Subject <span style="color:red;">*</span></label>
                    <input type="text" name="subject" required value="{{ old('subject') }}" class="form-control" placeholder="Enter Subject">
                  </div>
                <div class="form-group">
                  <label>Users (Teacher - Student - Parent)</label>
                  <select class="form-control select2" name="user_id" style="width: 100%;">
                    <option value="">Select</option>
                  </select>
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
                  <button type="submit" class="btn btn-primary">Send Email</button>
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
  <script src="{{ url('public/plugins/select2/js/select2.full.min.js') }}"></script>
  <script type="text/javascript">

  $(function () {
    $('.select2').select2({
      ajax: {
        url: '{{ url('admin/communicate/search_user') }}',
        dataType: 'json',
        delay: 250,
        data: function (data) {
          return {
            search: data.term,
          };
        },
        processResults: function (response) {
          return {
            results:response
          };
        },
      }
    });

    $('#compose-textarea').summernote({
      height: 225,
      
    });
  });
  </script>
  @endsection