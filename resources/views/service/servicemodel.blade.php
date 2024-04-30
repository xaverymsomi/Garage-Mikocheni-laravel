<div class="modal-header">
    <h4 class="modal-title">{{ trans($logo->system_name) }}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="row mt-2">
        <div class="col-md-6 col-sm-6 col-xs-10">

            <div class="col-md-6 col-sm-12 col-xs-12">
                <img src="..//public/general_setting/<?php echo $logo->logo_image; ?>" class="system_logo_img mx-1">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 service_list mt-2">
                <p class="mb-0">
                    <img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class="m-1">
                    <?php
                    echo '' . $logo->email;
                    ?>
                <div class="col-12 d-flex align-items-start m-1">
                    <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}">&nbsp;
                    <div class="col mx-2">
                        <?php
                        echo '   ' . $logo->address . ' ';
                        echo ', ' . getCityName($logo->city_id);
                        echo ', ' . getStateName($logo->state_id);
                        echo ', ' . getCountryName($logo->country_id);
                        ?>
                    </div>
                </div>
                </p>
            </div>
        </div>
        <div class="row col-md-6 col-sm-6 col-xs-10">
            <div class="col-md-10 col-sm-10 col-xs-12 service mx-4">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        <p class="fw-bold mb-0"><i class="fa fa-user fa-lg"></i></p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="cname mb-0"><?php echo getCustomerName($custo_info->id); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        <p class="fw-bold mb-0"> <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}"></p>
                    </div>
                    <div class="col-md-11 col-sm-11 col-xs-11">
                        <p class="cname mb-0"><?php echo getCustomerAddress($custo_info->id) . ', '; ?> <?php echo getCityName($custo_info->city_id) != null ? getCityName($custo_info->city_id) . ', ' : ''; ?> <?php echo getStateName($custo_info->state_id) . ', ' . getCountryName($custo_info->country_id); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        <p class="fw-bold mb-0"><i class="fa fa-phone fa-lg"></i></p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="cname mb-0"><?php echo $custo_info->mobile_no; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        <p class="fw-bold mb-0"><img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class="m-0"></p>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <p class="cname mb-0"><?php echo $custo_info->email; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-12 mx-4">
                <?php
                if ($custo_info->tax_id !== null) {
                ?>
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <p class="fw-bold mb-0">{{ trans('message.Tax Id') }}:</p>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <p class="cname mb-0"><?php echo $custo_info->tax_id; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row p-2">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class=" table-responsive">
            <table class="table adddatatable service">
                <thead>
                    <tr>
                        <th class="cname text-start">{{ trans('message.Jobcard Number') }}</th>
                        <th class="cname text-start">{{ trans('message.Coupon Number') }}</th>
                        <th class="cname text-start">{{ trans('message.Vehicle Name') }}</th>
                        <th class="cname text-start">{{ trans('message.Number Plate') }}</th>
                        <th class="cname text-start">{{ trans('message.In Date') }}</th>
                        <th class="cname text-start">{{ trans('message.Out Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($used_cpn_data))
                    <tr>
                        <td class="cname text-start fw-bold"><?php echo $used_cpn_data->jocard_no; ?></td>
                        <td class="cname text-start fw-bold"><?php if (!empty($used_cpn_data->coupan_no)) {
                                                                    echo $used_cpn_data->coupan_no;
                                                                } else {
                                                                    echo 'Paid Service';
                                                                } ?></td>
                        <td class="cname text-start fw-bold"><?php echo getVehicleName($used_cpn_data->vehicle_id); ?></td>
                        <td class="cname text-start fw-bold"><?php echo getVehicleNumberPlate($vhi_no->vehicle_id); ?></td>
                        <td class="cname text-start fw-bold"><?php echo date(getDateFormat(), strtotime($used_cpn_data->in_date)); ?></td>
                        <td class="cname text-start fw-bold"><?php echo date(getDateFormat(), strtotime($used_cpn_data->out_date)); ?></td>

                    </tr>
                    @else
                    <tr>
                        <td class="cname text-center" colspan="6">{{ trans('message.No data available in table.') }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table adddatatable service">
                <thead>
                    <tr>
                        <th class="cname text-start">{{ trans('message.Assigned To') }}</th>
                        <th class="cname text-start">{{ trans('message.Repair Category') }}</th>
                        <th class="cname text-start">{{ trans('message.Service Type') }}</th>
                        <th class="cname text-start">{{ trans('message.Details') }}</th>
                        <th class="cname text-start"> </th>
                        <th class="cname text-start"> </th>
                        <!-- <th class="cname text-start"> </th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cname text-start fw-bold"><?php echo getAssignedName($vhi_no->assign_to); ?></td>
                        <td class="cname text-start fw-bold"><?php echo ucwords($vhi_no->service_category); ?></td>
                        <td class="cname text-start fw-bold">
                            {{ trans('message.' . ucwords($vhi_no->service_type)) }}

                        </td>
                        <td class="cname text-start fw-bold"><?php echo $vhi_no->detail; ?></td>
                        <td class="cname text-start fw-bold"> </td>
                        <td class="cname text-start fw-bold"> </td>
                        <td class="cname text-start fw-bold"> </td>

                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <?php
        $total1 = 0;
        $i = 1;
        if (!empty($all_data)) {
            ?>
                <div class=" table-responsive">
                    <table class="table table-bordered mt-1 mb-2" width="98%" border="0">
                        <tbody>
                            <tr class="printimg">
                                <td class="cname fw-bold">{{ trans('message.Service Charges') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class=" table-responsive">
                    <table class="table table-bordered adddatatable m-auto" width="98%" border="1">
                        <thead>
                            <tr>
                                <th class="text-start" style="width: 5%;">#</th>
                                <th class="text-start">{{ trans('message.Category') }}</th>
                                <th class="text-start">{{ trans('message.Observation Point') }}</th>
                                <th class="text-start">{{ trans('message.Product Name') }}</th>
                                <th class="text-start">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                                <th class="text-start">{{ trans('message.Quantity') }} </th>
                                <th class="text-start" style="width: 25%;">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>) </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_data as $ser_proc) { ?>
                            <tr>
                                <td class="text-start cname"><?php echo $i++; ?></td>
                                <td class="text-start cname"> <?php echo $ser_proc->category; ?></td>
                                <td class="text-start cname"> <?php echo $ser_proc->obs_point; ?></td>
                                <td class="text-start cname"> <?php echo getProduct($ser_proc->product_id); ?></td>
                                <td class="text-start cname"> <?php echo $ser_proc->price; ?></td>
                                <td class="text-start cname"><?php echo $ser_proc->quantity; ?></td>
                                <td class="text-start cname"><?php echo $ser_proc->total_price; ?></td>

                                <?php if (!empty($ser_proc->total_price)) {
                                    $total1 += $ser_proc->total_price;
                                } ?>
                            </tr>
                        <?php
                    }
                } else {
                        ?>
                        <!-- <tr>
                            <td class="cname text-center" colspan="7">{{ trans('message.No data available in table.') }}</td>
                        </tr> -->

                        </tbody>
                    </table>
                </div>
            <?php
                }
            ?>

            <?php
            $total2 = 0;
            $i = 1;
            if (!empty($all_data2)) {
                foreach ($all_data2 as $ser_proc2) {
            ?>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3 mb-2" width="98%" border="0">
                            <tr class="printimg">
                                <td class="cname fw-bold" colspan="7">{{ trans('message.Other Service Charges') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered adddatatable m-auto" width="98%" border="1">
                            <thead>
                                <tr>
                                    <th class="text-start" style="width: 5%;">#</th>
                                    <th class="text-start">{{ trans('message.Charge for') }}</th>
                                    <th class="text-start">{{ trans('message.Product Name') }}</th>
                                    <th class="text-start">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                                    <th class="text-start" style="width: 25%;">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>) </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="text-start cname"><?php echo $i++; ?></td>
                                    <td class="text-start cname">{{ trans('message.Other Charges') }}</td>
                                    <td class="text-start cname"><?php echo $ser_proc2->comment; ?></td>
                                    <td class="text-start cname"><?php echo $ser_proc2->total_price; ?></td>
                                    <td class="text-start cname"><?php echo $ser_proc2->total_price; ?></td>
                                    <?php if (!empty($ser_proc2->total_price)) {
                                        $total2 += $ser_proc2->total_price;
                                    } ?>
                                </tr>
                            <?php
                        }
                    } else { ?>
                            <!-- <tr>
                            <td class="cname text-center" colspan="5">{{ trans('message.No data available in table.') }}</td>
                        </tr> -->

                            </tbody>
                        </table>
                    </div>
                <?php
                    }
                ?>
                <!-- MOT Test Service Charge Details Start -->
                <?php
                //$vhi_no->mot_status
                $mot_status = $vhi_no->mot_status;
                $total3 = 0;

                if ($mot_status == 1) {

                ?>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3 mb-2" width="100%" border="0">
                            <tr class="printimg">
                                <td class="cname fw-bold">{{ trans('message.MOT Test Service Charge') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="table table-responsive">
                        <table class="table table-bordered adddatatable mx-1" width="100%" border="1">
                            <thead>
                                <tr>
                                    <th class="text-start" style="width: 5%;">#</th>
                                    <th class="text-start">{{ trans('message.MOT Charge Detail') }}</th>
                                    <th class="text-start">{{ trans('message.MOT Test') }}</th>
                                    <th class="text-start">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                                    <th class="text-start" style="width: 25%;">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-start cname">1</td>
                                    <td class="text-start cname">{{ trans('message.MOT Testing Charges') }}</td>
                                    <td class="text-start cname">{{ trans('message.Completed') }}</td>
                                    <td class="text-start cname"><?php echo number_format((float) 0); ?></td>
                                    <td class="text-start cname"><?php echo number_format((float) 0); ?></td>
                                    <?php $total3 += 0; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>

                <?php
                $total4 = 0;

                if ($washbay_data != null) {
                ?>

                    <div class="table-responsive">
                        <table class="table table-bordered mt-3 mb-2" width="100%" border="0">
                            <tr class="printimg">
                                <td class="cname"><b>{{ trans('message.Wash Bay Service Charge') }}</b></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered adddatatable" width="100%" border="1">
                            <thead>
                                <tr>
                                    <th class="text-start" style="width: 5%;">#</th>
                                    <th class="text-start">{{ trans('message.Charge for') }}</th>
                                    <th class="text-start">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                                    <th class="text-start" style="width: 25%;">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>) </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-start cname">1</td>
                                    <td class="text-start cname">{{ trans('message.Wash Bay Service') }}</td>
                                    <td class="text-start cname"><?php echo number_format((float) $washbay_data->price); ?></td>
                                    <td class="text-start cname"><?php echo number_format((float) $washbay_data->price); ?></td>
                                    <?php $total4 += $washbay_data->price; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
                <!-- Washbay Service Charge Details End -->

                <!-- For Custom Field -->
                @if (!empty($tbl_custom_fields))
                @php $showTableHeading = false; @endphp
                @foreach ($tbl_custom_fields as $tbl_custom_field)
                @php
                $tbl_custom = $tbl_custom_field->id;
                $userid = $vhi_no->id;
                $datavalue = getCustomDataService($tbl_custom, $userid);
                @endphp

                @if ($tbl_custom_field->type == 'radio' && $datavalue != '')
                @php $showTableHeading = true; @endphp
                @elseif ($datavalue != null)
                @php $showTableHeading = true; @endphp
                @endif
                @endforeach

                @if ($showTableHeading)
                <table class="table table-bordered mt-3 mb-2" width="100%" border="0">
                    <tr class="printimg">
                        <td class="cname" colspan="">{{ trans('message.Other Information') }}</td>
                    </tr>
                </table>
                <table class="table table-bordered adddatatable" width="100%" border="1">
                    @foreach ($tbl_custom_fields as $tbl_custom_field)
                    <?php
                    $tbl_custom = $tbl_custom_field->id;
                    $userid = $vhi_no->id;

                    $datavalue = getCustomDataService($tbl_custom, $userid);
                    ?>
                    @if ($tbl_custom_field->type == 'radio')
                    @if ($datavalue != '')
                    <?php
                    $radio_selected_value = getRadioSelectedValue($tbl_custom_field->id, $datavalue);
                    ?>
                    <tr>
                        <th class="text-center" style="width: 10%;">{{ $tbl_custom_field->label }} :</th>
                        <td class="text-left cname">{{ $radio_selected_value }}</td>
                    </tr>
                    @endif
                    @else
                    @if ($datavalue != null)
                    <tr>
                        <th class="text-center" style="width: 10%;">{{ $tbl_custom_field->label }} :</th>
                        <td class="text-left cname">{{ $datavalue }}</td>
                    </tr>
                    @endif
                    @endif
                    @endforeach
                </table>
                @endif
                @endif
                <!-- For Custom Field End -->

    </div>
</div>
</div>
</div>
</div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary closeServicemodal btn-sm ms-0" data-bs-dismiss="modal">{{ trans('message.Close') }}</button>
</div>

</div>