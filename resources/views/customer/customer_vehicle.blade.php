@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- page content -->
<style>
   .theTooltip {
   position: absolute !important;
   -webkit-transform-style: preserve-3d;
   transform-style: preserve-3d;
   -webkit-transform: translate(15%, -50%);
   transform: translate(15%, -50%);
   }
</style>
<div class="right_col" role="main" style="background-color: #e6e6e6;">
   <div class="">
      <div class="page-title">
         <div class="nav_menu">
            <nav>
               <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
                  <a href="{!! url('/customer/list') !!}" id="">
                     <i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                     Client Creation</span>
               </div>
               @include('dashboard.profile')
            </nav>
         </div>
      </div>
   </div>
  
   <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_content">
               <form id="demo-form2" action="{!! url('/customer/store') !!}" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left input_mask customerAddForm">
                  <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                     <h4><b>{{ trans('message.PERSONAL INFORMATION') }}</b></h4>
                     <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                  </div>
                  <div class="row row-mb-0">
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('firstname') ? ' has-error' : '' }}">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="firstname">{{ trans('message.First Name') }} <label class="color-danger">*</label> </label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <input type="text" id="firstname" name="firstname" class="firstname form-control" value="{{ old('firstname') }}" placeholder="{{ trans('message.Enter First Name') }}" maxlength="50">
                           @if ($errors->has('firstname'))
                           <span class="help-block">
                           <strong>{{ $errors->first('firstname') }}</strong>
                           </span>
                           @endif
                        </div>
                     </div>
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="lastname">{{ trans('message.Last Name') }} <label class="color-danger">*</label></label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <input type="text" id="lastname" name="lastname" placeholder="{{ trans('message.Enter Last Name') }}" value="{{ old('lastname') }}" maxlength="50" class="form-control lastname">
                           @if ($errors->has('lastname'))
                           <span class="help-block">
                           <strong>{{ $errors->first('lastname') }}</strong>
                           </span>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="row row-mb-0">
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                        {{ trans('message.Gender') }}
                        <label class="color-danger">*</label></label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 gender">
                           <input type="radio" name="gender" value="0" checked>
                           {{ trans('message.Male') }}
                           <input type="radio" name="gender" value="1"> {{ trans('message.Female') }}
                        </div>
                     </div>
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('mobile') ? ' has-error' : '' }}">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="mobile">{{ trans('message.Mobile No') }} <label class="color-danger">*</label></label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <input type="text" name="mobile" placeholder="{{ trans('message.Enter Mobile No') }}" value="{{ old('mobile') }}" class="form-control" maxlength="16" minlength="6">
                           @if ($errors->has('mobile'))
                           <span class="help-block">
                           <strong>{{ $errors->first('mobile') }}</strong>
                           </span>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="row row-mb-0">
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="email">{{ trans('message.Email') }} <label class="color-danger">*</label></label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <input type="text" name="email" placeholder="{{ trans('message.Enter Email') }}" value="{{ old('email') }}" class="form-control" maxlength="50">
                           @if ($errors->has('email'))
                           <span class="help-block">
                           <strong>{{ $errors->first('email') }}</strong>
                           </span>
                           @endif
                        </div>
                     </div>
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="password">{{ trans('message.Password') }} <label class="color-danger">*</label></label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <input type="password" name="password" placeholder="{{ trans('message.Enter Password') }}" class="form-control col-md-7 col-xs-12" maxlength="20">
                           @if ($errors->has('password'))
                           <span class="help-block">
                           <strong>{{ $errors->first('password') }}</strong>
                           </span>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="row row-mb-0">
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" style="" for="password_confirmation">{{ trans('message.Confirm Password') }} <label class="color-danger">*</label></label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <input type="password" name="password_confirmation" placeholder="{{ trans('message.Enter Confirm Password') }}" class="form-control col-md-7 col-xs-12" maxlength="20">
                           @if ($errors->has('password_confirmation'))
                           <span class="help-block">
                           <strong>{{ $errors->first('password_confirmation') }}</strong>
                           </span>
                           @endif
                        </div>
                     </div>
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Date of Birth') }}
                        </label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                           {{-- <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span> --}}
                           <input type="text" id="date_of_birth" autocomplete="off" class="form-control datepicker" placeholder="<?php echo getDatepicker(); ?>" name="dob" value="{{ old('dob') }}" onkeypress="return false;" />
                        </div>
                     </div>
                  </div>
                  <div class="row row-mb-0">
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('TIN-number') ? ' has-error' : '' }} ">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="TIN-number">{{ trans('TIN number') }} </label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <input type="text" name="TIN" placeholder="Enter TIN number'" value="{{ old('TIN number') }}" class="form-control TIN-number" maxlength="25">
                           @if ($errors->has('TIN number'))
                           <span class="help-block">
                           <strong>{{ $errors->first('TIN number') }}</strong>
                           </span>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="row row-mb-0">
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="image">
                        National Idenfication Card (NIDA) </label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <input type="file" id="image" name="image" value="{{ old('image') }}" class="form-control chooseImage">
                           <img src="{{ url('public/customer/nida.jpg') }}" id="imagePreview" alt="User Image" class="datatable_img" style="width: 52px; padding-top: 8px;">
                        </div>
                     </div>
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="image">
                        Driving License </label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <input type="file" id="image" name="image" value="{{ old('image') }}" class="form-control chooseImage">
                           <img src="{{ url('public/customer/drive.png') }}" id="imagePreview" alt="User Image" class="datatable_img" style="width: 52px; padding-top: 8px;">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                     <h4><b>{{ trans('message.ADDRESS') }}</b></h4>
                     <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                  </div>
                  <div class="row row-mb-0">
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('country_id') ? ' has-error' : '' }}">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="country_id">{{ trans('message.Country') }} <label class="color-danger">*</label></label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <select class="form-control select_country form-select" name="country_id" countryurl="{!! url('/getstatefromcountry') !!}">
                              <option value="">{{ trans('message.Select Country') }}</option>
                              @foreach ($country as $countrys)
                              <option value="{{ $countrys->id }}">{{ $countrys->name }}</option>
                              @endforeach
                           </select>
                           @if ($errors->has('country_id'))
                           <span class="help-block">
                           <strong>{{ $errors->first('country_id') }}</strong>
                           </span>
                           @endif
                        </div>
                     </div>
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="state_id">{{ trans('message.State') }} </label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <select class="form-control state_of_country form-select" name="state_id" stateurl="{!! url('/getcityfromstate') !!}">
                              <option value="">{{ trans('message.Select State') }}</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="city">{{ trans('message.Town/City') }}</label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <select class="form-control city_of_state form-select" name="city">
                              <option value="">{{ trans('message.Select City') }}</option>
                           </select>
                        </div>
                     </div>
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('address') ? ' has-error' : '' }}">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="address">{{ trans('message.Address') }} <label class="color-danger">*</label></label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           <textarea class="form-control addressTextarea" id="address" name="address" maxlength="100">{{ old('address') }}</textarea>
                           @if ($errors->has('address'))
                           <span class="help-block">
                           <strong>{{ $errors->first('address') }}</strong>
                           </span>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                     <h4><b>{{ trans('VEHICLE INFORMATION') }}</b></h4>
                     <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                  </div>
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <div class="row row-mb-0">
                    <div class="row row-mb-0">
                       <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                          <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('Vehicle For')}}<label class="color-danger"></label></label>
                          <div class="form-group col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 mb-0 pt-2">
                             <input type="radio" name="vhi_for" value="0"  checked>{{ trans('message.Service') }}
                             <!-- <input type="radio" name="vhi_for" value="1" > {{ trans('message.Sell') }} -->
                          </div>
                       </div>
                    </div>
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Vehicle Type') }} <label class="color-danger">*</label></label>
                       <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                          <div class="select-wrapper">
                             <select class="form-control select_vehicaltype form-select" name="vehical_id" vehicalurl="{!! url('/vehicle/vehicaltypefrombrand') !!}" required>
                                <option value="">{{ trans('message.Select Type') }}</option>
                                @if (!empty($vehical_type))
                                @foreach ($vehical_type as $vehical_types)
                                <option value="{{ $vehical_types->id }}">
                                   {{ $vehical_types->vehicle_type }}
                                </option>
                                @endforeach
                                @endif
                             </select>
                             <div class="arrow-icon-vehicle"></div>
                          </div>
                       </div>
                       <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 addremove">
                          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-target="#responsive-modal" data-bs-toggle="modal">{{ trans('message.Add/Remove') }}</button>
                       </div>
                    </div>
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Number Plate') }} <label class="text-danger">*</label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="number_plate" value="{{ old('number_plate') }}" placeholder="{{ trans('message.Enter Number Plate') }}" maxlength="30" class="form-control number_plate">
                       </div>
                    </div>
                 </div>
                 <div class="row row-mb-0">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Vehicle Brand') }} <label class="color-danger">*</label></label>
                       <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                          <div class="select-wrapper">
                             <select class="form-control select_vehicalbrand form-select" name="vehicabrand" url="{!! url('/vehicle/vehicalmodelfrombrand') !!}">
                                <option value="">{{ trans('message.Select Brand') }}</option>
                             </select>
                             <div class="arrow-icon-vehicle"></div>
                          </div>
                       </div>
                       <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 addremove">
                          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-target="#responsive-modal-brand " data-bs-toggle="modal">{{ trans('message.Add/Remove') }}</button>
                       </div>
                    </div>
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('price') ? ' has-error' : '' }} my-form-group" id="price-field">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">
                       {{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label>
                       </label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="price" value="{{ old('price') }}" placeholder="{{ trans('message.Enter Price') }}" class="form-control price_is" maxlength="10">
                       </div>
                    </div>
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6" id="customer-field">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="customer">{{ trans('message.Select Customer') }} <label class="color-danger">*</label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <select class="form-control select_customer form-select" name="customer">
                             <option value="">{{ trans('message.Select Customer') }}</option>
                             @if (!empty($customer))
                             @foreach ($customer as $customers)
                             <option value="{{ $customers->id }}" {{ request()->input('c_id') == $customers->id ? 'selected' : '' }}>
                             {{ getCustomerName($customers->id) }}
                             </option>
                             @endforeach
                             @endif
                          </select>
                       </div>
                    </div>
                 </div>
                 <div class="row row-mb-0">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Fuel Type') }} <label class="color-danger">*</label></label>
                       <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                          <div class="select-wrapper">
                             <select class="form-control select_fueltype form-select" name="fueltype" required>
                                <option value="">{{ trans('message.Select fuel') }} </option>
                                @if (!empty($fuel_type))
                                @foreach ($fuel_type as $fuel_types)
                                <option value="{{ $fuel_types->id }}">{{ $fuel_types->fuel_type }}
                                </option>
                                @endforeach
                                @endif
                             </select>
                             <div class="arrow-icon-vehicle"></div>
                          </div>
                       </div>
                       <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 addremove">
                          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-target="#responsive-modal-fuel" data-bs-toggle="modal">{{ trans('message.Add/Remove') }}</button>
                       </div>
                    </div>
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <div class="select-wrapper">
                             <select class="form-control select_branch form-select" name="branch">
                                @foreach ($branchDatas as $branchData)
                                <option value="{{ $branchData->id }}">{{ $branchData->branch_name }}
                                </option>
                                @endforeach
                             </select>
                             <div class="arrow-icon-branch"></div>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="row row-mb-0">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Model Name') }} <label class="color-danger">*</label></label>
                       <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                          <div class="select-wrapper">
                             <select class="form-control model_addname form-select" name="modelname" required>
                                <option value="">{{ trans('message.Select Model') }}</option>
                             </select>
                             <div class="arrow-icon-vehicle"></div>
                          </div>
                       </div>
                       <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 addremove">
                          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-target="#responsive-modal-vehi-model" data-bs-toggle="modal">{{ trans('message.Add/Remove') }}</button>
                       </div>
                    </div>
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Model Years') }} <label class="color-danger"></label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                          <input type="text" name="modelyear" autocomplete="off" class="form-control" id="myDatepicker2" />
                       </div>
                    </div>
                 </div>
                 {{-- 
                 <div class="row row-mb-0">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('odometerreading') ? ' has-error' : '' }}">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Odometer Reading') }} <label class="text-danger"></label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="odometerreading" value="{{ old('odometerreading') }}" placeholder="{{ trans('message.Enter Odometer Reading') }}" maxlength="20" class="form-control odometer_read">
                       </div>
                    </div>
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Date of Manufacturing') }} <label class="text-danger"></label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 ">
                          <input type="text" name="dom" autocomplete="off" class="form-control datepicker date" placeholder="<?php echo getDatepicker(); ?>" onkeypress="return false;" />
                       </div>
                    </div>
                 </div>
                 --}}
                 {{-- 
                 <div class="row row-mb-0">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Gear Box') }} <label class="text-danger"></label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="gearbox" value="{{ old('gearbox') }}" placeholder="{{ trans('message.Enter Grear Box') }}" maxlength="30" class="form-control gear_box">
                       </div>
                    </div>
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Gear Box No') }}.</label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="gearboxno" value="{{ old('gearboxno') }}" placeholder="{{ trans('message.Enter Gearbox No.') }}" maxlength="30" class="form-control gear_box_no">
                       </div>
                    </div>
                 </div>
                 --}}
                 <div class="row row-mb-0">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Engine No') }}. <label class="text-danger"></label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="engineno" value="{{ old('engineno') }}" placeholder="{{ trans('message.Enter Engine No.') }}" maxlength="30" class="form-control engine_no">
                       </div>
                    </div>
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Chassis No') }}. <label class="color-danger"></label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="chasicno" value="{{ old('chasicno') }}" placeholder="{{ trans('message.Enter Chassis No.') }}" maxlength="30" class="form-control chassis_no">
                       </div>
                    </div>
                    {{-- 
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Engine Size') }} <label class="text-danger"></label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="enginesize" value="{{ old('enginesize') }}" placeholder="{{ trans('message.Enter Engine Size') }}" maxlength="30" class="form-control engine_size">
                       </div>
                    </div>
                    --}}
                 </div>
                 {{-- 
                 <div class="row row-mb-0">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Key No') }}. <label class="text-danger"></label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="keyno" value="{{ old('keyno') }}" placeholder="{{ trans('message.Enter Key No.') }}" maxlength="30" class="form-control key_no">
                       </div>
                    </div>
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Engine') }} <label class="text-danger"></label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="engine" value="{{ old('engine') }}" placeholder="{{ trans('message.Enter Engine') }}" maxlength="30" class="form-control engineField">
                       </div>
                    </div>
                 </div>
                 --}}
                 {{-- 
                 <div class="row row-mb-0">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Chassis No') }}. <label class="color-danger"></label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="chasicno" value="{{ old('chasicno') }}" placeholder="{{ trans('message.Enter Chassis No.') }}" maxlength="30" class="form-control chassis_no">
                       </div>
                    </div>
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Number of Gear') }} <label class="text-danger"></label></label>
                       <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                          <input type="text" name="gearno" value="{{ old('gearno') }}" placeholder="{{ trans('message.Enter Number of Gear') }}" maxlength="5" class="form-control no_of_gear">
                       </div>
                    </div>
                 </div>
                 --}}
                 <div class="row row-mb-0">
                    <!-- Vehical images  -->
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                       <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Select Multiple Images') }}
                       </label>
                       <div class="form-group col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                          <input type="file" name="image[]" class="form-control imageclass" id="images" onchange="preview_images();" data-max-file-size="5M" multiple />
                       </div>
                       <div class="row classimage mt-2" id="image_preview"></div>
                    </div>
                 </div>
                 <div class="row row-mb-0">
                    <!-- Vehicle Description  -->
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                       <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                          <h2 class="fw-bold">{{ trans('message.Vehicle Description') }}</h2>
                          <br>
                          <button type="button" id="add_new_description" class="btn btn-outline-secondary newaddvehicledescription btn-sm float-end addbutton" url="{!! url('vehicle/add/getDescription') !!}">{{ trans('+') }}</button>
                       </div>
                       <div class="table-responsive mt-3 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 table-bordered">
                          <table class="table table-bordered addtaxtype" id="tab_decription_detail">
                             <thead>
                                <tr>
                                   <th class="all">{{ trans('message.Description') }}</th>
                                   <th class="all">{{ trans('message.Action') }}</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr id="row_id_1">
                                   <td>
                                      <textarea name="description[]" class="form-control" maxlength="100" id="tax_1"></textarea>
                                   </td>
                                   <td>
                                      <span class="d-none" data-id="1"><i class="fa fa-trash disabled"></i></span>
                                   </td>
                                </tr>
                             </tbody>
                          </table>
                       </div>
                    </div>
                    <!--vehicle color-->
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group ms-1">
                       <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                          <h2 class="fw-bold">{{ trans('message.Vehicle Color') }} </h2>
                          </span><br>
                          <button type="button" id="add_new_color" class="btn btn-outline-secondary newaddvehicledescription btn-sm float-end addbutton" url="{!! url('vehicle/add/getcolor') !!}">{{ trans('+') }}
                          </button>
                       </div>
                       <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 text-end mb-3">
                          <button type="button" data-bs-target="#responsive-modal-color" data-bs-toggle="modal" class="btn btn-outline-secondary btn-sm newaddvehicledescription mt-1">{{ trans('message.Add/Remove') }}</button><br>
                       </div>
                       <div class="table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                          <table class="table table-bordered addtaxtype" id="tab_color">
                             <thead>
                                <tr>
                                   <th class="all">{{ trans('message.Colors') }}</th>
                                   <th>{{ trans('message.Action') }}</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr id="color_id_1">
                                   <td>
                                      <select name="color[]" class="form-control color form-select" id="tax_1" data-id="1">
                                         <option value="">{{ trans('message.Select Color') }}
                                         </option>
                                         @if (!empty($color))
                                         @foreach ($color as $colors)
                                         <option value="{{ $colors->id }}" style="background-color:{{ $colors->color_code }}; color: #ffffff; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                                            {{ $colors->color }}
                                         </option>
                                         @endforeach
                                         @endif
                                      </select>
                                   </td>
                                   <td>
                                   </td>
                                </tr>
                             </tbody>
                          </table>
                       </div>
                    </div>
                 </div>
         
                  <!-- Custom field data  -->
                  @if (!empty($tbl_custom_fields))
                  <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                     <h4><b>{{ trans('message.CUSTOM FIELDS') }}</b></h4>
                     <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                  </div>
                  <?php
                     $subDivCount = 0;
                     ?>
                  @foreach ($tbl_custom_fields as $myCounts => $tbl_custom_field)
                  <?php
                     if ($tbl_custom_field->required == 'yes') {
                       $required = 'required';
                       $red = '*';
                     } else {
                       $required = '';
                       $red = '';
                     }
                     
                     $subDivCount++;
                     ?>
                  @if ($myCounts % 2 == 0)
                  <div class="row row-mb-0">
                     @endif
                     <div class="row form-group col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 error_customfield_main_div_{{ $myCounts }}">
                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="account-no">{{ $tbl_custom_field->label }} <label class="color-danger">{{ $red }}</label></label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                           @if ($tbl_custom_field->type == 'textarea')
                           <textarea name="custom[{{ $tbl_custom_field->id }}]" class="form-control textarea_{{ $tbl_custom_field->id }} textarea_simple_class common_simple_class common_value_is_{{ $myCounts }}" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="100" isRequire="{{ $required }}" type="textarea" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}></textarea>
                           <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                           @elseif($tbl_custom_field->type == 'radio')
                           <?php
                              $radioLabelArrayList = getRadiolabelsList($tbl_custom_field->id);
                              ?>
                           @if (!empty($radioLabelArrayList))
                           <div style="margin-top: 5px;">
                              @foreach ($radioLabelArrayList as $k => $val)
                              <label><input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" value="{{ $k }}" <?php if ($k == 0) {
                                 echo 'checked';
                                 } ?>>{{ $val }}</label>
                              @endforeach
                           </div>
                           @endif
                           @elseif($tbl_custom_field->type == 'checkbox')
                           <?php
                              $checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id);
                              $cnt = 0;
                              ?>
                           @if (!empty($checkboxLabelArrayList))
                           <div class="required_checkbox_parent_div_{{ $tbl_custom_field->id }}" style="margin-top: 5px;">
                              @foreach ($checkboxLabelArrayList as $k => $val)
                              <label><input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}">
                              {{ $val }}</label> &nbsp;
                              <?php $cnt++; ?>
                              @endforeach
                              <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                           </div>
                           <input type="hidden" name="checkboxCount" value="{{ $cnt }}">
                           @endif
                           @elseif($tbl_custom_field->type == 'textbox')
                           <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" class="form-control textDate_{{ $tbl_custom_field->id }} textdate_simple_class common_value_is_{{ $myCounts }} common_simple_class" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="30" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>
                           <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display:none"></span>
                           @elseif($tbl_custom_field->type == 'date')
                           <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" class="form-control textDate_{{ $tbl_custom_field->id }} date_simple_class common_value_is_{{ $myCounts }} common_simple_class" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="30" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }} onkeydown="return false">
                           <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display:none"></span>
                           @endif
                        </div>
                     </div>
                     @if ($myCounts % 2 != 0)
                  </div>
                  @endif
                  @endforeach
                  <?php
                     if ($subDivCount % 2 != 0) {
                       echo '</div>';
                     }
                     ?>
                  @endif
                  <!-- Custom field data -->
                  <div class="row">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <div class="row">
                        <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                           <a class="btn btn-primary customerAddcancleButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                           </div> -->
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 customerAddSubmitButton my-1 mx-0">
                           <button type="submit" class="btn btn-success customerAddSubmitButton">{{ trans('message.SUBMIT') }}</button>
                        </div>
                     </div>
                  </div>
               </form>


               {{-- End of Client form --}}
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Page content end -->
<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
   $(document).ready(function() {
     // $('#datepicker').datepicker( $.datepicker.regional[ "hi" ] );
     //  $.datetimepicker.dates[ "ru" ] ;
     $(".datepicker").datetimepicker({
       format: "<?php echo getDatepicker(); ?>",
       todayBtn: true,
       autoclose: 1,
       minView: 2,
       endDate: new Date(),
       language: "{{ getLangCode() }}",
     });
     // $('.datepicker').datetimepicker["ru"];
     // var dateLang = 
     $('.select_country').change(function() {
       countryid = $(this).val();
       var url = $(this).attr('countryurl');
       $.ajax({
         type: 'GET',
         url: url,
         data: {
           countryid: countryid
         },
         success: function(response) {
           $('.state_of_country').html(response);
         }
       });
     });
   
     $('body').on('change', '.state_of_country', function() {
       stateid = $(this).val();
   
       var url = $(this).attr('stateurl');
       $.ajax({
         type: 'GET',
         url: url,
         data: {
           stateid: stateid
         },
         success: function(response) {
           $('.city_of_state').html(response);
         }
       });
     });
   
   
     $("#image").change(function() {
       readUrl(this);
       $("#imagePreview").css("display", "block");
     });
   
   
   
     /*If any white space for companyname, firstname, lastname and addresstext are then make empty value of these all field*/
     $('body').on('keyup', '.addressTextarea', function() {
   
       var addressValue = $(this).val();
       if (!addressValue.replace(/\s/g, '').length) {
         $(this).val("");
       }
     });
   
     $('body').on('keyup', '#firstname', function() {
   
       var firstName = $(this).val();
   
       if (!firstName.replace(/\s/g, '').length) {
         $(this).val("");
       }
     });
   
     $('body').on('keyup', '#lastname', function() {
   
       var lastName = $(this).val();
   
       if (!lastName.replace(/\s/g, '').length) {
         $(this).val("");
       }
     });
   
     $('body').on('keyup', '.displayname', function() {
   
       var displayName = $(this).val();
   
       if (!displayName.replace(/\s/g, '').length) {
         $(this).val("");
       }
     });
   
     $('body').on('keyup', '.companyname', function() {
   
       var companyName = $(this).val();
   
       if (!companyName.replace(/\s/g, '').length) {
         $(this).val("");
       }
     });
   
     $('body').on('change', '.chooseImage', function() {
       var imageName = $(this).val();
       var imageExtension = /(\.jpg|\.jpeg|\.png)$/i;
   
       if (imageExtension.test(imageName)) {
         $('.imageHideShow').css({
           "display": ""
         });
       } else {
         $('.imageHideShow').css({
           "display": "none"
         });
       }
     });
   
   
   
     /*Custom Field manually validation*/
     var msg1 = "{{ trans('message.field is required') }}";
     var msg2 = "{{ trans('message.Only blank space not allowed') }}";
     var msg3 = "{{ trans('message.Special symbols are not allowed.') }}";
     var msg4 = "{{ trans('message.At first position only alphabets are allowed.') }}";
   
     /*Form submit time check validation for Custom Fields */
     $('body').on('click', '.customerAddSubmitButton', function(e) {
       $('#demo-form2 input, #demo-form2 select, #demo-form2 textarea').each(
   
         function(index) {
           var input = $(this);
   
           if (input.attr('name') == "firstname" || input.attr('name') == "lastname" ||
             input.attr('name') ==
             "email" || input.attr('name') == "password" || input.attr('name') ==
             "password_confirmation" ||
             input.attr('name') == "mobile" || input.attr('name') == "country_id" ||
             input.attr('name') ==
             "address") {
             if (input.val() == "") {
               //alert("i am blank");
               return false;
             }
           } else if (input.attr('isRequire') == 'required') {
             var rowid = (input.attr('rows_id'));
             var labelName = (input.attr('fieldnameis'));
   
             //if (input.attr('type') != 'radio' && input.attr('type') != 'checkbox')
             if (input.attr('type') == 'textbox' || input.attr('type') == 'textarea') {
               if (input.val() == '' || input.val() == null) {
                 $('.common_value_is_' + rowid).val("");
                 $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                 $('#common_error_span_' + rowid).css({
                   "display": ""
                 });
                 $('.error_customfield_main_div_' + rowid).addClass('has-error');
                 e.preventDefault();
                 return false;
               } else if (!input.val().replace(/\s/g, '').length) {
                 $('.common_value_is_' + rowid).val("");
                 $('#common_error_span_' + rowid).text(labelName + " : " + msg2);
                 $('#common_error_span_' + rowid).css({
                   "display": ""
                 });
                 $('.error_customfield_main_div_' + rowid).addClass('has-error');
                 e.preventDefault();
                 return false;
               }
               //else if(!input.val().match(/^[a-zA-Z0-9][a-zA-Z0-9\s\.\@\-\_]*$/))
               else if (!input.val().match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                 $('.common_value_is_' + rowid).val("");
                 $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
                 $('#common_error_span_' + rowid).css({
                   "display": ""
                 });
                 $('.error_customfield_main_div_' + rowid).addClass('has-error');
                 e.preventDefault();
                 return false;
               }
             } else if (input.attr('type') == 'checkbox') {
               var ids = input.attr('custm_isd');
               if ($(".required_checkbox_" + ids).is(':checked')) {
                 $('#common_error_span_' + rowid).css({
                   "display": "none"
                 });
                 $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                 $('.required_checkbox_parent_div_' + ids).css({
                   "color": ""
                 });
                 $('.error_customfield_main_div_' + ids).removeClass('has-error');
               } else {
                 $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                 $('#common_error_span_' + rowid).css({
                   "display": ""
                 });
                 $('.error_customfield_main_div_' + rowid).addClass('has-error');
                 $('.required_checkbox_' + ids).css({
                   "outline": "2px solid #a94442"
                 });
                 $('.required_checkbox_parent_div_' + ids).css({
                   "color": "#a94442"
                 });
                 e.preventDefault();
                 return false;
               }
             } else if (input.attr('type') == 'date') {
               if (input.val() == '' || input.val() == null) {
                 $('.common_value_is_' + rowid).val("");
                 $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                 $('#common_error_span_' + rowid).css({
                   "display": ""
                 });
                 $('.error_customfield_main_div_' + rowid).addClass('has-error');
                 e.preventDefault();
                 return false;
               } else {
                 $('#common_error_span_' + rowid).css({
                   "display": "none"
                 });
                 $('.error_customfield_main_div_' + rowid).removeClass('has-error');
               }
             }
           } else if (input.attr('isRequire') == "") {
             //Nothing to do
           }
         }
       );
     });
   
   
     /*Anykind of input time check for validation for Textbox, Date and Textarea*/
     $('body').on('keyup', '.common_simple_class', function() {
   
       var rowid = $(this).attr('rows_id');
       var valueIs = $('.common_value_is_' + rowid).val();
       var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
       var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
       var inputTypes = $('.common_value_is_' + rowid).attr('type');
   
       if (requireOrNot != "") {
         if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') {
           if (valueIs == "") {
             $('.common_value_is_' + rowid).val("");
             $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
             $('#common_error_span_' + rowid).css({
               "display": ""
             });
             $('.error_customfield_main_div_' + rowid).addClass('has-error');
           } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
             $('.common_value_is_' + rowid).val("");
             $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
             $('#common_error_span_' + rowid).css({
               "display": ""
             });
             $('.error_customfield_main_div_' + rowid).addClass('has-error');
           } else {
             $('#common_error_span_' + rowid).css({
               "display": "none"
             });
             $('.error_customfield_main_div_' + rowid).removeClass('has-error');
           }
         } else if (inputTypes == 'date') {
           if (valueIs != "") {
             $('#common_error_span_' + rowid).css({
               "display": "none"
             });
             $('.error_customfield_main_div_' + rowid).removeClass('has-error');
           } else {
             $('.common_value_is_' + rowid).val("");
             $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
             $('#common_error_span_' + rowid).css({
               "display": ""
             });
             $('.error_customfield_main_div_' + rowid).addClass('has-error');
           }
         } else {
           //alert("Yes i am radio and checkbox");
         }
       } else {
         if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') {
           if (valueIs != "") {
             if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
               $('.common_value_is_' + rowid).val("");
               $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
               $('#common_error_span_' + rowid).css({
                 "display": ""
               });
               $('.error_customfield_main_div_' + rowid).addClass('has-error');
             } else {
               $('#common_error_span_' + rowid).css({
                 "display": "none"
               });
               $('.error_customfield_main_div_' + rowid).removeClass('has-error');
             }
           } else {
             $('#common_error_span_' + rowid).css({
               "display": "none"
             });
             $('.error_customfield_main_div_' + rowid).removeClass('has-error');
           }
         }
       }
     });
   
   
     /*For required checkbox checked or not*/
     $('body').on('click', '.checkbox_simple_class', function() {
   
       var rowid = $(this).attr('rows_id');
       var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
       var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
       var inputTypes = $('.common_value_is_' + rowid).attr('type');
       var custId = $('.common_value_is_' + rowid).attr('custm_isd');
   
       if (requireOrNot != "") {
         if ($(".required_checkbox_" + custId).is(':checked')) {
           $('.required_checkbox_' + custId).css({
             "outline": ""
           });
           $('.required_checkbox_' + custId).css({
             "color": ""
           });
           $('#common_error_span_' + rowid).css({
             "display": "none"
           });
           $('.required_checkbox_parent_div_' + custId).css({
             "color": ""
           });
           $('.error_customfield_main_div_' + rowid).removeClass('has-error');
         } else {
           $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
           $('.required_checkbox_' + custId).css({
             "outline": "2px solid #a94442"
           });
           $('.required_checkbox_' + custId).css({
             "color": "#a94442"
           });
           $('#common_error_span_' + rowid).css({
             "display": ""
           });
           $('.required_checkbox_parent_div_' + custId).css({
             "color": "#a94442"
           });
           $('.error_customfield_main_div_' + rowid).addClass('has-error');
           e.preventDefault();
           return false;
         }
       }
     });
   
   
   
     $('body').on('change', '.date_simple_class', function() {
   
       var rowid = $(this).attr('rows_id');
       var valueIs = $('.common_value_is_' + rowid).val();
       var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
       var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
       var inputTypes = $('.common_value_is_' + rowid).attr('type');
       var custId = $('.common_value_is_' + rowid).attr('custm_isd');
   
       if (requireOrNot != "") {
         if (valueIs != "") {
           $('#common_error_span_' + rowid).css({
             "display": "none"
           });
           $('.error_customfield_main_div_' + rowid).removeClass('has-error');
         } else {
           $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
           $('#common_error_span_' + rowid).css({
             "display": ""
           });
           $('.error_customfield_main_div_' + rowid).addClass('has-error');
           e.preventDefault();
           return false;
         }
       }
     });
   });
   
   /*For image preview at selected image*/
   function readUrl(input) {
     if (input.files && input.files[0]) {
       var reader = new FileReader();
   
       reader.onload = function(e) {
         $('#imagePreview').attr('src', e.target.result);
       }
       reader.readAsDataURL(input.files[0]);
     }
   }
</script>
<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\CustomerAddEditFormRequest', '#demo-form2') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<!-- Form submit at a time only one -->
<script type="text/javascript">
   /*$(document).ready(function () {
                     $('.customerAddSubmitButton').removeAttr('disabled'); //re-enable on document ready
                 });
                 $('.customerAddForm').submit(function () {
                     $('.customerAddSubmitButton').attr('disabled', 'disabled'); //disable on any form submit
                 });
   
                 $('.customerAddForm').bind('invalid-form.validate', function () {
                   $('.customerAddSubmitButton').removeAttr('disabled'); //re-enable on form invalidation
                 });*/
</script>
@endsection