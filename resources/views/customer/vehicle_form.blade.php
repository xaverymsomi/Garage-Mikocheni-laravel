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