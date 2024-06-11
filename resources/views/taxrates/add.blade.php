@extends('layouts.app')
@section('content')
<!-- page content start-->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
           <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/taxrates/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                {{ trans('message.Add Account Tax') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
    @include('success_message.message')
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
          <div class="x_panel">
            <br />
            <form action="{{ url('/taxrates/store') }}" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left" id="tax-rates-add-form">

              <div class="row form-group row-mb-0">
                <label class="control-label col-md-2 col-sm-2 col-xs-10" for="first-name">{{ trans('message.Tax name') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-10">
                  <input type="text" required="required" name="taxrate" placeholder="{{ trans('message.Enter Tax Name') }}" value="{{ old('taxrate') }}" class="form-control col-md-7 col-xs-12" maxlength="20">
                </div>
              </div>
              <div class="row form-group row-mb-0">
                <label class="control-label col-md-2 col-sm-2 col-xs-10" for="tax-number">{{ trans('message.Tax Number') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-10">
                  <input type="text" required="required" name="tax_number" placeholder="{{ trans('message.Enter Tax Number') }}" value="{{ old('tax_number') }}" class="form-control col-md-7 col-xs-12" maxlength="20">
                </div>
              </div>
              <div class="row form-group row-mb-0">
                <label class="control-label col-md-2 col-sm-2 col-xs-10" for="first-name">
                  {{ trans('message.Tax Rates') }} (%) <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-10">
                  <input type="text" required="required" name="tax" placeholder="{{ trans('message.Enter Tax Rate Name') }}" class="form-control col-md-7 col-xs-12">
                  @if ($errors->has('tax'))
                  <span class="help-block">
                    <strong>{{ $errors->first('tax') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                  <a class="btn btn-primary taxratesCancelButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                </div> -->
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-2 mx-0">
                  <button type="submit" class="btn btn-success taxratesSubmitButton">{{ trans('message.SUBMIT') }}</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- For form field validate -->
{!! JsValidator::formRequest('App\Http\Requests\StoreAccountTaxRatesRequest', '#tax-rates-add-form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection