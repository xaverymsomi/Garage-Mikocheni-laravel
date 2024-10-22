@extends('layouts.app')
@section('content')
  <!-- page content -->
  <div class="right_col"
    role="main">
    <div class="">
      <div class="page-title">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"> </i><span class="titleup">&nbsp;
                  {{ trans('Labour Hours') }}</span></a>
            </div>
            @include('dashboard.profile')
          </nav>
        </div>
        @if (session('message'))
          <div class="row massage">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="checkbox checkbox-success checkbox-circle mb-2 alert alert-success alert-dismissible fade show">
                <input id="checkbox-10"
                  type="checkbox"
                  checked="">
                <label for="checkbox-10 colo_success" style="margin-left: 20px;font-weight: 600;"> {{ session('message') }} </label>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 1rem 0.75rem;"></button>

              </div>
            </div>
          </div>
        @endif
      </div>
      <div class="x_content">
        <ul class="nav nav-tabs bar_tabs"
          role="tablist">
          <li role="presentation"
            class=""><a href="{!! url('/labor_hour/list') !!}"><span class="visible-xs"></span> <i
                class="fa fa-list fa-lg">&nbsp;</i>{{ trans('List Of Inspection Product') }}</span></a></li>

          <li role="presentation"
            class="active"><a href="{!! url('/labor_hour/add') !!}"><span class="visible-xs"></span> <i
                class="fa fa-plus-circle fa-lg">&nbsp;</i><b>{{ trans('Add Hours') }}</b></span></a></li>

        </ul>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">

            <div class="x_content">


              <form method="post"
                action="{!! url('/labor_hour/store') !!}"
                enctype="multipart/form-data"
                class="form-horizontal upperform">

                <div class="row row-mb-0">
                  <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('Body Type Name') }} <label class="color-danger">*</label></label>

                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                        <select class="form-control select_branch form-select" name="vehicleType">
                            <option value="">{{ trans('Body Type') }}</option>
                            @if (!empty($body_type))
                            @foreach ($body_type as $body_types)
                            <option value="{{ $body_types->vehicle_type }}">
                                {{ $body_types->vehicle_type }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                  </div>
                  <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('Model Name') }} <label class="color-danger">*</label></label>

                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                        <select class="form-control select_branch form-select" name="modelName">
                            <option value="">{{ trans('Model Name') }}</option>
                            @if (!empty($model_name))
                            @foreach ($model_name as $model_names)
                            <option value="{{ $model_names->model_name }}">
                                {{ $model_names->model_name }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                  </div>
                </div>

                <div class="row row-mb-0">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('Body Part Names') }} <label class="color-danger">*</label></label>

                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                            <select class="form-control select_branch form-select" name="name">
                                <option value="">{{ trans('Body Part') }}</option>
                                @if (!empty($library))
                                @foreach ($library as $libraries)
                                <option value="{{ $libraries->name }}">
                                    {{ $libraries->name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('Time/Hours') }} <label class="color-danger">*</label></label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                            <input type="number" id="jobno" name="hours" class="form-control" value="" placeholder="Enter Labour hour">
                        </div>
                    </div>
                </div>

                <input type="hidden"
                  name="_token"
                  value="{{ csrf_token() }}">

                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                    <button type="submit"
                      class="btn btn-success">{{ trans('message.Submit') }}</button>
                  </div>
                </div>

              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"
    src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
@endsection
