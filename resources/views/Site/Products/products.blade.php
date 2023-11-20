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
			<h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
				All Products</span>
		</div>
	</div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm ">
	<!--div-->
	<div class="col-xl-12">
		<div class="d-flex">
			<div class="col-sm-6 col-md-4 col-xl-1 mb-2">
				<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal"
					href="#modaldemo">Create</a>
			</div>
			<div class="modal" id="modaldemo">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">Create Product</h6><button aria-label="Close" class="close"
								data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="{{ route('products.store') }}" method="post">
								@csrf
								<div class="form-group">
									<label class="form-label mg-b-0">Product Name</label>
									<input class="form-control" name="name" placeholder="Enter Section Name"
										type="text">
								</div>
								<div class="input-group mb-3">
									<select class="form-select" name="Bank" id="inputGroupSelect01">
										<option value="">Select Bank ...</option>
										@foreach ($sections as $section)
										<option value="{{ $section->id }}">
											{{ $section->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="form-label mg-b-0">Describtion</label>
									<textarea class="form-control" name="describtion"
										placeholder="Enter Section Describtion" rows="5"></textarea>
								</div>
								<button class="btn ripple btn-outline-success" type="submit">Save</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-3 mb-3"
				style="display:none;margin-right:25%;background:chartreuse;padding:20px;text-align:center" id="success">
			</div>
		</div>
		<div class="card">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">{{ __('Products') }}</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-md-nowrap" id="example1">
						<thead>
							<tr>
								<th class="wd-15p border-bottom-0">#</th>
								<th class="wd-15p border-bottom-0">{{ __('Product Name') }}</th>
								<th class="wd-15p border-bottom-0">{{ __('Product Describtion') }}</th>
								<th class="wd-20p border-bottom-0">{{ __('Bank') }}</th>
								<th class="wd-15p border-bottom-0">{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($products as $row => $product)
							<tr>
								<td>{{ $row +1 }}</td>
								<td>{{ $product->name }}</td>
								<td>{{ $product->describtion }}</td>
								<td>{{ $product->NameS }}</td>
								<td>
									<a class="modal-effect btn btn-sm btn-info" data-effect="effect-just-me"
										data-toggle="modal" href="#modaldemo{{ $row }}"><i class="las la-pen"></i>
									</a>
									<div class="modal" id="modaldemo{{ $row }}">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content modal-content-demo">
												<div class="modal-header">
													<h6 class="modal-title">Update Product</h6><button
														aria-label="Close" class="close" data-dismiss="modal"
														type="button"><span aria-hidden="true">&times;</span></button>
												</div>
												<div class="modal-body">
													<form action="{{ route('products.update',$product->id) }}"
														method="post">
														@method('patch')
														@csrf
														<div class="form-group">
															<label class="form-label mg-b-0">Section Name</label>
															<input class="form-control" name="name"
																placeholder="Enter Product Name" type="text"
																value="{{ $product->name }}">
														</div>
														<div class="form-group">
															<label class="form-label mg-b-0">Describtion</label>
															<textarea class="form-control" name="describtion"
																placeholder="Enter Product Describtion"
																rows="5">{{ $product->describtion }}</textarea>
														</div>
														<div class="form-group">
															<label class="form-label mg-b-0">Bank</label>
															<select class="form-select" name="Bank"
																aria-label="Default select example">
																@foreach ($sections as $section)
																<option value="{{ $section->id }}" @selected( $product->
																	NameS==$section->name)>
																	{{ $section->name }}
																</option>
																@endforeach
															</select>
														</div>
														<button class="btn ripple btn-outline-success"
															type="submit">Save</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-just-me"
										data-toggle="modal" href="#modaldemo8"><i class="las la-trash"></i>
									</a>
								</td>
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
{{-- @php
dd(session()->exists('success'));
@endphp --}}
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
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
	if ("{{ session('success') }}") {
	$('#success').text("{{ session('success')}}").slideDown().delay(4000).slideUp();
	}if ("{{ session('update') }}") {
	$('#success').text("{{ session('update') }}").slideDown().delay(4000).slideUp();
	}if ("{{ $errors->any() }}") {
	$('#success').text("{{ $errors->first() }}").css({'background':'red','color':'white'}).slideDown().delay(4000).slideUp();
	}
</script>
@endsection