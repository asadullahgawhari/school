  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student Attendance </h1>
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
                <div class="form-group col-sm-5">
                  <label>Class <span style="color:red;">*</span></label>
                  <select class="form-control" name="class_id" id="getClass" required>
                    <option value="">Select Class</option>
                    @foreach($getClass as $class)
                      <option {{ (Request::get('class_id') == $class->class_id ? 'selected' : '') }} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-sm-5">
                  <label>Attendance Date <span style="color:red;">*</span></label>
                  <input type="date" class="form-control" value="{{ Request::get('attendance_date') }}" required name="attendance_date" id="getAttendanceDate">
                </div>

                <div class="form-group col-sm-2">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('teacher/attendance/student') }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
            @if (!empty(Request::get('class_id')) && !empty(Request::get('attendance_date')))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Student Name</th>
                      <th>Attendance</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($getStudent) && !empty($getStudent->count()))
                    @foreach($getStudent as $value)
                    @php
                      $attendance_type = '';
                      $getAttendance = $value->getAttendance($value->id, Request::get('class_id'), Request::get('attendance_date'));

                      if(!empty($getAttendance->attendance_type))
                      {
                        $attendance_type = $getAttendance->attendance_type;
                      }
                    @endphp
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->name }} {{ $value->last_name }}</td>
                      <td>
                        <label style="margin-right: 15px">
                          <input type="radio" {{ ($attendance_type == '1') ? 'checked' : '' }} value="1" id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}"> Present
                        </label>
                        <label style="margin-right: 15px">
                          <input type="radio" {{ ($attendance_type == '2') ? 'checked' : '' }} value="2" id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}"> Late
                        </label>
                        <label style="margin-right: 15px">
                          <input type="radio" {{ ($attendance_type == '3') ? 'checked' : '' }} value="3" id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}"> Absent
                        </label>
                        <label style="margin-right: 15px">
                          <input type="radio" {{ ($attendance_type == '4') ? 'checked' : '' }} value="4" id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}"> Half Day
                        </label>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  @endsection

  @section('script')
  <script type="text/javascript">
    
    $('.SaveAttendance').change(function(e) {

      var student_id = $(this).attr('id');
      var attendance_type = $(this).val();
      var class_id = $('#getClass').val();
      var attendance_date = $('#getAttendanceDate').val();

      $.ajax({
        type: "POST",
        url: "{{ url('teacher/attendance/student/save') }}",
        data: {
          "_token": "{{ csrf_token() }}",
          student_id : student_id,
          attendance_type : attendance_type,
          class_id : class_id,
          attendance_date : attendance_date,
        },
        dataType: "json",
        success: function(data) {
          alert(data.message);
        },
      });

    });
  </script>
  @endsection