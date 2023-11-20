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
            <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                All Users</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm">
    <!--div-->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">{{ __('Users') }}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">{{ __('Invoice Number') }}</th>
                                <th class="wd-15p border-bottom-0">{{ __('Invoice Created At') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Due Date') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Status') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Product') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Section') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Vat') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Discount') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Total') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Notes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $row => $invoice)
                            <tr>
                                <th class="wd-15p border-bottom-0">{{ $row +1 }}</th>
                                <th class="wd-15p border-bottom-0">{{ $invoice->invoice_number }}</th>
                                <th class="wd-15p border-bottom-0">{{ $invoice->date_create_invoice }}</th>
                                <th class="wd-15p border-bottom-0">{{ $invoice->due_date_invoice }}</th>
                                <th class="wd-15p border-bottom-0">{{ $invoice->status }}</th>
                                <th class="wd-15p border-bottom-0">{{ $invoice->product }}</th>
                                <th class="wd-15p border-bottom-0">{{ $invoice->section }}</th>
                                <th class="wd-15p border-bottom-0">{{ $invoice->vat }}</th>
                                <th class="wd-15p border-bottom-0">{{ $invoice->discount }}</th>
                                <th class="wd-15p border-bottom-0">{{ $invoice->total }}</th>
                                <th class="wd-15p border-bottom-0">{{ $invoice->notes }}</th>
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
@endsection