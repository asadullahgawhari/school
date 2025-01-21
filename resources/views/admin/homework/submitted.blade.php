  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Submitted Homework </h1>
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
                  <label>Student First Name</label>
                  <input type="text" name="first_name" value="{{ Request::get('first_name') }}" class="form-control" placeholder="Student First Name">
                </div>
                <div class="form-group col-sm-2">
                  <label>Student Last Name</label>
                  <input type="text" name="last_name" value="{{ Request::get('last_name') }}" class="form-control" placeholder="Student Last Name">
                </div>
                <div class="form-group col-sm-2">
                  <label>From Created Date</label>
                  <input type="date" name="from_created_date" value="{{ Request::get('from_created_date') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <label>To Created Date</label>
                  <input type="date" name="to_created_date" value="{{ Request::get('to_created_date') }}" class="form-control">
                </div>
                <div class="form-group col-sm-2">
                  <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fas fa-search"></i></button>
                  <a href="{{ url('admin/homework/homework/submitted/'.$homework_id) }}" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-home"></i></a>
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
                <h3 class="card-title">Submitted Homework List </h3>
              </div>
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Student Name</th>
                      <th>Document</th>
                      <th>Description</th>
                      <th>Created Date</th>
                   </tr>
                  </thead>
                  <tbody>
                    @forelse($getRecord as $value)
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                      
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