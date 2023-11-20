@extends('Site.layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Edit Invoices</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<!-- row -->
{{-- @php
dd($errors->all());
@endphp --}}
<div class="row">

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('apply.status',$invoice->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    {{-- 1 --}}
                    <div class="row">
                        <div class="col-4">
                            <label>Invoice Date Created</label>
                            <input class="form-control fc-datepicker" name="date_create_invoice" readonly
                                placeholder="YYYY-MM-DD" type="date" value="{{$invoice->date_create_invoice}}">
                            <div>
                                @error('date_create_invoice')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <label>Due Date Invoice</label>
                            <input class="form-control fc-datepicker" value="{{$invoice->due_date_invoice}}"
                                name="due_date_invoice" placeholder="YYYY-MM-DD" type="date" readonly>
                            <div>
                                @error('due_date_invoice')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>
                    {{-- 2 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">Bank</label>
                            <select name="bank" id="bank" class="form-control" readonly>
                                <!--placeholder-->
                                <option value="{{ $invoice->bank }}">{{ $invoice->Bank->name }}</option>
                            </select>
                            <div>
                                @error('bank')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Product</label>
                            <select id="product" name="product" class="form-control" readonly>
                                <option value="{{ $invoice->product }}">{{ $invoice->Product->name }}</option>
                            </select>
                            <div>
                                @error('product')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Collection</label>
                            <input type="text" class="form-control" value="{{$invoice->collection}}" id="inputName"
                                name="collection" readonly>
                            <div>
                                @error('collection')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- 3 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">Commission</label>
                            <input type="text" name="commission" value="{{$invoice->commission}}"
                                class="form-control form-control-lg" id="Commission" readonly>
                            <div>
                                @error('commission')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <label for="inputName" class="control-label">Discount</label>
                            <input type="text" class="form-control form-control-lg" value="{{$invoice->discount}}"
                                id="Discount" value="0" name="discount" readonly>
                            <div>
                                @error('discount')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <label for="inputName" class="control-label">Precent Of
                                Vat</label>
                            <select name="vat" id="Rate_VAT" class="form-control" readonly>
                                <!--placeholder-->
                                <option value="">Select Precent</option>
                                <option @selected($invoice->vat == '0.05') value="0.05">5%</option>
                                <option @selected($invoice->vat == '0.10') value="0.10">10%</option>
                            </select>
                            <div>
                                @error('vat')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- 4 --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">Value Of
                                Vat</label>
                            @php
                            $value = ((float)$invoice->commission-(float)$invoice->discount) * (float)$invoice->vat;
                            @endphp
                            <input type="text" class="form-control" value="{{ $value }}" id="Value_VAT" readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Total After
                                Vat</label>
                            <input type="text" class="form-control" name="total" value="{{ $invoice->total }}"
                                id="Total" readonly>
                        </div>
                    </div>

                    {{-- 5 --}}
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">Notes</label>
                            <textarea class="form-control" id="exampleTextarea" value="{{$invoice->notes}}" name="notes"
                                rows="3" readonly></textarea>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">Status</label>
                            <select id="product" name="status" class="form-control">
                                <option @selected($invoice->status == "Paid") value="Paid">{{
                                    __('Paid') }}</option>
                                <option @selected($invoice->status == "Unpaid") value="Unpaid">{{
                                    __('Unpaid') }}</option>
                                <option @selected($invoice->status == "Partially paid") value="Partially paid">{{
                                    __("Partially paid") }}</option>
                            </select>
                            <div>
                                @error('status')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <label>Date</label>
                            <input class="form-control fc-datepicker" name="TimeOfChangeStatus" placeholder="YYYY-MM-DD"
                                type="date" value="{{ date('Y-m-d') }}">
                            <div>
                                @error('TimeOfChangeStatus')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
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
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/Culc_Invoice.js') }}"></script>
@endsection