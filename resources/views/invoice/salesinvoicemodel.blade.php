<html>

<head>
    <script language="javascript">
        function PrintElem(el) {
            if ("{{ $page_action }}" === "mobile_app") {
                window.location.href = "{{ url('invoice/salespdf/' . $invioce->id) }}?page_action={{ $page_action }}";
            } else {
                var restorepage = $('body').html();
                var printcontent = $('#' + el).clone();
                $('body').empty().html(printcontent);
                window.print();
                // window.onload = function(){ window.print(); }     
                $('body').html(restorepage);
                window.location.reload();
            }
        }
    </script>

    <script src="{{ URL::asset('vendors/datatables.net/media/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            console.log = function() {}
        });
    </script>
</head>

<body>
    <div class="loader"></div>
    <div id="salesdata" class="col-md-12" style="background-color: #fff;">
        <div class="modal-header">
            <h3 class="text-center"><?php echo $logo->system_name; ?></h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="row mt-2">
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 printimg position-relative mt-2" style="margin-left: 0px;">
                    <!-- <img src="{{ URL('public/vehicle/service.png') }}"> -->
                    <img src="{{ url::asset('public/general_setting/' . $logo->logo_image) }}" class="system_logo_img">
                </div>
                <div class="row col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 salesinvoice_modal ms-0 mt-2">
                    <p class="invoice_address mb-0">
                        <img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class="mb-1">
                        <?php
                        echo '' . $logo->email;
                        echo '<br><i class="fa fa-phone fa-lg" aria-hidden="true" class="mb-1"></i>&nbsp;&nbsp;' . $logo->phone_number;

                        ?>

                    <div class="col-12 d-flex align-items-start m-1 mx-0">
                        <img src="{{ url::asset('public/img/icons/Vector (14).png') }}" class="mb-1">&nbsp;
                        <div class="col mx-1">
                            <?php

                            $taxNumber = $taxName = null;
                            if (!empty($taxes)) {
                                foreach ($taxes as $tax) {
                                    if (substr_count($tax, ' ') > 1) {
                                        $taxNumberArray = explode(' ', $tax);

                                        $taxName = $taxNumberArray[0];
                                        $taxNumber = $taxNumberArray[2];
                                    }
                                }
                            }

                            echo $logo->address . ' ';
                            echo '' . getCityName($logo->city_id);
                            echo ', ' . getStateName($logo->state_id);
                            echo ', ' . getCountryName($logo->country_id);
                            ?>

                            <?php
                            if ($taxName !== null && $taxNumber !== null) {
                                echo '<br>&nbsp;<b>' . $taxName . ': </b>' . $taxNumber;
                            }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <table id="adddatatable1" class="table adddatatable invoiceview mx-5" style="border-collapse:collapse;">
                    <tr>
                        <th class="cname col-2">{{ trans('message.Bill Number :') }} </th>
                        <td class="cname"> <?php echo $sales->bill_no; ?> </td>
                    </tr>
                    <tr>
                        <th class="cname">{{ trans('message.Invoice Number') }} :</th>
                        <td class="cname"> <?php echo getInvoiceNumbersForSaleInvoice($sales->id); ?> </td>
                    </tr>
                    <tr>
                        <th class="cname">{{ trans('message.Date :') }} </th>
                        <td class="cname"> <?php echo date(getDateFormat(), strtotime($invioce->date)); ?></td>
                    </tr>
                    <tr>
                        <th class="cname">{{ trans('message.Status :') }} </th>
                        <td class="cname"><?php if ($invioce->payment_status == 0) {
                                                echo '<span style="color: rgb(255, 0, 0);">' .  trans('message.Unpaid') . '</span>';
                                            } elseif ($invioce->payment_status == 1) {
                                                echo '<span style="color: rgb(255, 165, 0);">' .  trans('message.Partially paid') . '</span>';
                                            } elseif ($invioce->payment_status == 2) {
                                                echo '<span style="color: rgb(0, 128, 0);">' .  trans('message.Full Paid') . '</span>';
                                            } else {
                                                echo '<span style="color: rgb(255, 0, 0);">' .  trans('message.Unpaid') . '</span>';
                                            }
                                            ?></td>
                    </tr>
                    <tr>
                        <th class="cname" style="font-size: 14px;">{{ trans('message.Sale Amount') }}
                            (<?php echo getCurrencySymbols(); ?>) :
                        </th>
                        <td class="cname" style="font-size: 14px;"><?php echo number_format($invioce->grand_total, 2); ?></td>
                    </tr>

                </table>
            </div>
        </div>
        <hr />
        <div class="table-responsive">
            <div class="row col-md-12 col-sm-12 col-xs-12 mx-0" id="adddatatable2" class="adddatatable" border="0">

                <!-- <table id="adddatatable2" class="adddatatable " width="100%" border="0"> -->
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="col-md-10 col-sm-10 col-xs-10 payment_to">

                        <h4>{{ trans('message.Payment To') }} </h4>
                        <td valign="top" align="left" class="ps-3">

                            <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}">
                            <?php echo getCustomerAddress($sales->customer_id); ?><br /><?php echo getCustomerCity($sales->customer_id) != null ? getCustomerCity("$sales->customer_id") . ', ' : ''; ?>
                            <?php echo getCustomerState("$sales->customer_id,");
                            echo ', ';
                            echo getCustomerCountry($sales->customer_id); ?>

                        </td>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="col-md-8 col-sm-8 col-xs-8 mx-5 ps-2 bill_to">
                        <h4>{{ trans('message.Bill To') }} </h4>

                        <td valign="top" align="left" class="pe-2">
                            <b><i class="fa fa-user fa-lg"></i> </b>&nbsp; <?php echo getCustomerName($sales->customer_id); ?><br>
                            <b><i class="fa fa-phone fa-lg"></i></b>&nbsp;&nbsp; <?php echo getCustomerMobile($sales->customer_id); ?><br>
                            <b><img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class="m-0"> </b>&nbsp;<?php echo getCustomerEmail($sales->customer_id); ?><br>
                            <?php if (getCustomerTaxid($sales->customer_id) !== null) { ?>
                                <b>{{ trans('message.Tax Id') }} : </b><?php echo getCustomerTaxid($sales->customer_id); ?><br>
                            <?php } ?>
                            <!-- <b>{{ trans('message.Name :') }} </b> <?php echo getCustomerName($sales->customer_id); ?><br><b>{{ trans('message.Mobile :') }}
                            </b><?php echo getCustomerMobile($sales->customer_id); ?> <br><b>{{ trans('message.Email :') }} </b><?php echo getCustomerEmail($sales->customer_id); ?><br>
                         -->
                        </td>

                    </div>
                </div>
                <!-- </table> -->
            </div>
        </div>
        <hr />
        <!-- For Custom Field of Customer Module-->
        @if (!empty($tbl_custom_fields_customers))

        <div class="table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <table id="adddatatable3" class="table table-bordered salesserviceInvoicemodel" border="0" style="border-collapse:collapse;">
                <tr class="printimg cname">
                    <th class="text-start cname invoiceview" colspan="2">
                        {{ trans('message.Customer Other Details') }}
                    </th>
                </tr>

                @foreach ($tbl_custom_fields_customers as $tbl_custom_fields_customer)
                <?php
                $tbl_custom = $tbl_custom_fields_customer->id;
                $userid = $sales->customer_id;

                $datavalue = getCustomData($tbl_custom, $userid);
                ?>
                @if ($tbl_custom_fields_customer->type == 'radio')
                @if ($datavalue != '')
                <?php
                $radio_selected_value = getRadioSelectedValue($tbl_custom_fields_customer->id, $datavalue);
                ?>

                <tr>
                    <th class="text-start cname" style="width: 25%;">
                        {{ $tbl_custom_fields_customer->label }} :
                    </th>
                    <td class="text-start cname">{{ $radio_selected_value }}
                    </td>
                </tr>
                @else
                <tr>
                    <th class="text-start cname" style="width: 25%;">
                        {{ $tbl_custom_fields_customer->label }} :
                    </th>
                    <td class="text-start cname">
                        {{ trans('message.Data not available') }}
                    </td>
                </tr>
                @endif
                @else
                @if ($datavalue != null)
                <tr>
                    <th class="text-start cname" style="width: 25%;">
                        {{ $tbl_custom_fields_customer->label }} :
                    </th>
                    <td class="text-start cname">{{ $datavalue }}</td>
                </tr>
                @else
                <tr>
                    <th class="text-start cname" style="width: 25%;">
                        {{ $tbl_custom_fields_customer->label }} :
                    </th>
                    <td class="text-start cname">
                        {{ trans('message.Data not available') }}
                    </td>
                </tr>
                @endif
                @endif
                @endforeach
            </table>
        </div>
        @endif
        <!-- For Custom Field End of Customer Module -->

        <div class="table-responsive">
            <table id="adddatatable3" class="table table-bordered salesserviceInvoicemodel" border="0" style="border-collapse:collapse;">
                <thead>
                    <tr class="printimg cname">
                        <th class="text-left cname fw-bold" colspan="4">
                            {{ trans('message.Vehicle Details') }}
                        </th>
                    </tr>
                    <tr>
                        <th class="text-left cname">{{ trans('message.Model') }}</th>
                        <th class="text-left cname">{{ trans('message.Type') }} </th>
                        <th class="text-left cname">{{ trans('message.Color') }} </th>
                        <th class="text-left cname" style="width: 25%;">
                            {{ trans('message.Chasis No') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left cname"><?php echo $vehicale->modelname; ?></td>
                        <td class="text-left cname"><?php echo getVehicleType($vehicale->vehicletype_id); ?></td>
                        <td class="text-left cname"><?php echo getVehicleColor($sales->color_id); ?></td>
                        <td class="text-left cname">
                            <?php echo $vehicale->chassisno; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- For Custom Field -->
        @if (!empty($tbl_custom_fields_sales) == 1)
        <hr />
        <div class="table-responsive">
            <table id="adddatatable3" class="table table-bordered salesserviceInvoicemodel" border="0" style="border-collapse:collapse;">
                <tr class="printimg cname">
                    <th class="text-left cname" colspan="2" style="font-size: 14px;">
                        {{ trans('message.Other Information') }}
                    </th>
                </tr>

                @foreach ($tbl_custom_fields_sales as $tbl_custom_fields_sale)
                <?php
                $tbl_custom = $tbl_custom_fields_sale->id;
                $userid = $viewid;

                $datavalue = getCustomDataSales($tbl_custom, $userid);
                ?>
                @if ($tbl_custom_fields_sale->type == 'radio')
                @if ($datavalue != '')
                <?php
                $radio_selected_value = getRadioSelectedValue($tbl_custom_fields_sale->id, $datavalue);
                ?>

                <tr>
                    <th class="text-start cname" style="width: 10%;">
                        {{ $tbl_custom_fields_sale->label }} :
                    </th>
                    <td class="text-start cname">
                        {{ $radio_selected_value }}
                    </td>
                </tr>
                @else
                <tr>
                    <th class="text-start cname" style="width: 10%;">
                        {{ $tbl_custom_fields_sale->label }} :
                    </th>
                    <td class="text-start cname">
                        {{ trans('message.Data not available') }}
                    </td>
                </tr>
                @endif
                @else
                @if ($datavalue != null)
                <tr>
                    <th class="text-start cname" style="width: 10%;">
                        {{ $tbl_custom_fields_sale->label }} :
                    </th>
                    <td class="text-start cname">{{ $datavalue }}</td>
                </tr>
                @else
                <tr>
                    <th class="text-start cname" style="width: 10%;">
                        {{ $tbl_custom_fields_sale->label }} :
                    </th>
                    <td class="text-start cname">
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


        <!-- For Custom Field of Invoice table -->
        @if (!empty($tbl_custom_fields_invoice) == 1)
        <hr />
        <div class="table-responsive">
            <table id="adddatatable3" class="table table-bordered salesserviceInvoicemodel" border="0" style="border-collapse:collapse;">
                <tr class="printimg cname">
                    <th class="text-start cname" colspan="2" style="font-size: 14px;">
                        {{ trans('message.Other Information Of Invoice') }}
                    </th>
                </tr>

                @foreach ($tbl_custom_fields_invoice as $tbl_custom_fields_invoices)
                <?php
                $tbl_custom = $tbl_custom_fields_invoices->id;
                $userid = $invioce->id;

                $datavalue = getCustomDataInvoice($tbl_custom, $userid);
                ?>

                @if ($tbl_custom_fields_invoices->type == 'radio')
                @if ($datavalue != '')
                <?php
                $radio_selected_value = getRadioSelectedValue($tbl_custom_fields_invoices->id, $datavalue);
                ?>
                <tr>
                    <th class="text-start cname">
                        {{ $tbl_custom_fields_invoices->label }} :
                    </th>
                    <td class="text-start cname" style="width: 25%;">
                        {{ $radio_selected_value }}
                    </td>
                </tr>
                @else
                <tr>
                    <th class="text-start cname">
                        {{ $tbl_custom_fields_invoices->label }} :
                    </th>
                    <td class="text-start cname" style="width: 25%;">
                        {{ trans('message.Data not available') }}
                    </td>
                </tr>
                @endif
                @else
                @if ($datavalue != null)
                <tr>
                    <th class="text-start cname">
                        {{ $tbl_custom_fields_invoices->label }} :
                    </th>
                    <td class="text-start cname" style="width: 25%;">{{ $datavalue }}</td>
                </tr>
                @else
                <tr>
                    <th class="text-start cname">
                        {{ $tbl_custom_fields_invoices->label }} :
                    </th>
                    <td class="text-start cname" style="width: 25%;">
                        {{ trans('message.Data not available') }}
                    </td>
                </tr>
                @endif
                @endif
                @endforeach
            </table>
        </div>
        @endif
        <!-- For Custom Field Invoice Table End -->
        <br>
        <div class="table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <table class="table table-bordered salesserviceInvoicemodel" style="border-collapse:collapse; width: 99%;">
                <thead>
                    <tr class="printimg">
                        <th class="text-end fw-bold cname">{{ trans('message.Description') }}&nbsp;&nbsp;</th>
                        <th class="text-left fw-bold cname">&nbsp;&nbsp;{{ trans('message.Amount') }} (<?php echo getCurrencySymbols(); ?>)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-end cname"><?php echo $vehicale->modelname;
                                                    echo ' :'; ?></td>
                        <td class="text-end fw-bold cname gst f-17" fw-bold style="width: 25%;"><?php $total_price = $sales->total_price;
                                                                                                echo number_format($total_price, 2); ?>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td class="text-right cname" colspan="1"></td>
                    </tr> -->
                    <?php
                    if (!empty($rto)) { ?>
                        <tr>
                            <td class="text-end cname">
                                {{ trans('message.RTO / Registration / C.R. Temp Tax') }} :
                            </td>
                            <td class="text-end fw-bold cname gst f-17"><b><?php $rto_reg = $rto->registration_tax;
                                                                            echo number_format($rto_reg, 2); ?></b></td>
                        </tr>
                        <tr>
                            <td class="text-end cname">{{ trans('message.Number Plate Charges') }}
                                :
                            </td>
                            <td class="text-end fw-bold cname gst f-17"><b><?php $rto_plate = $rto->number_plate_charge;
                                                                            echo number_format($rto_plate, 2); ?></b></td>
                        </tr>
                        <tr>
                            <td class="text-end cname">{{ trans('message.Muncipal Road Tax') }} :
                            </td>
                            <td class="text-end fw-bold cname gst f-17"><b><?php $rto_road = $rto->muncipal_road_tax;
                                                                            echo number_format($rto_road, 2); ?></b></td>
                        </tr>
                        <!-- <tr>
                        <td class="cname" colspan="2"></td>
                    </tr> -->
                    <?php } ?>
                    <tr>
                        <?php if (!empty($rto)) {
                            $rto_charges = $rto_reg + $rto_plate + $rto_road;
                        } ?>
                        <td class="text-end cname">{{ trans('message.Total Amount') }} :
                            <!-- (<?php echo getCurrencySymbols(); ?>) : -->
                        </td>
                        <?php if (!empty($rto)) { ?>
                            <td class="text-end fw-bold cname gst f-17"><b><?php $total_amt = $total_price + $rto_charges;
                                                                            echo number_format($total_amt, 2); ?></b></td>
                        <?php
                        } else { ?>
                            <td class="text-end fw-bold cname gst f-17"><b><?php $total_amt = $total_price;
                                                                            echo number_format($total_amt, 2); ?></b></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="text-end cname">{{ trans('message.Discount') }}
                            (<?php echo $invioce->discount . '%'; ?>) :</td>
                        <td class="text-end fw-bold cname gst f-17"><b><?php $discount = ($total_amt * $invioce->discount) / 100;
                                                                        echo number_format($discount, 2); ?></b></td>
                    </tr>
                    <tr>
                        <td class="text-end cname">{{ trans('message.Total') }} :
                            <!-- (<?php echo getCurrencySymbols(); ?>) : -->
                        </td>
                        <td class="text-end fw-bold cname gst f-17"><b><?php $after_dis_total = $total_amt - $discount;
                                                                        echo number_format($after_dis_total, 2); ?></b></td>
                    </tr>
                    <!-- <tr>
                        <td class="cname" colspan="2"></td>
                    </tr> -->
                    <?php
                    if (!empty($taxes)) {
                        $total_tax = 0;
                        $taxes_amount = 0;
                        $taxName = null;
                        foreach ($taxes as $tax) {
                            $taxes_per = explode(" ", $tax);
                            $taxes_amount = ($after_dis_total * $taxes_per[1]) / 100;

                            $total_tax +=  $taxes_amount;

                            if (substr_count($tax, ' ') > 1) {
                                $taxNumberArray = explode(" ", $tax);

                                $taxName = $taxNumberArray[0] . " " . $taxNumberArray[1];
                            } else {
                                $taxName = $tax;
                            }
                    ?>
                            <tr>
                                <td class="text-end cname"><?php echo $taxName; ?> (%) :</td>
                                <td class="text-end fw-bold cname gst f-17"><?php echo number_format($taxes_amount, 2); ?> </td>
                            </tr>
                    <?php    }
                        $final_grand_total = $after_dis_total + $total_tax;
                    } else {
                        $final_grand_total = $after_dis_total;
                    } ?>
                    <!-- <tr>
                        <td class="text-end cname">{{ trans('message.Grand Total') }}
                                (<?php echo getCurrencySymbols(); ?>) :</td>
                        <td class="text-right cname"><b><?php $final_grand_total;
                                                        echo number_format($final_grand_total, 2); ?></b></td>
                    </tr> -->

                    <?php
                    $paid_amount = $invioce->paid_amount;
                    $Adjustmentamount = $final_grand_total - $paid_amount; ?>
                    <tr>
                        <td class="text-end cname" width="81.5%">
                            {{ trans('message.Adjustment Amount') }}({{trans('message.Paid Amount')}}) :
                            <!-- (<?php echo getCurrencySymbols(); ?>) : -->
                        </td>
                        <td class="text-end fw-bold cname gst f-17"><b><?php $paid_amount;
                                                                        echo number_format($paid_amount, 2); ?></b></td>
                    </tr>

                    <tr>
                        <td class="text-end cname" width="81.5%">
                            {{ trans('message.Due Amount') }} :
                            <!-- ({{ getCurrencySymbols() }}) : -->
                        </td>
                        <td class="text-end fw-bold cname gst f-17"><b><?php $Adjustmentamount;
                                                                        echo number_format($Adjustmentamount, 2); ?></b></td>
                    </tr>

                    <tr class="large-screen">
                        <td class="text-right cname" colspan="2">
                            <div class="row col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 grand_total_freeservice pt-2">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 text-end fullpaid_invoice_list pt-1">
                                    {{ trans('message.Grand Total') }}( <?php echo getCurrencySymbols(); ?> ):
                                </div>
                                <div class="row col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                    <label class="total_amount pt-1"><?php $final_grand_total;
                                                                        echo number_format($final_grand_total, 2); ?> </label>
                                </div>

                            </div>
                        </td>
                    </tr>

                    <tr class="small-screen">
                        <td class="text-end cname text-light" width="81.5%">{{ trans('message.Grand Total') }} (<?php echo getCurrencySymbols(); ?>) :</td>
                        <td class="text-right fw-bold cname gst text-light"><?php $final_grand_total;
                                                                            echo number_format($final_grand_total, 2); ?> </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="modal-footer">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ">
                @if (Auth::user()->role != 'employee')
                @if ($Adjustmentamount != 0 && $Adjustmentamount < 999999 && $p_key !=null) <script src="https://js.stripe.com/v3/">
                    </script>
                    <form method="post" action="{{ url('invoice/stripe') }}" class="medium" id="medium">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type='hidden' name="invoice_amount" value="{{ $Adjustmentamount }}">
                        <input type='hidden' name="invoice_id" value="{{ $invioce->id }}">
                        <input type='hidden' name="invoice_no" value="{{ $invioce->invoice_number }}">
                        <input type='hidden' name="p_key" value="{{ $p_key }}">
                        <input type="submit" class="submit2  btn btn-default text-right" value="{{ trans('message.Pay with card') }}" data-key="<?php echo $p_key; ?>" data-email="{{ getCustomerEmail($sales->customer_id) }}" data-name="{{ $logo->system_name }}" data-description="Invoice Number - {{ $invioce->invoice_number }}" data-amount="{{ $Adjustmentamount * 100 }}" data-locale="auto" data-currency="{{ strtolower(getCurrencyCode()) }}" />

                        <script src="https://checkout.stripe.com/v2/checkout.js"></script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                        <script>
                            $(document).ready(function() {

                                $('.submit2').on('click', function(event) {
                                    event.preventDefault();
                                    var $button = $(this),
                                        $form = $button.parents('form');
                                    var opts = $.extend({}, $button.data(), {
                                        token: function(result) {
                                            $form.append($('<input>').attr({
                                                type: 'hidden',
                                                name: 'stripeToken',
                                                value: result.id
                                            })).submit();
                                        }
                                    });
                                    StripeCheckout.open(opts);
                                });
                            });
                        </script>

                    </form>
                    @endif
                    @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 modal-footer mx-3">
            <button type="button" class="btn btn-outline-secondary printbtn btn-sm mx-2 pdfbutton" id="" target="_blank" onclick="PrintElem('salesdata')"><img src="{{ URL('public/img/icons/Print (1).png') }}" class="pdfButton"></button>
            <a href="{{ url('invoice/salespdf/' . $invioce->id) }}?page_action={{ $page_action }}" class="prints tagAforPdfBtn "><button type="button" class="btn btn-outline-secondary pdfButton btn-sm mx-0"><img src="{{ URL('public/img/icons/PDF.png') }}" class="pdfButton"></button></a>
            <a href="" class="prints tagAforCloseBtn"><button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary closeButton btn-sm mx-1">{{ trans('message.Close') }}</button></a>
        </div>
    </div>
    </div>
    @if ($Adjustmentamount > 999999)
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h3 class="text-danger" style="text-align: center;">
            <b>{{ trans('message.You can not pay more than 999999 using the card.') }}
        </h3></b>
    </div>
    @endif

    @if ($p_key == null)
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h4 class="text-danger" style="text-align: center;">
            <b>{{ trans('message.Please update stripe API key details to take payment directly from the card!') }}
        </h4></b>
    </div>
    @endif
    </div>
</body>

</html>