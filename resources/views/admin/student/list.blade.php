  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student List </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Add New Student</a>
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
                  <input type="text" name="last_name" value="{{ Request::get('last_name') }}" class="form-control" placeholder="Last Name">
                </div>
                <div class="form-group col-sm-2">
                  <label>Admission Number</label>
                  <input type="text" name="admission_number" value="{{ Request::get('admission_number') }}" class="form-control" placeholder="Admission Number">
                </div>
                <div class="form-group col-sm-2">
                  <label>Roll Number</label>
                  <input type="text" name="roll_number" value="{{ Request::get('roll_number') }}" class="form-control" placeholder="Roll Number">
                </div>
                <div class="form-group col-sm-2">
                  <label>Class</label>
                  <input type="text" name="class" value="{{ Request::get('class') }}" class="form-control" placeholder="Class">
                </div>
                <div class="form-group col-sm-2">
                  <label>Gender</label>
                    <select class="form-control" name="gender">
                      <option value="">Select Gender</option>
                      <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                      <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                      <option {{ (Request::get('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                  <label>Caste</label>
                  <input type="text" name="caste" value="{{ Request::get('caste') }}" class="form-control" placeholder="caste">
                </div>
                <div class="form-group col-sm-2">
                  <label>Religion</label>
                  <input type="text" name="religion" value="{{ Request::get('religion') }}" class="form-control" placeholder="Religion">
                </div>
                <div class="form-group col-sm-2">
                  <label>Mobile Number</label>
                  <input type="text" name="mobile_number" value="{{ Request::get('mobile_number') }}" class="form-control" placeholder="Mobile Number">
                </div>
                <div class="form-group col-sm-2">
                  <label>Blood Group</label>
                  <input type="text" name="blood_group" value="{{ Request::get('blood_group') }}" class="form-control" placeholder="Blood Group">
                </div>
                <div class="form-group col-sm-2">
                  <label>Height</label>
                  <input type="text" name="height" value="{{ Request::get('height') }}" class="form-control" placeholder="Height">
                </div>
                <div class="form-group col-sm-2">
                  <label>Weight</label>
                  <input type="text" name="weight" value="{{ Request::get('weight') }}" class="form-control" placeholder="Weight">
                </div>
                <div class="form-group col-sm-2">
                  <label>Status </label>
                  <select class="form-control" name="status">
                    <option value="">Select Status</option>
                    <option {{ (Request::get('status') == '0') ? 'selected' : '' }} value="0">Active</option>
                  <option {{ (Request::get('status') == '1') ? 'selected' : '' }} value="1">Inactive</option>
                  </select>
                </div>
                <div class="form-group col-sm-2">
                  <label>Email address</label>
                  <input type="text" name="email" value="{{ Request::get('email') }}" class="form-control" placeholder="Email">
                </div>
                <div class="form-group col-sm-2">
                  <label>Date of Birth</label>
                  <input type="date" name="date_of_birth" value="{{ Request::get('date_of_birth') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <label>Admission Date</label>
                  <input type="date" name="admission_date" value="{{ Request::get('admission_date') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <label>Created Date</label>
                  <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control">
                </div>
                <!-- <div class="form-group col-sm-2">
                  <label>Updated Date</label>
                  <input type="date" name="updated_at" value="{{ Request::get('updated_at') }}" class="form-control" placeholder="Updated Date">
                </div> -->
                <div class="form-group col-sm-2">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('admin/student/list') }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
                <h3 class="card-title">Student List (Total :  {{ $getRecord->total() }})</h3>

                <form style="float: right;" method="post" action="{{ url('admin/student/export_student') }}">
                {{ csrf_field() }}

                <input type="hidden" value="{{ Request::get('name') }}" name="name">
                <input type="hidden" value="{{ Request::get('last_name') }}" name="last_name">
                <input type="hidden" value="{{ Request::get('admission_number') }}" name="admission_number">
                <input type="hidden" value="{{ Request::get('roll_number') }}" name="roll_number">
                <input type="hidden" value="{{ Request::get('class') }}" name="class">
                <input type="hidden" value="{{ Request::get('gender') }}" name="gender">
                <input type="hidden" value="{{ Request::get('caste') }}" name="caste">
                <input type="hidden" value="{{ Request::get('religion') }}" name="religion">
                <input type="hidden" value="{{ Request::get('mobile_number') }}" name="mobile_number">
                <input type="hidden" value="{{ Request::get('blood_group') }}" name="blood_group">
                <input type="hidden" value="{{ Request::get('height') }}" name="height">
                <input type="hidden" value="{{ Request::get('weight') }}" name="weight">
                <input type="hidden" value="{{ Request::get('status') }}" name="status">
                <input type="hidden" value="{{ Request::get('email') }}" name="email">
                <input type="hidden" value="{{ Request::get('date_of_birth') }}" name="date_of_birth">
                <input type="hidden" value="{{ Request::get('admission_date') }}" name="admission_date">
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
                      <th>Student Name</th>
                      <th>Last Name</th>
                      <th>Parent Name</th>
                      <th>Admission Number</th>
                      <th>Roll Number</th>
                      <th>Class</th>
                      <th>Gender</th>
                      <th>Date of Birth</th>
                      <th>Caste</th>
                      <th>Religion</th>
                      <th>Mobile Number</th>
                      <th>Admission Date</th>
                      <th>Blood Group</th>
                      <th>Height</th>
                      <th>Weight</th>
                      <th>Status</th>
                      <th>Email</th>
                      <th>Created Date</th>
                      <th>Updated Date</th>
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
                        <td>{{ $value->parent_name }} {{ $value->parent_last_name }}</td>
                        <td>{{ $value->admission_number }}</td>
                        <td>{{ $value->roll_number }}</td>
                        <td>{{ $value->class_name }}</td>
                        <td>{{ $value->gender }}</td>
                        <td style="min-width: 80px;">
                          @if(!empty($value->date_of_birth))
                            {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                          @endif
                        </td>
                        <td>{{ $value->caste }}</td>
                        <td>{{ $value->religion }}</td>
                        <td>{{ $value->mobile_number }}</td>
                        <td>
                          @if(!empty($value->admission_date))
                            {{ date('d-m-Y', strtotime($value->admission_date)) }}
                          @endif
                        </td>
                        <td>{{ $value->blood_group }}</td>
                        <td>{{ $value->height }}</td>
                        <td>{{ $value->weight }}</td>
                        <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}</td>
                        <td style="min-width: 150px;">
                          <a href="{{ url('admin/student/edit/'.$value->id ) }}" class="btn btn-primary btn-sm fas fa-edit"></a>
                          <a href="{{ url('admin/student/delete/'.$value->id ) }}" class=" btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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