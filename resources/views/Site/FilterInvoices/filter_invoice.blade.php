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
            <h4 class="content-title mb-0 my-auto">Filteration</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Invoices</span>
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
                    <h4 class="card-title mg-b-0">{{ __('Role') }}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('invoice.search.result') }}" method="post">
                    @csrf
                    <div class="row mb-5">
                        <div class="col">
                            <!--placeholder-->
                            <div class="form-check">
                                <input type="radio" checked name="filter" class="form-check-input" id="radio_type"
                                    value="filter_by_type">
                                <label class="form-check-label" style="padding-right: 25px;" for="radio_type">
                                    Search By Invoice Type
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="filter" class="form-check-input" id="radio_number"
                                    value="filter_by_number">
                                <label class="form-check-label" style="padding-right: 25px;" for="radio_number">
                                    Search By Invoice Number
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="type">
                        <div class="col-4">
                            <label for="inputName" class="control-label">Invoices</label>
                            <select name="invoice" id="bank" class="form-control SlectBox">
                                <!--placeholder-->
                                <option value="all">All Invoices</option>
                                <option value="Paid">Paid Invoices</option>
                                <option value="Partially paid">Partial Paid Invoices</option>
                                <option value="Unpaid">Un-Paid Invoices</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="inputName" class="control-label">From</label>
                            <input type="date" class="form-control" id="inputName" name="From">
                        </div>
                        <div class="col-4">
                            <label for="inputName" class="control-label">To</label>
                            <input type="date" class="form-control" id="inputName" name="To">
                        </div>
                    </div>
                    <div class="row" style="display: none" id="number">
                        <div class="col-4">
                            <label for="inputName" class="control-label">Number Invoice</label>
                            <input type="text" class="form-control" id="inputName" name="invoice_number">
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            @if(session()->has('invoices'))
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
                                <th>{{ __('Created At') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (session('invoices') as $row => $invoice)
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
                                <td>{{ $invoice->created_at }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12">No Invoices ..</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
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
    $(function(){
$('#radio_type').on('click', function () {
    $('#type').show();
    $('#number').hide();
});
$('#radio_number').on('click', function () {
    $('#type').hide();
    $('#number').show();
});
})
</script>
@endsection