@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/employee/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                {{ trans('message.Add Employees') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <form id="employee_add_form" method="post" action="{!! url('employee/store') !!}" enctype="multipart/form-data" class="form-horizontal upperform employeeAddForm">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
              <h4><b>{{ trans('message.PERSONAL INFORMATION') }}</b></h4>
              <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('firstname') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="firstname">{{ trans('message.First Name') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="{{ trans('message.Enter First Name') }}" class="form-control" maxlength="50">
                  @if ($errors->has('firstname'))
                  <span class="help-block">
                    <strong>{{ $errors->first('firstname') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="lastname">{{ trans('message.Last Name') }} <label class="color-danger">*</label> </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="{{ trans('message.Enter Last Name') }}" class="form-control" maxlength="50">
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Gender') }}
                  <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 gender">
                  <input type="radio" name="gender" value="1" checked>{{ trans('message.Male') }}
                  <input type="radio" name="gender" value="2">{{ trans('message.Female') }}
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="email">{{ trans('message.Email') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('message.Enter Email') }}" class="form-control" maxlength="50">
                  @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="password">{{ trans('message.Password') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="password" id="password" placeholder="{{ trans('message.Enter Password') }}" name="password" class="form-control" maxlength="20">

                  @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="Password">{{ trans('message.Confirm Password') }} <label class="color-danger">*</label></label>
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
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('mobile') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="mobile">{{ trans('message.Mobile No.') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="{{ trans('message.Enter Mobile No') }}" class="form-control" maxlength="16" minlength="6">
                  @if ($errors->has('mobile'))
                  <span class="help-block">
                    <strong>{{ $errors->first('mobile') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control select_branch form-select" name="branch">
                    @foreach ($branchDatas as $branchData)
                    <option value="{{ $branchData->id }}">{{ $branchData->branch_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
             
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('join_date') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="join_date">{{ trans('message.Join Date') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date ">
                  <input type="text" id="join_date" class="form-control leftdate joinDate datepicker" placeholder="<?php echo getDatepicker(); ?>" value="{{ old('join_date', date('Y-m-d')) }}" name="join_date">

                  @if ($errors->has('join_date'))
                  <span class="help-block">
                    <strong>{{ $errors->first('join_date') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="designation">{{ trans('message.Designation') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="" class="form-control" value="{{ old('designation') }}" name="designation" maxlength="30" placeholder="{{ trans('message.Designation') }}">
                  @if ($errors->has('designation'))
                  <span class="help-block" style="color:#a94442;">
                    <strong>{{ $errors->first('designation') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('left_date') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="left_date">{{ trans('message.Left Date') }}</label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                  <input type="text" id="left_date" class="form-control datepicker2" placeholder="<?php echo getDatepicker(); ?>" name="left_date" value="{{ old('left_date') }}">
                </div>

                @if ($errors->has('left_date'))
                <span class="help-block" style="margin-left: 27%;">
                  <strong>{{ $errors->first('left_date') }}</strong>
                </span>
                @endif
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6  {{ $errors->has('dob') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Date of Birth') }}</label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                  <input type="text" id="date_of_birth" autocomplete="off" class="form-control datepicker1" placeholder="<?php echo getDatepicker(); ?>" name="dob" value="{{ old('dob') }}" onkeypress="return false;">
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('displayname') ? ' has-error' : '' }}">
                <label for="displayname" class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Display Name') }}
                </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="displayname" class="form-control" value="{{ old('displayname') }}" placeholder="{{ trans('message.Enter Display Name') }}" maxlength="25" name="displayname">
                </div>
              </div>
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('landlineno') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="landlineno">{{ trans('message.Landline No.') }} <label class="color-danger"></label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="landlineno" name="landlineno" value="{{ old('landlineno') }}" placeholder="{{ trans('message.Enter LandLine No') }}" maxlength="16" minlength="6" class="form-control">
                  @if ($errors->has('landlineno'))
                  <span class="help-block">
                    <strong>{{ $errors->first('landlineno') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('image') ? ' has-error' : '' }}">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="image">{{ trans('message.Image') }}</label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="file" id="image" name="image" class="form-control chooseImage">

                    <img src="{{ url('public/employee/avtar.png') }}" id="imagePreview" alt="User Image" class="datatable_img mt-2" style="width: 52px;">
                  </div>
              </div>
            </div>
  
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 mt-3">
              <h4><b>{{ trans('message.ADDRESS') }}</b></h4>
              <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="country_id">{{ trans('message.Country') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control select_country form-select" name="country_id" countryurl="{!! url('/getstatefromcountry') !!}">
                    <option value="">{{ trans('message.Select Country') }}</option>
                    @foreach ($country as $countrys)
                    <option value="{{ $countrys->id }}">{{ $countrys->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="state">{{ trans('message.State') }} </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control state_of_country form-select" name="state" stateurl="{!! url('/getcityfromstate') !!}">
                    <option value="">{{ trans('message.Select State') }}</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="city">{{ trans('message.Town/City') }}</label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control city_of_state form-select" name="city">
                    <option value="">{{ trans('message.Select City') }}</option>
                  </select>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="address">{{ trans('message.Address') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <textarea id="address" name="address" class="form-control addressTextarea" maxlength="100">{{ old('address') }}</textarea>
                </div>
              </div>
            </div>

            <!-- Custom field -->
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
                    <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" value="{{ $k }}" <?php if ($k == 0) {
                                                                                                                              echo 'checked';
                                                                                                                            } ?>>{{ $val }} &nbsp;
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
                    <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}"> {{ $val }} &nbsp;
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
            <!-- Custom field -->
            <!-- <div class="row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <a class="btn supplierCancleButton" href="{{ URL::previous() }}">{{ trans('CANCLE') }}</a>
                            </div>
                        </div>
                       
                        </div>
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">                         
                            <button type="submit" class="btn supplierSubmitButton" >{{ trans('SUBMIT') }}</button> 
                        </div>
                        </div> -->


            <div class="row">
              <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <a class="btn btn-primary employeeCancleButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
              </div> -->
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <button type="submit" class="btn btn-success employeeSubmitButton">{{ trans('message.SUBMIT') }}</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script>
  $(document).ready(function() {
    // Country Change State List
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


    $('.datepicker1').datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
      todayBtn: true,
      autoclose: 1,
      minView: 2,
      endDate: new Date(),
      language: "{{ getLangCode() }}",
    });

    $(".datepicker,.input-group-addon").click(function() {
      var dateend = $('#left_date').val('');
    });

    $('.datepicker').datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
      todayBtn: true,
      autoclose: 1,
      minView: 2,
      endDate: new Date(),
      language: "{{ getLangCode() }}",
    });
    $('.datepicker2').datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
      todayBtn: true,
      autoclose: 1,
      minView: 2,
      language: "{{ getLangCode() }}",

    });

    $(".datepicker").datetimepicker({
        format: "<?php echo getDatepicker(); ?>",
      })
      .on('changeDate', function(selected) {
        var startDate = new Date(selected.date.valueOf());

        $('.datepicker2').datetimepicker({
          format: "<?php echo getDatepicker(); ?>",
        }).datetimepicker('setStartDate', startDate);
      })
      .on('clearDate', function(selected) {
        $('.datepicker2').datetimepicker('setStartDate', null);
      })

    $('.datepicker2').click(function() {
      var date = $('#join_date').val();
      var msg1 = "{{ trans('message.First Select Join Date') }}";
      // alert(date)
      if (date == '') {
        swal({
          title: msg1,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg6,
          },
          dangerMode: true,
        });


      } else {
        $('.datepicker2').datetimepicker({
          format: "<?php echo getDatepicker(); ?>",
          minView: 2,
          autoclose: 1,
        })
      }
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

    $('body').on('keyup', '#displayname', function() {
      var displayName = $(this).val();

      if (!displayName.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });


    /*If date field have value then error msg and has error class remove*/
    $('.joinDate').on('change', function() {
      var DateValue = $(this).val();

      if (DateValue != null) {
        $('#join_date-error').css({
          "display": "none"
        });
      }

      if (DateValue != null) {
        $(this).parent().parent().removeClass('has-error');
      }
    });

    $("#image").change(function() {
      readUrl(this);
      $("#imagePreview").css("display", "block");
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

    /******* Custom Field manually validation ******/
    var msg1 = "{{ trans('message.field is required') }}";
    var msg2 = "{{ trans('message.Only blank space not allowed') }}";
    var msg3 = "{{ trans('message.Special symbols are not allowed.') }}";
    var msg4 = "{{ trans('message.At first position only alphabets are allowed.') }}";
    var msg5 = "{{ trans('message.First Select Join Date') }}";
    var msg6 = "{{ trans('message.OK') }}";


    /*Form submit time check validation for Custom Fields */
    $('body').on('click', '.employeeSubmitButton', function(e) {
      $('#employee_add_form input, #employee_add_form select, #employee_add_form textarea').each(

        function(index) {
          var input = $(this);

          if (input.attr('name') == "firstname" || input.attr('name') == "lastname" || input.attr('name') ==
            "email" || input.attr('name') == "password" || input.attr('name') == "password_confirmation" ||
            input.attr('name') == "mobile" || input.attr('name') == "join_date" || input.attr('name') ==
            "designation" || input.attr('name') == "country_id" || input.attr('name') == "address") {
            if (input.val() == "") {
              return false;
            }
          } else if (input.attr('isRequire') == 'required') {
            var rowid = (input.attr('rows_id'));
            var labelName = (input.attr('fieldnameis'));

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
              } else if (!input.val().match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
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
          } else if (valueIs.match(/^\s+/)) {
            $('.common_value_is_' + rowid).val("");
            $('#common_error_span_' + rowid).text(labelName + " : " + msg4);
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
            if (valueIs.match(/^\s+/)) {
              $('.common_value_is_' + rowid).val("");
              $('#common_error_span_' + rowid).text(labelName + " : " + msg4);
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
        }
      }
    });

  });


  /******* For image preview at selected image ********/
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


<!-- For form field validate -->
{!! JsValidator::formRequest('App\Http\Requests\EmployeeAddEditFormRequest', '#employee_add_form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection