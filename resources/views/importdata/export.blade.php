@extends('layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- page content -->

<div class="right_col" role="main" style="background-color: #e6e6e6;">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i><span class="titleup">&nbsp
                                {{ trans('message.Export Data') }}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
    </div>
    @include('success_message.message')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            {{-- nav tabs new code start --}}
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    @can('customer_add')
                    <a href="{!! url('/import/user') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="fa-solid fa-file-import fa-lg"></i><b> {{ trans('message.Import Users') }}</b></a>
                    @endcan
                </li>
                <li class="nav-item">
                    @can('customer_add')
                    <a href="{!! url('/import/vehicle') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="fa-solid fa-file-import fa-lg"></i><b> {{ trans('message.Import Vehicle') }}</b></a>
                    @endcan
                </li>
                <li class="nav-item">
                    @can('customer_add')
                    <a href="{!! url('/export') !!}" class="nav-link active"><span class="visible-xs"></span><i class="fa-solid fa-file-export fa-lg"></i><b> {{ trans('message.Export') }}</b></a>
                    @endcan
                </li>
            </ul>
            {{-- nav tabs new code end --}}
            <div class="x_panel">
                <div class="x_content">
                    <!-- <table id="datatable" class="table jambo_table" style="margin-top:20px;">
                        <thead>
                            <tr>
                                <td>{{ trans('Module Name') }}</td>
                                <td>{{ trans('message.Action') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('export') }}" method="post" enctype="multipart/form-data">
                                {{ @csrf_field() }}
                                <tr>
                                    <td><label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="user">
                                            {{ trans('User Data') }} </label>
                                    <td>
                                        <a href="{{ route('export', ['table' => 'users']) }}" class="btn btn-success btn-sm">{{ trans('Export') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="vehicle">
                                            {{ trans('Vehicle Data') }} </label></td>
                                    <td>
                                        <a href="{{ route('export', ['table' => 'tbl_vehicles']) }}" class="btn btn-success btn-sm">{{ trans('Export') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="vehicle">
                                            {{ trans('Vehicle Type') }} </label></td>
                                    <td>
                                        <a href="{{ route('export', ['table' => 'tbl_vehicle_types']) }}" class="btn btn-success btn-sm">{{ trans('Export') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="vehicle">
                                            {{ trans('Vehicle Brand') }} </label></td>
                                    <td>
                                        <a href="{{ route('export', ['table' => 'tbl_vehicle_brands']) }}" class="btn btn-success btn-sm">{{ trans('Export') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="vehicle">
                                            {{ trans('Fuel Type') }} </label></td>
                                    <td>
                                        <a href="{{ route('export', ['table' => 'tbl_fuel_types']) }}" class="btn btn-success btn-sm">{{ trans('Export') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="vehicle">
                                            {{ trans('Model Name') }} </label></td>
                                    <td>
                                        <a href="{{ route('export', ['table' => 'tbl_model_names']) }}" class="btn btn-success btn-sm">{{ trans('Export') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="vehicle">
                                            {{ trans('Branch') }} </label></td>
                                    <td>
                                        <a href="{{ route('export', ['table' => 'branches']) }}" class="btn btn-success btn-sm">{{ trans('Export') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="vehicle">
                                            {{ trans('Country') }} </label></td>
                                    <td>
                                        <a href="{{ route('export', ['table' => 'tbl_countries']) }}" class="btn btn-success btn-sm">{{ trans('Export') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="vehicle">
                                            {{ trans('City') }} </label></td>
                                    <td>
                                        <a href="{{ route('export', ['table' => 'tbl_cities']) }}" class="btn btn-success btn-sm">{{ trans('Export') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="vehicle">
                                            {{ trans('State') }} </label></td>
                                    <td>
                                        <a href="{{ route('export', ['table' => 'tbl_states']) }}" class="btn btn-success btn-sm">{{ trans('Export') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="vehicle">
                                            {{ trans('User Role') }} </label></td>
                                    <td>
                                        <a href="{{ route('export', ['table' => 'roles']) }}" class="btn btn-success btn-sm">{{ trans('Export') }}</a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content end -->

<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@endsection