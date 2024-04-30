<html dir="{{ getLangCode() === 'ar' ? 'rtl' : '' }}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style type="text/css">
    @if (getLangCode()==='hi')body,
    p,
    td,
    div,
    th {
      font-family: freeserif;
    }

    @elseif (getLangCode()==='gu') body,
    p,
    td,
    div,
    th {
      font-family: freeserif;
    }

    @elseif (getLangCode()==='ja') body,
    p,
    td,
    div,
    th {
      font-family: freeserif;
    }

    @elseif (getLangCode()==='zhcn') body,
    p,
    td,
    div,
    th {
      font-family: DejaVu Sans, freeserif; // not working
    }

    @elseif (getLangCode()==='th') body,
    p,
    td,
    div,
    th,
    strong {
      font-family: bitstreamcyberbit, freeserif, garuda, norasi, quivira;
    }

    @elseif (getLangCode()==='mr') body,
    p,
    td,
    div,
    th {
      font-family: freeserif;
    }

    @elseif (getLangCode()==='ta') body,
    p,
    td,
    div,
    th,
    strong {
      font-family: ind_ta_1_001, freeserif;
    }

    @else body,
    p,
    td,
    div,
    th,
    strong {
      font-family: freeserif;
    }

    @endif
  </style>
</head>
<style>
  body {
    font-family: 'Helvetica';
    font-style: normal;
    font-weight: normal;
    color: #333;
  }

  .itemtable th,
  td {
    padding: 0px 14px 6px 14px;
    font-size: 14px;
  }

  #imggrapish {
    margin-top: -50px;
    margin-left: 5px;
  }

  page[size="A4"] {
    background: white;
    width: 21cm;
    height: 29.7cm;
    display: block;
    margin: 0 auto;
    margin-bottom: 0.5cm;
  }

  .mail_img {
    width: 12px;
  }

  .addr_img {
    width: 10px;
  }

  .user_img {
    width: 14px;
    height: 12px;
  }

  .phoneimg {
    width: 14px;
    height: 12px;
    /* margin-bottom: 2px; */
    margin-right: 1px;
  }

  .invoice_detail {
    line-height: 25px;
    font-size: 14px;
  }

  .system_addr_details {
    line-height: 25px;
    font-size: 14px;
  }

  .customer_details {
    line-height: 25px;
    margin-top: 3px;
  }

  .cust_addr_details {
    line-height: 25px;
  }

  .grand_total_modal_invoice {
    background: #DC3733;
    color: #FFFFFF;
    margin-left: 55%;
    margin-bottom: 0px;
  }

  @media print {

    body,
    page[size="A4"] {
      margin: 0;
      box-shadow: 0;
    }
  }
</style>

<body>

  <div class="row" id="imggrapish">
    <br>
    <table width="100%" border="0" style="margin:0px 8px 0px 8px; font-family:Poppins;">
      <tr>
        <td align="left">
          <h3 style="font-size:18px;"><?php echo $logo->system_name; ?></h3>
        </td>
      </tr>
    </table>
    <hr />
    <table>
      <tbody>
        <tr class="customer_details">
          <td width="15%" style="vertical-align:top;float:left;" align="left">
            <span style="width:100%;">
              <img src="{{ base_path() }}/public/general_setting/<?php echo $logo->logo_image; ?>" width="230px" height="70px">
            </span>
          </td>
          <td style="width: 45%;" vertical-align:top;">
            <span style="float:right; class=" cust_addr_details">
              <b><img src="{{ URL::asset('public/img/icons/user_img.png') }}" class="user_img"></b> <?php echo getCustomerName($tbl_invoices->customer_id); ?>
              <br>
              <b><img src="{{ URL::asset('public/img/icons/Vector (14).png') }}" class="addr_img"></b> <?php echo $customer->address;
                                                                                                        echo ', ';
                                                                                                        echo getCityName("$customer->city_id") != null ? getCityName("$customer->city_id") . ', ' : ''; ?><?php echo getStateName("$customer->state_id,");
                                                                                                                                                                                                          echo ', ';
                                                                                                                                                                                                          echo getCountryName($customer->country_id); ?>
              <br>
              <b><img src="{{ URL::asset('public/img/icons/phoneimg1.png') }}" class="phoneimg"></b> <?php echo "$customer->mobile_no"; ?>
              <br>
              <b><img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class=" mail_img"></b> <?php echo $customer->email; ?>
              <br>
              <b>{{ trans('message.Invoice') }} :</b> <?php echo $tbl_invoices->invoice_number; ?>
              <br>
              <b>{{ trans('message.Status :') }}</b><?php if ($tbl_invoices->payment_status == 0) {
                                                      echo '<span style="color: rgb(255, 0, 0);">' .  trans('message.Unpaid') . '</span>';
                                                    } elseif ($tbl_invoices->payment_status == 1) {
                                                      echo '<span style="color: rgb(255, 165, 0);">' .  trans('message.Partially paid') . '</span>';
                                                    } elseif ($tbl_invoices->payment_status == 2) {
                                                      echo '<span style="color: rgb(0, 128, 0);">' .  trans('message.Full Paid') . '</span>';
                                                    } else {
                                                      echo '<span style="color: rgb(255, 0, 0);">' .  trans('message.Unpaid') . '</span>';
                                                    } ?><br>
              <b>{{ trans('message.Date') }} :</b> <?php echo date(getDateFormat(), strtotime($tbl_invoices->date)); ?>
              <br>
              @if(($customer->tax_id) != '')
              <b>{{ trans('message.Tax Id') }} :</b>
              <?php echo $customer->tax_id; ?>
              @endif


            </span>
          </td>

        </tr>
        <tr>
          <td width="50%" style="vertical-align:top;float:left;">
            <span style="float:left; font-size: 14px;" class="system_addr_details">
              <img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class="mail_img">
              <?php
              echo '' . $logo->email;
              ?>
              <br>
              <img src="{{ URL::asset('public/img/icons/phoneimg1.png') }}" class="phoneimg">
              <?php
              echo '' . $logo->phone_number;
              ?>
              <br>
              <div class="col-12 d-flex align-items-start" style="margin-top: 2px;">
                <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}" class="addr_img">
                <?php
                $taxNumber = $taxName = null;
                if (!empty($service_taxes)) {
                  foreach ($service_taxes as $tax) {

                    if (substr_count($tax, ' ') > 1) {
                      $taxNumberArray = explode(" ", $tax);

                      $taxName = $taxNumberArray[0];
                      $taxNumber = $taxNumberArray[2];
                    }
                  }
                }

                //echo $logo->address ? ', <br>' : '';
                echo $logo->address . ' ';
                echo ' ' . getCityName($logo->city_id);
                echo ', ' . getStateName($logo->state_id);
                echo ', ' . getCountryName($logo->country_id);

                if ($taxName !== null && $taxNumber !== null) {
                  echo '<br> ' . $taxName . ':- ' . $taxNumber;
                }

                ?>
              </div>
            </span>
          </td>

        </tr>
      </tbody>
    </table>

    <hr />
    <table class="table " border="0" width="100%" style="border-collapse:collapse;">
      <thead></thead>

      <tbody class="itemtable">
        <tr>
          <th align="left" style="padding:8px;">{{ trans('message.Jobcard Number') }}</th>
          <th align="left" style="padding:8px;">{{ trans('message.Coupon Number') }}</th>
          <th align="left" style="padding:8px;">{{ trans('message.Vehicle Name') }}</th>
          <th align="left" style="padding:8px;">{{ trans('message.Number Plate') }}</th>
          <th align="left" style="padding:8px;">{{ trans('message.In Date') }}</th>
          <th align="left" style="padding:8px;">{{ trans('message.Out Date') }}</th>
        </tr>

        <tr>
          <td align="left" style="padding:8px;"><?php echo "$tbl_services->job_no"; ?></td>
          <td align="left" style="padding:8px;"><?php if (!empty($job->coupan_no)) {
                                                  echo $job->coupan_no;
                                                } else {
                                                  echo trans('message.Paid Service');
                                                } ?></td>
          <td align="left" style="padding:8px;"><?php if (!empty($job->vehicle_id)) {
                                                  echo getVehicleName($job->vehicle_id);
                                                } ?></td>
          <td align="left" style="padding:8px;"><?php if (!empty($job->vehicle_id)) {
                                                  echo getVehicleNumberPlate($job->vehicle_id);
                                                } ?></td>
          <td align="left" style="padding:8px;"><?php if (!empty($job)) {
                                                  echo date(getDateFormat(), strtotime($job->in_date));
                                                } ?> </td>
          <td align="left" style="padding:8px;"><?php if (!empty($job)) {
                                                  echo date(getDateFormat(), strtotime($job->out_date));
                                                } ?> </td>
        </tr>
        <tr>
          <th align="left" style="padding:8px;">{{ trans('message.Assigned To') }}</th>
          <th align="left" style="padding:8px;">{{ trans('message.Repair Category') }}</th>
          <th align="left" style="padding:8px;">{{ trans('message.Service Type') }}</th>
          <th align="left" style="padding:8px;" colspan="3">{{ trans('message.Details') }}</th>
        </tr>
        <tr>
          <td align="left" style="padding:8px;"><?php echo getAssignedName($tbl_services->assign_to); ?> </td>
          <td align="left" style="padding:8px;"><?php echo $tbl_services->service_category; ?> </td>
          <td align="left" /* style="padding:8px;"><?php echo $tbl_services->service_type; ?> </td> */
          <td align="left" style="padding:8px;" colspan="3"><?php echo $tbl_services->detail; ?> </td>
        </tr>
      </tbody>
    </table>
    <hr />
    <?php
    $total1 = 0;
    if ($service_pro === []) {
    } else { ?>
      <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
        <tbody>
          <tr class="printimg" style=" color:#333;">
            <th align="left" style="padding:8px; font-size:14px;" colspan="7">{{ trans('message.Service Charges') }}</th>
          </tr>
          <tr>
            <th align="left" style="padding:8px; width: 5%;"> # </th>
            <th align="left" style="padding:8px;">{{ trans('message.Category') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Observation Point') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Product Name') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
            <th align="left" style="padding:8px;">{{ trans('message.Quantity') }} </th>
            <th align="left" style="padding:8px; width: 20%;">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>) </th>
          </tr>


          <?php
          $total1 = 0;
          $i = 1;
          foreach ($service_pro as $service_pros) { ?>
            <br />

            <tr>
              <td align="left" style="padding:8px;"><?php echo $i++; ?></td>
              <td align="left" style="padding:8px;"> <?php echo $service_pros->category; ?></td>
              <td align="left" style="padding:8px;"> <?php echo $service_pros->obs_point; ?></td>
              <td align="left" style="padding:8px;"> <?php echo getProduct($service_pros->product_id); ?></td>
              <td align="left" style="padding:8px;"> <?php echo $service_pros->price; ?></td>
              <td align="left" style="padding:8px;"><?php echo $service_pros->quantity; ?></td>
              <td align="right" style="padding:8px;"><?php echo $service_pros->total_price; ?></td>
              <?php $total1 += $service_pros->total_price; ?>
            </tr>


          <?php } ?>
        </tbody>
      </table>
    <?php
    }
    $total2 = 0;
    $i = 1;
    foreach ($service_pro2 as $service_pros) { ?>
      <br />
      <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
        <tbody>
          <tr style="color:#333;">
            <th align="left" style="font-size:14px;padding:8px;" colspan="7">{{ trans('message.Other Service Charges') }}</th>
          </tr>
          <tr>
            <th align="left" style="padding:8px;  width: 5%;">#</th>
            <th align="left" style="padding:8px;" colspan="2">{{ trans('message.Charge for') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Product Name') }}</th>
            <th align="left" style="padding:8px;" colspan="2">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
            <th align="left" style="padding:8px; width: 20%;">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>) </th>
          </tr>

          <tr>
            <td align="left" style="padding:8px;"><?php echo $i++; ?></td>
            <td align="left" style="padding:8px;" colspan="2">{{ trans('message.Other Charges') }}</td>
            <td align="left" style="padding:8px;"><?php echo $service_pros->comment; ?></td>
            <td align="left" style="padding:8px;" colspan="2"><?php echo number_format((float) $service_pros->total_price, 2); ?></td>
            <td align="right" style="padding:8px;"><?php echo number_format((float) $service_pros->total_price, 2); ?></td>
            <?php $total2 += $service_pros->total_price; ?>
          </tr>

        </tbody>
      </table>
    <?php } ?>

    <!-- MOT Testing Part Invoice -->
    <?php
    $mot_status = $tbl_invoices->mot_status;
    $total3 = 0;

    if ($mot_status == 1) {
    ?>
      <br />
      <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
        <tr style="color:#333;">
          <th align="left" style="font-size:14px;padding:8px;" colspan="7">{{ trans('message.MOT TEST SERVICE CHARGE') }}</th>
        </tr>
        <tr>
          <th align="left" style="padding:8px; width: 5%;">#</th>
          <th align="left" style="padding:8px;" colspan="2">{{ trans('message.MOT Charge Detail') }}</th>
          <th align="left" style="padding:8px;">{{ trans('message.MOT Test') }}</th>
          <th align="left" style="padding:8px;" colspan="2">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
          <th align="left" style="padding:8px; width: 20%;">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
        </tr>
        <?php $total3 = 0; ?>
        <tr>
          <td align="left" style="padding:8px;">1</td>
          <td align="left" style="padding:8px;" colspan="2">{{ trans('message.MOT Testing Charges') }}</td>
          <td align="left" style="padding:8px;">{{ trans('message.Completed') }}</td>
          <td align="left" style="padding:8px;" colspan="2"><?php echo number_format((float) 0, 2); ?></td>
          <td align="right" style="padding:8px;"><?php echo number_format((float) 0, 2); ?></td>
          <?php $total3 += 0; ?>
        </tr>
      </table>
    <?php
    }
    ?>
    <!-- MOT Testing Part Invoice Ending-->


    <!-- Washbay Service Charge Details Start -->
    <?php

    $total4 = 0;

    if ($washbay_data != null) {
    ?>
      <br />
      <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
        <tr style="color:#333;">
          <th align="left" style="font-size:14px;padding:8px;" colspan="7">{{ trans('message.Wash Bay Service Charge') }}</th>
        </tr>
        <tr>
          <th align="left" style="padding:8px; width: 5%;">#</th>
          <th align="left" style="padding:8px;" colspan="4">{{ trans('message.Charge for') }}</th>
          <th align="left" style="padding:8px;">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
          <th align="left" style="padding:8px; width: 20%;">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>) </th>
        </tr>

        <tr>
          <td align="left" style="padding:8px;">1</td>
          <td align="left" style="padding:8px;" colspan="4">{{ trans('message.Wash Bay Service') }}</td>
          <td align="left" style="padding:8px;"><?php echo number_format((float) $washbay_data->price, 2); ?></td>
          <td align="right" style="padding:8px;"><?php echo number_format((float) $washbay_data->price, 2); ?></td>
          <?php $total4 += $washbay_data->price; ?>
        </tr>
      </table>
    <?php
    }
    ?>
    <!-- Washbay Service Charge Details End -->

    <!-- Custom Field Of Customer Module (User table)-->
    @if (empty($tbl_custom_fields_customers) == 0)
    @php $showTableHeading = false; @endphp
    @foreach ($tbl_custom_fields_customers as $tbl_custom_fields_customer)
    @php
    $tbl_custom = $tbl_custom_fields_customer->id;
    $userid = $tbl_services->customer_id;
    $datavalue = getCustomData($tbl_custom, $userid);
    @endphp

    @if ($tbl_custom_fields_customer->type == 'radio' && $datavalue != '')
    @php $showTableHeading = true; @endphp
    @elseif ($datavalue != null)
    @php $showTableHeading = true; @endphp
    @endif
    @endforeach

    @if ($showTableHeading)
    <br />
    <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
      <tr class="printimg" style="color:#333;">
        <th align="left" style="padding:8px; font-size:14px;" colspan="2">
          {{ trans('message.Customer Other Details') }}
        </th>
      </tr>
      @foreach ($tbl_custom_fields_customers as $tbl_custom_fields_customer)
      <?php
      $tbl_custom = $tbl_custom_fields_customer->id;
      $userid = $tbl_invoices->customer_id;

      $datavalue = getCustomData($tbl_custom, $userid);
      ?>

      @if ($tbl_custom_fields_customer->type == 'radio')
      @if ($datavalue != '')
      <?php
      $radio_selected_value = getRadioSelectedValue($tbl_custom_fields_customer->id, $datavalue);
      ?>
      <tr>
        <th align="left" style="padding:8px;">
          {{ $tbl_custom_fields_customer->label }} :
        </th>
        <td align="left" style="padding:8px;">{{ $radio_selected_value }}</td>
      </tr>

      @endif
      @else
      @if ($datavalue != null)
      <tr>
        <th align="left" style="padding:8px;">
          {{ $tbl_custom_fields_customer->label }} :
        </th>
        <td align="left" style="padding:8px;">{{ $datavalue }}</td>
      </tr>
      @endif
      @endif
      @endforeach
    </table>
    @endif
    @endif
    <!-- Custom Field Invoice Customer Module (User table)-->

    <!-- Custom Field Of Invoice Module-->

    @if (!empty($tbl_custom_fields_invoice))
    @php $showTableHeading = false; @endphp
    @foreach ($tbl_custom_fields_invoice as $tbl_custom_fields_invoices)
    @php
    $tbl_custom = $tbl_custom_fields_invoices->id;
    $userid = $service_tax->id;

    $datavalue = getCustomDataInvoice($tbl_custom, $userid);
    @endphp

    @if ($tbl_custom_fields_invoices->type == 'radio' && $datavalue != '')
    @php $showTableHeading = true; @endphp
    @elseif ($datavalue != null)
    @php $showTableHeading = true; @endphp
    @endif
    @endforeach

    @if ($showTableHeading)
    <br />
    <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
      <tr class="printimg" style="color:#333;">
        <th align="left" style="padding:8px; font-size:14px;" colspan="2">
          {{ trans('message.Other Information Of Invoice') }}
        </th>
      </tr>
      @foreach ($tbl_custom_fields_invoice as $tbl_custom_fields_invoices)
      <?php
      $tbl_custom = $tbl_custom_fields_invoices->id;
      $userid = $service_tax->id;

      $datavalue = getCustomDataInvoice($tbl_custom, $userid);
      ?>

      @if ($tbl_custom_fields_invoices->type == 'radio')
      @if ($datavalue != '')
      <?php
      $radio_selected_value = getRadioSelectedValue($tbl_custom_fields_invoices->id, $datavalue);
      ?>

      <tr>
        <th align="left" style="padding:8px; ">
          {{ $tbl_custom_fields_invoices->label }} :
        </th>
        <td align="left" style="padding:8px;">{{ $radio_selected_value }}</td>
      </tr>
      @endif
      @else
      @if ($datavalue != null)
      <tr>
        <th align="left" style="padding:8px;">
          {{ $tbl_custom_fields_invoices->label }} :
        </th>
        <td align="left" style="padding:8px;">{{ $datavalue }}</td>
      </tr>
      @endif
      @endif
      @endforeach
    </table>
    @endif
    @endif
    <!-- Custom Field Invoice Module End -->

    <!-- For Custom Field Of Service Module-->
    @if (!empty($tbl_custom_fields_service))
    @php $showTableHeading = false; @endphp
    @foreach ($tbl_custom_fields_service as $tbl_custom_fields_services)
    @php
    $tbl_custom = $tbl_custom_fields_services->id;
    $userid = $tbl_services->id;

    $datavalue = getCustomDataService($tbl_custom, $userid);
    @endphp

    @if ($tbl_custom_fields_services->type == 'radio' && $datavalue != '')
    @php $showTableHeading = true; @endphp
    @elseif ($datavalue != null)
    @php $showTableHeading = true; @endphp
    @endif
    @endforeach

    @if ($showTableHeading)
    <br />
    <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
      <tr class="printimg" style="color:#333;">
        <th align="left" style="padding:8px; font-size:14px;" colspan="2">
          {{ trans('message.Other Information Of Service') }}
        </th>
      </tr>
      @foreach ($tbl_custom_fields_service as $tbl_custom_fields_services)
      <?php
      $tbl_custom = $tbl_custom_fields_services->id;
      $userid = $tbl_services->id;

      $datavalue = getCustomDataService($tbl_custom, $userid);
      ?>

      @if ($tbl_custom_fields_services->type == 'radio')
      @if ($datavalue != '')
      <?php
      $radio_selected_value = getRadioSelectedValue($tbl_custom_fields_services->id, $datavalue);
      ?>

      <tr>
        <th align="left" style="padding:8px;">
          {{ $tbl_custom_fields_services->label }} :
        </th>
        <td align="left" style="padding:8px;">{{ $radio_selected_value }}</td>
      </tr>
      @endif
      @else
      @if ($datavalue != null)
      <tr>
        <th align="left" style="padding:8px;">
          {{ $tbl_custom_fields_services->label }} :
        </th>
        <td align="left" style="padding:8px;">{{ $datavalue }}</td>
      </tr>
      @endif
      @endif
      @endforeach
    </table>
    @endif
    @endif
    <!-- For Custom Field Service Module End -->

    <br />
    <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
      <tbody>
        <tr>
          <td align="right" style="padding:8px;">{{ trans('message.Fixed Service Charge') }} (<?php echo getCurrencySymbols(); ?>)</td>
          <td align="right" style="padding:8px; font-size: 17px;"><b><?php $fix = $tbl_services->charge;
                                                                      if (!empty($fix)) {
                                                                        echo number_format($fix, 2);
                                                                      } else {
                                                                        echo 'Free Service';
                                                                      } ?></b></td>
        </tr>
        <tr>
          <td align="right" style="padding:8px;" width="80%">{{ trans('message.Total Service Amount') }} (<?php echo getCurrencySymbols(); ?>) :</td>
          <td align="right" style="padding:8px; font-size: 17px;"><b><?php $total_amt = $total1 + $total2 + $total3 + $total4 + $fix;
                                                                      echo number_format($total_amt, 2); ?></b></td>
        </tr>
        <tr>
          <td align="right" style="padding:8px;" width="80%">{{ trans('message.Discount') }} (<?php echo $tbl_invoices->discount . '%'; ?>) :</td>
          <td align="right" style="padding:8px; font-size: 17px;"><b><?php $discount = ($total_amt * $tbl_invoices->discount) / 100;
                                                                      echo number_format($discount, 2); ?></b></td>
        </tr>
        <tr>
          <td align="right" style="padding:8px;" width="80%">{{ trans('message.Total') }} (<?php echo getCurrencySymbols(); ?>) :</td>
          <td align="right" style="padding:8px; font-size: 17px;"><b><?php $after_dis_total = $total_amt - $discount;
                                                                      echo number_format($after_dis_total, 2); ?></b></td>
        </tr>
        <?php

        if (!empty($service_taxes)) {
          $total_tax = 0;
          $taxes_amount = 0;
          $taxName = null;
          foreach ($service_taxes as $tax) {
            // $taxes_per = preg_replace("/[^0-9,.]/", "", $tax);
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
              <td align="right" style="padding:8px;" width="80%"><b><?php echo $taxName; ?> (%) :</b></td>
              <td align="right" style="padding:8px; font-size: 17px;"><b><?php echo number_format($taxes_amount, 2); ?></b></td>
            </tr>

        <?php  }
          $final_grand_total = $after_dis_total + $total_tax;
        } else {
          $final_grand_total = $after_dis_total;
        }
        ?>

        <?php
        $paid_amount = $tbl_invoices->paid_amount;
        $Adjustmentamount = $final_grand_total - $paid_amount; ?>

        <tr>
          <td align="right" style="padding:8px;" width="80%">
            {{ trans('message.Adjustment Amount') }}({{trans('message.Paid Amount')}})(<?php echo getCurrencySymbols(); ?>) :
          </td>

          <td align="right" style="padding:8px; font-size: 17px;"><b>
              <?php $paid_amount;
              echo number_format($paid_amount, 2); ?></b>
          </td>
        </tr>

        <tr>
          <td align="right" style="padding:8px;" width="80%">{{ trans('message.Due Amount') }} (<?php echo getCurrencySymbols(); ?>):

          </td>
          <td align="right" style="padding:8px; font-size: 17px;"><b><?php $Adjustmentamount;
                                                                      echo number_format($Adjustmentamount, 2); ?></b></td>

        </tr>

        <tr class="grand_total_modal_invoice">
          <td align="right" style="padding:8px;" width="80%">{{ trans('message.Grand Total') }} (<?php echo getCurrencySymbols(); ?>) :</td>
          <td align="right" style="padding:8px; font-size: 17px;"><b><?php $final_grand_total;
                                                                      echo number_format($final_grand_total, 2); ?></b></td>
        </tr>
      </tbody>
    </table>
  </div>


</body>

</html>