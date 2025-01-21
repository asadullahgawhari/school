  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parent List </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">Add New Parent</a>
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
                  <label>Last Name</label>
                  <input type="text" name="last_name" value="{{ Request::get('last_name') }}" class="form-control" placeholder="Last Name">
                </div>
                <div class="form-group col-sm-3">
                  <label>Gender</label>
                    <select class="form-control" name="gender">
                      <option value="">Select Gender</option>
                      <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                      <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                      <option {{ (Request::get('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                  <label>Mobile Number</label>
                  <input type="text" name="mobile_number" value="{{ Request::get('mobile_number') }}" class="form-control" placeholder="Mobile Number">
                </div>
                <div class="form-group col-sm-3">
                  <label>Occupation</label>
                  <input type="text" name="occupation" value="{{ Request::get('occupation') }}" class="form-control" placeholder="Occupation">
                </div>
                <div class="form-group col-sm-3">
                  <label>Email address</label>
                  <input type="text" name="email" value="{{ Request::get('email') }}" class="form-control" placeholder="Email">
                </div>
                <div class="form-group col-sm-3">
                  <label>Created Date</label>
                  <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control">
                </div>
                <!-- <div class="form-group col-sm-2">
                  <label>Updated Date</label>
                  <input type="date" name="updated_at" value="{{ Request::get('updated_at') }}" class="form-control" placeholder="Updated Date">
                </div> -->
                <div class="form-group col-sm-3">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('admin/parent/list') }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
                <h3 class="card-title">Parent List (Total :  {{ $getRecord->total() }})</h3>

                <form style="float: right;" method="post" action="{{ url('admin/parent/export_parent') }}">
                {{ csrf_field() }}

                <input type="hidden" value="{{ Request::get('name') }}" name="name">
                <input type="hidden" value="{{ Request::get('last_name') }}" name="last_name">
                <input type="hidden" value="{{ Request::get('gender') }}" name="gender">
                <input type="hidden" value="{{ Request::get('mobile_number') }}" name="mobile_number">
                <input type="hidden" value="{{ Request::get('occupation') }}" name="occupation">
                <input type="hidden" value="{{ Request::get('email') }}" name="email">
                <input type="hidden" value="{{ Request::get('date') }}" name="date">
                
                  <button type="submit" class="btn btn-primary btn-sm">Export To Excel</button>
                </form>

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
                      <th>gender</th>
                      <th>Mobile Number</th>
                      <th>Occupation</th>
                      <th>Status</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Created Date</th>
                      <th>Updated By</th>
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
                        <td>{{ $value->gender }}</td>
                        <td>{{ $value->mobile_number }}</td>
                        <td>{{ $value->occupation }}</td>
                        <td>
                          @if($value->status == 0)
                            Active
                          @else
                            Inactive
                          @endif
                        </td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}</td>
                        <td style="min-width: 350px;">
                          <a href="{{ url('admin/parent/edit/'.$value->id ) }}" class="btn btn-primary btn-sm">Edit</a>
                          <a href="{{ url('admin/parent/delete/'.$value->id ) }}" class=" btn btn-danger btn-sm">Delete</a>
                          <a href="{{ url('admin/parent/my_student/'.$value->id ) }}" class="btn btn-success btn-sm">My Student</a>
                          <a href="{{ url('chat?receiver_id='.base64_encode($value->id)) }}" class=" btn btn-warning btn-sm">Message</i></a>
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