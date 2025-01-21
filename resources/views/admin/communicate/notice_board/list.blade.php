  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notice Board </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/communicate/notice_board/add') }}" class="btn btn-primary">Add Notice Board</a>
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
                  <label>Title</label>
                  <input type="text" name="title" value="{{ Request::get('title') }}" class="form-control" placeholder="Search Title">
                </div>
                <div class="form-group col-sm-2">
                  <label>Notice Date From</label>
                  <input type="date" name="notice_date_form" value="{{ Request::get('notice_date_form') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <label>Notice Date To</label>
                  <input type="date" name="notice_date_to" value="{{ Request::get('notice_date_to') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <label>Publish Date From</label>
                  <input type="date" name="publish_date_from" value="{{ Request::get('publish_date_from') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <label>Publish Date To</label>
                  <input type="date" name="publish_date_to" value="{{ Request::get('publish_date_to') }}" class="form-control">
                </div>
                <div class="form-group col-sm-1">
                  <label>Message To</label>
                  <select name="message_to" class="form-control">
                    <option value="">Select</option>
                    <option {{ (Request::get('message_to') == 2) ? 'selected' : '' }} value="2">Teacher</option>
                    <option {{ (Request::get('message_to') == 3) ? 'selected' : '' }} value="3">Student</option>
                    <option {{ (Request::get('message_to') == 4) ? 'selected' : '' }} value="4">Parent</option>
                  </select>
                </div>
                <div class="form-group col-sm-1">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('admin/communicate/notice_board') }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
                <h3 class="card-title">Notice Board List </h3>
              </div>
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Notice Date</th>
                      <th>Publish Date</th>
                      <th>Message To</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Action</th>
                   </tr>
                  </thead>
                  <tbody>
                    @forelse($getRecord as $value)
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->title }}</td>
                      <td>{{ date('d-m-Y', strtotime($value->notice_date)) }}</td>
                      <td>{{ date('d-m-Y', strtotime($value->publish_date)) }}</td>
                      <td>
                        @foreach($value->getMessage as $message)
                          @if($message->message_to == 2)
                            <div>Teacher</div>
                          @elseif($message->message_to == 3)
                            <div>Student</div>
                          @elseif($message->message_to == 4)
                            <div>Parent</div>
                          @endif
                        @endforeach
                      </td>
                      <td>{{ $value->created_by_name }}</td>
                      <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                      <td style="min-width: 120px;">
                        <a href="{{ url('admin/communicate/notice_board/edit/'.$value->id ) }}" class="btn btn-primary btn-sm fas fa-edit"></a>
                        <a href="{{ url('admin/communicate/notice_board/delete/'.$value->id ) }}" class=" btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                      </td>
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