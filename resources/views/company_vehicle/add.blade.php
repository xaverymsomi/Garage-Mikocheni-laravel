@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
         
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup"><a href="{!! url('/company_vehicle/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"class="mb-1"></i><span class="titleup">
              {{ trans('Add Company Vehicle') }}</span></a>
        </div>
        @include('dashboard.profile')
      </nav>
    </div>
  </div>
  <!-- <p class="col-md-12 col-xs-12 col-sm-12 ln_solid mt-3"></p> -->
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <form id="productAdd-Form" method="post" action="{{ url('/company_vehicle/store') }}" enctype="multipart/form-data" class="form-horizontal upperform productAddForm">

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('Vehicle Number') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">

                  <input type="text" id="p_no" name="p_no" class="form-control" value="{{ $code }}" placeholder="{{ trans('Enter Vehicle No') }}" readonly>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Purchase Date') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date ">
                  <input type="text" id="p_date" name="p_date" autocomplete="off" class="form-control datepicker productDate" value="{{ old('p_date', date('Y-m-d')) }}" placeholder="<?php echo getDatepicker(); ?>" style="width=" onkeypress="return false;">
                </div>
              </div>
            </div>


            {{-- <div class="row row-mb-0"> --}}
              {{-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Name') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="name" name="name" class="form-control" placeholder="{{ trans('Enter Vehicle Name') }}" value="{{ old('name') }}" maxlength="30" required>
                </div>
              </div> --}}

              {{-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control select_branch_product form-select" name="branch">
                    @foreach ($branchDatas as $branchData)
                    <option value="{{ $branchData->id }}">{{ $branchData->branch_name }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div> --}}
            {{-- </div> --}}

              

            <div class="row row-mb-0">
              {{-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Manufacturer Name') }} <label class="color-danger">*</label></label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <select id="p_type" name="p_type" class="form-control product_type_data form-select">
                    <option value="">--{{ trans('message.Select Manufacturing Name') }}--
                    </option>
                    @if (!empty($vehical_type))
                                 @foreach ($vehical_type as $vehical_types)
                                 <option value="{{ $vehical_types->id }}">
                                    {{ $vehical_types->vehicle_type }}
                                 </option>
                                 @endforeach
                                 @endif
                  </select>
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 addremove">
                  <button type="button" data-bs-target="#responsive-modal" data-bs-toggle="modal" class="btn btn-outline-secondary btn-sm">{{ trans('message.Add/Remove') }}</button>
                </div>
              </div> --}}

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('Quantity') }}</label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="number" id="quantity" name="quantity" class="form-control" placeholder="{{ trans('Enter Quantity') }}" value="1" maxlength="20">
                </div>
              </div>
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Warranty') }}</label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="warranty" name="warranty" class="form-control" placeholder="{{ trans('Enter Vehicle Warranty') }}" value="{{ old('warranty') }}" maxlength="20">
                </div>
              </div>
              
             
            </div>
            <!-- VEHICLE INFORMATION -->
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
              <h4><b>{{ trans('VEHICLE INFORMATION') }}</b></h4>
              <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
          </div>
      
          <div id="vehicle-info-container">
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
                              <select class="form-control select_make" name="vehicles[0][vehicabrand]" id="vehicabrand">
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
                              <select class="form-control select_body_type" name="vehicles[0][vehical_id]" id="vehical_id">
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
                              <select class="form-control select_model_name" name="vehicles[0][modelname]" id="modelname">
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
                          {{-- <div class="col-md-8">
                              
                          </div> --}}
                          <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                              {{-- <input type="file" id="image" name="image" class="form-control chooseImage"> --}}
                              <input type="file" name="vehicles[0][vehicle_images][]" class="form-control" multiple>
                              <img src="{{ url('public/product/avtar.png') }}" id="imagePreview" alt="User Image" class="datatable_img" style="width: 52px; padding-top: 8px;">
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row row-mb-0">

            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('Dealer Price') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">

                  <input type="text" id="dealer_price" name="dealer_price" class="form-control" value="{{ old('dealer_price') }}" placeholder="{{ trans('Dealer Price') }}">
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('price') ? ' has-error' : '' }} my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('Retail Price') }} (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="price" name="price" class="form-control" placeholder="{{ trans('Enter Product Retail Price') }}" value="{{ old('price') }}" maxlength="10" required>
                  @if ($errors->has('price'))
                  <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>

            <!-- Start Custom Field, (If register in Custom Field Module)  -->
            @if (!$tbl_custom_fields->isEmpty())
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
              @endforeach
              <?php
              if ($subDivCount % 2 != 0) {
                echo '</div>';
              }
              ?>
              @endif
              <!-- End Custom Field -->
              <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                  <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                    <a class="btn btn-primary productCancelButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                  </div> -->
                  <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 productSubmitButton my-2 mx-0">
                    <button type="submit" class="btn btn-success productSubmitButton">{{ trans('message.SUBMIT') }}</button>
                  </div>
                </div>
              </div>
          </form>
        </div>

        <!-- Vehicle Type  -->
        <div class="col-md-6">
            <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title"> {{ trans('message.Add Vehicle Type') }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                     </div>
                     <div class="modal-body">
                        <form name="" class="form-horizontal formaction" action="" method="">
                           <table class="table vehical_type_class">
                              <div class="row">
                                 <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 data_popup">
                                    <input type="text" class="form-control vehical_type model_input" name="vehical_type" id="vehical_type" placeholder="{{ trans('message.Enter Vehicle Type') }}" maxlength="20" required />
                                 </div>
                                 <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 data_popup">
                                    <button type="button" class="btn btn-success vehicaltypeadd model_submit" id="vehicleTypeSubmit" url="{!! url('/vehicle/vehicle_type_add') !!}">{{ trans('message.Submit') }}</button>
                                 </div>
                              </div>
                              <tbody>
                                 @if (!empty($vehical_type))
                                 @foreach ($vehical_type as $vehical_types)
                                 <tr class="del-{{ $vehical_types->id }} data_color_name row mx-1">
                                    <td class="text-start col-6">{{ $vehical_types->vehicle_type }}</td>
                                    <td class="text-end col-6"><button type="button" vehicletypeid="{{ $vehical_types->id }}" deletevehical="{!! url('/vehicle/vehicaltypedelete') !!}" class="btn btn-danger text-white border-0 deletevehicletype"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                 </tr>
                                 @endforeach
                                 @endif
                              </tbody>
                           </table>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
<!-- End  Vehicle Type  -->
            <!-- Vehicle Brand -->
            <div class="col-md-6">
                <div id="responsive-modal-brand" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                      <div class="modal-content">
                         <div class="modal-header">
                            <h4 class="modal-title">{{ trans('message.Add Vehicle Brand') }}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                         </div>
                         <div class="modal-body">
                            <form class="form-horizontal" action="" method="">
                               <div class="row">
                                  <div class="col-md-5 form-group data_popup">
                                     <select class="form-control vehical_id model_input form-select" name="vehical_id" id="vehicleTypeSelect" vehicalurl="{!! url('/vehicle/vehicalformtype') !!}" required>
                                        <option>{{ trans('message.Select Vehicle Type') }}</option>
                                        @if (!empty($vehical_type))
                                        @foreach ($vehical_type as $types)
                                        <option value="{{ $types->id }}">
                                           {{ $types->vehicle_type }}
                                        </option>
                                        @endforeach
                                        @endif
                                     </select>
                                  </div>
                               </div>
                               <div class="row">
                                  <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group data_popup">
                                     <input type="text" class="form-control vehical_brand model_input" name="vehical_brand" id="vehical_brand" placeholder="{{ trans('message.Enter Vehicle Brand') }}" maxlength="25" required />
                                  </div>
                                  <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 form-group data_popup"> 
                                     <button type="button" class="btn btn-success vehicalbrandadd mt-0" vehiclebrandurl="{!! url('/vehicle/vehicle_brand_add') !!}">{{ trans('message.Submit') }}</button>
                                  </div>
                               </div>
                         </div>
                         <table class="table vehical_brand_class">
                         <tbody>
                         @if (!empty($vehical_brand))
                         @foreach ($vehical_brand as $vehical_brands)
                         <tr class="del-{{ $vehical_brands->id }} data_color_name row mx-3">
                         <td class="text-start col-6">
                         {{ $vehical_brands->vehicle_brand }}
                         </td>
                         <td class="text-end col-6">
                         <button type="button" brandid="{{ $vehical_brands->id }}" deletevehicalbrand="{!! url('/vehicle/vehicalbranddelete') !!}" class="btn btn-danger text-white border-0 deletevehiclebrands"><i class="fa fa-trash" aria-hidden="true"></i></button>
                         </td>
                         </tr>
                         @endforeach
                         @endif
                         </tbody>
                         </table>
                         </form>
                      </div>
                   </div>
                </div>
             </div>
        
 
        
      </div>
    </div>
  </div>
</div>
<!-- /page content -->



<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
   
  $(document).ready(function() {

    $('.datepicker').datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
      todayBtn:true,
      autoclose: 1,
      minView: 2,
      endDate: new Date(),
      language: "{{ getLangCode() }}",
     
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

    var msg17 = "{{ trans('message.Please enter only alphanumeric data') }}";
    var msg18 = "{{ trans('message.Only blank space not allowed') }}";
    var msg19 = "{{ trans('message.This Record is Duplicate') }}";
    var msg20 = "{{ trans('message.An error occurred :') }}";

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
                                title:msg53,
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

                            $('.color_name_data').append('<option value=' + data + ' style="background-color:' + c_code + ';color: #ffffff;">' + c_name +
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


    var msg1 = "{{ trans('message.Are You Sure?') }}";
    var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
    var msg3 = "{{ trans('message.Cancel') }}";
    var msg4 = "{{ trans('message.Yes, delete!') }}";
    var msg5 = "{{ trans('message.Done!') }}";
    var msg6 = "{{ trans('message.Manufacturer Deleted Successfully') }}";
    var msg7 = "{{ trans('message.Cancelled') }}";
    var msg8 = "{{ trans('message.Your data is safe') }}";
    var unitdelete = "{{ trans('message.Unit Of Measurement Deleted Successfully') }}";
    var colordelete = "{{ trans('message.Color Deleted Successfully') }}";

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
              $(".color_name_data option[value=" + colorid + "]")
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


    /*Product type add add  model*/
    $('.addtype').click(function() {
      var product_type = $('.product_type').val();
      var url = $(this).attr('producturl');

      var msg21 = "{{ trans('message.Please enter manufacturer name') }}";

      function define_variable() {
        return {
          product_type_value: $('.product_type').val(),
          product_type_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
          product_type_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
        };
      }

      var call_var_product_typeadd = define_variable();

      if (product_type == "") {
        swal({
          title: msg21,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });

      } else if (!call_var_product_typeadd.product_type_pattern.test(call_var_product_typeadd
          .product_type_value)) {
        $('.product_type').val("");
        swal({
          title: msg17,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true, 
        });
      } else if (!product_type.replace(/\s/g, '').length) {
        $('.product_type').val("");
        swal({
          title: msg18,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });

      } else if (!call_var_product_typeadd.product_type_pattern2.test(call_var_product_typeadd
          .product_type_value)) {
        $('.product_type').val("");
        swal({
          title: msg34,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });
      } else {
        $.ajax({
          type: 'GET',
          url: url,
          data: {
            product_type: product_type 
          },

          //Form submit at a time only one for addProductType(Manufacture Name)
          beforeSend: function() {
            $(".addtype").prop('disabled', true);
          },
          success: function(data) {
            var newd = $.trim(data);
            var classname = 'del-' + newd;

            if (data == '01') {
              swal({
                title: msg19,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });
            } else {
              $('.producttype').append('<tr class="data_of_type row mx-1 ' + classname +
                '"><td class="text-start">' +
                product_type +
                '</td><td class="text-end"><button type="button" productid=' +
                data +
                ' deleteproduct="{!! url('prodcttypedelete') !!}" class="btn btn-danger text-white border-0 deleteproducted"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
              );

              $('.product_type_data').append('<option value=' + data + '>' +
                product_type + '</option>');

              $('.product_type').val('');
            }

            //Form submit at a time only one for addProductType(Manufacture Name)
            $(".addtype").prop('disabled', false);
            return false;
          },
          error: function(e) {
            alert(msg20 + " " + e.responseText);
            console.log(e);
          }
        });
      }
    });


    /*Product Type Delete  model*/
    $('body').on('click', '.deleteproducted', function() {
      var ptypeid = $(this).attr('productid');
      var url = $(this).attr('deleteproduct');
      swal({
        title: msg1,
        text: msg2,
        icon: 'warning',
        cancelButtonColor: '#C1C1C1',
        buttons: [msg3, msg4],
        dangerMode: true,
      }).then((isConfirm) => {
        if (isConfirm) {
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              ptypeid: ptypeid
            },
            success: function() {
              $('.del-' + ptypeid).remove();
              $(".product_type_data option[value=" + ptypeid + "]")
                .remove();
              swal({
                title: msg5,
                text: msg6,
                icon: "success",
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
            icon: "success",
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });

        }
      });


    });


    /*Unit add  model*/
    $('.addunit').click(function() {
      var unit_measurement = $('.u_name').val();
      var url = $(this).attr('uniturl');

      
      var msg9 = "{{ trans('message.Please enter unit of measurement') }}";

      function define_variable() {
        return {
          unit_measurement_value: $('.u_name').val(),
          unit_measurement_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
          unit_measurement_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
        };
      }

      var call_var_unit_measurementadd = define_variable();

      if (unit_measurement == "") {
        swal({
          title: msg9,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });
      } else if (!call_var_unit_measurementadd.unit_measurement_pattern.test(
          call_var_unit_measurementadd
          .unit_measurement_value)) {
        $('.u_name').val("");
        swal({
          title: msg17,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });

      } else if (!unit_measurement.replace(/\s/g, '').length) {
        $('.u_name').val("");
        swal({
          title: msg18,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });

      } else if (!call_var_unit_measurementadd.unit_measurement_pattern2.test(
          call_var_unit_measurementadd
          .unit_measurement_value)) {
        $('.u_name').val("");
        swal({
          title: msg34,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });

      } else {
        $.ajax({
          type: 'GET',
          url: url,
          data: {
            unit_measurement: unit_measurement
          },

          //Form submit at a time only one for addUnitModel
          beforeSend: function() {
            $(".addunit").prop('disabled', true);
          },
          success: function(data) {
            var newd = $.trim(data);
            var deleteclass = 'delete-' + newd;

            if (data == '01') {
              swal({
                title: msg19,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });
            } else {
              $('.unitproductname').append('<tr class=" row mx-1 ' + deleteclass +
                ' data_unit_name"><td class="text-start">' +
                unit_measurement +
                '</td><td class="text-end"><button type="button" unitid=' +
                data +
                ' u_url="{!! url('product/unitdelete') !!}" class="btn btn-danger text-white border-0 unitdelete"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td></tr>'
              );

              $('.unit_product_data').append('<option value=' + data + '>' +
                unit_measurement +
                '</option>');

              $('.u_name').val('');
            }

            //Form submit at a time only one for addUnitModel
            $(".addunit").prop('disabled', false);
            return false;
          },
          error: function(e) { 
            alert(msg20 + ' ' + e.responseText);
            console.log(e);
          }
        });
      }
    });


    $('body').on('click', '.unitdelete', function() {
      var unitid = $(this).attr('unitid');
      var url = $(this).attr('u_url');

      swal({
        title: msg1,
        text: msg2,
        icon: 'warning',
        cancelButtonColor: '#C1C1C1',
        buttons: [msg3, msg4],
        dangerMode: true,
      }).then((isConfirm) => {
        if (isConfirm) {
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              unitid: unitid
            },
            success: function(data) {

              $('.delete-' + unitid).remove();
              $(".unit_product_data option[value=" + unitid + "]")
                .remove();
              swal({
                title: msg5,
                text: unitdelete,
                icon: "success",
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
            icon: "error",
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        }
      });


    });

    $(".select_supplier_auto_search").select2();


    /*If date field have value then error msg and has error class remove*/
    $('body').on('change', '.productDate', function() {
      var outDateValue = $(this).val();

      if (outDateValue != null) {
        $('#p_date-error').css({
          "display": "none"
        });
      }

      if (outDateValue != null) {
        $(this).parent().parent().removeClass('has-error');
      }
    });


    /*If select box have value then error msg and has error class remove*/
    $('#sup_id').on('change', function() {

      var supplierValue = $('select[name=sup_id]').val();

      if (supplierValue != null) {
        $('#sup_id-error').css({
          "display": "none"
        });
      }

      if (supplierValue != null) {
        $(this).parent().parent().removeClass('has-error');
      }
    });


    /*If any white space then is is not allowed it*/
    $('body').on('keyup', '.product_type', function() {

      var product_typeValue = $(this).val();

      if (!product_typeValue.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });

    $('body').on('keyup', '.c_name', function() {

      var c_nameValue = $(this).val();

      if (!c_nameValue.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });

    $('body').on('keyup', '.u_name', function() {

      var u_nameValue = $(this).val();

      if (!u_nameValue.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });


    /*Custom Field manually validation*/
    var msg31 = "{{ trans('message.field is required') }}";
    var msg32 = "{{ trans('message.Only blank space not allowed') }}";
    var msg33 = "{{ trans('message.Special symbols are not allowed.') }}";
    var msg34 = "{{ trans('message.At first position only alphabets are allowed.') }}";

    /*Form submit time check validation for Custom Fields */
    $('body').on('click', '.productSubmitButton', function(e) {
      $('#productAdd-Form input, #productAdd-Form select, #productAdd-Form textarea').each(

        function(index) {
          var input = $(this);

          if (input.attr('name') == "p_date" || input.attr('name') == "name" || input
            .attr('name') ==
            "price" || input.attr('name') == "unit" || input.attr('name') == "sup_id") {
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
  });
</script>

<script>
    // Color name to HTML color value mapping
    const colorMap = {
        "red": "#ff0000",
        "blue": "#0000FF",
        "green": "#008000",
        "black": "#000000",
        "brown": "#A52A2A",
        "grey": "#808080",
        "pink": "#FFC0CB",
        "purple": "#800080",
        "yellow": "#FFFF00",
    };
    let colorPickerChanged = false;
    function removeSpecialSymbols(str) {
        return str.replace(/[^a-zA-Z0-9]/g, '');
    }

    // Get references to the color input and text input
    const colorInput = document.getElementById("c_code");
    const textInput = document.getElementById("c_name");

    // Add an event listener to the color input to update the text input
    colorInput.addEventListener("input", function () {
        const cleanedColorCode = removeSpecialSymbols(colorInput.value);
        textInput.value = `custom${cleanedColorCode}`;
        colorPickerChanged = true;
    });
</script>


<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\ProductAddEditFormRequest', '#productAdd-Form') !!}
<<<<<<< HEAD
<script type="text/javascript"src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
=======
<script type="text/javascript"
  src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

>>>>>>> 723c46cc149b3e892bfe937a70101070799b9d16
@endsection
