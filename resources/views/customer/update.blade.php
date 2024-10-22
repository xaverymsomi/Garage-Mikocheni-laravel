@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php if (
  getLangCode() == 'en' ||
  getLangCode() == 'ro' ||
  getLangCode() == 'gu' ||
  getLangCode() == 'mr'
) {
?>
  <style>
    @media (max-width: 320px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 8px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @media (max-width: 30px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 8px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }
  </style>
<?php
} ?>
<?php if (
  getLangCode() == 'it' ||
  getLangCode() == 'id' ||
  getLangCode() == 'tr' ||
  getLangCode() == 'hu' ||
  getLangCode() == 'de' ||
  getLangCode() == 'ger' ||
  getLangCode() == 'pt' ||
  getLangCode() == 'fr' ||
  getLangCode() == 'hi' ||
  getLangCode() == 'et' ||
  getLangCode() == 'lt'
) {
?>
  <style>
    @media (max-width: 320px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @media (max-width: 30px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }
  </style>
<?php
} ?>
<?php if (getlangCode() == 'ta') {
?>
  <style>
    @media (max-width: 320px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 60px !important;
      }
    }

    @media (max-width: 30px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 60px !important;
      }
    }

    @supports (-webkit-touch-callout: none) {
      ul.bar_tabs>li.active {
        margin-top: 1px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }
  </style>
<?php
} ?>
<?php if (getLangCode() == 'fi') {
?>
  <style>
    @media (max-width: 320px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 8px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @media (max-width: 30px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 8px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @supports (-webkit-touch-callout: none) {
      ul.bar_tabs>li.active {
        margin-top: 1px !important;
        margin-left: 8px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }
  </style>
<?php
} ?>
<?php if (
  getLangCode() == 'cs' ||
  getLangCode() == 'ru' ||
  getLangCode() == 'vi' ||
  getLangCode() == 'gr'
) {
?>
  <style>
    @media (max-width: 320px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @media (max-width: 30px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @supports (-webkit-touch-callout: none) {
      ul.bar_tabs>li.active {
        margin-top: 1px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }
  </style>
<?php
} ?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{{ URL::previous() }}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                {{ trans('message.Edit Customer') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
  </div>
<div class="clearfix"></div>
@if ($errors->any())
@foreach ($errors->all() as $error)
<div>{{ $error }}</div>
@endforeach
@endif
<div class="row">
  <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">

    <div class="x_panel">
      <div class="x_content">
        <form id="demo-form2" action="update/{{ $customer->id }}" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask">
          <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
            <h4><b>{{ trans('message.PERSONAL INFORMATION') }}</b></h4>
            <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
          </div>

          <div class="row row-mb-0">
            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('firstname') ? ' has-error' : '' }}">
              <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="firstname">{{ trans('Full Name') }} <label class="color-danger">*</label> </label>
              <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                <input type="text" id="firstname" name="firstname" placeholder="{{ trans('Enter Full Name') }}" value="{{ $customer->name }}" class="form-control" maxlength="50">

              </div>
            </div>

            
          </div>

          
          <div class="row row-mb-0">
            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback">
              <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Gender') }}
                <label class="color-danger">*</label></label>
              <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 gender">
                <input type="radio" name="gender" value="0" <?php if ($customer->gender == 0) {
                                                              echo 'checked';
                                                            } ?> checked> {{ trans('message.Male') }}

                <input type="radio" name="gender" value="1" <?php if ($customer->gender == 1) {
                                                              echo 'checked';
                                                            } ?>> {{ trans('message.Female') }}
              </div>
            </div>

            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('mobile') ? ' has-error' : '' }}">
              <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="mobile">{{ trans('message.Mobile No') }} <label class="color-danger">*</label> </label>
              <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                <input type="text" name="mobile" placeholder="{{ trans('message.Enter Mobile No') }}" value="{{ $customer->mobile_no }}" maxlength="16" minlength="6" class="form-control">
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
                <input type="text" name="email" placeholder="{{ trans('message.Enter Email') }}" value="{{ $customer->email }}" class="form-control" maxlength="50">
                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
              <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="password">{{ trans('message.Password') }}</label>
              <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                <input type="password" name="password" placeholder="{{ trans('message.Enter Password') }}" maxlength="20" class="form-control">
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
              <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" style="" for="Password">{{ trans('message.Confirm Password') }}</label>
              <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                <input type="password" name="password_confirmation" placeholder="{{ trans('message.Enter Confirm Password') }}" class="form-control" maxlength="20">
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
                <input type="date" id="date_of_birth" autocomplete="off" class="form-control datepicker" placeholder="<?php echo getDatepicker(); ?>" name="dob" value="{{ date(getDateFormat(), strtotime($customer->birth_date)) }}" onkeypress="return false;" />
              </div>
            </div>
          </div>

          

          
          

          
          <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 mt-3">
            <h4><b>{{ trans('message.Address') }}</b></h4>
            <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
          </div>

          <div class="row row-mb-0">
            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback">
              <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="country_id">{{ trans('message.Country') }} <label class="color-danger">*</label></label>
              <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                <select class="form-control select_country form-select" name="country_id" countryurl="{!! url('/getstatefromcountry') !!}">
                  <option value="">Select Country</option>
                  @foreach ($country as $countrys)
                  <option value="{{ $countrys->id }}" <?php if ($customer->country_id == $countrys->id) {
                                                        echo 'selected';
                                                      } ?>>{{ $countrys->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback">
              <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="state_id">{{ trans('message.Town/City') }} </label>
              <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                <select class="form-control state_of_country form-select" name="state_id" stateurl="{!! url('/getcityfromstate') !!}">
                  <option value="">{{ trans('message.Select City') }}</option>
                  @if ($state != null)
                  @foreach ($state as $states)
                  <option value="{!! $states->id !!}" <?php if ($customer->state_id == $states->id) {
                                                        echo 'selected';
                                                      } ?>>{!! $states->name !!}</option>
                  @endforeach
                  @else
                  <option value=""></option>
                  @endif
                </select>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback">
              <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="address">{{ trans('message.Address') }} <label class="color-danger">*</label></label>
              <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                <input type="text" class="form-control" name="address" id="" value="{{ $customer->address }}">
              </div>
            </div>
          </div>

          <div class="x_panel bgr">
            <div class="row">
                <?php
                if (count($vehicles) == 0) {
                ?>
                    <p style="text-align: center;"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
                <?php
                } else {
                    foreach ($vehicles as $vehicals)
                ?>

                <?php
            }
                ?>
            </div>
            @if (!empty($vehicals))
            <div class="row mt-4">
              <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 col-sm-10 col-xs-10 header">
                  <h4><b>{{ trans('LIST OF VEHICLES') }}</b>
                  </h4>   
              </div>
              <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">
              </div>
          </div>
            <table id="supplier" class="table responsive jumbo_table" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ trans('message.Photo') }}</th>
                        <th>{{ trans('message.BRAND/MODEL NAME') }}</th>
                        <th>{{ trans('message.TYPE') }}</th>
                        <th>{{ trans('message.NUMBER PLATE') }}</th>
                        <th>{{ trans('message.LAST SERVICE DATE') }}</th>
                        <th>{{ trans('message.Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($vehicles) !== 0)
                    @foreach ($vehicles as $vehicals)
                    <tr>
                        <?php $vehicleimage = getVehicleImage($vehicals->id); ?>
                        <td>
                            <img src="{{ URL::asset('public/vehicle/' . $vehicleimage) }}" width="50px" height="50px" class="rounded">
                        </td>
                        <td>{{ $vehicals->modelname }}</td>
                        <td>{{ getVehicleType($vehicals->vehicletype_id) }}</td>
                        <td>{{ $vehicals->number_plate }}</td>
                        <td>{{ $vehicals->lastServiceDate ? $vehicals->lastServiceDate->format('Y-m-d') : 'No service records' }}</td>
                        
                        <td>
                          <div class="dropdown_toggle">
                              <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonAction" data-bs-toggle="dropdown" aria-expanded="false">

                              <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonAction">
                                  @can('vehicle_edit')
                                  <li><a class="dropdown-item" href="{!! url('/vehicle/list/edit/' . $vehicals->id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</a></li>
                                  @endcan
                              </ul>

                          </div>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @endif
        </div>

          <!-- Custom field  -->
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

          $tbl_custom = $tbl_custom_field->id;
          $userid = $customer->id;
          $datavalue = getCustomData($tbl_custom, $userid);

          $subDivCount++;
          ?>

          @if ($myCounts % 2 == 0)
          <div class="row row-mb-0">
            @endif

            <div class="row form-group col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 error_customfield_main_div_{{ $myCounts }}">
              <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="account-no">{{ $tbl_custom_field->label }} <label class="color-danger">{{ $red }}</label></label>
              <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                @if ($tbl_custom_field->type == 'textarea')
                <textarea name="custom[{{ $tbl_custom_field->id }}]" class="form-control textarea_{{ $tbl_custom_field->id }} textarea_simple_class common_simple_class common_value_is_{{ $myCounts }}" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="100" isRequire="{{ $required }}" type="textarea" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>{{ $datavalue }}</textarea>

                <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                @elseif($tbl_custom_field->type == 'radio')
                <?php
                $radioLabelArrayList = getRadiolabelsList($tbl_custom_field->id);
                ?>
                @if (!empty($radioLabelArrayList))
                <div style="margin-top: 5px;">
                  @foreach ($radioLabelArrayList as $k => $val)
                  <label><input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" value="{{ $k }}" <?php
                                                                                                                                  $getRadioValue = getRadioLabelValueForUpdate($customer->id, $tbl_custom_field->id);

                                                                                                                                  if ($k == $getRadioValue) {
                                                                                                                                    echo 'checked';
                                                                                                                                  } ?>> {{ $val }}</label> &nbsp;
                  @endforeach
                </div>
                @endif
                @elseif($tbl_custom_field->type == 'checkbox')
                <?php
                $checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id);
                ?>
                @if (!empty($checkboxLabelArrayList))
                <?php
                $getCheckboxValue = getCheckboxLabelValueForUpdate($customer->id, $tbl_custom_field->id);
                ?>
                <div class="required_checkbox_parent_div_{{ $tbl_custom_field->id }}" style="margin-top: 5px;">
                  @foreach ($checkboxLabelArrayList as $k => $val)
                  <label><input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }} " isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}" <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                      if ($val == getCheckboxVal($customer->id, $tbl_custom_field->id, $val)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                                                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                                                                                                                                                                                                                                      ?>> {{ $val }}</label> &nbsp;
                  @endforeach
                  <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                </div>
                @endif
                @elseif($tbl_custom_field->type == 'textbox')
                <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" value="{{ $datavalue }}" maxlength="30" class="form-control textDate_{{ $tbl_custom_field->id }} textdate_simple_class common_value_is_{{ $myCounts }} common_simple_class" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>

                <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display:none"></span>
                @elseif($tbl_custom_field->type == 'date')
                <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" value="{{ $datavalue }}" maxlength="30" class="form-control textDate_{{ $tbl_custom_field->id }} date_simple_class common_value_is_{{ $myCounts }} common_simple_class" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" onkeydown="return false" {{ $required }}>

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
          <!-- Custom field  -->

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
              <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
            </div> -->
            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
              <button type="submit" class="btn btn-success updateCustomerButton">{{ trans('message.UPDATE') }}</button>
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

<script>
  $(document).ready(function() {

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

    $('.datepicker').datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
      maxDate: new Date(),
      todayBtn: true,
      autoclose: 1,
      minView: 2,
      endDate: new Date(),
      language: "{{ getLangCode() }}",
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




    /***** Custom Field manually validation ******/
    var msg1 = "{{ trans('message.field is required') }}";
    var msg2 = "{{ trans('message.Only blank space not allowed') }}";
    var msg3 = "{{ trans('message.Special symbols are not allowed.') }}";
    var msg4 = "{{ trans('message.At first position only alphabets are allowed.') }}";

    /*Form submit time check validation for Custom Fields */
    $('body').on('click', '.updateCustomerButton', function(e) {
      $('#demo-form2 input, #demo-form2 select, #demo-form2 textarea').each(

        function(index) {
          var input = $(this);

          if (input.attr('name') == "firstname" || input.attr('name') =="email" || input.attr('name') == "password" || input.attr('name') == "password_confirmation" ||
            input.attr('name') == "mobile" || input.attr('name') == "country_id" || input.attr('name') ==
            "address") {
            if (input.val() == "") {
              return true;
            } else {
              return true;
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
              else if(!input.val().match(/^[a-zA-Z0-9][a-zA-Z0-9\s\.\@\-\_]*$/))        	
              // else if (!input.val().match(
              //     /^[(a-zA-Z0-9\s)\p{L}]+$/u
              //   )) {
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
                $('.error_customfield_main_div_' + rowid).removeClass('has-error');
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
          }
          //else if(!valueIs.match(/^[a-zA-Z0-9][a-zA-Z0-9\s\.\@\-\_]*$/))
          else if (!valueIs.match(
              /^[(a-zA-Z0-9\s)\p{L}]+$/u
            )) {
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
            }
            //else if(!valueIs.match(/^[a-zA-Z0-9][a-zA-Z0-9\s\.\@\-\_]*$/))
            else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
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
</script>

<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<!-- For form validation -->
{!! JsValidator::formRequest('App\Http\Requests\CustomerAddEditFormRequest', '#demo-form2') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection