<script language="javascript">
    function PrintElem(el) {
        if ("{{ $page_action }}" === "mobile_app") {
            window.location.href = "{{ url('quotation/quotationpdf/' . $service_data->id) }}?page_action={{ $page_action }}";
        } else {
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();

            $('body').html(restorepage);
            window.location.reload();
        }
    }
</script>

<script src="{{ URL::asset('vendors/datatables.net/media/js/jquery.dataTables.min.js') }}"></script>
<div>
    <div id="sales_print">
        <div class="modal-header">
            <h4 class="modal-title mx-3"> {{ getNameSystem() }}</h4>
            
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="">
            <div class="row mx-0">
                <div class="modal-body pb-0">
                    <div class="row" id="">
                        <table class="table table-bordered adddatatable mx-0">
                            <thead>
                                <tr>
                                    <th colspan="14" class="text-center">APPRAISAL SHEET</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">INSURER:</td>

                                    <td colspan="4"></td>
                                    <td colspan="2">REF NO.</td>
                                    <td colspan="5">{{ getQuotationNumber($service_data->job_no) }}</td>

                                </tr>
                                <tr>
                                    <td colspan="2">CLAIMANT</td>
                                    <td colspan="4">{{ getCustomerName($custo_info->id) }}</td>
                                    
                                    <td colspan="2">BROKER</td>
                                    <td colspan="5"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">CLAIM NO.</td>
                                    <td colspan="4"></td>

                                    <td colspan="2">DATE</td>
                                    <?php $date_db = date('Y-m-d', strtotime($service_data->service_date)); ?>
                                    @if (!empty($current_month) && strpos($available, $date_db) !== false)
                                    <td colspan="2"><span class="label label-danger">{{ date(getDateFormat(), strtotime($date_db)) }}</span>
                                    </td>
                                    @else
                                    <td colspan="2"> {{ date(getDateFormat(), strtotime($date_db)) }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                        {{-- <!-- <h3 class="text-center"><?php echo $logo->system_name; ?></h3> -->
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6  printimg position-relative ms-2">
                                <img src="..//public/general_setting/<?php echo $logo->logo_image; ?>" class="system_logo_img">

                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 system_address mt-1 ms-1">
                                <p class="mb-0">
                                    <img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class="m-2">

                                    <?php
                                    $taxNumber = $taxName = null;
                                    if (!empty($service_taxes)) {
                                        foreach ($service_taxes as $tax) {
                                            $taxName = getTaxNameFromTaxTable($tax);
                                            $taxNumber = getTaxNumberFromTaxTable($tax);
                                        }
                                    }
                                    echo ' ' . $logo->email;
                                    echo '<br>&nbsp;&nbsp;<i class="fa fa-phone fa-lg" aria-hidden="true" class="mb-0"></i>&nbsp;&nbsp;&nbsp;&nbsp;' . $logo->phone_number;
                                    ?>
                                <div class="col-12 d-flex align-items-start m-1">
                                    <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}" class="m-1">
                                    <div class="col mx-2">
                                        <?php
                                        echo '&nbsp;' . $logo->address . ' ';
                                        echo ' ' . getCityName($logo->city_id);
                                        echo ',&nbsp;' . getStateName($logo->state_id);
                                        echo ',&nbsp;' . getCountryName($logo->country_id);
                                        ?>
                                    </div>
                                </div>
                                <?php
                                if ($taxName !== null && $taxNumber !== null) {
                                    // echo '<br>' . $taxName . ': &nbsp;' . $taxNumber;
                                    // echo '<b>&nbsp; ' . $taxName . ' :</b> ' . $taxNumber;
                                }
                                ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 quotation">

                            <table class="table quotation">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-md-1 col-sm-1 col-xs-1">
                                                <p class="fw-bold mb-0"><i class="fa fa-user fa-lg"></i></p>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                <p class="cname mb-0"><?php echo getCustomerName($custo_info->id); ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-1 col-sm-1 col-xs-1">
                                                <p class="fw-bold mb-0"><img src="{{ URL::asset('public/img/icons/Vector (14).png') }}"></p>
                                            </div>
                                            <div class="col-md-11 col-sm-11 col-xs-11">
                                                <p class="cname mb-0"><?php echo getCustomerAddress($custo_info->id) . ', '; ?> <?php echo getCityName($custo_info->city_id) != null ? getCityName($custo_info->city_id) . ', ' : ''; ?> <?php echo getStateName($custo_info->state_id) . ', ' . getCountryName($custo_info->country_id); ?></p>
                                            </div>
                                        </div>
                                        <!-- <tr>
                                        <th>{{ trans('message.Address') }} :</th>
                                        <td class="cname"><?php echo getCustomerAddress($custo_info->id) . ', '; ?> <?php echo getCityName($custo_info->city_id) != null ? getCityName($custo_info->city_id) . ', ' : ''; ?> <?php echo getStateName($custo_info->state_id) . ', ' . getCountryName($custo_info->country_id); ?>
                                        </td>
                                    </tr> -->
                                        <div class="row">
                                            <div class="col-md-1 col-sm-1 col-xs-1">
                                                <p class="fw-bold mb-0"><i class="fa fa-phone fa-lg"></i></p>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                <p class="cname mb-0"><?php echo $custo_info->mobile_no; ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-1 col-sm-1 col-xs-1">
                                                <p class="fw-bold mb-0"><img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class="m-0"></p>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                <p class="cname mb-0"><?php echo $custo_info->email; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        

                                        

                                     
                                        

                                        <!-- @if (getCustomerCompanyName($custo_info->id) != '')
                                        <tr>
                                            <th>{{ trans('message.Company') }} :</th>
                                            <td class="cname"><?php echo getCustomerCompanyName($custo_info->id); ?></td>
                                        </tr>
                                    @endif -->
                                    </div>
                                    </tbody>
                                </div>
                            </table>

                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 table-responsive">
                            <table class="table table-bordered table-responsive adddatatable quotationDetail mb-0" width="100%">
                                <span class="border-0">
                                    <thead>
                                        {{-- <tr>
                                            <th class="cname text-left">{{ trans('message.Quotation Number') }}</th>
                                            <th class="cname text-left">{{ trans('message.Vehicle Name') }}</th>
                                            <th class="cname text-left">{{ trans('message.Number Plate' ?? '-') }}</th>
                                            <th class="cname text-left">{{ trans('message.Date') }}</th>

                                        </tr> --}}
                                        <tr>
                                            <td colspan="2">REG NO.</td>
                                            <td colspan="2">MAKER</td>
                                            <td colspan="2">MODEL</td>
                                            <td colspan="2">CHASSIS</td>
                                            <td colspan="2">YOM</td>
                                            <td colspan="2">COLOUR</td>
                                            <td colspan="2">ENGINE</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">{{ $Vehicle_inf->number_plate }}</td>
                                            <td colspan="2">{{ getVehicleBrand($maker) }}</td>
                                            <td colspan="2">{{ getVehicleName($vehi_name) }}</td>
                                            <td colspan="2">{{ $chassis_no }}</td>
                                            <td colspan="2">{{ $Vehicle_inf->modelyear }}</td>
                                            
                                            <td colspan="2">{{ getColor($Vehicle_inf->color) }}</td>
                                            <td colspan="2">{{ $Vehicle_inf->engineno }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="cname text-left fw-bold"><?php echo getQuotationNumber($service_data->job_no); ?></td>
                                            <td class="cname text-left fw-bold"><?php echo getVehicleName($service_data->vehicle_id); ?></td>
                                            <td class="cname text-left fw-bold"><?php echo getVehicleNumberPlate($service_data->vehicle_id); ?></td>
                                            <td class="cname text-left fw-bold"><?php echo date(getDateFormat(), strtotime($service_data->service_date)); ?></td>

                                        </tr> --}}
                                    </tbody>
                                </span>
                            </table>

                        </div>
                    </div>
                    <?php
                    $total2 = 0;
                    if (!empty($all_data3)) {
                ?>
            <div class="table table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 mb-0">
                <table class="table table-bordered adddatatable mx-0">
                    <thead>
                        {{-- <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-center">{{ trans('message.Product Name') }}</th>
                            <th class="text-center">{{ trans('Quantity') }}</th>
                            
                            <th class="text-center">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                            <th class="text-center" style="width: 25%;">{{ trans('message.Total Price') }}
                                (<?php echo getCurrencySymbols(); ?>)
                            </th>
                        </tr> --}}
                        <tr>
                            <td rowspan="2">SN</td>
                            <td class="text-center" colspan="1" rowspan="2">DESCRIPTION OF PARTS &amp; REPLACEMENT</td>
                            {{-- <td class="text-center" rowspan="2">REPAIR</td>
                            <td class="text-center" rowspan="2">REPLACE</td>
                            <td class="text-center" rowspan="2">LEFT</td>
                            <td class="text-center" rowspan="2">RIGHT</td> --}}
                            <td class="text-center" rowspan="2">QTY</td>
                            <td class="text-center" rowspan="2">HOURS</td>
                            <td class="text-center">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</td>
                            <td class="text-center" style="width: 25%;">{{ trans('message.Total Price') }}
                                (<?php echo getCurrencySymbols(); ?>)
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total2 = 0;
                        $i = 1;
                        if (!empty($all_data3)) {
                            foreach ($all_data3 as $ser_proc2) {
                        ?>
                                <tr>
                                    <td class="text-center cname" style="width: 10px;"><?php echo $i++; ?></td>
                                    <td class="text-center cname"><?php echo getProduct($ser_proc2->product_id); ?></td>
                                    {{-- <td class="text-center cname"><?php echo $ser_proc2->quantity; ?></td>
                                    <td class="text-center cname"><?php echo $ser_proc2->quantity; ?></td>
                                    <td class="text-center cname"><?php echo $ser_proc2->quantity; ?></td>
                                    <td class="text-center cname"><?php echo $ser_proc2->quantity; ?></td> --}}
                                    <td class="text-center cname"><?php echo $ser_proc2->quantity; ?></td>
                                    @php
                                        $product = getProduct($ser_proc2->product_id);
                                        $labours = App\Labours::where('name', $product)->get(); 
                                    @endphp

                                    <td class="text-center cname">
                                        @foreach($labours as $labour)
                                            {{ $labour->hours }} {{-- Assuming 'hours' is the column you want to display --}}
                                        @endforeach
                                    </td>
                                    
                                    <td class="text-center cname"><?php echo number_format((float) $ser_proc2->price, 2); ?></td>
                                    <td class="text-end cname"><?php echo number_format((float) $ser_proc2->total_price, 2); ?></td>
                                    <?php if (!empty($ser_proc2->total_price)) {
                                        $total2 += $ser_proc2->total_price;
                                    } ?>
                                </tr>
                                
                            <?php
                            }?>
                            <?php
                        } else { ?>
                            <!-- <tr>
                            <td class="cname text-center" colspan="5">{{ trans('message.Data not available') }}</td>
                        </tr> -->

                    </tbody>
                </table>
            </div>

        <?php
                        }
                    }
        ?>
                    {{-- <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                            <table class="table table-bordered adddatatable w-100 mb-0">
                                <span class="border-0">
                                    <thead>
                                        <tr>
                                            <th class="cname text-left">{{ trans('Job Category') }}</th>

                                            <th class="cname text-left">{{ trans('message.Service Type') }}</th>
                                            <th class="cname text-left">{{ trans('message.Details') }}</th>
                                            <th class="cname text-left"> </th>
                                            <th class="cname text-left"> </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="cname text-left fw-bold"><?php echo ucwords($service_data->service_category); ?></td>
                                            <td class="cname text-left fw-bold"><?php echo ucwords($service_data->service_type); ?></td>
                                            <td class="cname text-left fw-bold"><?php echo $service_data->detail; ?></td>
                                            <td class="cname text-left fw-bold"></td>
                                            <td class="cname text-left fw-bold"> </td>

                                        </tr>
                                    </tbody>
                                </span>
                            </table>
                        </div>
                    </div> --}}
                    <hr>
                    <?php
                    $total1 = 0;
                    $i = 1;
                    if (!empty($all_data)) {
                    ?>
                        <div class="row mx-0 table-responsive">
                            <table class="table table-bordered mb-0">
                                <span class="border-0">
                                    <tbody>
                                        <tr class="printimg">
                                            <td class="cname fw-bold">{{ trans('message.Observation Charges') }}</td>
                                        </tr>
                                    </tbody>
                                </span>
                            </table>
                        </div>
                        <div class="table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                            <table class="table table-bordered adddatatable">
                                <thead>
                                    <tr>
                                        <th class="text-start" style="width: 5%;">#</th>
                                        <th class="text-left">{{ trans('message.Category') }}</th>
                                        <th class="text-left">{{ trans('message.Observation Point') }}</th>
                                        <th class="text-left">{{ trans('message.Product Name') }}</th>
                                        <th class="text-left">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                                        <th class="text-left">{{ trans('message.Quantity') }} </th>
                                        <th class="text-left">{{ trans('message.Charge') }}</th>
                                        <th class="text-left" style="width: 25%;">{{ trans('message.Total Price') }}
                                            (<?php echo getCurrencySymbols(); ?>)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($all_data as $ser_proc) {
                                    ?>
                                        <tr>
                                            <td class="text-center cname"><?php echo $i++; ?></td>
                                            <td class="text-center cname">
                                                <?php echo isset($ser_proc->category) ? $ser_proc->category : '-'; ?>
                                            </td>
                                            <td class="text-center cname">
                                                <?php echo isset($ser_proc->obs_point) ? $ser_proc->obs_point : '-'; ?>
                                            </td>
                                            <td class="text-center cname">
                                                <?php echo isset($ser_proc->product_id) ? getProduct($ser_proc->product_id) : '-'; ?>
                                            </td>
                                            <td class="text-center cname">
                                                <?php echo isset($ser_proc->price) ? number_format((float) $ser_proc->price, 2) : '-'; ?>
                                            </td>
                                            <td class="text-center cname">
                                                <?php echo isset($ser_proc->quantity) ? $ser_proc->quantity : '-'; ?>
                                            </td>

                                            <?php if (!empty($ser_proc->total_price) && $ser_proc->chargeable != 0) {
                                                $total1 += $ser_proc->total_price;
                                            } ?>
                                            <td class="text-center cname">
                                                <?php
                                                if ($ser_proc->chargeable == 1) {
                                                    echo trans('message.Yes');
                                                } else {
                                                    echo trans('message.No');
                                                }
                                                ?>
                                            </td>
                                            <td class="text-end cname"><?php echo number_format((float) $ser_proc->total_price, 2); ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else { ?>
                                    <!-- <tr>
                            <td class="cname text-center" colspan="7">{{ trans('message.Data not available') }}</td>
                        </tr> -->


                                </tbody>
                            </table>
                        </div>
                    <?php
                                }
                                $total2 = 0;
                                if (!empty($all_data2)) {
                    ?>


                        <div class="table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                            <table class="table table-bordered">
                                <tr class="printimg">
                                    <td class="cname fw-bold" colspan="7">{{ trans('message.Other Service Charges') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="table table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 mb-0">
                            <table class="table table-bordered adddatatable mx-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">#</th>
                                        <th class="text-center">{{ trans('message.Charge for') }}</th>
                                        <th class="text-center">{{ trans('message.Product Name') }}</th>
                                        <th class="text-center">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                                        <th class="text-center" style="width: 25%;">{{ trans('message.Total Price') }}
                                            (<?php echo getCurrencySymbols(); ?>)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total2 = 0;
                                    $i = 1;
                                    if (!empty($all_data2)) {
                                        foreach ($all_data2 as $ser_proc2) {
                                    ?>
                                            <tr>
                                                <td class="text-center cname" style="width: 10px;"><?php echo $i++; ?></td>
                                                <td class="text-center cname">{{ trans('message.Other Charges') }}</td>
                                                <td class="text-center cname"><?php echo $ser_proc2->comment; ?></td>
                                                <td class="text-center cname"><?php echo number_format((float) $ser_proc2->total_price, 2); ?></td>
                                                <td class="text-end cname"><?php echo number_format((float) $ser_proc2->total_price, 2); ?></td>
                                                <?php if (!empty($ser_proc2->total_price)) {
                                                    $total2 += $ser_proc2->total_price;
                                                } ?>
                                            </tr>
                                        <?php
                                        }
                                    } else { ?>
                                        <!-- <tr>
                                        <td class="cname text-center" colspan="5">{{ trans('message.Data not available') }}</td>
                                    </tr> -->

                                </tbody>
                            </table>
                        </div>

                <?php
                                    }
                                }
                ?>
                <!-- Washbay Service Charge Details Start -->
                <?php
                $total4 = 0;

                if ($washbay_data != null) {
                ?>
                    <div class="row table-responsive">
                        <table class="table-responsive row mx-0 mb-0">
                            <tr class="printimg">
                                <td class="cname fw-bold">{{ trans('message.Wash Bay Service Charge') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="row table-responsive mx-1">
                        <table class="table table-bordered adddatatable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%;">#</th>
                                    <th class="text-center cname">{{ trans('message.Charge for') }}</th>
                                    <th class="text-center">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                                    <th class="text-center" style="width: 25%;">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center cname">1</td>
                                    <td class="text-center cname">{{ trans('message.Wash Bay Service') }}</td>
                                    <td class="text-center cname"><?php echo number_format((float) $washbay_data->price, 2); ?></td>
                                    <td class="text-end cname"><?php echo number_format((float) $washbay_data->price, 2); ?></td>
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
                <div class="table-responsive row mx-0 mb-0">
                    <table class="table table-bordered">
                        <tr class="printimg">
                            <td class="cname fw-bold" colspan="">{{ trans('message.Other Information') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 mx-1">
                    <table class="table table-bordered adddatatable" style="width: 98%;">
                        @foreach ($tbl_custom_fields as $tbl_custom_field)
                        <?php
                        $tbl_custom = $tbl_custom_field->id;
                        $userid = $service_data->id;

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
                        @else
                        <tr>
                            <th class="text-center" style="width: 10%;">{{ $tbl_custom_field->label }} :</th>
                            <td class="text-left cname">
                                {{ trans('message.Data not available') }}
                            </td>
                        </tr>
                        @endif
                        @else
                        @if ($datavalue != null)
                        <tr>
                            <th class="text-center" style="width: 10%;">{{ $tbl_custom_field->label }} :</th>
                            <td class="text-left cname">{{ $datavalue }}</td>
                        </tr>
                        @else
                        <tr>
                            <th class="text-center" style="width: 10%;">{{ $tbl_custom_field->label }} :</th>
                            <td class="text-left cname">
                                {{ trans('message.Data not available') }}
                            </td>
                        </tr>
                        @endif
                        @endif
                        @endforeach
                    </table>
                </div>
                @endif
                <!-- For Custom Field End -->

                <div class="row mx-1 table-responsive">
                    <table class="table table-bordered quotation_total">
                        <tr>
                            <td class="text-end cname" style="width: 75%;">{{ trans('TOTAL APPRAISAL.') }} (<?php echo getCurrencySymbols(); ?>)</td>
                            <td class="text-end cname fw-bold gst f-17"><?php $fix = $service_data->charge;
                                                                        if (!empty($fix)) {
                                                                            echo number_format($fix, 2);
                                                                        } else {
                                                                            echo 'Free Service';
                                                                        } ?></td>
                        </tr>
                        <tr>
                            <td class="text-end cname">{{ trans('SUBTOTAL') }}
                                (<?php echo getCurrencySymbols(); ?>)
                                :
                            </td>
                            <td class="text-end cname fw-bold gst f-17"><b><?php $total_amt = $total1 + $total2 + $total4 + $fix;
                                                                            echo number_format($total_amt, 2); ?></b></td>
                        </tr>
                        <?php
                        if (!empty($service_taxes)) {
                            $all_taxes = 0;
                            $total_tax = 0;
                            foreach ($service_taxes as $ser_tax) {
                                $taxes_to_count = getTaxPercentFromTaxTable($ser_tax);
                                $all_taxes = ($total_amt * $taxes_to_count) / 100;
                                $total_tax +=  $all_taxes;
                        ?>
                                <tr>
                                    <td class="text-end cname"><?php echo getTaxNameAndPercentFromTaxTable($ser_tax); ?> (%) :</td>
                                    <td class="text-end cname fw-bold gst f-17"><b><?php $all_taxes;
                                                                                    echo number_format($all_taxes, 2); ?></b></td>
                                </tr>
                        <?php
                            }
                        } else {
                            $total_tax = 0;
                        }
                        ?>
                        <!-- <tr class="grand_total">
                                    <td class="text-end cname">{{ trans('message.Grand Total') }}
                                            (<?php echo getCurrencySymbols(); ?>) :</td>
                                    <td class="text-right cname"><b><?php $grd_total = $total_amt + $total_tax;
                                                                    echo number_format($grd_total, 2); ?></b></td>
                                </tr> -->

                        <tr class="large-screen">
                            <td class="text-right cname" colspan="2">
                                <div class="row col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 grand_total_freeservice pt-2">
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 text-end fullpaid_invoice_list pt-1">
                                        {{ trans('message.Grand Total') }}( <?php echo getCurrencySymbols(); ?> ):
                                    </div>
                                    <div class="row col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                        <label class="total_amount pt-1"><?php $grd_total = $total_amt + $total_tax;
                                                                            echo number_format($grd_total, 2); ?> </label>
                                    </div>

                                </div>
                            </td>
                        </tr>

                        <tr class="small-screen">
                            <td class="text-end cname text-light" width="81.5%">{{ trans('message.Grand Total') }} (<?php echo getCurrencySymbols(); ?>) :</td>
                            <td class="text-right fw-bold cname gst text-light"><?php $grd_total = $total_amt + $total_tax;
                                                                                echo number_format($grd_total, 2); ?></td>
                        </tr>
                    </table>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="row modalfooterline">

    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 modal-footer mpPrintPdfCloseButtonForSmallDevices mx-2">

        <a href="{{ url('quotation/quotationpdf/' . $service_data->id) }}?page_action={{ $page_action }}" class="prints tagAforPdfBtn"><button type="button" class="btn pdfButton"><img src="{{ URL('public/img/icons/PDF.png') }}" class="pdfButton"></button></a>

        <button type="button" class="btn printbtn" id="" onclick="PrintElem('sales_print')"><img src="{{ URL('public/img/icons/Print (1).png') }}" class="pdfButton"></button>

        <!-- <a href="" class="prints tagAforCloseBtn"><button type="button" data-dismiss="modal"
                class="btn btn-outline-secondary closeButton">{{ trans('message.Close') }}</button></a> -->
    </div>

</div>
</div>

{{-- </html> --}}