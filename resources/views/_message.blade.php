@if(!empty(session('success')))
	<div class="alert alert-success" role="alert">
		<button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ session('success') }}
	</div>
@endif

@if(!empty(session('error')))
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ session('error') }}
	</div>
@endif

@if(!empty(session('danger')))
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ session('danger') }}
	</div>
@endif