@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="page-title">
      <div class="nav_menu">
         <nav>

       
            <div class="nav toggle">
               <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/vehicle/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
               {{ trans('message.Add Vehicle') }}  </span></a>
            </div>
            @include('dashboard.profile')
         </nav>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <section id="" class="">

                    <div class="panel-body padding_0 pb-0">
                      <div class="row margin_top_15px mx-1">
                        <div class="col-xl-3 col-md-3 col-sm-6">
                          <label class="">{{ trans('message.Display Name') }} </label><br>
                          <label class="fw-bold">{{ $customer->name }}<br></label>
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                          <div class="guardian_div mb-2">
                            <p class="fw-bold overflow-visible h5"> {{ trans('message.Address Details') }} </p>
                            <div class="row">
                              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                                <label class=""> {{ trans('message.Country') }}: </label>
                                <label class="fw-bold">
                                  {{ getCountryName($customer->country_id) }}
                                </label>
                              </div>
                              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                                <label class=""> {{ trans('message.Town/City') }}: </label>
                                <label class="fw-bold">
                                  {{ getStateName($customer->state_id)  ?? trans('message.Not Added') }}
                                </label>
                              </div>
                              <div class="col-xl-12 col-md-12 col-sm-12 mt-1">
                                <label class=""> {{ trans('message.Address') }}: </label>
                                <label class="fw-bold">
                                  {{ getAddressName($customer->id)  ?? trans('message.Not Added') }}
                                </label>
                              </div>
                              <!-- <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                                <label class=""> {{ trans('message.Address') }}: </label>
                                <label class="text-dark fw-bold">{{ $customer->address }}</label>
                              </div> -->
                            </div>
                
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
                        <table id="supplier" class="table responsive jumbo_table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ trans('message.Photo') }}</th>
                                    <th>{{ trans('message.BRAND/MODEL NAME') }}</th>
                                    <th>{{ trans('message.TYPE') }}</th>
                                    <th>{{ trans('message.NUMBER PLATE') }}</th>
                                    <th>{{ trans('message.LAST SERVICE DATE') }}</th>
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
                                    <!-- <td><button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" serviceid="{{ $vehicals->id }}" class="btn save border-0"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3"></button></td> -->
                                    
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        @endif
                    </div>
                    </div>
                    <!-- END PANEL BODY DIV-->
                
                  </section>
                <form id="vehicleAdd-Form" action="{{ url('/search-customer/store_vehicle') }}" method="POST" enctype="multipart/form-data" class="form-horizontal upperform vehicleAddForm">
                    @csrf
                    <input type="hidden" name="id" value="{{ $customer->id }}">
                <!-- VEHICLE INFORMATION -->
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                    <h4><b>{{ trans('VEHICLE INFORMATION') }}</b></h4>
                    <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                </div>
            
                <div id="vehicle-info-container">
                    <!-- Vehicle Info Template -->
                    <div class="vehicle-info-template row row-mb-0">
                       <div class="row">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Number Plate') }} <label class="text-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                               <input type="text" name="vehicles[0][number_plate]" value="{{ old('number_plate') }}" placeholder="{{ trans('message.Enter Number Plate') }}" maxlength="30" class="form-control number_plate">
                            </div>
                         </div>
                        
                         <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Model Years') }} <label class="text-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                               <input type="text" name="vehicles[0][model_year]" autocomplete="off" class="form-control" id="myDatepicker2" />
                            </div>
                         </div>
                       </div>
                       <div class="row">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('Make') }}<label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <div class="select-wrapper">
                                    <select class="form-control select_make select_branch form-select" name="vehicles[0][vehicabrand]" id="vehicabrand">
                                        <option value="">{{ trans('Select Make') }}</option>
                                        @if (!empty($vehical_brand))
                                            @foreach ($vehical_brand as $vehical_brands)
                                                <option value="{{ $vehical_brands->id }}">
                                                    {{ $vehical_brands->vehicle_brand }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="arrow-icon-branch"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Chassis No') }} <label class="text-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                               <input type="text" name="vehicles[0][chassis_no]" value="{{ old('chasicno') }}" placeholder="{{ trans('message.Enter Chassis No.') }}" maxlength="30" class="form-control chassis_no">
                            </div>
                         </div>
                        
                          
                     </div>
                     <div class="row">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('Body Type') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <div class="select-wrapper">
                                    <select class="form-control select_body_type select_branch form-select" name="vehicles[0][vehical_id]" id="vehical_id">
                                        <option value="">{{ trans('message.Select Type') }}</option>
                                        @if (!empty($vehical_type))
                                            @foreach ($vehical_type as $vehical_types)
                                                <option value="{{ $vehical_types->id }}">
                                                    {{ $vehical_types->vehicle_type }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="arrow-icon-branch"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Engine No') }} <label class="text-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                               <input type="text" name="vehicles[0][engine_no]" placeholder="{{ trans('message.Enter Engine No') }}" class="form-control">
                            </div>
                         </div>
                       
                          
                     </div>
                     <div class="row">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('Model Name') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <div class="select-wrapper">
                                    <select class="form-control select_branch form-select" name="vehicles[0][modelname]" id="modelname">
                                        <option value="">{{ trans('message.Select Model') }}</option>
                                    </select>
                                    <div class="arrow-icon-branch"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('Fuel') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                               <div class="select-wrapper">
                                  <select class="form-control select_branch form-select" name="vehicles[0][fueltype]">
                                    <option value="">{{ trans('message.Select fuel') }} </option>
                                     @if (!empty($fuel_type))
                                     @foreach ($fuel_type as $fuel_types)
                                     <option value="{{ $fuel_types->id }}">{{ $fuel_types->fuel_type }}
                                     </option>
                                     @endforeach
                                     @endif
                                  </select>
                                  <div class="arrow-icon-branch"></div>
                               </div>
                            </div>
                         </div> 
                        

                          
                    </div>
                    <div class="row">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('Color') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                               <div class="select-wrapper">
                                  <select class="form-control select_branch form-select" name="vehicles[0][color]">
                                    <option value="">{{ trans('message.-- Select Color --') }}</option>
                                    @if (!empty($color))
                                    @foreach ($color as $colors)
                                    <option value="{{ $colors->id }}" style="background-color:{{ $colors->color_code }}; color: #ffffff;">{{ $colors->color }}</option>
                                    @endforeach
                                    @endif
                                  </select>
                                  <div class="arrow-icon-branch"></div>
                               </div>
                            </div>
                         </div>
                         <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                               <div class="select-wrapper">
                                  <select class="form-control select_branch form-select" name="vehicles[0][branch]">
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
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-form-group has-feedback">
                             <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">Vehicle Images <label class="color-danger">*</label></label>
                             <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                 <!-- Allow multiple image uploads -->
                                 <input type="file" name="vehicle_images[]" class="form-control" multiple>
                             </div>
                         </div>
                     </div>
                </div>
                </div>
                 
                  <!-- Start Custom Field, (If register in Custom Field Module)  -->
                  @if (!empty($tbl_custom_fields))
                  <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">

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
                           <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" span>
                           @elseif($tbl_custom_field->type == 'radio')
                           <?php
                              $radioLabelArrayList = getRadiolabelsList($tbl_custom_field->id);
                              ?>
                           @if (!empty($radioLabelArrayList))
                           <div class="mt-1">
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
                           <div class="mt-1 required_checkbox_parent_div_{{ $tbl_custom_field->id }}">
                              @foreach ($checkboxLabelArrayList as $k => $val)
                              <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}"> {{ $val }}
                              &nbsp;
                              <?php $cnt++; ?>
                              @endforeach
                              <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger"></span>
                           </div>
                           <input type="hidden" name="checkboxCount" value="{{ $cnt }}">
                           @endif
                           @elseif($tbl_custom_field->type == 'textbox')
                           <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" class="form-control textDate_{{ $tbl_custom_field->id }} textdate_simple_class common_value_is_{{ $myCounts }} common_simple_class" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="30" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>
                           <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger"></span>
                           @elseif($tbl_custom_field->type == 'date')
                           <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" class="form-control textDate_{{ $tbl_custom_field->id }} date_simple_class common_value_is_{{ $myCounts }} common_simple_class" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="30" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }} onkeydown="return false">
                           <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger"></span>
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
                  <!-- End Custom Field -->
                  <div class="row">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                        <button type="button" class="btn btn-success customerAddSubmitButton" url="{!! url('customer_vehicle/add/getanother_vehicle') !!}" id="add-more-vehicles">
                            {{ trans('Add another Vehicle') }}
                        </button>
                    </div>
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                        <a class="btn btn-primary vehicleAddCancleButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                        </div> -->
                     <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                        <button type="submit" class="btn btn-success vehicleAddSubmitButton">{{ trans('message.SUBMIT') }}</button>
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
   
       /*vehicle type*/
       $('.vehicaltypeadd').click(function() {
   
           var vehical_type = $('.vehical_type').val();
           var url = $(this).attr('url');
           // alert(vehical_type);
           var msg13 = "{{ trans('message.Please enter vehicle type') }}";
   
           function define_variable() {
               return {
                   vehicle_type_value: $('.vehical_type').val(),
                   vehicle_type_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                   vehicle_type_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
               };
           }
   
           var call_var_vehicletypeadd = define_variable();
   
           if (vehical_type == "") {
               swal({
                   title: msg13,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
   
           } else if (!call_var_vehicletypeadd.vehicle_type_pattern.test(call_var_vehicletypeadd
                   .vehicle_type_value)) {
               $('.vehical_type').val("");
               swal({
                   title: msg14,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!vehical_type.replace(/\s/g, '').length) {
               $('.vehical_type').val("");
               swal({
                   title: msg15,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!call_var_vehicletypeadd.vehicle_type_pattern2.test(call_var_vehicletypeadd
                   .vehicle_type_value)) {
               $('.vehical_type').val("");
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
                       vehical_type: vehical_type
                   },
   
                   beforeSend: function() {
                       $(".vehicaltypeadd").prop('disabled', true);
                   },
   
                   success: function(data) {
   
                       var newd = $.trim(data);
                       var classname = 'del-' + newd;
   
                       if (newd == '01') {
                           swal({
                               title: msg16,
                               cancelButtonColor: '#C1C1C1',
                               buttons: {
                                   cancel: msg35,
                               },
                               dangerMode: true,
                           });
                       } else {
                           $('.vehical_type_class').append('<tr class=" data_color_name row mx-1 ' + classname +
                               '"><td class="text-start col-6">' +
                               vehical_type +
                               '</td><td class="text-end col-6"><button type="button" vehicletypeid=' +
                               data +
                               ' deletevehical="{!! url('/vehicle/vehicaltypedelete') !!}" class="btn btn-danger text-white border-0 deletevehicletype"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                           );
   
                           $('.select_vehicaltype').append('<option value=' + data + '>' +
                               vehical_type + '</option>');
                           $('.vehical_type').val('');
   
                           $('.vehical_id').append('<option value=' + data + '>' +
                               vehical_type + '</option>');
                           $('.vehical_type').val('');
                       }
   
                       $(".vehicaltypeadd").prop('disabled', false);
                       return false;
                   },
               });
           }
       });
   
   
       var msg1 = "{{ trans('message.Are You Sure?') }}";
       var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
       var msg3 = "{{ trans('message.Cancel') }}";
       var msg4 = "{{ trans('message.Yes, delete!') }}";
       var msg5 = "{{ trans('message.Done!') }}";
       var msg6 = "{{ trans('message.It was succesfully deleted!') }}";
       var msg7 = "{{ trans('message.Cancelled') }}";
       var msg8 = "{{ trans('message.Your data is safe') }}";
       var vtypedelete = "{{ trans('message.Vehicle Type Deleted Successfully') }}";
       var vbranddelete = "{{ trans('message.Vehicle Brand Deleted Successfully') }}";
       var fueldelete = "{{ trans('message.Fuel Type Deleted Successfully') }}";
       var modeldelete = "{{ trans('message.Model Deleted Successfully') }}";
       var colordelete = "{{ trans('message.Color Deleted Successfully') }}";
   
       /*vehical Type delete*/
       $('body').on('click', '.deletevehicletype', function() {
   
           var vtypeid = $(this).attr('vehicletypeid');
           var url = $(this).attr('deletevehical');
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
                           vtypeid: vtypeid
                       },
                       success: function(data) {
                           $('.del-' + vtypeid).remove();
                           $(".select_vehicaltype option[value=" + vtypeid + "]")
                               .remove();
                           $("#vehicleTypeSelect option[value=" + vtypeid + "]")
                               .remove();
                           swal({
                               title: msg5,
                               text: vtypedelete,
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
   
       /*vehical brand*/
       $('.vehicalbrandadd').click(function() {
   
           var vehical_id = $('.vehical_id').val();
           var vehical_brand = $('.vehical_brand').val();
           var url = $(this).attr('vehiclebrandurl');
   
           var msg17 = "{{ trans('message.Please first select vehicle type') }}";
           var msg18 = "{{ trans('message.Please enter vehicle brand') }}";
   
           function define_variable() {
               return {
                   vehicle_brand_value: $('.vehical_brand').val(),
                   vehicle_brand_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                   vehicle_brand_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
               };
           }
   
           var call_var_vehiclebrandadd = define_variable();
   
           if ($("#vehicleTypeSelect")[0].selectedIndex <= 0) {
   
               swal({
                   title: msg17,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else {
               if (vehical_brand == "") {
                   swal({
                       title: msg18,
                       cancelButtonColor: '#C1C1C1',
                       buttons: {
                           cancel: msg35,
                       },
                       dangerMode: true,
                   });
               } else if (!call_var_vehiclebrandadd.vehicle_brand_pattern.test(call_var_vehiclebrandadd
                       .vehicle_brand_value)) {
                   $('.vehical_brand').val("");
                   swal({
                       title: msg33,
                       cancelButtonColor: '#C1C1C1',
                       buttons: {
                           cancel: msg35,
                       },
                       dangerMode: true,
                   });
               } else if (!vehical_brand.replace(/\s/g, '').length) {
                   // var str = "    ";
                   $('.vehical_brand').val("");
                   swal({
                       title: msg32,
                       cancelButtonColor: '#C1C1C1',
                       buttons: {
                           cancel: msg35,
                       },
                       dangerMode: true,
                   });
               } else if (!call_var_vehiclebrandadd.vehicle_brand_pattern2.test(
                       call_var_vehiclebrandadd
                       .vehicle_brand_value)) {
                   $('.vehical_brand').val("");
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
                           vehical_id: vehical_id,
                           vehical_brand: vehical_brand
                       },
   
                       beforeSend: function() {
                           $(".vehicalbrandadd").prop('disabled', true);
                       },
   
                       success: function(data) {
                           var newd = $.trim(data);
                           var classname = 'del-' + newd;
   
                           if (newd == "01") {
                               swal({
                                   title: msg16,
                                   cancelButtonColor: '#C1C1C1',
                                   buttons: {
                                       cancel: msg35,
                                   },
                                   dangerMode: true,
                               });
                           } else {
                               $('.vehical_brand_class').append('<tr class=" data_color_name row mx-3 ' + classname +
                                   '"><td class="text-start col-6">' + vehical_brand +
                                   '</td><td class="text-end col-6"><button type="button" brandid=' +
                                   data +
                                   ' deletevehicalbrand="{!! url('vehicle/vehicalbranddelete') !!}" class="btn btn-danger text-white border-0 deletevehiclebrands"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                               );
   
                               $('.select_vehicalbrand').append('<option value=' + data +
                                   '>' + vehical_brand +
                                   '</option>');
   
                               $('.vehi_brand_id').append('<option value=' + data +
                                   '>' + vehical_brand +
                                   '</option>');
   
                               $('.vehical_brand').val('');
                           }
   
                           $(".vehicalbrandadd").prop('disabled', false);
                           return false;
                       },
   
                   });
               }
           }
       });
   
   
       /*vehical brand delete*/
       $('body').on('click', '.deletevehiclebrands', function() {
   
           var vbrandid = $(this).attr('brandid');
           var url = $(this).attr('deletevehicalbrand');
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
                           vbrandid: vbrandid
                       },
                       success: function(data) {
                           $('.del-' + vbrandid).remove();
                           $(".select_vehicalbrand option[value=" + vbrandid + "]")
                               .remove();
                           swal({
                               title: msg5,
                               text: vbranddelete,
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
   
   
   
       $('.fueltypeadd').click(function() {
   
           var fuel_type = $('.fuel_type').val();
           var url = $(this).attr('fuelurl');
   
           var msg21 = "{{ trans('message.Please enter fuel type') }}";
   
           function define_variable() {
               return {
                   vehicle_fuel_value: $('.fuel_type').val(),
                   vehicle_fuel_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                   vehicle_fuel_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
               };
           }
   
           var call_var_vehiclefueladd = define_variable();
   
           if (fuel_type == "") {
               swal({
                   title: msg21,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!call_var_vehiclefueladd.vehicle_fuel_pattern.test(call_var_vehiclefueladd
                   .vehicle_fuel_value)) {
               $('.fuel_type').val("");
               swal({
                   title: msg14,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!fuel_type.replace(/\s/g, '').length) {
               // var str = "    ";
               $('.fuel_type').val("");
               swal({
                   title: msg15,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!call_var_vehiclefueladd.vehicle_fuel_pattern2.test(call_var_vehiclefueladd
                   .vehicle_fuel_value)) {
               $('.fuel_type').val("");
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
                       fuel_type: fuel_type
                   },
   
                   beforeSend: function() {
                       $(".fueltypeadd").prop('disabled', true);
                   },
   
                   success: function(data) {
                       var newd = $.trim(data);
                       var classname = 'del-' + newd;
   
                       if (newd == '01') {
                           swal({
                               title: msg16,
                               cancelButtonColor: '#C1C1C1',
                               buttons: {
                                   cancel: msg35,
                               },
                               dangerMode: true,
                           });
                       } else {
                           $('.fuel_type_class').append('<tr class=" data_of_type row mx-1 ' + classname +
                               '"><td class="text-start col-6">' +
                               fuel_type +
                               '</td><td class="text-end col-6"><button type="button" fuelid=' +
                               data +
                               ' deletefuel="{!! url('/vehicle/fueltypedelete') !!}" class="btn btn-danger text-white border-0 fueldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                           );
   
                           $('.select_fueltype').append('<option value=' + data + '>' +
                               fuel_type + '</option>');
   
                           $('.fuel_type').val('');
                       }
   
                       $(".fueltypeadd").prop('disabled', false);
                       return false;
                   },
   
               });
           }
       });
   
   
       /*Fuel  Type delete*/
       $('body').on('click', '.fueldeletes', function() {
           var fueltypeid = $(this).attr('fuelid');
           var url = $(this).attr('deletefuel');
   
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
                           fueltypeid: fueltypeid
                       },
                       success: function(data) {
                           $('.del-' + fueltypeid).remove();
                           $(".select_fueltype option[value=" + fueltypeid + "]")
                               .remove();
                           swal({
                               title: msg5,
                               text: fueldelete,
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
   
   
       /*Add Vehicle Model*/
       $('.vehi_model_add').click(function() {
           var model_name = $('.vehi_modal_name').val();
           var model_url = $(this).attr('modelurl');
           var brand_id = $('.vehi_brand_id').val();
   
           var msg9 = "{{ trans('message.Please enter model name') }}";
   
           function define_variable() {
               return {
                   vehicle_model_value: $('.vehi_modal_name').val(),
                   vehicle_model_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                   vehicle_model_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
               };
           }
   
           var call_var_vehiclemodeladd = define_variable();
   
           if (model_name == "") {
               swal({
                   title: msg9,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!call_var_vehiclemodeladd.vehicle_model_pattern.test(call_var_vehiclemodeladd
                   .vehicle_model_value)) {
               $('.vehi_modal_name').val("");
               swal({
                   title: msg14,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!model_name.replace(/\s/g, '').length) {
               $('.vehi_modal_name').val("");
               swal({
                   title: msg15,
                   cancelButtonColor: '#C1C1C1',
                   buttons: {
                       cancel: msg35,
                   },
                   dangerMode: true,
               });
           } else if (!call_var_vehiclemodeladd.vehicle_model_pattern2.test(call_var_vehiclemodeladd
                   .vehicle_model_value)) {
               $('.vehi_modal_name').val("");
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
                   url: model_url,
                   data: {
                       model_name: model_name,
                       brand_id: brand_id
                   },
   
                   beforeSend: function() {
                       $(".vehi_model_add").prop('disabled', true);
                   },
   
                   success: function(data) {
                       var newd = $.trim(data);
                       var classname = 'mod-' + newd;
   
                       if (newd == '01') {
                           swal({
                               title: msg16,
                               cancelButtonColor: '#C1C1C1',
                               buttons: {
                                   cancel: msg35,
                               },
                               dangerMode: true,
                           });
                       } else {
                           $('.vehi_model_class').append('<tr class=" data_color_name row mx-1 ' + classname +
                               '"><td class="text-start col-6">' +
                               model_name +
                               '</td><td class="text-end col-6"><button type="button" modelid=' +
                               data +
                               ' deletemodel="{!! url('/vehicle/vehicle_model_delete') !!}" class="btn btn-danger text-white border-0 modeldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                           );
                           $('.model_addname').append("<option value='" + model_name +
                               "'>" + model_name +
                               "</option>");
                           $('.vehi_modal_name').val('');
                       }
   
                       $(".vehi_model_add").prop('disabled', false);
                       return false;
                   },
               });
           }
       });
   
       /*Delete vehicle model*/
       $('body').on('click', '.modeldeletes', function() {
   
           var mod_del_id = $(this).attr('modelid');
           var del_url = $(this).attr('deletemodel');
   
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
                       url: del_url,
                       data: {
                           mod_del_id: mod_del_id
                       },
                       success: function(data) {
                           $('.mod-' + mod_del_id).remove();
                           $(".model_addname option[value=" + mod_del_id + "]")
                               .remove();
                           swal({
                               title: msg5,
                               text: modeldelete,
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
   
   
       /*vehical Type from brand*/
       $('.select_vehicaltype').change(function() {
           vehical_id = $(this).val();
           var url = $(this).attr('vehicalurl');
   
           $.ajax({
               type: 'GET',
               url: url,
               data: {
                   vehical_id: vehical_id
               },
               success: function(response) {
                   $('.select_vehicalbrand').html(response);
   
                   $('.select_vehicalbrand').trigger('change');
               }
           });
       });
   
       /*vehical Model from brand*/
       $('.select_vehicalbrand').change(function() {
           id = $(this).val();
           var url = $(this).attr('url');
   
           $.ajax({
               type: 'GET',
               url: url,
               data: {
                   id: id
               },
               success: function(response) { 
                   $('.model_addname').html(response);
               }
           });
       });
   
       var msg100 = "{{ trans('message.An error occurred :') }}";
   
       /*Vehical Description*/
       $("#add_new_description").click(function() {
   
           var row_id = $("#tab_decription_detail > tbody > tr").length;
           var url = $(this).attr('url');
           var row_number = row_id + 1;
           $.ajax({
               type: 'GET',
               url: url,
               data: {
                   row_id: row_id
               },
               beforeSend: function() {
                   $("#add_new_description").prop('disabled', true); // disable button
               },
               success: function(response) {
                   $("#tab_decription_detail > tbody").append(response.html);
                   $("#tab_decription_detail > tbody").css({
                       borderTop: "1px solid #dee2e6",
                   });
                   // $("#tab_decription_detail > tbody > tr").style.borderTop = "thick solid #0000FF";
                   document.getElementById('row_id_' + row_number).style.borderTop =
                       "1px solid #dee2e6"
   
                   $("#add_new_description").prop('disabled', false); // enable button
                   return false;
               },
               error: function(e) {
                   alert(msg100 + " " + e.responseText);
                   console.log(e);
               }
           });
       });
   
   
       $('body').on('click', '.delete_description', function() {
           var row_id = $(this).attr('data-id');
   
           $('table#tab_decription_detail tr#row_id_' + row_id).remove();
           return false;
       });
   
   
       /*vehical color*/
       $("#add_new_color").click(function() {
           var color_id = $("#tab_color > tbody > tr").length;
           var url = $(this).attr('url');
   
           $.ajax({
               type: 'GET',
               url: url,
               data: {
                   color_id: color_id
               },
               beforeSend: function() {
                   $("#add_new_color").prop('disabled', true); // disable button
               },
               success: function(response) {
                   $("#tab_color > tbody").append(response.html);
                   $("#add_new_color").prop('disabled', false); // disable button
                   return false;
               },
               error: function(e) {
                   alert(msg42 + " " + e.responseText);
                   console.log(e);
               }
           });
       });
   
       // Initialize the color picker on the input field
   // $("#color_picker_input").colorpicker();
   
   // $("#add_new_color").click(function() {
   //     var color_id = $("#tab_color > tbody > tr").length;
   //     var url = $(this).attr('url');
   //     var selectedColor = $("#color_picker_input").val(); // Get the selected color from the input field
   
   //     $.ajax({
   //         type: 'GET',
   //         url: url,
   //         data: {
   //             color_id: color_id,
   //             selectedColor: selectedColor // Send the selected color to the server
   //         },
   //         beforeSend: function() {
   //             $("#add_new_color").prop('disabled', true);
   //         },
   //         success: function(response) {
   //             $("#tab_color > tbody").append(response.html);
   //             $("#add_new_color").prop('disabled', false);
   //         },
   //         error: function(e) {
   //             alert(msg42 + " " + e.responseText);
   //             console.log(e);
   //         }
   //     });
   // });
   
   
   
   
       $('body').on('click', '.remove_color', function() {
   
           var color_id = $(this).attr('data-id');
   
           $('table#tab_color tr#color_id_' + color_id).remove();
           return false;
       });
   
   
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
       // Show the customer field initially
       $('#customer-field').show();
       $('#price-field').hide();
   
       // When a radio button is clicked
       $('input[name="vhi_for"]').click(function() {
           if ($(this).val() === '0') {
               // If "Vehicle for Service" is selected, show the customer field and hide the price field
               $('#customer-field').show();
               $('#price-field').hide();
               $('select[name="customer"]').prop('required', true);
               $('input[name="price"]').removeAttr('required');
           } else {
               // If "Vehicle for Sale" is selected, hide the customer field and show the price field
               $('#customer-field').hide();
               $('#price-field').show();
               $('select[name="customer"]').removeAttr('required');
               $('input[name="price"]').prop('required', true);
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
<script>
    const allModels = @json($model_name);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const vehicleBrandSelect = document.getElementById('vehicabrand');
        const vehicleTypeSelect = document.getElementById('vehical_id');
        const modelNameSelect = document.getElementById('modelname');
        const allModels = @json($model_name);

        function filterModels() {
            const selectedBrand = vehicleBrandSelect.value;
            const selectedType = vehicleTypeSelect.value;

            // Clear the model name select options
            modelNameSelect.innerHTML = '<option value="">{{ trans('message.Select Model') }}</option>';

            // Filter and populate the model name select
            allModels.forEach(function (model) {
                if (model.vehicleType_id == selectedType && model.brand_id == selectedBrand) {
                    const option = document.createElement('option');
                    option.value = model.id;
                    option.textContent = model.model_name;
                    modelNameSelect.appendChild(option);
                }
            });
        }

        vehicleBrandSelect.addEventListener('change', filterModels);
        vehicleTypeSelect.addEventListener('change', filterModels);
    });
</script>
<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\VehicleAddEditFormRequest', '#vehicleAdd-Form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
@endsection