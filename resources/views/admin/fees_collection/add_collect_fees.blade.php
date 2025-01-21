  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Collect Fees </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <button type="button" class="btn btn-primary" id="AddFees">Add Fees</button>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Payment Detail - {{ $getStudent->name }} {{ $getStudent->last_name }}</h3>
              </div>
              <div class="card-body p-0" style="overflow-x:auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Class Name</th>
                      <th>Total Amount</th>
                      <th>Paid Amount</th>
                      <th>Remaning Amount</th>
                      <th>Payment Type</th>
                      <th>Remark</th>
                      <th>Created By</th>
                      <th>Created Date</th> 
                   </tr>
                  </thead>
                  <tbody>
                    @forelse($getFees as $vlaue)
                    <tr>
                      <td>{{ $vlaue->class_name }}</td>
                      <td>{{ number_format($vlaue->total_amount, 2) }}$</td>
                      <td>{{ number_format($vlaue->paid_amount, 2) }}$</td>
                      <td>{{ number_format($vlaue->remaning_amount, 2) }}$</td>
                      <td>{{ $vlaue->payment_type }}</td>
                      <td>{{ $vlaue->remark }}</td>
                      <td>{{ $vlaue->created_by_name }}</td>
                      <td>{{ date('d-m-Y', strtotime($vlaue->created_at)) }}</td>
                    </tr>
                    @empty
                      <tr>
                        <td colspan="100%">Record not fount</td>
                      </tr>
                    @endforelse
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

  <div class="modal fade" id="AddFeesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Fees</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          {{ csrf_field() }}
          <div class="modal-body">
            <div class="form-group">
              <label class="col-form-label">Class Name: {{ $getStudent->class_name }}</label>
            </div>
            <div class="form-group">
              <label class="col-form-label">Total Amount: {{ number_format($getStudent->amount, 2) }}$</label>
            </div>
            <div class="form-group">
              <label class="col-form-label">Paid Amount: {{ number_format($paid_amount, 2) }}$</label>
            </div>
            <div class="form-group">
              @php
                $RemaningAmount = $getStudent->amount - $paid_amount;
              @endphp
              <label class="col-form-label">Remaning Amount: {{ number_format($RemaningAmount, 2) }}$</label>
            </div>
            <div class="form-group">
              <label class="col-form-label">Amount <span style="color: red;">*</span></label>
              <input type="number" class="form-control" name="amount">
            </div>
            <div class="form-group">
              <label class="col-form-label">Payment Type <span style="color: red;">*</span></label>
              <select class="form-control" name="payment_type" required>
                <option value="">Select</option>
                <option value="cash">Cash</option>
                <option value="cheque">Cheque</option>
              </select>
            </div>
            <div class="form-group">
              <label class="col-form-label">Remark</label>
              <textarea class="form-control" name="remark"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @endsection

  @section('script')
  <script type="text/javascript">
    $('#AddFees').click(function(){
      $('#AddFeesModal').modal('show');
    });
  </script>
  @endsection