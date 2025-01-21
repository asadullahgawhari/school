  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Marks Grade</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form method="post" action="" enctype="multipart/form-data">
                <!--CSRF is Outputs a hidden <input> element with the name _token and the value of this token OR token with every POST, PUT, PATCH, or DELETE request -->
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Grade Name <span style="color:red;">*</span></label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="form-control" placeholder="Enter Grade Name">
                  </div>
                  <div class="form-group">
                    <label>Percent From <span style="color:red;">*</span></label>
                    <input type="number" name="percent_from" required value="{{ old('percent_from') }}" class="form-control" placeholder="Enter Percent From">
                  </div>
                  <div class="form-group">
                    <label>Percent To <span style="color:red;">*</span></label>
                    <input type="number" name="percent_to" required value="{{ old('percent_to') }}" class="form-control" placeholder="Enter Percent To">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection