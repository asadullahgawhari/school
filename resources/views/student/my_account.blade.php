  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Account</h1>
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
            @include('_message')
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
                      <label>Caste </label>
                      <input type="text" name="caste" value="{{ old('caste', $getRecord->caste) }}" class="form-control" placeholder="Caste">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Religion </label>
                      <input type="text" name="religion" value="{{ old('religion', $getRecord->religion) }}" class="form-control" placeholder="Religion">
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Mobile Number <span style="color:red;">*</span></label>
                      <input type="text" name="mobile_number" value="{{ old('mobile_number', $getRecord->mobile_number) }}" class="form-control" placeholder="Mobile Number">
                      <div style="color:red;">{{ $errors->first('mobile_number') }}</div>
                    </div>
                    <div class="form-group col-sm-4">
                      <label>Profile </label>
                      <input type="file" name="profile_pic" value="{{ old('profile_pic') }}" class="form-control">
                      @if(!empty($getRecord->getProfile()))
                        <img src="{{ $getRecord->getProfile() }}" style="width: 100px;">
                      @endif
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Blood Group </label>
                      <input type="text" name="blood_group" value="{{ old('blood_group', $getRecord->blood_group) }}" class="form-control" placeholder="Blood Group">
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Height </label>
                      <input type="text" name="height" value="{{ old('height', $getRecord->height) }}" class="form-control" placeholder="Height">
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Weight </label>
                      <input type="text" name="weight" value="{{ old('weight', $getRecord->weight) }}" class="form-control" placeholder="Weight">
                    </div>
                    <div class="form-group col-sm-3">
                      <label>Email address <span style="color:red;">*</span></label>
                      <input type="email" name="email" required value="{{ old('email', $getRecord->email) }}" class="form-control" placeholder="Enter Email">
                      <div style="color:red;">{{ $errors->first('email') }}</div>
                    </div>

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