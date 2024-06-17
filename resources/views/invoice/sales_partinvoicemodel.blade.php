<html>

<head>
    <script language="javascript">
        function PrintElem(el) {
            if ("{{ $page_action }}" === "mobile_app") {
                window.location.href = "{{ url('invoice/salespartpdf/' . $invioce->id) }}?page_action={{ $page_action }}";
            } else {
                var restorepage = $('body').html();
                var printcontent = $('#' + el).clone();
                $('body').empty().html(printcontent);
                window.print();

                $('body').html(restorepage);
                // window.location.reload();
            }
        }
    </script>
    <script src="{{ URL::asset('vendors/datatables.net/media/js/jquery.dataTables.min.js') }}"></script>

</head>

<body>
    <div id="sales_print" class="col-md-12">

        <!-- <table width="100%" border="0">
            <tbody>
                <tr>
                    <td align="right">
                        <?php $nowdate = date('Y-m-d'); ?>
                        <strong>{{ trans('message.Date') }} : </strong><?php echo date(getDateFormat(), strtotime($nowdate)); ?>
                    </td>
                </tr>
            </tbody>
        </table> -->
        <!-- <div class="modal-header">
        <h3 class="text-center"><?php echo $logo->system_name; ?></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div> -->
        <div class="row mt-1">
            <div class="col-md-7 col-sm-7 col-xs-7 mx-2">

                <div class="col-md-6 col-sm-12 col-xs-12 printimg position-relative mx-0">
                    <!-- <img src="{{ URL('public/vehicle/service.png') }}" style="width: 250px; height: 90px;"> -->
                    <img src="{{ url::asset('public/general_setting/' . $logo->logo_image) }}" class="system_logo_img">
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 sale_partmodal mt-2">
                    <p class="mb-0">
                        <img src="{{ URL::asset('public/img/icons/Vector (15).png') }}">
                        <?php
                        echo '' . $logo->email;
                        echo '<br><i class="fa fa-phone fa-lg" aria-hidden="true"></i>&nbsp;' . $logo->phone_number;
                        ?>
                        <br>
                    <div class="col-9 d-flex align-items-start m-1 mx-0">
                        <img src="{{ url::asset('public/img/icons/Vector (14).png') }}">
                        <div class="col mx-2">
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
                            echo ', ' . getCityName($logo->city_id);
                            echo ', ' . getStateName($logo->state_id);
                            echo ', ' . getCountryName($logo->country_id);
                            ?>
                        </div>
                    </div>
                    <?php
                    if ($taxName !== null && $taxNumber !== null) {
                        echo '<b> ' . $taxName . ':</b> ' . $taxNumber;
                    }
                    ?>
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <table class="table invoice_sale_part" width="100%" style="border-collapse:collapse;">
                    <tr>
                        <th class="cname">{{ trans('message.Bill Number :') }} </th>
                        <td class="cname"> <?php echo $sales->bill_no; ?> </td>
                    </tr>
                    <tr>
                        <th class="cname">{{ trans('message.Invoice Number') }} : </th>
                        <td class="cname"> <?php echo getInvoiceNumbersForSalepartInvoice($sales->id); ?> </td>
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
                    <!-- <tr>
                        <th class="cname">{{ trans('message.Sale Amount :') }} (<?php echo getCurrencySymbols(); ?>) </th>
                        <td class="cname"><?php echo number_format($invioce->grand_total, 2); ?></td>
                    </tr> -->
                </table>
            </div>
        </div>
        <hr />
        <div class="mx-2">
            <table width="100%" border="0">
                <thead>
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-7 payment_to">
                            <h4>{{ trans('message.Payment To,') }} </h4>
                            <div class="col-10">
                                <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}">
                                <?php echo getCustomerAddress($sales->customer_id);
                                echo ', '; ?> <?php echo getCustomerCity($sales->customer_id) != null ? getCustomerCity("$sales->customer_id") . ',' : ''; ?><?php echo getCustomerState("$sales->customer_id,");
                                                                                                                                                                echo ', ';
                                                                                                                                                                echo getCustomerCountry($sales->customer_id); ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 bill_to mx-4">
                            <h4>{{ trans('message.Bill To,') }} </h4>
                            <div class="col-11"> <b><i class="fa fa-user fa-lg"></i></b>&nbsp; <?php echo getCustomerName($sales->customer_id); ?><br>
                                <b><i class="fa fa-phone fa-lg"></i></b>&nbsp;&nbsp;<?php echo getCustomerMobile($sales->customer_id); ?><br>
                                <b><img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class="m-0"></b>&nbsp;<?php echo getCustomerEmail($sales->customer_id); ?>
                            </div>
                            <?php if (getCustomerTaxid($sales->customer_id) !== null) { ?>
                                <b>{{ trans('message.Tax Id') }} : </b><?php echo getCustomerTaxid($sales->customer_id); ?><br>
                            <?php } ?>
                        </div>
                    </div>
                </thead>
            </table>
            <hr />
            <!-- For Custom Field Customer Module (User table) -->
            @if (!empty($tbl_custom_fields_customers))
            @php $showTableHeading = false; @endphp
            @foreach ($tbl_custom_fields_customers as $tbl_custom_fields_customer)
            @php
            $tbl_custom = $tbl_custom_fields_customer->id;
            $userid = $sales->customer_id;

            $datavalue = getCustomData($tbl_custom, $userid);
            @endphp

            @if ($tbl_custom_fields_customer->type == 'radio' && $datavalue != '')
            @php $showTableHeading = true; @endphp
            @elseif ($datavalue != null)
            @php $showTableHeading = true; @endphp
            @endif
            @endforeach

            @if ($showTableHeading)

            <div class="table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                <table class="table table-bordered" border="0" style="border-collapse:collapse;" width="100%">
                    <tr class="printimg">
                        <td class="cname" style="font-size: 14px;">
                            <b>{{ trans('message.Customer Other Details') }}</b>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                <table class="table table-bordered adddatatable" border="1" style="border-collapse:collapse; width:99%">
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
                        <th class="text-start">{{ $tbl_custom_fields_customer->label }} :</th>
                        <td class="text-start cname" style="width: 25%;">{{ $radio_selected_value }}</td>
                    </tr>

                    @endif
                    @else
                    @if ($datavalue != null)

                    <tr>
                        <th class="text-start">{{ $tbl_custom_fields_customer->label }} :</th>
                        <td class="text-start cname" style="width: 25%;">{{ $datavalue }}</td>
                    </tr>
                    @endif
                    @endif
                    @endforeach
                </table>
            </div>

            @endif
            @endif
            <!-- For Custom Field End Customer Module (User table)-->

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" border="0" style="border-collapse:collapse;">
                    <thead>
                        <tr class="printimg cname">
                            <th class="text-start cname fw-bold" colspan="4">
                                {{ trans('message.Part Details') }}
                            </th>
                        </tr>
                        <tr>
                            <th class="text-start cname">{{ trans('message.Manufacturer Name') }} </th>
                            <th class="text-start cname">{{ trans('message.Product Name') }}</th>
                            <th class="text-start cname">{{ trans('message.Quantity') }}</th>
                            <th class="text-start cname">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                            <th class="text-start cname">{{ trans('message.Amount') }} (<?php echo getCurrencySymbols(); ?>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($saless as $d)
                        <tr>
                            <td class="text-start cname">{{ getManufacturer($d->product_type_id) }}</td>
                            <td class="text-start cname">{{ getPart($d->product_id)->name }}</td>
                            <td class="text-start cname">{{ $d->quantity }}</td>
                            <td class="text-start cname">{{ $d->price }}</td>
                            <td class="text-end cname">{{ $d->total_price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- For Custom Field -->
            @if (!empty($tbl_custom_fields_salepart))
            @php $showTableHeading = false; @endphp
            @foreach ($tbl_custom_fields_salepart as $tbl_custom_fields_saleparts)
            @php
            $tbl_custom = $tbl_custom_fields_saleparts->id;
            $userid = $sales->id;

            $datavalue = getCustomDataSalepart($tbl_custom, $userid);
            @endphp

            @if ($tbl_custom_fields_saleparts->type == 'radio' && $datavalue != '')
            @php $showTableHeading = true; @endphp
            @elseif ($datavalue != null)
            @php $showTableHeading = true; @endphp
            @endif
            @endforeach

            @if ($showTableHeading)
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" border="0" style="border-collapse:collapse;">
                    <tr class="printimg cname">
                        <th class="text-start cname" colspan="2">
                            {{ trans('message.Other Information') }}
                        </th>
                    </tr>

                    @foreach ($tbl_custom_fields_salepart as $tbl_custom_fields_saleparts)
                    <?php
                    $tbl_custom = $tbl_custom_fields_saleparts->id;
                    $userid = $sales->id;

                    $datavalue = getCustomDataSalepart($tbl_custom, $userid);
                    ?>

                    @if ($tbl_custom_fields_saleparts->type == 'radio')
                    @if ($datavalue != '')
                    <?php
                    $radio_selected_value = getRadioSelectedValue($tbl_custom_fields_saleparts->id, $datavalue);
                    ?>
                    <tr>
                        <th class="text-start cname">{{ $tbl_custom_fields_saleparts->label }} :</th>
                        <td class="text-start cname" style="width: 25%;">{{ $radio_selected_value }}</td>
                    </tr>
                    @else
                    <tr>
                        <th class="text-start cname">{{ $tbl_custom_fields_saleparts->label }} :</th>
                        <td class="text-center cname">{{ trans('message.Data not available') }}</td>
                    </tr>
                    @endif
                    @else
                    @if ($datavalue != null)
                    <tr>
                        <th class="text-start cname">{{ $tbl_custom_fields_saleparts->label }} :</th>
                        <td class="text-start cname" style="width: 25%;">{{ $datavalue }}</td>
                    </tr>
                    @else
                    <tr>
                        <th class="text-start cname">{{ $tbl_custom_fields_saleparts->label }} :</th>
                        <td class="text-center cname">{{ trans('message.Data not available') }}</td>
                    </tr>
                    @endif
                    @endif
                    @endforeach
                </table>
            </div>
            @endif
            @endif
            <!-- For Custom Field End -->

            <div class="table-responsive col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                <table class="table table-bordered invoicesale_part" style="border-collapse:collapse; width: 99%;">
                    <thead>

                        <tr class="printimg">
                            <th class="text-end fw-bold cname">{{ trans('message.Description') }}&nbsp;&nbsp;</th>
                            <th class="text-start fw-bold cname">{{ trans('message.Amount') }} (<?php echo getCurrencySymbols(); ?>)</th>
                        </tr>

                    </thead>
                    <tbody>
                        <!-- @foreach ($saless as $d)
                        <tr>
                            <td class="text-end cname"><?php echo $vehicale->name;
                                                        echo ' :'; ?></td>
                            <td class="text-right fw-bold cname gst" style="width: 25%;"><b><?php $total_price = $d->total_price;
                                                                                            echo number_format($total_price, 2); ?></b></td>
                        </tr>
                        @endforeach -->
                        <!-- <tr>
                            <td class="text-right cname" colspan="1"></td>
                        </tr> -->
                        <tr>

                            <td class="text-end end">{{ trans('message.Total Amount') }} (<?php echo getCurrencySymbols(); ?>) :</td>

                            <td class="text-end fw-bold cname gst f-17"><b><?php $total_amt = $salesps->total_price;
                                                                            echo number_format($salesps->total_price, 2); ?></b></td>
                        </tr>
                        <tr>
                            <td class="text-end cname">{{ trans('message.Discount') }} (<?php echo $invioce->discount . '%'; ?>) :
                            </td>
                            <td class="text-end fw-bold cname gst f-17"><b><?php $discount = ($total_amt * $invioce->discount) / 100;
                                                                            echo number_format($discount, 2); ?></b></td>
                        </tr>
                        <tr>
                            <td class="text-end cname">{{ trans('message.Total') }} : (<?php echo getCurrencySymbols(); ?>)</td>
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
                                    <td class="text-end fw-bold cname gst f-17"><b><?php echo number_format($taxes_amount, 2); ?></b></td>
                                </tr>
                        <?php }
                            $final_grand_total = $after_dis_total + $total_tax;
                        } else {
                            $final_grand_total = $after_dis_total;
                        } ?>
                        <!-- <tr>
                            <td class="text-end cname">{{ trans('message.Grand Total') }} (<?php echo getCurrencySymbols(); ?>)
                                    :</td>
                            <td class="text-right cname"><b><?php $final_grand_total;
                                                            echo number_format($final_grand_total, 2); ?></b></td>
                        </tr> -->



                        <?php
                        $paid_amount = $invioce->paid_amount;
                        $Adjustmentamount = $final_grand_total - $paid_amount; ?>
                        <tr>
                            <td class="text-end cname" width="81.5%">{{ trans('message.Adjustment Amount')}}({{trans('message.Paid Amount')}})
                                (<?php echo getCurrencySymbols(); ?>) :</td>
                            <td class="text-end fw-bold cname gst f-17"><b><?php $paid_amount;
                                                                            echo number_format($paid_amount, 2); ?></b></td>
                        </tr>

                        <tr>
                            <td class="text-end cname" width="81.5%">{{ trans('message.Due Amount') }}
                                ({{ getCurrencySymbols() }}) :</td>
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
    </div>
    <div class="row me-4 pe-1">
        <div class="col-md-12 col-sm-12 col-xs-12 ms-2">
            <div class="col-md-6 col-sm-6 col-xs-3 mpPayWithCardButtonForSmallDevices">
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

            <div class="ps-0 modal-footer mpPrintPdfCloseButtonForSmallDevices">
                <button type="button" class="btn btn-outline-secondary btn-sm printbtn mx-2 ms-0" id="" onclick="PrintElem('sales_print')"><img src="{{ URL('public/img/icons/Print (1).png') }}" class="pdfButton"></button>
                <a href="{{ url('invoice/salespartpdf/' . $invioce->id) }}?page_action={{ $page_action }}" class="prints tagAforPdfBtn"><button type="button" class="btn btn-outline-secondary btn-sm pdfButton mx-0" style="margin-left: 15px;"><img src="{{ URL('public/img/icons/PDF.png') }}" class="pdfButton"></button></a>
                <a href="" class="prints tagAforCloseBtn"><button type="button" data-dismiss="modal" class="btn btn-outline-secondary btn-sm closeButton" style="margin-left: 5px;">{{ trans('message.Close') }}</button></a>
            </div>

            @if ($Adjustmentamount > 999999)
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h3 class="text-danger" style="text-align: center;">
                    <b>{{ trans('message.You can not pay more than 999999 using the card.') }}</b>
                </h3>
            </div>
            @endif

            @if ($p_key == null)
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h4 class="text-danger" style="text-align: center;">
                    <b>{{ trans('message.Please update stripe API key details to take payment directly from the card!') }}</b>
                </h4>
            </div>
            @endif
        </div>
    </div>
</body>

</html>