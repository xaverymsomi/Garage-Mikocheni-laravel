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
                                {{ trans('message.Import Data') }}</span></a>
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
                    <a href="{!! url('/import/vehicle') !!}" class="nav-link active"><span class="visible-xs"></span><i class="fa-solid fa-file-import fa-lg"></i><b> {{ trans('message.Import Vehicle') }}</b></a>
                    @endcan
                </li>
                <li class="nav-item">
                    @can('customer_add')
                    <a href="{!! url('/export') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="fa-solid fa-file-export fa-lg"></i><b> {{ trans('message.Export') }}</b></a>
                    @endcan
                </li>
            </ul>
            {{-- nav tabs new code end --}}
            <div class="x_panel">
                <div class="x_content">
                    <form id="import_form" action="" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="row col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5 form-group my-form-group has-feedback">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 mt-2" for="image">
                                    {{ trans('Select File') }} </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="file" id="" name="csv_file" class="form-control chooseImage" required>
                                </div>
                            </div>
                            <div class="row col-md-7 col-lg-7 col-xl-7 col-xxl-7 col-sm-7 col-xs-7 form-group my-form-group has-feedback">
                                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                                    <a class="btn btn-outline-primary btn-sm m-1" href="public/pdf/csv/users.csv" download><i class="fa fa-download" aria-hidden="true"></i> {{ trans('message.CSV Sample') }}</a>
                                    <a class="btn btn-outline-danger btn-sm m-1" href="public/pdf/csv/user_instructions.txt" target="_blank">{{ trans('message.instructions') }}</a>
                                    <!-- <a class="btn btn-outline-danger btn-sm m-1" href="public/pdf/csv/countries.csv" download>{{ trans('countries') }}</a>
                                    <a class="btn btn-outline-danger btn-sm m-1" href="public/pdf/csv/states.csv" download>{{ trans('states') }}</a>
                                    <a class="btn btn-outline-danger btn-sm m-1" href="public/pdf/csv/cities.csv" download>{{ trans('cities') }}</a>
                                    <a class="btn btn-outline-danger btn-sm m-1" href="public/pdf/csv/roles.csv" download>{{ trans('roles') }}</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 text-center">
                                    <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.Cancel') }}</a>
                                    <!-- <button type="submit" class="btn btn-success">{{ trans('message.Upload') }}</button> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content end -->

<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- For form field validate -->
{!! JsValidator::formRequest('App\Http\Requests\ImportDataFormRequest', '#import_form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection