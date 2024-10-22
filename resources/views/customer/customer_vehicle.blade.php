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
                  Client Registration</span>
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

               <form action="{{ route('searchCustomerByName') }}" method="GET">
                  <div class="row">
                      <div class="row col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 form-group my-form-group">
                          <input class="form-control" type="text" name="search" placeholder="Enter Client Email">
                      </div>
                      <div class="row col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 form-group my-form-group">
                          <input class="form-control" type="text" name="nida" placeholder="Enter NIDA number">
                      </div>
                  </div>
                  <div class="row">
                     <div class="row col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 form-group my-form-group">
                           
                               <select name="Customername" id="cust-id" class="form-control select_vhi select_customer_auto_search form-select" cus_url="{!! url('service/get_vehi_name') !!}">
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
                    <div class="row col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 form-group my-form-group">
                        <input class="form-control" type="text" name="rogue_id" placeholder="Enter Rogue ID">
                    </div>
                      <div class="row col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 form-group my-form-group">
                          <button class="btn btn-outline-secondary btn-sm"  type="submit">Search</button>
                      </div>
                  </div>
              </form>
                
                <form id="demo-form2" action="{!! url('/customer/store') !!}" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left input_mask customerAddForm">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                        <h4><b>{{ trans('message.PERSONAL INFORMATION') }}</b></h4>
                        <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                    </div>

                    
                
                    <!-- Customer Type Toggle -->
                    <div class="row row-mb-0">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('Customer Type') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <select id="customerType" name="customer_type" class="form-control" onchange="toggleCustomerType()">
                                    <option value="#">--- select client type ---</option>
                                    <option value="individual">{{ trans('Individual') }}</option>
                                    <option value="corporate">{{ trans('Corporate/Organization') }}</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group">
                            <input class="form-control" type="text" id="searchInput" placeholder="Search by name">
                            <div id="searchResults"></div>
                        </div> --}}
                        
                    </div>

                
                    <!-- Individual Customer Information -->
                    <div id="individualCustomerInfo">
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="firstname">{{ trans('Full Name') }} <label class="color-danger">*</label> </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="firstname" name="firstname" class="firstname form-control" value="{{ old('firstname') }}" placeholder="{{ trans('Enter Full Name') }}" maxlength="50">
                                    @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Gender') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 gender">
                                    <input type="radio" name="gender" value="0" checked> {{ trans('message.Male') }}
                                    <input type="radio" name="gender" value="1"> {{ trans('message.Female') }}
                                </div>
                            </div>
                        </div>
                        <div class="row row-mb-0">
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
                        </div>
                        <div class="row row-mb-0">
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
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="password_confirmation">{{ trans('message.Confirm Password') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="password" name="password_confirmation" placeholder="{{ trans('message.Enter Confirm Password') }}" class="form-control col-md-7 col-xs-12" maxlength="20">
                                    @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Date of Birth') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                    <input type="text" id="date_of_birth" autocomplete="off" class="form-control datepicker" placeholder="<?php echo getDatepicker(); ?>" name="dob" value="{{ old('dob') }}" onkeypress="return false;" />
                                </div>
                            </div>
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('TIN-number') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="TIN-number">{{ trans('TIN Number') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="tin_no" placeholder="{{ trans('Enter TIN Number') }}" value="{{ old('TIN-number') }}" class="form-control" maxlength="50">
                                    @if ($errors->has('TIN-number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('TIN-number') }}</strong>
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
                                  <input type="file" id="image" name="nida" value="{{ old('image') }}" class="form-control chooseImage">
                                  <img src="{{ url('public/customer/nida.jpg') }}" id="imagePreview" alt="User Image" class="datatable_img" style="width: 52px; padding-top: 8px;">
                               </div>
                            </div>
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('TIN-number') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="NIDA-number">{{ trans('NIDA Number') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="nida_no" placeholder="{{ trans('Enter NIDA Number') }}" value="{{ old('NIDA-number') }}" class="form-control" maxlength="50">
                                    @if ($errors->has('NIDA-number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('NIDA-number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="image">
                                Driving License </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                   <input type="file" id="image" name="driving" value="{{ old('image') }}" class="form-control chooseImage">
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
                               <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="state_id">{{ trans('City') }} </label>
                               <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                  <select class="form-control state_of_country form-select" name="state_id" stateurl="{!! url('/getcityfromstate') !!}">
                                     <option value="">{{ trans('message.Select City') }}</option>
                                  </select>
                               </div>
                            </div>
                         </div>
                         <div class="row">
                            
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('address') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="address">{{ trans('message.Address') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                 <input type="text" name="customer_address" class="firstname form-control" value="{{ old('firstname') }}" placeholder="{{ trans('Enter Address Name') }}" maxlength="50">
                                 
                             </div>
                             </div>
                         </div>
                    </div>
                
                    <!-- Corporate Customer Information -->
                    <div id="corporateCustomerInfo" style="display: none;">
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="firstname">{{ trans('Company Name') }} <label class="color-danger">*</label> </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="firstname" name="firstname" class="firstname form-control" value="{{ old('firstname') }}" placeholder="{{ trans('Enter Company Name') }}" maxlength="50">
                                    @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="mobile">{{ trans('Contact person information') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="person" placeholder="{{ trans('Name of Contacted person') }}" value="{{ old('mobile') }}" class="form-control" maxlength="16" minlength="6">
                                    @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="mobile">{{ trans('Contact information') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="mobile" placeholder="{{ trans('Enter Contact information No') }}" value="{{ old('mobile') }}" class="form-control" maxlength="16" minlength="6">
                                    @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
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
                        </div>
                        <div class="row row-mb-0">
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
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="password_confirmation">{{ trans('message.Confirm Password') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="password" name="password_confirmation" placeholder="{{ trans('message.Enter Confirm Password') }}" class="form-control col-md-7 col-xs-12" maxlength="20">
                                    @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('TIN-number') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="TIN-number">{{ trans('TIN Number') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="tin_no" placeholder="{{ trans('Enter TIN Number') }}" value="{{ old('TIN-number') }}" class="form-control" maxlength="50">
                                    @if ($errors->has('TIN-number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('TIN-number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback">
                               <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="image">
                                TIN Certificate </label>
                               <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                  <input type="file" id="image" name="tin_certificate" value="{{ old('image') }}" class="form-control chooseImage">
                                  <img src="{{ url('public/customer/nida.jpg') }}" id="imagePreview" alt="User Image" class="datatable_img" style="width: 52px; padding-top: 8px;">
                               </div>
                            </div>
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback">
                               <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="image">
                                Certificate of Incorporation </label>
                               <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                  <input type="file" id="image" name="incorporation" value="{{ old('image') }}" class="form-control chooseImage">
                                  <img src="{{ url('public/customer/drive.png') }}" id="imagePreview" alt="User Image" class="datatable_img" style="width: 52px; padding-top: 8px;">
                               </div>
                            </div>
                         </div>
                         <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                            <h4><b>{{ trans('COMPANY ADDRESS') }}</b></h4>
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
                               <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="state_id">{{ trans('City') }} </label>
                               <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                  <select class="form-control state_of_country form-select" name="state_id" stateurl="{!! url('/getcityfromstate') !!}">
                                     <option value="">{{ trans('message.Select City') }}</option>
                                  </select>
                               </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('address') ? ' has-error' : '' }}">
                               <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="address">{{ trans('message.Address') }} <label class="color-danger">*</label></label>
                               <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <input type="text" name="customer_address" class="firstname form-control" value="{{ old('firstname') }}" placeholder="{{ trans('Enter Address Name') }}" maxlength="50">
                                
                            </div>
                            </div>
                         </div>
                    </div>
            
                    <!-- VEHICLE INFORMATION -->
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                        <h4><b>{{ trans('VEHICLE INFORMATION') }}</b></h4>
                        <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                    </div>
                
                    <!-- Container for vehicle info sections -->
                    <div id="vehicle-info-container">
                        <!-- Existing vehicle info template -->
                        <div class="vehicle-info-template row row-mb-0">
                            <div class="row">
                                <div class="row col-md-6">
                                    <label class="control-label col-md-4" for="number_plate">{{ trans('message.Number Plate') }} <label class="text-danger">*</label></label>
                                    <div class="col-md-8">
                                        <input type="text" name="vehicles[0][number_plate]" placeholder="{{ trans('message.Enter Number Plate') }}" maxlength="30" class="form-control number_plate">
                                    </div>
                                </div>
                                <div class="row col-md-6">
                                    <label class="control-label col-md-4" for="model_year">{{ trans('message.Model Years') }} <label class="text-danger">*</label></label>
                                    <div class="col-md-8">
                                        <input type="text" name="vehicles[0][model_year]" autocomplete="off" class="form-control model_year">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row col-md-6">
                                    <label class="control-label col-md-4" for="vehicabrand">{{ trans('Make') }} <label class="text-danger">*</label></label>
                                    <div class="col-md-8">
                                        <select class="form-control select_make" name="vehicles[0][vehicabrand]">
                                            <option value="">{{ trans('Select Make') }}</option>
                                            @foreach ($vehical_brand as $vehical_brands)
                                                <option value="{{ $vehical_brands->id }}">{{ $vehical_brands->vehicle_brand }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row col-md-6">
                                    <label class="control-label col-md-4" for="chassis_no">{{ trans('message.Chassis No') }} <label class="text-danger">*</label></label>
                                    <div class="col-md-8">
                                        <input type="text" name="vehicles[0][chassis_no]" placeholder="{{ trans('message.Enter Chassis No.') }}" maxlength="30" class="form-control chassis_no">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row col-md-6">
                                    <label class="control-label col-md-4" for="vehical_id">{{ trans('Body Type') }} <label class="text-danger">*</label></label>
                                    <div class="col-md-8">
                                        <select class="form-control select_body_type" name="vehicles[0][vehical_id]">
                                            <option value="">{{ trans('message.Select Type') }}</option>
                                            @foreach ($vehical_type as $vehical_types)
                                                <option value="{{ $vehical_types->id }}">{{ $vehical_types->vehicle_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row col-md-6">
                                    <label class="control-label col-md-4" for="engine_no">{{ trans('message.Engine No') }} <label class="text-danger">*</label></label>
                                    <div class="col-md-8">
                                        <input type="text" name="vehicles[0][engine_no]" placeholder="{{ trans('message.Enter Engine No') }}" class="form-control engine_no">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row col-md-6">
                                    <label class="control-label col-md-4" for="modelname">{{ trans('Model Name') }} <label class="text-danger">*</label></label>
                                    <div class="col-md-8">
                                        <select class="form-control select_model_name" name="vehicles[0][modelname]">
                                            <option value="">{{ trans('message.Select Model') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row col-md-6">
                                    <label class="control-label col-md-4" for="fueltype">{{ trans('Fuel') }} <label class="text-danger">*</label></label>
                                    <div class="col-md-8">
                                        <select class="form-control select_fuel" name="vehicles[0][fueltype]">
                                            <option value="">{{ trans('message.Select fuel') }}</option>
                                            @foreach ($fuel_type as $fuel_types)
                                                <option value="{{ $fuel_types->id }}">{{ $fuel_types->fuel_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row col-md-6">
                                    <label class="control-label col-md-4" for="color">{{ trans('Color') }} <label class="text-danger">*</label></label>
                                    <div class="col-md-8">
                                        <select class="form-control select_color" name="vehicles[0][color]">
                                            <option value="">{{ trans('message.-- Select Color --') }}</option>
                                            @foreach ($color as $colors)
                                                <option value="{{ $colors->id }}" style="background-color:{{ $colors->color_code }}; color: #ffffff;">{{ $colors->color }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row col-md-6">
                                    <label class="control-label col-md-4" for="branch">{{ trans('message.Branch') }} <label class="text-danger">*</label></label>
                                    <div class="col-md-8">
                                        <select class="form-control select_branch" name="vehicles[0][branch]">
                                            @foreach ($branchDatas as $branchData)
                                                <option value="{{ $branchData->id }}">{{ $branchData->branch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-mb-0">
                                <div class="row col-md-6 form-group">
                                    <label class="control-label col-md-4" for="vehicle_images">Vehicle Images <label class="text-danger">*</label></label>
                                    <div class="col-md-8">
                                        <input type="file" name="vehicles[0][vehicle_images][]" class="form-control" multiple>
                                    </div>
                                </div>
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
                        <!-- Add another vehicle button -->
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                            <button type="button" class="btn btn-success customerAddSubmitButton" id="add-more-vehicles">
                                {{ trans('Add another Vehicle') }}
                            </button>
                        </div>
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 customerAddSubmitButton my-1 mx-0">
                           <button id="submit-btn" type="submit" class="btn btn-success customerAddSubmitButton">{{ trans('message.SUBMIT') }}</button>
                        </div>
                     </div>
                  </div>
               </form>
               
            </div>
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
   
   
   
     /*If any white space for companyname, firstname and addresstext are then make empty value of these all field*/
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
   
           if (input.attr('name') == "firstname" ||
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
<script>
   var msg35 = "{{ trans('message.OK') }}";
   $(document).ready(function() {
       $('#myDatepicker2').datetimepicker({
           format: "yyyy",
           endDate: new Date(),
           minView: 4,
           autoclose: true,
           startView: 4,
           language: "{{ getLangCode() }}",
       });
   
   
       var msg14 = "{{ trans('message.Please enter only alphanumeric data') }}";
       var msg15 = "{{ trans('message.Only blank space not allowed') }}";
       var msg16 = "{{ trans('message.This Record is Duplicate') }}";
   

   
       // Basic
       $('.dropify').dropify();
   
       // Translated
       $('.dropify-fr').dropify({
          messages: {
               default: 'Glissez-déposez un fichier ici ou cliquez',
               replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
               remove: 'Supprimer',
               error: 'Désolé, le fichier trop volumineux'
           }
       });
   
       // Used events
       var drEvent = $('#input-file-events').dropify();
   
       drEvent.on('dropify.beforeClear', function(event, element) {
           return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
       });
   
       drEvent.on('dropify.afterClear', function(event, element) {
           alert('File deleted');
       });
   
       drEvent.on('dropify.errors', function(event, element) {
           console.log('Has Errors');
       });
   
       var drDestroy = $('#input-file-to-destroy').dropify();
       drDestroy = drDestroy.data('dropify')
   
       $('#toggleDropify').on('click', function(e) {
           e.preventDefault();
           if (drDestroy.isDropified()) {
               drDestroy.destroy();
           } else {
               drDestroy.init();
           }
       })
   
       /*images show in multiple in for loop*/
       $(".imageclass").click(function() {
           $(".classimage").empty();
       });
   
       function preview_images() {
           var total_file = document.getElementById("images").files.length;
   
           for (var i = 0; i < total_file; i++) {
               $('#image_preview').append(
                   "<div class='col-md-3 col-sm-3 col-xs-12' style='padding:5px;'><img class='uploadImage' src='" +
                   URL
                   .createObjectURL(event.target.files[i]) + "' width='100px' height='60px'> </div>");
           }
       }
   
   
       /*new image append*/
       $("#add_new_images").click(function() {
           var image_id = $("#tab_images > tbody > tr").length;
           var url = $(this).attr('url');
           var msg43 = "{{ trans('message.An error occurred :') }}";
   
           $.ajax({
               type: 'GET',
               url: url,
               data: {
                   image_id: image_id
               },
               success: function(response) {
                   $("#tab_images > tbody").append(response);
                   return false;
               },
               error: function(e) {
                   alert(msg43 + " " + e.responseText);
                   console.log(e);
               }
           });
       });
   
   
       $('body').on('click', '.trash_accounts', function() {
   
           var image_id = $(this).attr('data-id');
   
           $('table#tab_images tr#image_id_' + image_id).fadeOut();
           return false;
       });
   
   
       $('.datepicker').datetimepicker({
           format: "<?php echo getDatepicker(); ?>",
           todayBtn: true,
           autoclose: 1,
           minView: 2,
           endDate: new Date(),
           language: "{{ getLangCode() }}",
   
       });
   
   
       /*If put firstly any white space then clear textbox*/
       $('body').on('keyup', '.vehical_type', function() {
   
           var vehical_typeVal = $(this).val();
   
           if (!vehical_typeVal.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.vehical_brand', function() {
   
           var vehical_brandVal = $(this).val();
   
           if (!vehical_brandVal.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.fuel_type', function() {
   
           var fuel_typeVal = $(this).val();
   
           if (!fuel_typeVal.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.vehi_modal_name', function() {
   
           var vehi_modal_nameVal = $(this).val();
   
           if (!vehi_modal_nameVal.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
   
   
       $('body').on('keyup', '.chassis_no', function() {
   
           var chasicno1 = $(this).val();
   
           if (!chasicno1.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.no_of_gear', function() {
   
           var gearno1 = $(this).val();
   
           if (!gearno1.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.price_is', function() {
   
           var price1 = $(this).val();
   
           if (!price1.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.odometer_read', function() {
   
           var odometerreading1 = $(this).val();
   
           if (!odometerreading1.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.gear_box', function() {
   
           var gearbox1 = $(this).val();
   
           if (!gearbox1.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.gear_box_no', function() {
   
           var vehi_modal_nameVal = $(this).val();
   
           if (!vehi_modal_nameVal.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.engine_no', function() {
   
           var engineno1 = $(this).val();
   
           if (!engineno1.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.engine_size', function() {
   
           var enginesize1 = $(this).val();
   
           if (!enginesize1.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.engineField', function() {
   
           var engine1 = $(this).val();
   
           if (!engine1.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.key_no', function() {
   
           var keyno1 = $(this).val();
   
           if (!keyno1.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
       $('body').on('keyup', '.number_plate', function() {
   
           var number_plate = $(this).val();
   
           if (!number_plate.replace(/\s/g, '').length) {
               $(this).val("");
           }
       });
   
   
   
       /*Custom Field manually validation*/
       var msg31 = "{{ trans('message.field is required') }}";
       var msg32 = "{{ trans('message.Only blank space not allowed') }}";
       var msg33 = "{{ trans('message.Special symbols are not allowed.') }}";
       var msg34 = "{{ trans('message.At first position only alphabets are allowed.') }}";
   
       /*Form submit time check validation for Custom Fields */
       $('body').on('click', '.vehicleAddSubmitButton', function(e) {
           $('#vehicleAdd-Form input, #vehicleAdd-Form select, #vehicleAdd-Form textarea').each(
   
               function(index) {
                   var input = $(this);
   
                   if (input.attr('name') == "vehical_id" || input.attr('name') == "vehicabrand" ||
                       input.attr(
                           'name') == "fueltype" || input.attr('name') == "modelname" || input
                       .attr('name') == "price") {
                       if (input.val() == "") {
                           return false;
                       }
                   } else if (input.attr('isRequire') == 'required') {
                       var rowid = (input.attr('rows_id'));
                       var labelName = (input.attr('fieldnameis'));
   
                       if (input.attr('type') == 'textbox' || input.attr('type') == 'textarea') {
                           if (input.val() == '' || input.val() == null) {
                               $('.common_value_is_' + rowid).val("");
                               $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                               $('#common_error_span_' + rowid).css({
                                   "display": ""
                               });
                               $('.error_customfield_main_div_' + rowid).addClass('has-error');
                               e.preventDefault();
                               return false;
                           } else if (!input.val().replace(/\s/g, '').length) {
                               $('.common_value_is_' + rowid).val("");
                               $('#common_error_span_' + rowid).text(labelName + " : " + msg32);
                               $('#common_error_span_' + rowid).css({
                                   "display": ""
                               });
                               $('.error_customfield_main_div_' + rowid).addClass('has-error');
                               e.preventDefault();
                               return false;
                           } else if (!input.val().match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                               $('.common_value_is_' + rowid).val("");
                               $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
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
                               $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
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
                               $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
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
                       $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                       $('#common_error_span_' + rowid).css({
                           "display": ""
                       });
                       $('.error_customfield_main_div_' + rowid).addClass('has-error');
                   } else if (valueIs.match(/^\s+/)) {
                       $('.common_value_is_' + rowid).val("");
                       $('#common_error_span_' + rowid).text(labelName + " : " + msg34);
                       $('#common_error_span_' + rowid).css({
                           "display": ""
                       });
                       $('.error_customfield_main_div_' + rowid).addClass('has-error');
                   } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                       $('.common_value_is_' + rowid).val("");
                       $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
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
                       $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
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
                       if (valueIs.match(/^\s+/)) {
                           $('.common_value_is_' + rowid).val("");
                           $('#common_error_span_' + rowid).text(labelName + " : " + msg34);
                           $('#common_error_span_' + rowid).css({
                               "display": ""
                           });
                           $('.error_customfield_main_div_' + rowid).addClass('has-error');
                       } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                           $('.common_value_is_' + rowid).val("");
                           $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
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
                   $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
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
                   $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                   $('#common_error_span_' + rowid).css({
                       "display": ""
                   });
                   $('.error_customfield_main_div_' + rowid).addClass('has-error');
               }
           }
       });
   
   
       // added by arjun for color module dynamic add item and reove item
     
       var msg51 = "{{ trans('message.Please enter only alphanumeric data') }}";
       var msg52 = "{{ trans('message.Only blank space not allowed') }}";
       var msg53 = "{{ trans('message.This Record is Duplicate') }}";
       var msg54 = "{{ trans('message.An error occurred :') }}";
   
       var regex = /^#?[0-9A-Fa-f]+$/;
       var userInput = "#FF5733"; // Example input
       if (regex.test(userInput)) {
           // Valid input
           console.log("Valid input!");
       } else {
           // Invalid input
           console.log(msg51);
       }
       
       /*color add  model*/
      
   
       $('.addcolor').click(function() {
           var c_name = $('.c_name').val();
           var c_code = $('.c_code').val();
           var url = $(this).attr('colorurl');
   
           var msg55 = "{{ trans('message.Please enter color name') }}";
           
           function define_variable() {
               return {
                   addcolor_value: $('.c_name').val(),
                   addcolor_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                   addcolor_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
               };
           }
   
           var call_var_addcoloradd = define_variable();
   
           if (c_name == "") {
               swal({
                   title: msg55,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!call_var_addcoloradd.addcolor_pattern.test(call_var_addcoloradd
                   .addcolor_value)) {
               $('.c_name').val("");
               swal({
                   title: msg51,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!c_name.replace(/\s/g, '').length) {
               $('.c_name').val("");
               swal({
                   title: msg52,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!call_var_addcoloradd.addcolor_pattern2.test(call_var_addcoloradd
                   .addcolor_value)) {
               $('.c_name').val("");
               swal({
                   title: msg34,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!colorPickerChanged) {
               swal({
                   title: "Please Select color",
                   cancelButtonColor: "#C1C1C1",
                   buttons: {
                       cancel: "OK",
                   },
                   dangerMode: true,
               });
               return;
           } else {
               $.ajax({
                   type: 'GET',
                   url: url,
                   data: {
                       c_name: c_name,
                       c_code: c_code
                   },
   
                   //Form submit at a time only one for addColorModel
                   beforeSend: function() {
                       $(".addcolor").prop('disabled', true);
                   },
   
                   success: function(data) {
                       var newd = $.trim(data);
                       var classname = 'del-' + newd;
   
                       if (data == '01') {
                           swal({
                               title: msg53,
                               cancelButtonColor: '#C1C1C1',
                               buttons: {
                                   cancel: msg35,
                               },
                               dangerMode: true,
                           });
                       } else {
                           $('.colornametype').append('<tr class="data_color_name row mx-1 ' + classname +
                               '"><td class="text-start col-6">' + c_name +
                               '</td><td class="text-end col-6"><div class="color_code d-inline-block" style="background-color:' + c_code + '; margin-right:4px;">' + c_code + '</div><button type="button" id=' +
                               data +
                               ' deletecolor="{!! url('colortypedelete') !!}" class="btn btn-danger text-white border-0 deletecolors"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                           );
   
                           $('.color').append('<option value=' + data + ' style="background-color:' + c_code + ';color: #ffffff;">'+ c_name +
                               '</option>'); 
   
                           $('.c_name').val('');
                       }
   
                       //Form submit at a time only one for addColorModel
                       $(".addcolor").prop('disabled', false);
                       return false;
                   },
                   error: function(e) {
                       alert(mag20 + ' ' + e.responseText);
                       console.log(e);
                   }
               });
           }
       });
   
   
       var msg101 = "{{ trans('message.Are You Sure?') }}";
       var msg102 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
       var msg103 = "{{ trans('message.Cancel') }}";
       var msg104 = "{{ trans('message.Yes, delete!') }}";
       var msg105 = "{{ trans('message.Done!') }}";
       var msg106 = "{{ trans('message.It was succesfully deleted!') }}";
       var msg107 = "{{ trans('message.Cancelled') }}";
       var msg108 = "{{ trans('message.Your data is safe') }}";
   
       /*color Delete  model*/
       $('body').on('click', '.deletecolors', function() {
           var colorid = $(this).attr('id');
   
           var url = $(this).attr('deletecolor');
   
           swal({
               title: msg1,
               text: msg2,
               icon: "warning",
               buttons: [msg3, msg4],
               dangerMode: true,
               cancelButtonColor: "#C1C1C1",
           }).then((isConfirm) => {
               if (isConfirm) {
                   $.ajax({
                       type: 'GET',
                       url: url,
                       data: {
                           colorid: colorid
                       },
                       success: function(data) {
                           $('.del-' + colorid).remove();
                           $(".color option[value=" + colorid + "]")
                               .remove();
                           swal({
                               title: msg5,
                               text: colordelete,
                               icon: 'success',
                               cancelButtonColor: '#C1C1C1',
                               buttons: {
                                   cancel: msg35,
                               },
                               dangerMode: true,
                           });
                       }
                   });
               } else {
                   swal({
                       title: msg7,
                       text: msg8,
                       icon: 'error',
                       cancelButtonColor: '#C1C1C1',
                       buttons: {
                           cancel: msg35,
                       },
                       dangerMode: true,
                   });
               }
           })
   
       });
   
       // $(".select_vehicaltype").select2();
       // $(".select_vehicalbrand").select2();
       // $(".select_fueltype").select2();
       // $(".model_addname").select2(); 
   
   });
</script>
<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\CustomerAddEditFormRequest', '#demo-form2') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<!-- Form submit at a time only one -->
<!-- Scripts starting -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

   
    function toggleCustomerType() {
    var customerType = document.getElementById('customerType').value;
    var individualInfo = document.getElementById('individualCustomerInfo');
    var corporateInfo = document.getElementById('corporateCustomerInfo');

    if (customerType === 'individual') {
        individualInfo.style.display = 'block';
        corporateInfo.style.display = 'none';
        enableFields(individualInfo);
        disableFields(corporateInfo);
    } else if (customerType === 'corporate') {
        individualInfo.style.display = 'none';
        corporateInfo.style.display = 'block';
        disableFields(individualInfo);
        enableFields(corporateInfo);
    } else {
        individualInfo.style.display = 'none';
        corporateInfo.style.display = 'none';
        disableFields(individualInfo);
        disableFields(corporateInfo);
    }
}

function disableFields(container) {
    var inputs = container.getElementsByTagName('input');
    var selects = container.getElementsByTagName('select');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = true;
    }
    for (var j = 0; j < selects.length; j++) {
        selects[j].disabled = true;
    }
}

function enableFields(container) {
    var inputs = container.getElementsByTagName('input');
    var selects = container.getElementsByTagName('select');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = false;
    }
    for (var j = 0; j < selects.length; j++) {
        selects[j].disabled = false;
    }
}

// Initialize the form on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleCustomerType();
});

</script>
<script>
    $(document).ready(function() {
    // Initialize row_id
    var row_id = $("#vehicle-info-container .vehicle-info-template").length;

    $("#add-more-vehicles").click(function() {
        var url = $(this).attr('url');

        // Increment row_id
        row_id++;

        // Define the error message (assuming Laravel's translation method)
        var msg16 = "{{ trans('app.An error occurred :') }}";

        $.ajax({
            type: 'GET',
            url: url,
            data: {
                row_id: row_id
            },
            beforeSend: function() {
                // Optionally disable the button to prevent multiple clicks
                $("#add-more-vehicles").prop('disabled', true);
            },
            success: function(response) {
                // Assuming the response contains the HTML for the new vehicle form
                $("#vehicle-info-container").append(response.html);
                // Reset form data of the cloned vehicle form
                $("#vehicle-info-container .vehicle-info-template:last").find('input[type=text], select').val('');
                // Re-enable the button
                $("#add-more-vehicles").prop('disabled', false);
            },
            error: function(e) {
                alert(msg16 + " " + e.responseText);
                console.log(e);
                // Re-enable the button
                $("#add-more-vehicles").prop('disabled', false);
            }
        });
    });
});

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Include all model data in JSON format -->
{{-- <script>
    // JavaScript to filter model names based on selected make and body type
    $(document).ready(function() {
        $('#vehicabrand, #vehical_id').on('change', function() {
            var selectedMakeId = $('#vehicabrand').val();
            var selectedVehicleType = $('#vehical_id').val();

            // Show all options initially
            $('#modelname option').hide();

            // Filter and show only relevant options
            $('#modelname option').each(function() {
                var makeId = $(this).data('make-id');
                var vehicleType = $(this).data('vehicle-type');

                if (makeId == selectedMakeId && vehicleType == selectedVehicleType) {
                    $(this).show();
                }
            });

            // Select the first visible option if available
            var firstVisibleOption = $('#modelname option:visible:first');
            if (firstVisibleOption.length) {
                firstVisibleOption.prop('selected', true);
            }
        });
    });
</script> --}}

<script>
    const allModels = @json($model_name);

    document.addEventListener('DOMContentLoaded', function () {
        let vehicleCount = 1; // Start from 1 since 0 is used for the first vehicle

        function setupFiltering(container) {
            const vehicleBrandSelect = container.querySelector('.select_make');
            const vehicleTypeSelect = container.querySelector('.select_body_type');
            const modelNameSelect = container.querySelector('.select_model_name');

            function filterModels() {
                const selectedBrand = vehicleBrandSelect.value;
                const selectedType = vehicleTypeSelect.value;

                // Clear the model name select options
                modelNameSelect.innerHTML = '<option value="">{{ trans('message.Select Model') }}</option>';

                // Filter and populate the model name select
                allModels.forEach(function (model) {
                    if (model.vehicleType_id == selectedType && model.brand_id == selectedBrand) {
                        const option = document.createElement('option');
                        option.value = model.model_name;
                        option.textContent = model.model_name;
                        modelNameSelect.appendChild(option);
                    }
                });
            }

            vehicleBrandSelect.addEventListener('change', filterModels);
            vehicleTypeSelect.addEventListener('change', filterModels);
        }

        // Initial setup for existing vehicle info
        const existingTemplate = document.querySelector('.vehicle-info-template');
        setupFiltering(existingTemplate);

        // Handle dynamically added vehicles
        document.getElementById('add-more-vehicles').addEventListener('click', function () {
            const container = document.getElementById('vehicle-info-container');
            const newTemplate = existingTemplate.cloneNode(true);

            // Update input names to be unique
            newTemplate.querySelectorAll('input, select').forEach(function (element) {
                if (element.name) {
                    element.name = element.name.replace('[0]', '[' + vehicleCount + ']');
                }
                element.value = ''; // Clear the value
            });

            vehicleCount++;

            // Append the new template
            container.appendChild(newTemplate);

            // Setup filtering for the newly added template
            setupFiltering(newTemplate);
        });
    });
</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\VehicleAddEditFormRequest', '#demo-form2') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
@endsection