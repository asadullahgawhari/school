  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $getStudent->name }} {{ $getStudent->last_name }}'s Attendance </h1>
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
                <div class="form-group col-sm-4">
                  <label>Attendance </label>
                  <input type="date" class="form-control" value="{{ Request::get('attendance_date') }}" name="attendance_date" >
                </div>
                <div class="form-group col-sm-4">
                  <label>Attendance Date </label>
                  <select class="form-control" name="attendance_type">
                    <option value="">Select</option>
                    <option {{ (Request::get('attendance_type') == 1) ? 'selected' : '' }} value="1">Present</option>
                    <option {{ (Request::get('attendance_type') == 2) ? 'selected' : '' }} value="2">Late</option>
                    <option {{ (Request::get('attendance_type') == 3) ? 'selected' : '' }} value="3">Absent</option>
                    <option {{ (Request::get('attendance_type') == 4) ? 'selected' : '' }} value="4">Half Day</option>
                  </select>
                </div>
                <div class="form-group col-sm-4">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('parent/my_student/attendance/'.$getStudent->id) }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
                <h3 class="card-title">My Attendance (Total: {{ $getRecord->total() }})</h3>
              </div>
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Class Name</th>
                      <th>Attendance Type</th>
                      <th>Attendance Date</th>
                      <th>Created Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($getRecord as $value)
                      <tr>
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
                        <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="100%">Record not found</td>
                      </tr>
                    @endforelse
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
