  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin List </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/admin/add') }}" class="btn btn-primary">Add New Admin</a>
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
                  <label>Name</label>
                  <input type="text" name="name" value="{{ Request::get('name') }}" class="form-control" placeholder="Search Name">
                </div>
                <div class="form-group col-sm-2">
                  <label>Last Name</label>
                  <input type="text" name="last_name" value="{{ Request::get('last_name') }}" class="form-control" placeholder="Search Last Name">
                </div>
                <div class="form-group col-sm-3">
                  <label>Email address</label>
                  <input type="text" name="email" value="{{ Request::get('email') }}" class="form-control" placeholder="Search Email">
                </div>
                <div class="form-group col-sm-2">
                  <label>Date</label>
                  <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control" placeholder="Search Date">
                </div>
                <div class="form-group col-sm-3">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('admin/admin/list') }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
                <h3 class="card-title">Admin List (Total :  {{ $getRecord->total() }})</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Profile</th>
                      <th>Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Created Date</th>
                      <th>Action</th> 
                   </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <td>
                          @if(!empty($value->getProfileDirect()))
                            <img src="{{ $value->getProfileDirect() }}" style="height: 50px; width: 50px; border-radius: 50px;">
                          @endif
                        </td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->last_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                        <td style="min-width: 150px;">
                          <a href="{{ url('admin/admin/edit/'.$value->id ) }}" class="btn btn-primary btn-sm fas fa-edit"></a>
                          <a href="{{ url('admin/admin/delete/'.$value->id ) }}" class=" btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                          <a href="{{ url('chat?receiver_id='.base64_encode($value->id)) }}" class=" btn btn-success btn-sm"><i class="nav-icon fas fa-paper-plane"></i></a>
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