@extends('Site.layouts.master')
@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
				List Invoices</span>
		</div>
	</div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{ session()->get('success') }}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@if (session()->has('update'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
	<strong>{{ session()->get('update') }}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif
@endif
@if (session()->has('database'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>{{ session()->get('database') }}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif
<div class="row row-sm">
	<!--div-->
	<div class="col-xl-12">
		@if (URL::current()!=url('/archive/invoices'))
		<div class="col-sm-6 col-md-4 col-xl-2 mb-2">
			<a href="{{ route('invoice.create') }}" class="modal-effect btn btn-outline-primary btn-block">Add New
				Invoice</a>
		</div>
		@endif
		<div class="card">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">{{ __('Invoices') }}</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-md-nowrap" id="example1">
						<thead>
							<tr>
								<th>#</th>
								<th>{{ __('Invoice Number') }}</th>
								<th>{{ __('Invoice Created At') }}</th>
								<th>{{ __('Due Date') }}</th>
								<th>{{ __('Status') }}</th>
								<th>{{ __('Product') }}</th>
								<th>{{ __('Section') }}</th>
								<th>{{ __('Discount') }}</th>
								<th>{{ __('Vat') }}</th>
								<th>{{ __('Total') }}</th>
								<th>{{ __('Notes') }}</th>
								<th>{{ __('Actions') }}</th>
								{{-- <th>{{ __('Delete') }}</th> --}}
							</tr>
						</thead>
						<tbody>
							@foreach ($invoices as $row => $invoice)
							<tr>
								<th>{{ $row +1 }}</th>
								<td>
									<a href="{{ route('invoice.details',$invoice->id) }}">
										{{ $invoice->invoice_number}}</a>
								</td>
								<td>{{ $invoice->date_create_invoice }}</td>
								<td>{{ $invoice->due_date_invoice }}</td>
								<td>
									@if ($invoice->status == "Paid")
									<span class="text-success">{{ $invoice->status }}</span>
									@elseif ($invoice->status == "Unpaid")
									<span class="text-danger">{{ $invoice->status }}</span>
									@else
									<span class="text-warning">{{ $invoice->status }}</span>
									@endif
								</td>
								<td>{{ $invoice->Product->name }}</td>
								<td>{{ $invoice->Bank->name }}</td>
								<td>{{ $invoice->discount }}</td>
								<td>{{ $invoice->vat }}</td>
								<td>{{ $invoice->total }}</td>
								<td>{{ $invoice->notes }}</td>
								@if (URL::current()!=url('/archive/invoices'))
								<td>
									<a class="modal-effect btn btn-sm btn-info"
										href="{{ route('invoice.edit',$invoice->id) }}"><i class="las la-pen"></i>
									</a>
									<a class="modal-effect btn btn-sm btn-info"
										href="{{ route('show.status',$invoice->id) }}">{{ __('Change Status') }}</i>
									</a>
									<a class="modal-effect btn btn-sm btn-info"
										href="{{ route('invoice.archive',$invoice->id) }}">{{ __('Archive Invoice')
										}}</i>
									</a>
									<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
										data-toggle="modal" href="#modaldemo{{ $row }}"><i class="las la-trash"></i></a>
									<div class="modal" id="modaldemo{{ $row }}">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content modal-content-demo">
												<div class="modal-header">
													<h6 class="modal-title">Delete Invoice</h6><button
														aria-label="Close" class="close" data-dismiss="modal"
														type="button"><span aria-hidden="true">&times;</span></button>
												</div>
												<div class="modal-footer">
													<form action="{{ route('invoice.destroy',$invoice->id) }}"
														method="POST">
														@csrf
														@method('delete')
														<button class="btn ripple btn-danger" type="submit">Delete
														</button>
													</form>
													<button class="btn ripple btn-secondary" data-dismiss="modal"
														type="button">Close</button>
												</div>
											</div>
										</div>
									</div>
									<a class="modal-effect btn btn-sm btn-info" href="{{ route('show.print') }}">{{
										__('Print Invoice')
										}}</i>
									</a>
								</td>
								@else
								<td>
									<a class="modal-effect btn btn-sm btn-info"
										href="{{ route('invoices.edit',$invoice->id) }}">{{ __('Un-Archive Invoice')
										}}</i>
									</a>
								</td>
								@endif
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--/div-->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
	if ("{{ session('success') }}") {
	$('#success').text("{{ session('success') }}").slideDown().delay(4000).slideUp();
	}if ("{{ session('update') }}") {
	$('#success').text("{{ session('update') }}").slideDown().delay(4000).slideUp();
	}if ("{{ session('database') }}") {
	$('#success').text("{{ session('database') }}").slideDown().delay(4000).slideUp();
	}if ("{{ $errors->any() }}") {
	$('#success').text("{{ $errors->first() }}").css({'background':'red','color':'white'}).slideDown().delay(4000).slideUp();
	}
</script>
@endsection