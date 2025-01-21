  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Setting</h1>
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
            <div class="card card-primary">
              <form method="post" action="" enctype="multipart/form-data">
                <!--CSRF is Outputs a hidden <input> element with the name _token and the value of this token OR token with every POST, PUT, PATCH, or DELETE request -->
                {{ csrf_field() }}
                <div class="card-body">
                  
                  <div class="form-group">
                    <label>Paypal Business Email </label>
                    <input type="email" name="paypal_email" required class="form-control" value="{{ $getRecord->paypal_email }}" placeholder="Paypal Business Email">
                  </div>
                  <div class="form-group">
                    <label>Stripe Public Key </label>
                    <input type="text" name="stripe_key" class="form-control" value="{{ $getRecord->stripe_key }}">
                  </div>
                  <div class="form-group">
                    <label>Stripe Secret Key </label>
                    <input type="text" name="stripe_secret" class="form-control" value="{{ $getRecord->stripe_secret }}">
                  </div>

                  <div class="form-group col-sm-12">
                      <label>Logo </label>
                      <input type="file" name="logo" value="{{ old('logo') }}" class="form-control">
                      @if(!empty($getRecord->getLogo()))
                        <img src="{{ $getRecord->getLogo() }}" style="width: 100px;">
                      @endif
                  </div>

                  <div class="form-group col-sm-12">
                      <label>Fevicon </label>
                      <input type="file" name="fevicon" value="{{ old('fevicon') }}" class="form-control">
                      @if(!empty($getRecord->getFevicon()))
                        <img src="{{ $getRecord->getFevicon() }}" style="width: 100px;">
                      @endif
                  </div>
                  <div class="form-group">
                    <label>School Name </label>
                    <input type="text" name="school_name" class="form-control" value="{{ $getRecord->school_name }}">
                  </div>
                  <div class="form-group">
                    <label>Exam Description </label>
                    <textarea style="height: 150px;" class="form-control" name="exam_description">{{ $getRecord->exam_description }}</textarea>
                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection