  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assign Subject List </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/assign_subject/add') }}" class="btn btn-primary">Add New Assign Subject</a>
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
                  <label>Class Name</label>
                  <input type="text" name="class_name" value="{{ Request::get('class_name') }}" class="form-control" placeholder="Search Class Name">
                </div>
                <div class="form-group col-sm-2">
                  <label>Subject Name</label>
                  <input type="text" name="subject_name" value="{{ Request::get('subject_name') }}" class="form-control" placeholder="Search Subject Name">
                </div>
                <div class="form-group col-sm-2">
                  <label>Status </label>
                  <select class="form-control" name="status">
                    <option value="">Select Status</option>
                    <option {{ (Request::get('status') == '0') ? 'selected' : '' }} value="0">Active</option>
                  <option {{ (Request::get('status') == '1') ? 'selected' : '' }} value="1">Inactive</option>
                  </select>
                </div>
                <div class="form-group col-sm-3">
                  <label>Date</label>
                  <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control">
                </div>
                <div class="form-group col-sm-3">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Search</button>
                  <a href="{{ url('admin/assign_subject/list') }}" class="btn btn-success" style="margin-top: 32px;">Reset</a>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Class Assign Subject List (Total :  {{ $getRecord->total() }})</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Class Name</th>
                      <th>Subject Name</th>
                      <th>Status</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Updated Date</th>
                      <th>Action</th> 
                   </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->class_name }}</td>
                        <td>{{ $value->subject_name }}</td>
                        <td>
                          @if($value->status == 0)
                            Active
                          @else
                            Inactive
                          @endif
                        </td>
                        <td>{{ $value->created_by_name }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}</td>
                        <td style="min-width: 220px;">
                          <a href="{{ url('admin/assign_subject/edit/'.$value->id ) }}" class="btn btn-primary btn-sm">Edit</a>
                          <a href="{{ url('admin/assign_subject/edit_single/'.$value->id ) }}" class="btn btn-success btn-sm">Edit Single</a>
                          <a href="{{ url('admin/assign_subject/delete/'.$value->id ) }}" class=" btn btn-danger btn-sm">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <div style="padding: 10px;">
                 {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->onEachSide(1)->links() !!}
                </div>

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