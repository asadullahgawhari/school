  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit My Account</h1>
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
                  <div class="form-group">
                    <label>Name </label>
                    <input type="text" name="name" required class="form-control" value="{{ old('name', $getRecord->name) }}" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label>Last Name </label>
                    <input type="text" name="last_name" required class="form-control" value="{{ old('last_name', $getRecord->last_name) }}" placeholder="Enter Last Name">
                  </div>
                  <div class="form-group col-sm-12">
                      <label>Profile </label>
                      <input type="file" name="profile_pic" value="{{ old('profile_pic') }}" class="form-control">
                      @if(!empty($getRecord->getProfile()))
                        <img src="{{ $getRecord->getProfile() }}" style="width: 100px;">
                      @endif
                    </div>
                  <div class="form-group">
                    <label>Email address </label>
                    <input type="email" name="email" required class="form-control" value="{{ old('email', $getRecord->email) }}" placeholder="Enter Email">
                    <div style="color:red;">{{ $errors->first('email') }}</div>
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