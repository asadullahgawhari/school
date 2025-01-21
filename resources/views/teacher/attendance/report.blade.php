  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Attendance Report </h1>
          </div>
        </div>
      </div>
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
                  <label>Student ID </label>
                  <input type="text" class="form-control" value="{{ Request::get('student_id') }}" name="student_id" placeholder="Student ID" >
                </div>

                <div class="form-group col-sm-2">
                  <label>Student Name </label>
                  <input type="text" class="form-control" value="{{ Request::get('student_name') }}" name="student_name" placeholder="Student Name">
                </div>

                <div class="form-group col-sm-2">
                  <label>Class </label>
                  <select class="form-control" name="class_id">
                    <option value="">Select Class</option>
                    @foreach($getClass as $class)
                      <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-sm-2">
                  <label>Attendance Date </label>
                  <input type="date" class="form-control" value="{{ Request::get('attendance_date') }}" name="attendance_date" >
                </div>

                <div class="form-group col-sm-2">
                  <label>Attendance Date </label>
                  <select class="form-control" name="attendance_type">
                    <option value="">Select</option>
                    <option {{ (Request::get('attendance_type') == 1) ? 'selected' : '' }} value="1">Present</option>
                    <option {{ (Request::get('attendance_type') == 2) ? 'selected' : '' }} value="2">Late</option>
                    <option {{ (Request::get('attendance_type') == 3) ? 'selected' : '' }} value="3">Absent</option>
                    <option {{ (Request::get('attendance_type') == 4) ? 'selected' : '' }} value="4">Half Day</option>
                  </select>
                </div>

                <div class="form-group col-sm-2">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('teacher/attendance/report') }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Attendance List (Total: {{ $getRecord->total() }})</h3>
              </div>
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Student Name</th>
                      <th>Class Name</th>
                      <th>Attendance Type</th>
                      <th>Attendance Date</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($getRecord))
                    @forelse($getRecord as $value)
                      <tr>
                        <td>{{ $value->student_id }}</td>
                        <td>{{ $value->student_name }} {{ $value->student_last_name }}</td>
                        <td>{{ $value->class_name }}</td>
                        <td>
                          @if($value->attendance_type == 1)
                            Present
                          @elseif($value->attendance_type == 2)
                            Late
                          @elseif($value->attendance_type == 3)
                            Absent
                          @elseif($value->attendance_type == 4)
                            Half Day
                          @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($value->attendance_date)) }}</td>
                        <td>{{ $value->created_by_name }}</td>
                        <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="100%">Record not found</td>
                      </tr>
                    @endforelse
                    @else
                    {
                      <tr>
                        <td colspan="100%">Record not found</td>
                      </tr>
                    }
                    @endif
                    
                  </tbody>
                </table>
                @if(!empty($getRecord))
                <div style="padding: 10px;">
                 {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->onEachSide(1)->links() !!}
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  @endsection
