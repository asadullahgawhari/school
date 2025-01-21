  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>My Notice Board</h1>
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
                <div class="form-group col-sm-3">
                  <label>Title</label>
                  <input type="text" name="title" value="{{ Request::get('title') }}" class="form-control" placeholder="Search Title">
                </div>
                <div class="form-group col-sm-3">
                  <label>Notice Date From</label>
                  <input type="date" name="notice_date_form" value="{{ Request::get('notice_date_form') }}" class="form-control">
                </div>
                <div class="form-group col-sm-3">
                  <label>Notice Date To</label>
                  <input type="date" name="notice_date_to" value="{{ Request::get('notice_date_to') }}" class="form-control">
                </div>
                <div class="form-group col-sm-3">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('student/my_notice_board') }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
          @foreach($getRecord as $value)
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-body p-0">
                <div class="mailbox-read-info">
                  <h5>{{ $value->title }}</h5>
                  <h6><span class="mailbox-read-time float-right" style="font-weight: bold;">{{ date('d-m-Y', strtotime($value->notice_date)) }}</span></h6>
                </div>
                <div class="mailbox-read-message">
                  {!! $value->message !!}
                </div>
              </div>
            </div>
          </div>
          @endforeach

          <div style="padding: 10px;">
           {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->onEachSide(1)->links() !!}
          </div>

        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection