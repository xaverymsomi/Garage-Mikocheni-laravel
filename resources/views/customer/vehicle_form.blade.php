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
                    <select class="form-control select_make" name="vehicles[0][vehicabrand]" id="vehicabrand" onchange="filterModels(this)">
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
                    <select class="form-control select_body_type" name="vehicles[0][vehical_id]" id="vehical_id" onchange="filterModels(this)">
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
                        @foreach ($model_name as $model_names)
                            <option value="{{ $model_names->model_name }}">{{ $model_names->model_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row col-md-6">
                <label class="control-label col-md-4" for="fueltype">{{ trans('Fuel') }} <label class="text-danger">*</label></label>
                <div class="col-md-8">
                    <select class="form-control select_fuel" name="vehicles[0][fueltype]">
                        <option value="">{{ trans('message.Select fuel') }}</option>
                        @foreach ($model_name as $model_names)
                            <option value="{{ $model_names->model_name }}" data-make-id="{{ $model_names->brand_id }}" data-vehicle-type="{{ $model_names->vehicleType_id }}" style="display: none;"></option>
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

<script>
    // JavaScript to filter model names based on selected make and body type
    $(document).ready(function() {
        $('#vehicabrand, #vehical_id').on('change', function() {
            let selectedMakeId = vehicleBrandSelect.value;
            let selectedVehicleType = vehicleTypeSelect.value;

            // Show all options initially
            $('#modelname option').hide();

            // Filter and show only relevant options
            $('#modelname option').each(function() {
                let makeId = $(this).data('make-id');
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
</script>