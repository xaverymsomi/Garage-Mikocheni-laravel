@extends('layouts.app')

@section('content')


  <div class="right_col"
    role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>{{ trans('message.Add VehicalDiscriptions') }}</h3>
        </div>


      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_content">
            <div class="x_title">
              <ul class="nav nav-tabs"
                role="tablist">
                <li role="presentation"
                  class=""><a href="{!! url('/vehicaldiscriptions/list') !!}"><span class="visible-xs"><i
                        class="ti-info-alt"></i></span> {{ trans('message.VehicalDiscriptions List') }}</a></li>
                <li role="presentation"
                  class="active"><a href="{!! url('/vehicaldiscriptions/add') !!}"><span class="visible-xs"><i
                        class="ti-info-alt"></i></span> {{ trans('message.Add VehicalDiscriptions') }}</a></li>
              </ul>

              <div class="clearfix"></div>
            </div>

            <div class="x_panel">
              <br />
              <form action="{{ url('/vehicaldiscriptions/store') }}"
                method="post"
                enctype="multipart/form-data"
                data-parsley-validate
                class="form-horizontal form-label-left">

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"
                    for="first-name">Vehical Name <label class="text-danger">*</label>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="vehicaltypes"
                      class="form-control col-md-7 col-xs-12">
                      <option value="">{{ trans('message.Select Vehical name') }}</option>
                      @if (!empty($vehicalname))
                        @foreach ($vehicalname as $vehicalnames)
                          <option value="{{ $vehicalnames->id }}">{{ $vehicalnames->modelname }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"
                    for="first-name">{{                     for="first-name">trans('message.Vehical Discriptions') }} <label
                      class="text-danger">*</label>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text"
                      required="required"
                      name="vehicaldescription"
                      placeholder="{{ trans('message.Enter Vehical Discriptions') }} "
                      class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <input type="hidden"
                  name="_token"
                  value="{{ csrf_token() }}">
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button class="btn btn-primary"
                      type="button">{{ trans('message.Cancel') }}</button>

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

@endsection
