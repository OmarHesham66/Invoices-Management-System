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
            <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Add Users</span>
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
@endif
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <label for="inputName" class="control-label">Name</label>
                            <input type="text" class="form-control" id="inputName" name="name"
                                value="{{ old('name') }}">
                            <div>
                                @error('name')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="inputName" class="control-label">Email</label>
                            <input type="text" class="form-control" id="inputName" name="email"
                                value="{{ old('email') }}">
                            <div>
                                @error('email')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="inputName" class="control-label">Password</label>
                            <input type="password" class="form-control" id="inputName" name="password"
                                value="{{ old('password') }}">
                            <div>
                                @error('password')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="inputName" class="control-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                value="{{ old('password_confirmation') }}">
                            <div>
                                @error('password_confirmation')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">Role</label>
                            <select name="role[]" class="form-control" multiple>
                                <!--placeholder-->
                                @foreach ($roles as $role)
                                <option @selected(old("role")==$role->name) value="{{ $role->name }}"> {{
                                    $role->name }}</option>
                                @endforeach
                            </select>
                            <div>
                                @error('role')
                                <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
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
@endsection