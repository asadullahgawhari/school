  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Teacher</h1>
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
                      <label>Teacher Name <span style="color:red;">*</span></label>
                      <input type="text" name="name" required value="{{ old('name', $getRecord->name) }}" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Last Name </label>
                      <input type="text" name="last_name" value="{{ old('last_name', $getRecord->last_name) }}" class="form-control" placeholder="Enter Last Name">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Gender <span style="color:red;">*</span></label>
                      <select class="form-control" required name="gender">
                        <option value="">Select Gender</option>
                        <option {{ (old('gender', $getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                        <option {{ (old('gender', $getRecord->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                        <option {{ (old('gender', $getRecord->gender) == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                      </select>
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Date Of Birth </label>
                      <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $getRecord->date_of_birth) }}" class="form-control">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Mobile Number <span style="color:red;">*</span></label>
                      <input type="text" name="mobile_number" value="{{ old('mobile_number', $getRecord->mobile_number) }}" class="form-control" placeholder="Mobile Number">
                      <div style="color:red;">{{ $errors->first('mobile_number') }}</div>
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Joining Date </label>
                      <input type="date" name="admission_date" value="{{ old('admission_date', $getRecord->admission_date) }}" class="form-control">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Profile </label>
                      <input type="file" name="profile_pic" value="{{ old('profile_pic') }}" class="form-control">
                      @if(!empty($getRecord->getProfile()))
                        <img src="{{ $getRecord->getProfile() }}" style="width: 100px;">
                      @endif
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Satatus </label>
                      <select class="form-control" name="status">
                        <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                        <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>
                      </select>
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Marital Status </label>
                      <input type="text" name="marital_status" value="{{ old('marital_status', $getRecord->marital_status) }}" class="form-control" placeholder="Marital Status">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Current Address </label>
                      <input type="text" name="address" value="{{ old('address', $getRecord->address) }}" class="form-control" placeholder="Current Address">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Permanent Address </label>
                      <input type="text" name="permanent_address" value="{{ old('permanent_address', $getRecord->permanent_address) }}" class="form-control" placeholder="Permanent Address">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Qualification </label>
                      <input type="text" name="qualification" value="{{ old('qualification', $getRecord->qualification) }}" class="form-control" placeholder="Qualification">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Work Experience </label>
                      <input type="text" name="work_experience" value="{{ old('work_experience', $getRecord->work_experience) }}" class="form-control" placeholder="Work Experience">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Note </label>
                      <input type="text" name="note" value="{{ old('note', $getRecord->note) }}" class="form-control" placeholder="Note">
                    </div>

                  </div>
                    <hr>
                    <div class="form-group col-sm-12">
                      <label>Email address <span style="color:red;">*</span></label>
                      <input type="email" name="email" required value="{{ old('email', $getRecord->email) }}" class="form-control" placeholder="Enter Email">
                      <div style="color:red;">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group col-sm-12">
                      <label>Password</span></label>
                      <input type="text" name="password" class="form-control" placeholder="Enter Password">
                      <p>Do you want to change password so please add new password</p>
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