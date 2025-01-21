  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Class</h1>
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
              <form method="post" action="">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Class Name <span style="color:red;">*</span></label>
                    <input type="text" name="name" required value="{{ $getRecord->name }}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Amount ($) <span style="color:red;">*</span></label>
                    <input type="number" name="amount" required value="{{ $getRecord->amount }}" class="form-control" placeholder="Enter Amount">
                  </div>
                  <div class="form-group">
                    <label>Status </label>
                    <select class="form-control" name="status">
                      <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                      <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                    </select>
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