  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Student</h1>
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
                    <div class="form-group col-sm-4">
                      <label>Name <span style="color:red;">*</span></label>
                      <input type="text" name="name" required value="{{ old('name') }}" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Last Name </label>
                      <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Enter Last Name">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Admission Number </label>
                      <input type="text" name="admission_number" value="{{ old('admission_number') }}" class="form-control" placeholder="Admission Number">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Roll Number </label>
                      <input type="text" name="roll_number" value="{{ old('roll_number') }}" class="form-control" placeholder="Roll Number">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Class <span style="color:red;">*</span></label>
                      <select class="form-control" required name="class_id">
                        <option value="">Select Class</option>
                        @foreach($getClass as $value)
                          <option {{ (old('class_id') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Gender <span style="color:red;">*</span></label>
                      <select class="form-control" required name="gender">
                        <option value="">Select Gender</option>
                        <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                        <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                        <option {{ (old('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                      </select>
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Date Of Birth </label>
                      <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Caste </label>
                      <input type="text" name="caste" value="{{ old('caste') }}" class="form-control" placeholder="Caste">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Religion </label>
                      <input type="text" name="religion" value="{{ old('religion') }}" class="form-control" placeholder="Religion">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Mobile Number <span style="color:red;">*</span></label>
                      <input type="text" name="mobile_number" required value="{{ old('mobile_number') }}" class="form-control" placeholder="Mobile Number">
                      <div style="color:red;">{{ $errors->first('mobile_number') }}</div>
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Admission Date </label>
                      <input type="date" name="admission_date" value="{{ old('admission_date') }}" class="form-control">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Profile </label>
                      <input type="file" name="profile_pic" value="{{ old('profile_pic') }}" class="form-control">
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Blood Group </label>
                      <input type="text" name="blood_group" value="{{ old('blood_group') }}" class="form-control" placeholder="Blood Group">
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Height </label>
                      <input type="text" name="height" value="{{ old('height') }}" class="form-control" placeholder="Height">
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Weight </label>
                      <input type="text" name="weight" value="{{ old('weight') }}" class="form-control" placeholder="Weight">
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Satatus </label>
                      <select class="form-control" name="status">
                        <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                        <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                      </select>
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