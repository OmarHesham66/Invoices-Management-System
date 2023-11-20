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
				Details Invoices</span>
		</div>
	</div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
@if (session()->has('deleted'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>{{ session()->get('deleted') }}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif
<div class="col-xl-12">
	<!-- div -->
	<div class="card" id="tabs-style4">
		<div class="card-body">
			<div class="main-content-label mg-b-5">
				Vertical Tabs
			</div>
			<p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p>
			<div class="text-wrap">
				<div class="example">
					<div class="d-md-flex">
						<div class="">
							<div class="panel panel-primary tabs-style-4">
								<div class="tab-menu-heading">
									<div class="tabs-menu ">
										<!-- Tabs -->
										<ul class="nav panel-tabs ml-3">
											<li class=""><a href="#tab21" class="active" data-toggle="tab"><i
														class="fa fa-laptop"></i>{{ __('Invoice Information') }}</a>
											</li>
											<li><a href="#tab22" data-toggle="tab"><i class="fa fa-cube"></i>{{
													__('Invoice Transactions') }}</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="tabs-style-4 ">
							<div class="panel-body tabs-menu-body">
								<div class="tab-content">
									<div class="tab-pane active" id="tab21">
										<table class="table text-md-nowrap" id="example1">
											<tr>
												<th colspan="3" class="wd-15p border-bottom-0">{{ __('Invoice Number')
													}}</th>
												<td class="wd-15p border-bottom-0">
													{{ $invoice->invoice_number}}
												</td>
												<th colspan="3" class="wd-15p border-bottom-0">{{ __('Invoice Created
													At') }}
												</th>
												<td colspan="2" class="wd-15p border-bottom-0">{{
													$invoice->date_create_invoice
													}}</td>
												<th class="wd-20p border-bottom-0">{{ __('Status') }}</th>
												<td colspan="2" class="wd-15p border-bottom-0">
													@if ($invoice->status == "Paid")
													<span class="text-success">{{ $invoice->status }}</span>
													@elseif ($invoice->status == "Unpaid")
													<span class="text-danger">{{ $invoice->status }}</span>
													@else
													<span class="text-warning">{{ $invoice->status }}</span>
													@endif
												</td>
											</tr>
											<tr>
												<th colspan="2" class="wd-20p border-bottom-0">{{ __('Due Date') }}</th>
												<td colspan="2" class="wd-15p border-bottom-0">{{
													$invoice->due_date_invoice }}
												</td>
												<th class="wd-20p border-bottom-0">{{ __('Section') }}</th>
												<td class="wd-15p border-bottom-0">{{ $invoice->bank }}</td>
												<th class="wd-20p border-bottom-0">{{ __('Product') }}</th>
												<td class="wd-15p border-bottom-0">{{ $invoice->product }}</td>
												<th class="wd-20p border-bottom-0">{{ __('Collection') }}</th>
												<td class="wd-15p border-bottom-0">{{ $invoice->collection }}
												</td>
												<th class="wd-20p border-bottom-0">{{ __('Commission') }}</th>
												<td class="wd-15p border-bottom-0">{{ $invoice->commission }}
												</td>
											</tr>
											<tr>
												<th colspan="2" class="wd-20p border-bottom-0">{{ __('Discount') }}</th>
												<td class="wd-15p border-bottom-0">{{ $invoice->discount }}</td>
												<th colspan="2" class="wd-20p border-bottom-0">{{ __('Vat') }}</th>
												<td class="wd-15p border-bottom-0">{{ $invoice->vat }}</td>
												<th colspan="2" class="wd-20p border-bottom-0">{{ __('Total') }}</th>
												<td class="wd-15p border-bottom-0">{{ $invoice->total }}</td>
												<th colspan="2" class="wd-20p border-bottom-0">{{ __('Notes') }}</th>
												<td class="wd-15p border-bottom-0">{{ $invoice->notes }}</td>

											</tr>
											<tr>
												<th class="wd-20p border-bottom-0">{{ __('Attachment') }}</th>
												@if ($invoice->attachment)
												<td colspan="8" class="wd-15p border-bottom-0">{{ $invoice->attachment
													}}
												</td>
												<td class="wd-15p border-bottom-0"><a
														href="{{ route('file.show',$invoice->id) }}" target="_blank"
														class="btn btn-sm btn-outline-success">
														{{ __('Show') }}
													</a>
												</td>
												<td class="wd-15p border-bottom-0"><a
														href="{{ route('file.download',$invoice->id) }}" target="_blank"
														class="btn btn-sm btn-outline-warning">
														{{ __('Download') }}
													</a>
												</td>
												<td class="wd-15p border-bottom-0"><a
														href="{{ route('file.delete',$invoice->id) }}"
														class="btn btn-sm btn-outline-danger">
														{{ __('Delete') }}
													</a>
												</td>
												@else
												<td colspan="11">{{ __('No Attachment') }}</td>
												@endif
											</tr>
										</table>
									</div>
									<div class="tab-pane" id="tab22">
										<table class="table text-md-nowrap" id="example1">
											@foreach ($invoice->Details as $item)
											<tr>
												<th class="wd-20p border-bottom-0">{{ __('Invoice Number')
													}}</th>
												<td class="wd-15p border-bottom-0">{{ $invoice->invoice_number }}</td>
												<th class="wd-20p border-bottom-0">{{ __('Date Of Add') }}
												</th>
												<td class="wd-15p border-bottom-0">{{ $item->created_at }}
												</td>
												<th class="wd-20p border-bottom-0">{{ __('User') }}</th>
												<td class="wd-15p border-bottom-0">{{ $invoice->User->name
													}}</td>
												<th class="wd-20p border-bottom-0">{{ __('Status') }}</th>
												<td class="wd-15p border-bottom-0">
													@if ($item->status == "Paid")
													<span class="text-success">{{ $item->status }}</span>
													@elseif ($item->status == "Unpaid")
													<span class="text-danger">{{$item->status }}</span>
													@else
													<span class="text-warning">{{$item->status }}</span>
													@endif
												</td>
											</tr>
											@endforeach

										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
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
	}if ("{{ $errors->any() }}") {
	$('#success').text("{{ $errors->first() }}").css({'background':'red','color':'white'}).slideDown().delay(4000).slideUp();
	}
</script>
@endsection