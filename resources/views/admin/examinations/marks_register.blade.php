  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Marks Register </h1>
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
                  <label>Exam <span style="color:red;">*</span></label>
                  <select class="form-control" name="exam_id" required>
                    <option value="">Select Exam</option>
                    @foreach($getExam as $exam)
                      <option {{ (Request::get('exam_id') == $exam->id ? 'selected' : '') }} value="{{ $exam->id }}">{{ $exam->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-sm-4">
                  <label>Class <span style="color:red;">*</span></label>
                  <select class="form-control" name="class_id" required>
                    <option value="">Select Class</option>
                    @foreach($getClass as $class)
                      <option {{ (Request::get('class_id') == $class->id ? 'selected' : '') }} value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-sm-4">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('admin/examinations/marks_register') }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
            @if(!empty($getSubject) && !empty($getSubject->count()))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Marks Register </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Student Name</th>
                      @foreach($getSubject as $subject)
                      <th>
                        {{ $subject->subject_name }}
                        <br>
                        ({{ $subject->subject_type }}: {{ $subject->passing_marks }} - {{ $subject->full_marks }})
                      </th>
                      @endforeach
                      <th>Action</th> 
                   </tr>
                  </thead>
                  <tbody>
                    @if(!empty($getStudent) && !empty($getStudent->count()))
                    @foreach($getStudent as $student)
                    <form method="post" class="SubmitForm">
                      {{ csrf_field() }}
                      <input type="hidden" name="student_id" value="{{ $student->id }}">
                      <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                      <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                      <tr>
                        <td>{{ $student->name }} {{ $student->last_name }}</td>
                        @php
                          $i = 1;
                          $totalStudentMark = 0;
                          $totalFullMark = 0;
                          $totalPassingMark = 0;
                          $totalPassFailValidation = 0;
                        @endphp
                        @foreach($getSubject as $subject)

                        @php
                          $totalMark = 0;
                          $totalFullMark = $totalFullMark + $subject->full_marks;
                          $totalPassingMark = $totalPassingMark + $subject->passing_marks;

                          $getMark = $subject->getMark($student->id, Request::get('exam_id'), Request::get('class_id'), $subject->subject_id);

                          if(!empty($getMark))
                          {
                            $totalMark = $getMark->class_work + $getMark->home_work + $getMark->test_work + $getMark->exam;
                          }

                          $totalStudentMark = $totalStudentMark + $totalMark; 
                        @endphp

                        <td>
                          <div style="margin-bottom: 10px;">
                            Class Work
                            <input type="hidden" name="mark[{{ $i }}][full_marks]" value="{{ $subject->full_marks }}">
                            <input type="hidden" name="mark[{{ $i }}][passing_marks]" value="{{ $subject->passing_marks }}">
                            
                            <input type="hidden" name="mark[{{ $i }}][id]" value="{{ $subject->id }}">
                            <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id }}">
                            <input type="text" name="mark[{{ $i }}][class_work]" id="class_work_{{ $student->id }}{{ $subject->subject_id }}" placeholder="Enter Marks" value="{{ !empty($getMark->class_work) ? $getMark->class_work : '' }}" class="form-control">
                          </div>
                          <div style="margin-bottom: 10px;">
                            Home Work
                            <input type="text" name="mark[{{ $i }}][home_work]" id="home_work_{{ $student->id }}{{ $subject->subject_id }}" placeholder="Enter Marks" value="{{ !empty($getMark->home_work) ? $getMark->home_work : '' }}" class="form-control">
                          </div>
                          <div style="margin-bottom: 10px;">
                            Test Work
                            <input type="text" name="mark[{{ $i }}][test_work]" id="test_work_{{ $student->id }}{{ $subject->subject_id }}" placeholder="Enter Marks" value="{{ !empty($getMark->test_work) ? $getMark->test_work : '' }}" class="form-control">
                          </div>
                          <div style="margin-bottom: 10px;">
                            Exam
                            <input type="text" name="mark[{{ $i }}][exam]" id="exam_{{ $student->id }}{{ $subject->subject_id }}" placeholder="Enter Marks" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" class="form-control">
                          </div>
                          <div style="margin-bottom: 10px;">
                            <button type="button" id="{{ $student->id }}" data-val="{{ $subject->subject_id }}" data-exam="{{ Request::get('exam_id') }}" data-class="{{ Request::get('class_id') }}" data-schedule="{{ $subject->id }}" style="text-align: center;" class="btn btn-primary SaveSingleSubject">Save</button>
                          </div>

                          @if(!empty($getMark))
                          <div style="margin-bottom: 10px;"><hr>
                            Total Mark: <b>{{ $totalMark }}</b><br>
                            Passing Mark: <b>{{ $subject->passing_marks }}</b><br>
                            @if($totalMark >= $subject->passing_marks)
                              Result: <b><span style="color: darkgreen;">Passed</span></b>
                            @else
                              Result: <b><span style="color: red;">Failed</span></b>
                              @php
                                $totalPassFailValidation = 1;
                              @endphp
                            @endif
                          </div>
                          @endif
                        </td>
                        @php
                          $i++;
                        @endphp
                        @endforeach
                        <td>
                          <button style="margin-top: 5px;" type="submit" class="btn btn-success" >Save</button>
                          <a class="btn btn-primary" style="margin-top: 5px;" target="_blank" href="{{ url('admin/my_exam_result/print?exam_id='.Request::get('exam_id').'&student_id='.$student->id) }}">Print</a>
                          @if(!empty($totalStudentMark))

                          <br>
                          Full Mark: <b>{{ $totalFullMark }}</b>
                          <br>
                          Total Mark: <b>{{ $totalStudentMark }}</b>
                          <br>
                          Passing Mark: <b>{{ $totalPassingMark }}</b>
                          <br>
                          @php
                            $percentage = ($totalStudentMark * 100) / $totalFullMark;

                            $getGrade = App\Models\MarksGradeModel::getGrade($percentage);
                          @endphp
                          Percentage: <b>{{ round($percentage,2) }}%</b>
                          <br>
                          @if(!empty($getGrade))
                          Grade: <b>{{ $getGrade }}</b>
                          @endif
                          <br>
                          @if($totalPassFailValidation == 0)
                            Result: <b><span style="color: darkgreen;">Passed</span></b>
                          @else
                            Result: <b><span style="color: red;">Failed</span></b>
                          @endif
                          @endif
                        </td>
                      </tr>
                    </form>
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
    $('.SubmitForm').submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "{{ url('admin/examinations/submit_marks_register') }}",
        data: $(this).serialize(),
        dataType: "json",
        success: function(data) {
          alert(data.message);
        },
      });
    });

    $('.SaveSingleSubject').click(function(e) {
      var student_id = $(this).attr('id');
      var subject_id = $(this).attr('data-val');
      var exam_id = $(this).attr('data-exam');
      var class_id = $(this).attr('data-class');
      var id = $(this).attr('data-schedule');
      
      var class_work = $('#class_work_'+student_id+subject_id).val();
      var home_work = $('#home_work_'+student_id+subject_id).val();
      var test_work = $('#test_work_'+student_id+subject_id).val();
      var exam = $('#exam_'+student_id+subject_id).val();

      $.ajax({
        type: "POST",
        url: "{{ url('admin/examinations/single_submit_marks_register') }}",
        data: {
          "_token": "{{ csrf_token() }}",
          id : id,
          student_id : student_id,
          subject_id : subject_id,
          exam_id : exam_id,
          class_id : class_id,
          class_work : class_work,
          home_work : home_work,
          test_work : test_work,
          exam : exam
        },
        dataType: "json",
        success: function(data) {
          alert(data.message);
        },
      });

    });
  </script>
  @endsection