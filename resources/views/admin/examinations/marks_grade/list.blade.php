  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Marks Grade </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/examinations/marks_grade/add') }}" class="btn btn-primary">Add Marks Grade</a>
          </div>
        </div>
      </div>
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
                <h3 class="card-title">Marks Grade List </h3>
              </div>
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Grade Name</th>
                      <th>Percent From</th>
                      <th>Percent To</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Updated Date</th>
                      <th>Action</th> 
                   </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                      <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->percent_from }}</td>
                        <td>{{ $value->percent_to }}</td>
                        <td>{{ $value->created_by_name }}</td>
                        <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                        <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td>
                        <td style="min-width: 120px;">
                          <a href="{{ url('admin/examinations/marks_grade/edit/'.$value->id ) }}" class="btn btn-primary btn-sm fas fa-edit"></a>
                          <a href="{{ url('admin/examinations/marks_grade/delete/'.$value->id ) }}" class=" btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                      @endforeach
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection