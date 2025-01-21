  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parent Student List </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Searching or Filter -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Searching</h3>
          </div>
          <form method="get" action="">
            <div class="card-body">
              <div class="row">
                <div class="form-group col-sm-2">
                  <label>Student ID</label>
                  <input type="text" name="id" value="{{ Request::get('id') }}" class="form-control" placeholder="Student ID">
                </div>
                <div class="form-group col-sm-2">
                  <label>Name</label>
                  <input type="text" name="name" value="{{ Request::get('name') }}" class="form-control" placeholder="Search Name">
                </div>
                <div class="form-group col-sm-2">
                  <label>Last Name</label>
                  <input type="text" name="last_name" value="{{ Request::get('last_name') }}" class="form-control" placeholder="Last Name">
                </div>
                <div class="form-group col-sm-2">
                  <label>Email address</label>
                  <input type="text" name="email" value="{{ Request::get('email') }}" class="form-control" placeholder="Email">
                </div>
                <div class="form-group col-sm-2">
                  <label>Created Date</label>
                  <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('admin/parent/my_student/'.$parent_id) }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
                </div>
              </div>
          </form>
        </div>
      </div>
    </section>
    <!-- /.End searching or filter -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            @include('_message')
            @if(!empty($getSearchStudent))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Student List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Profile</th>
                      <th>Student Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Parent Name</th>
                      <th>Created Date</th>
                      <th>Action</th> 
                   </tr>
                  </thead>
                  <tbody>
                    @foreach($getSearchStudent as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <th>
                          @if(!empty($value->getProfile()))
                            <img src="{{ $value->getProfile() }}" style="height: 50px; width: 50px; border-radius: 50px;">
                          @endif
                        </th>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->last_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->parent_name }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td style="min-width: 200px;">
                          <a href="{{ url('admin/parent/assign_student_parent/'.$value->id.'/'.$parent_id ) }}" class="btn btn-primary btn-sm">Add Student to Parent</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            @endif

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Parent Student List ({{ $getParent->name }} {{ $getParent->last_name }})</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Profile</th>
                      <th>Student Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Parent Name</th>
                      <th>Created Date</th>
                      <th>Action</th> 
                   </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <th>
                          @if(!empty($value->getProfile()))
                            <img src="{{ $value->getProfile() }}" style="height: 50px; width: 50px; border-radius: 50px;">
                          @endif
                        </th>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->last_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->parent_name }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td style="min-width: 100px;">
                          <a href="{{ url('admin/parent/assign_student_parent_delete/'.$value->id ) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection