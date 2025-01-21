  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Parent</h1>
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
                  <div class="row">
                    <div class="form-group col-sm-3">
                      <label>Name <span style="color:red;">*</span></label>
                      <input type="text" name="name" required value="{{ old('name') }}" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Last Name </label>
                      <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Enter Last Name">
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Gender <span style="color:red;">*</span></label>
                      <select class="form-control" required name="gender">
                        <option value="">Select Gender</option>
                        <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                        <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                        <option {{ (old('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                      </select>
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Mobile Number <span style="color:red;">*</span></label>
                      <input type="text" name="mobile_number" required value="{{ old('mobile_number') }}" class="form-control" placeholder="Mobile Number">
                      <div style="color:red;">{{ $errors->first('mobile_number') }}</div>
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Occupation</label>
                      <input type="text" name="occupation" value="{{ old('occupation') }}" class="form-control" placeholder="Occupation">
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Profile </label>
                      <input type="file" name="profile_pic" value="{{ old('profile_pic') }}" class="form-control">
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Satatus </label>
                      <select class="form-control" name="status">
                        <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                        <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                      </select>
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Address</label>
                      <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Address">
                    </div>

                  </div>
                    <hr>
                    <div class="form-group col-sm-12">
                      <label>Email address <span style="color:red;">*</span></label>
                      <input type="email" name="email" required value="{{ old('email') }}" class="form-control" placeholder="Enter Email">
                      <div style="color:red;">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group col-sm-12">
                      <label>Password <span style="color:red;">*</span></label>
                      <input type="password" name="password" required class="form-control" placeholder="Enter Password">
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