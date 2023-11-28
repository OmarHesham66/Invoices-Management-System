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
        <div class="col-sm-6 col-md-4 col-xl-2 mb-2">
            <a href="{{ route('user.create') }}" class="modal-effect btn btn-outline-primary btn-block">
                Add User</a>
        </div>
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
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">{{ __('Name') }}</th>
                                <th class="wd-15p border-bottom-0">{{ __('Email') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Photo') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Status') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Role') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Careated At') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $row => $user)
                            <tr>
                                <th class="wd-15p border-bottom-0">{{ $row +1 }}</th>
                                <th class="wd-15p border-bottom-0">{{ $user->name }}</th>
                                <th class="wd-15p border-bottom-0">{{ $user->email }}</th>
                                <th class="wd-15p border-bottom-0"><img src="{{ asset($user->photo) }}" width="45px"
                                        height="45px"></th>
                                <th class="wd-15p border-bottom-0">{{ $user->status }}</th>
                                <th class="wd-15p border-bottom-0">[{{ implode(' ,
                                    ',$user->roles()->pluck('name')->toArray()) }}]</th>
                                <th class="wd-15p border-bottom-0">{{ $user->created_at }}</th>
                                <th class="wd-15p border-bottom-0">
                                    <a class="modal-effect btn btn-sm btn-info"
                                        href="{{ route('user.edit',$user->id) }}"><i class="las la-pen"></i>
                                    </a>
                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                        data-toggle="modal" href="#modaldemo{{ $row }}"><i class="las la-trash"></i></a>
                                    <div class="modal" id="modaldemo{{ $row }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Delete User</h6><button aria-label="Close"
                                                        class="close" data-dismiss="modal" type="button"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('user.destroy',$user->id) }}" method="POST">
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
                                </th>
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