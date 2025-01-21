  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>My Submitted Homework </h1>
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
                  <label>Class</label>
                  <input type="text" name="class_name" value="{{ Request::get('class_name') }}" class="form-control" placeholder="Search Class Name">
                </div>
                <div class="form-group col-sm-2">
                  <label>Subject</label>
                  <input type="text" name="subject_name" value="{{ Request::get('subject_name') }}" class="form-control" placeholder="Search Subject Name">
                </div>
                <div class="form-group col-sm-2">
                  <label>From Homework Date</label>
                  <input type="date" name="from_homework_date" value="{{ Request::get('from_homework_date') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <label>To Homework Date</label>
                  <input type="date" name="to_homework_date" value="{{ Request::get('to_homework_date') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <label>From Submission Date</label>
                  <input type="date" name="from_submission_date" value="{{ Request::get('from_submission_date') }}" class="form-control">
                </div>

                <div class="form-group col-sm-2">
                  <label>To Submission Date</label>
                  <input type="date" name="to_submission_date" value="{{ Request::get('to_submission_date') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <label>From Submitted Date</label>
                  <input type="date" name="from_created_at" value="{{ Request::get('from_created_at') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <label>To Submitted Date</label>
                  <input type="date" name="to_created_at" value="{{ Request::get('to_created_at') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('student/my_submitted_homework') }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Submitted Homework </h3>
              </div>
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Class</th>
                      <th>Subject</th>
                      <th>Homework Date</th>
                      <th>Submission Date</th>
                      <th>Document</th>
                      <th>Description</th>
                      <th>Created Date</th>
                      <th>Submitted Document</th>
                      <th>Submitted Description</th>
                      <th>Submitted Created Date</th>
                   </tr>
                  </thead>
                  <tbody>
                   @forelse($getRecord as $value)
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->class_name }}</td>
                      <td>{{ $value->subject_name }}</td>
                      <td>{{ date('d-m-Y', strtotime($value->getHomework->homework_date)) }}</td>
                      <td>{{ date('d-m-Y', strtotime($value->getHomework->submission_date)) }}</td>
                      <td>
                        @if(!empty($value->getHomework->getDocument()))
                          <a href="{{ $value->getDocument() }}" class="btn btn-primary" download="">Download</a>
                        @endif
                      </td>
                      <td>{!! $value->description !!}</td>
                      <td>{{ date('d-m-Y', strtotime($value->getHomework->created_at)) }}</td>

                      <td>
                        @if(!empty($value->getDocument()))
                          <a href="{{ $value->getDocument() }}" class="btn btn-primary" download="">Download</a>
                        @endif
                      </td>
                      <td>{!! $value->description !!}</td>
                      <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                    </tr>
                    @empty
                      <tr>
                        <td colspan="100%">Record not found</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
                <div style="padding: 10px;">
                 {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->onEachSide(1)->links() !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  @endsection