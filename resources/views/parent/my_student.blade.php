  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Student - Son </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Student </h3>
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
                          @if(!empty($value->getProfile()))
                            <img src="{{ $value->getProfile() }}" style="height: 50px; width: 50px; border-radius: 50px;">
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
                        <td>
                          @if($value->status == 0)
                            Active
                          @else
                            Inactive
                          @endif
                        </td>
                        <td>{{ $value->email }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}</td>
                        <td style="min-width: 500px;">
                          <a style="margin-bottom: 5px;" href="{{ url('parent/my_student/subject/'.$value->id ) }}" class="btn btn-primary btn-sm">Subject</a>
                          <a style="margin-bottom: 5px;" href="{{ url('parent/my_student/exam_timetable/'.$value->id ) }}" class="btn btn-success btn-sm">Exam Timetable</a>
                          <a style="margin-bottom: 5px;" href="{{ url('parent/my_student/exam_result/'.$value->id ) }}" class="btn btn-primary btn-sm">Exam Result</a>
                          <a style="margin-bottom: 5px;" href="{{ url('parent/my_student/calendar/'.$value->id ) }}" class="btn btn-warning btn-sm">Timetable</a>
                          <a style="margin-bottom: 5px;" href="{{ url('parent/my_student/attendance/'.$value->id ) }}" class="btn btn-primary btn-sm">Attendance</a>
                          <a style="margin-bottom: 5px;" href="{{ url('parent/my_student/homework/'.$value->id ) }}" class="btn btn-success btn-sm">Homework</a>
                          <a style="margin-bottom: 5px;" href="{{ url('parent/my_student/submitted_homework/'.$value->id ) }}" class="btn btn-primary btn-sm">Submitted Homework</a>
                          <a style="margin-bottom: 5px;" href="{{ url('chat?receiver_id='.base64_encode($value->id)) }}" class=" btn btn-warning btn-sm">Message</i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
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