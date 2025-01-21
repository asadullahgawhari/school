  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Subject List </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/subject/add') }}" class="btn btn-primary">Add New Subject</a>
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
                <div class="form-group col-sm-3">
                  <label>Name</label>
                  <input type="text" name="name" value="{{ Request::get('name') }}" class="form-control" placeholder="Search Name">
                </div>
                <div class="form-group col-sm-3">
                  <label>Subject Type </label>
                  <select class="form-control" name="type">
                    <option value="">Select Type</option>
                    <option {{ (Request::get('type') == 'Theory') ? 'selected' : '' }} value="Theory">Theory</option>
                  <option {{ (Request::get('type') == 'Practical') ? 'selected' : '' }} value="Practical">Practical</option>
                  </select>
                </div>
                <div class="form-group col-sm-3">
                  <label>Date</label>
                  <input type="date" name="date" value="" class="form-control">
                </div>
                <div class="form-group col-sm-3">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('admin/subject/list') }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
                <h3 class="card-title">Subject List (Total :  {{ $getRecord->total() }})</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Type</th>
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
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->type }}</td>
                        <td>
                          @if($value->status == 0)
                            Active
                          @else
                            Inactive
                          @endif
                        </td>
                        <td>{{ $value->created_by_name }}</td>
                        <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                        <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td>
                        <td style="min-width: 120px;">
                          <a href="{{ url('admin/subject/edit/'.$value->id ) }}" class="btn btn-primary btn-sm fas fa-edit"></a>
                          <a href="{{ url('admin/subject/delete/'.$value->id ) }}" class=" btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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