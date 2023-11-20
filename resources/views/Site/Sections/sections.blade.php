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
				All Sections</span>
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
							<h6 class="modal-title">Create Section</h6><button aria-label="Close" class="close"
								data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="{{ route('sections.store') }}" method="post">
								@csrf
								<div class="form-group">
									<label class="form-label mg-b-0">Section Name</label>
									<input class="form-control" name="name" placeholder="Enter Section Name"
										type="text">
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
					<h4 class="card-title mg-b-0">{{ __('Sections') }}</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-md-nowrap" id="example1">
						<thead>
							<tr>
								<th class="wd-15p border-bottom-0">#</th>
								<th class="wd-15p border-bottom-0">{{ __('Section Number') }}</th>
								<th class="wd-15p border-bottom-0">{{ __('Section Describtion') }}</th>
								<th class="wd-20p border-bottom-0">{{ __('User') }}</th>
								<th class="wd-15p border-bottom-0">{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($sections as $row => $section)
							<tr>
								<td>{{ $row +1 }}</td>
								<td>{{ $section->name }}</td>
								<td>{{ $section->describtion }}</td>
								<td>{{ $section->User->name }}</td>
								<td>
									<a class="modal-effect btn btn-sm btn-info" data-effect="effect-just-me"
										data-toggle="modal" href="#modaldemo{{ $row }}"><i class="las la-pen"></i>
									</a>
									<div class="modal" id="modaldemo{{ $row }}">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content modal-content-demo">
												<div class="modal-header">
													<h6 class="modal-title">Update Section</h6><button
														aria-label="Close" class="close" data-dismiss="modal"
														type="button"><span aria-hidden="true">&times;</span></button>
												</div>
												<div class="modal-body">
													<form action="{{ route('sections.update',$section->id) }}"
														method="post">
														@method('patch')
														@csrf
														{{-- <input type="hidden" name="id" value="{{  }}"> --}}
														<div class="form-group">
															<label class="form-label mg-b-0">Section Name</label>
															<input class="form-control" name="name"
																placeholder="Enter Section Name" type="text"
																value="{{ $section->name }}">
														</div>
														<div class="form-group">
															<label class="form-label mg-b-0">Describtion</label>
															<textarea class="form-control" name="describtion"
																placeholder="Enter Section Describtion"
																rows="5">{{ $section->describtion }}</textarea>
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
dd(session()->get('success'));
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
	if ("{{ session()->has('success') }}") {
	$('#success').text("{{ session()->get('success') }}").slideDown().delay(4000).slideUp();
	}if ("{{ session()->has('update') }}") {
	$('#success').text("{{ session()->get('update') }}").slideDown().delay(4000).slideUp();
	}if ("{{ $errors->any() }}") {
	$('#success').text("{{ $errors->first() }}").css({'background':'red','color':'white'}).slideDown().delay(4000).slideUp();
	}
</script>
@endsection