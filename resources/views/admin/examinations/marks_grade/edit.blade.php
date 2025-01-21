  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Marks Grade</h1>
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
                    <label>Grade Name </label>
                    <input type="text" name="name" value="{{ old('name', $getRecord->name) }}" class="form-control" placeholder="Enter Grade Name">
                  </div>
                  <div class="form-group">
                    <label>Percent From </label>
                    <input type="number" name="percent_from" value="{{ old('percent_from', $getRecord->percent_from) }}" class="form-control" placeholder="Enter Percent From">
                  </div>
                  <div class="form-group">
                    <label>Percent To </label>
                    <input type="number" name="percent_to" value="{{ old('percent_to', $getRecord->percent_to) }}" class="form-control" placeholder="Enter Percent To">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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