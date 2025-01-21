  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Class Timetable </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Searching or Filter -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Searching Class Timetable</h3>
          </div>
          <form method="get" action="">
            <div class="card-body">
              <div class="row">
                <div class="form-group col-sm-4">
                  <label>Class Name <span style="color:red;">*</span></label>
                  <select class="form-control getClass" name="class_id" required>
                    <option value="">Select Class</option>
                      @foreach($getClass as $class)
                        <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group col-sm-4">
                  <label>Subject Name <span style="color:red;">*</span></label>
                    <select class="form-control getSubject" name="subject_id" required>
                      <option value="">Select Subject</option>
                        @if(!empty($getSubject))
                          @foreach($getSubject as $subject)
                            <option {{ (Request::get('subject_id') == $subject->subject_id) ? 'selected' : '' }} value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                          @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group col-sm-4">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Search</button>
                  <a href="{{ url('admin/class_timetable/list') }}" class="btn btn-success" style="margin-top: 32px;">Reset</a>
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
            @if(!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))
            <form action="{{ url('admin/class_timetable/add') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
              <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Class Timetable</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0" style="overflow-x:auto;">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Week</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Room Number</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php 
                        $i = 1;
                      @endphp
                      @foreach($week as $value)
                        <tr>
                          <th>
                            <input type="hidden" name="timetable[{{ $i }}][week_id]" value="{{ $value['week_id'] }}">
                            {{ $value['week_name'] }}
                          </th>
                          <td>
                            <input type="time" name="timetable[{{ $i }}][start_time]" value="{{ $value['start_time'] }}" class="form-control">
                          </td>
                          <td>
                            <input type="time" name="timetable[{{ $i }}][end_time]" value="{{ $value['end_time'] }}" class="form-control">
                          </td>
                          <td>
                            <input type="text" name="timetable[{{ $i }}][room_number]" value="{{ $value['room_number'] }}" class="form-control">
                          </td>
                        </tr>
                        @php 
                          $i++;
                        @endphp
                      @endforeach
                    </tbody>
                  </table>
                  <div class="card-footer" style="text-align: right;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            </form>
            @endif
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

  @section('script')
    <script type="text/javascript">
      $('.getClass').change(function(){
        var class_id = $(this).val();
        $.ajax({
          url: "{{ url('admin/class_timetable/get_subject') }}",
          type: "POST",
          data:{
            "_token": "{{ csrf_token() }}",
            class_id:class_id,
          },
          dataType:"json",
          success:function(response){
            $('.getSubject').html(response.html);
          },
        });
      });
    </script>
  @endsection