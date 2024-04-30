<html dir="{{ getLangCode() === 'ar' ? 'rtl' : '' }}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <style type="text/css">
    @if (getLangCode()==='hi')body,
    p,
    td,
    div,
    th {
      font-family: Poppins;
    }

    @elseif (getLangCode()==='gu') body,
    p,
    td,
    div,
    th {
      font-family: Poppins;
    }

    @elseif (getLangCode()==='ja') body,
    p,
    td,
    div,
    th {
      font-family: Poppins;
    }

    @elseif (getLangCode()==='zhcn') body,
    p,
    td,
    div,
    th {
      font-family: Poppins; // not working
    }

    @elseif (getLangCode()==='th') body,
    p,
    td,
    div,
    th,
    strong {
      font-family: Poppins;
    }

    @elseif (getLangCode()==='mr') body,
    p,
    td,
    div,
    th {
      font-family: Poppins;
    }

    @elseif (getLangCode()==='ta') body,
    p,
    td,
    div,
    th,
    strong {
      font-family: Poppins;
    }

    @else body,
    p,
    td,
    div,
    th,
    strong {
      font-family: Poppins;
    }

    @endif
    /* * {
      font-family: Poppins;
    }
    body, p, td, div, th { font-family: Poppins; } */

    @font-face {
      font-family: "Poppins" !important;
      font-weight: normal;
      font-style: italic;
    }

    body {
      font-family: "Poppins";
    }
  </style>
  <style>
    /* body {
    font-family: 'Poppins' !important;
    font-style: normal;
    font-weight: normal;
    color: #333;
    }
   */
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

    @media print {

      body,
      page[size="A4"] {
        margin: 0;
        box-shadow: 0;
      }
    }

    .grand_total_modal_quotation {
      background: #DC3733;
      color: #FFFFFF;
      margin-left: 55%;
      margin-bottom: 0px;
    }

    .phoneimg {
      width: 14px;
      height: 12px;
      /* margin-bottom: 2px; */
      margin-right: 1px;
    }

    .user_img {
      width: 14px;
      height: 12px;
    }

    .cust_addr_details {
      line-height: 25px;
    }

    .customer_details {
      line-height: 25px;
      margin-top: 3px;
    }

    .system_addr_details {
      line-height: 25px;
    }

    .mail_img {
      width: 12px;
    }

    .addr_img {
      width: 10px;
    }
  </style>

</head>


<body>
  <div class="row" id="invoice_print">
    <table width="100%" border="0" style="margin:0px 8px 0px 8px; font-family:Poppins;">
      <tr>
        <td align="left">
          <h3 style="font-size:18px;"><?php echo $logo->system_name; ?></h3>
        </td>
      </tr>
    </table>
    <hr />
    <br><br><br><br>
    <div id="imggrapish" class="col-md-12 col-sm-12 col-xs-12">
      <table width="100%" border="0">
        <thead></thead>

        <tbody>
          <tr class="customer_details">
            <td width="15%" style="vertical-align:top;float:left; width:15%;" align="left">
              <span style="width:100%;">
                <img src="{{ base_path() }}/public/general_setting/<?php echo $logo->logo_image; ?>" width="230px" height="70px" style=" margin-top: 5px;">
              </span>
            </td>
            <td style="width: 45%;" vertical-align:top;">
              <span style="float:right; class="cust_addr_details">
                <b><img src="{{ URL::asset('public/img/icons/user_img.png') }}" class="user_img"></b><?php echo getCustomerName($tbl_services->customer_id); ?>
                <br>
                <b><img src="{{ URL::asset('public/img/icons/Vector (14).png') }}" class="addr_img"></b> <?php echo $customer->address;
                                                                                                          echo ' ,';
                                                                                                          echo getCityName("$customer->city_id"); ?><?php echo ''; ?><?php echo getStateName("$customer->state_id,");
                                                                                                                                                                      echo ' ,';
                                                                                                                                                                      echo getCountryName($customer->country_id); ?>
                <br>
                <b><img src="{{ URL::asset('public/img/icons/phoneimg1.png') }}" class="phoneimg"></b> <?php echo "$customer->mobile_no"; ?>
                <br>
                <b><img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class=" mail_img"></b> <?php echo $customer->email; ?>

                @if (getCustomerCompanyName($tbl_services->customer_id) != '')
                <br>
                <b>{{ trans('message.Company Name') }}:</b>
                <?php echo getCustomerCompanyName($tbl_services->customer_id); ?>
                @endif
                <br>
                @if(($customer->tax_id) != '')
                <b>{{ trans('message.Tax Id') }} :</b>
                <?php echo $customer->tax_id; ?>
                @endif
              </span>
            </td>
          </tr>
          <tr>
            <td width="55%" style="vertical-align:center;float:left;">
              <span style="float:left;" class="system_addr_details">
                <img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class=" mail_img">
                <?php
                $taxNumber = $taxName = null;
                if (!empty($service_taxes)) {
                  foreach ($service_taxes as $tax) {
                    $taxName = getTaxNameFromTaxTable($tax);
                    $taxNumber = getTaxNumberFromTaxTable($tax);
                  }
                }

                echo ' ' . $logo->email;
                ?>
                <br>
                <img src="{{ URL::asset('public/img/icons/phoneimg1.png') }}" class="phoneimg">
                <?php
                echo ' ' . $logo->phone_number;
                echo ' ';
                ?>
                <br>
                <div class="col-12 d-flex align-items-start" style="margin-top: 2px;">
                  <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}" class="addr_img">
                  <?php
                  echo ' ' . $logo->address . ' ';
                  echo ' ' . getCityName($logo->city_id);
                  echo ', ' . getStateName($logo->state_id);
                  echo ', ' . getCountryName($logo->country_id);
                  ?>

                </div>
                <?php
                if ($taxName !== null && $taxNumber !== null) {
                  echo ' ' . $taxName . ': ' . $taxNumber;
                }
                ?>
              </span>
            </td>

          </tr>
          <br>
        </tbody>
      </table>

      <hr />
      <table class="table" border="0" width="100%" style="border-collapse:collapse;">
        <tbody class="itemtable">
          <tr>
            <th align="left" style="padding:8px;">{{ trans('message.Quotation Number') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Vehicle Name') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Number Plate') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Date') }}</th>
          </tr>

          <tr>
            <td align="left" style="padding:8px;">
              <?php echo getQuotationNumber($tbl_services->job_no); ?>
            </td>
            <td align="left" style="padding:8px;"><?php echo getVehicleName($tbl_services->vehicle_id); ?></td>
            <td align="left" style="padding:8px;"><?php echo getVehicleNumberPlate($tbl_services->vehicle_id); ?></td>
            <td align="left" style="padding:8px;"><?php echo date(getDateFormat(), strtotime($tbl_services->service_date)); ?></td>

          </tr>
          <tr>
            <!-- <th align="left" style="padding:8px;">{{ trans('message.Assigned To') }}</th> -->
            <th align="left" style="padding:8px;">{{ trans('message.Repair Category') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Service Type') }}</th>
            <th align="left" style="padding:8px;" colspan="2">{{ trans('message.Details') }}</th>
          </tr>

          <tr>
            <!-- <td align="left" style="padding:8px;"><?php echo getAssignedName($tbl_services->assign_to); ?> </td> -->
            <td align="left" style="padding:8px;"><?php echo ucwords($tbl_services->service_category); ?> </td>
            <td align="left" style="padding:8px;"><?php echo ucwords($tbl_services->service_type); ?> </td>
            <td align="left" style="padding:8px;" colspan="2"><?php echo $tbl_services->detail; ?> </td>
          </tr>
        </tbody>
      </table>
      <hr />
      <br />
      <?php
      $total1 = 0;
      $i = 1;
      ?>
      <table class="table itemtable" width="100%" border="1" style="border-collapse:collapse; border-top: #FFFFFF; ">
        <tbody>

          <tr class="printimg tbl_heading" style="color:#333;">
            <th align="left" border="0" style="padding:8px; font-size:14px;" colspan="8">
              {{ trans('message.Observation Charges') }}
            </th>
          </tr>

          <tr>
            <th align="left" style="padding:8px; width: 5%;"># </th>
            <th align="left" style="padding:8px;">{{ trans('message.Category') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Observation Point') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Product Name') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
            <th align="left" style="padding:8px;">{{ trans('message.Quantity') }} </th>
            <th align="left" style="padding:8px;">{{ trans('message.Charge') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>) </th>
          </tr>
          <?php
          foreach ($service_pro as $service_pros) {
          ?>
            <tr>
              <td align="text-left" style="padding:8px;"><?php echo $i++; ?></td>
              <td align="text-left" style="padding:8px;"> <?php echo $service_pros->category; ?></td>
              <td align="text-left" style="padding:8px;"> <?php echo $service_pros->obs_point; ?></td>
              <td align="text-left" style="padding:8px;"> <?php echo getProduct($service_pros->product_id); ?></td>
              <td align="text-left" style="padding:8px;"> <?php echo $service_pros->price; ?></td>
              <td align="text-left" style="padding:8px;"><?php echo $service_pros->quantity; ?></td>
              <?php if (!empty($service_pros->total_price) && $service_pros->chargeable != 0) {
                $total1 += $service_pros->total_price;
              } ?>
              <td align="text-left" style="padding:8px;">
                <?php
                if ($service_pros->chargeable == 1) {
                  echo trans('message.Yes');
                } else {
                  echo trans('message.No');
                }
                ?>
              <td align="right" style="padding:8px;"><?php echo $service_pros->total_price; ?></td>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

      <br />
      <?php
      $total2 = 0;
      $i = 1;
      ?>

      <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
        <tbody>
          <tr style="color:#333;" class="tbl_heading">
            <th align="left" border="0" style="font-size:14px;padding:8px;" colspan="7">{{ trans('message.Other Service Charges') }}</th>
          </tr>
          <tr>
            <th align="left" style="padding:8px; width: 5%;"> # </th>
            <th align="left" style="padding:8px;" colspan="2">{{ trans('message.Charge for') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Product Name') }}</th>
            <th align="left" style="padding:8px;" colspan="2">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
            <th align="left" style="padding:8px; width: 20%;">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>) </th>
          </tr>
          <?php
          foreach ($service_pro2 as $service_pros) { ?>
            <tr>
              <td align="left" style="padding:8px;"><?php echo $i++; ?></td>
              <td align="left" style="padding:8px;" colspan="2">{{ trans('message.Other Charges') }}</td>
              <td align="left" style="padding:8px;"><?php echo $service_pros->comment; ?></td>
              <td align="left" style="padding:8px;" colspan="2"><?php echo number_format((float) $service_pros->total_price, 2); ?></td>
              <td align="right" style="padding:8px;"><?php echo number_format((float) $service_pros->total_price, 2); ?></td>
              <?php $total2 += $service_pros->total_price; ?>
            </tr>
          <?php } ?>
        </tbody>
      </table>


      <!-- MOT Testing Part Invoice -->
      <?php

      $mot_status = $tbl_services->mot_status;
      $total3 = 0;

      if ($mot_status == 1) {

      ?>
        <br />
        <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
          <tr style="color:#333;" class="tbl_heading">
            <th align="left" border="0" style="font-size:14px;padding:8px;" colspan="7">{{ trans('message.MOT Test Service Charge') }}</th>
          </tr>
          <tr>
            <th align="left" style="padding:8px; width: 5%;"> # </th>
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
      if (isset($washbay_data)) {
      ?>
        <br />
        <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
          <tr style="color:#333;" class="tbl_heading">
            <th align="left" style="font-size:14px;padding:8px;" colspan="10">{{ trans('message.Wash Bay Service Charge') }}</th>
          </tr>
          <tr>
            <th align="left" style="padding:8px; width: 5%;"> # </th>
            <th align="left" style="padding:8px;" colspan="5">{{ trans('message.Charge for') }}</th>
            <th align="left" style="padding:8px;" colspan="2">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
            <th align="left" style="padding:8px;" colspan="2">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
          </tr>
          <?php $total3 = 0; ?>
          <tr>
            <td align="left" style="padding:8px;">1</td>
            <td align="left" style="padding:8px;" colspan="5">{{ trans('message.Wash Bay Service') }}</td>
            <td align="left" style="padding:8px;" colspan="2"><?php echo number_format((float) $washbay_data->price, 2); ?></td>
            <td align="right" style="padding:8px;" colspan="2"><?php echo number_format((float) $washbay_data->price, 2); ?></td>
            <?php $total4 += $washbay_data->price; ?>
          </tr>
        </table>
      <?php
      }
      ?>
      <!-- Washbay Service Charge Details End -->



      <!-- Custom Field Of Invoice Module-->
      @if (!empty($tbl_custom_fields))
      <br />
      <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
        <tr style="color:#333;" class="tbl_heading">
          <th align="left" style="font-size:14px;padding:8px;" colspan="2">{{ trans('message.Other Information') }}</th>
        </tr>
        @foreach ($tbl_custom_fields as $tbl_custom_field)
        <?php
        $tbl_custom = $tbl_custom_field->id;
        $userid = $tbl_services->id;

        $datavalue = getCustomDataService($tbl_custom, $userid);
        ?>
        @if ($tbl_custom_field->type == 'radio')
        @if ($datavalue != '')
        <?php
        $radio_selected_value = getRadioSelectedValue($tbl_custom_field->id, $datavalue);
        ?>

        <tr>
          <th align="left" style="padding:8px;">{{ $tbl_custom_field->label }} :</th>
          <td align="left" style="padding:8px;">{{ $radio_selected_value }}</td>
        </tr>
        @else
        <tr>
          <th align="left" style="padding:8px;">{{ $tbl_custom_field->label }} :</th>
          <td align="left" style="padding:8px;">
            {{ trans('message.Data not available') }}
          </td>
        </tr>
        @endif
        @else
        @if ($datavalue != null)
        <tr>
          <th align="left" style="padding:8px;">{{ $tbl_custom_field->label }} :</th>
          <td align="left" style="padding:8px;">{{ $datavalue }}</td>
        </tr>
        @else
        <tr>
          <th align="left" style="padding:8px;">{{ $tbl_custom_field->label }} :</th>
          <td align="left" style="padding:8px;">
            {{ trans('message.Data not available') }}
          </td>
        </tr>
        @endif
        @endif
        @endforeach
      </table>
      @endif
      <!-- For Custom Field Service Module End -->
      <br>
      <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
        <thead></thead>
        <tfoot></tfoot>
        <tbody>
          <tr>
            <td align="right" style="padding:8px;">
              {{ trans('message.Fixed Service Charge') }} (<?php echo getCurrencySymbols(); ?>)
            </td>
            <td align="right" style="padding:8px;  width: 20%; font-size: 17px;"><b><?php $fix = $tbl_services->charge;
                                                                                    if (!empty($fix)) {
                                                                                      echo number_format($fix, 2);
                                                                                    } else {
                                                                                      echo 'Free Service';
                                                                                    } ?></b></td>
          </tr>

          <tr>
            <td align="right" style="padding:8px;" width: "85%">{{ trans('message.Total Service Amount') }} (<?php echo getCurrencySymbols(); ?>) :</td>
            <td align="right" style="padding:8px; width: 20%; font-size: 17px;"><b><?php $total_amt = $total1 + $total2 + $total3 + $total4 + $fix;
                                                                                    echo number_format($total_amt, 2); ?></b></td>
          </tr>

          <?php
          if (!empty($service_taxes)) {
            $all_taxes = 0;
            $total_tax = 0;
            foreach ($service_taxes as $ser_tax) {
              //$taxes_to_count = preg_replace("/[^0-9,.]/", "", $ser_tax);
              $taxes_to_count = getTaxPercentFromTaxTable($ser_tax);
              $all_taxes = ($total_amt * $taxes_to_count) / 100;
              $total_tax +=  $all_taxes;
          ?>
              <tr>
                <td align="right" style="padding:8px;" width: "85%"><?php echo getTaxNameAndPercentFromTaxTable($ser_tax); ?> (%) :</td>
                <td align="right" style="padding:8px; width: 20%; font-size: 17px;"><b><?php $all_taxes;
                                                                                        echo number_format($all_taxes, 2); ?></b></td>
              </tr>
          <?php
            }
          } else {
            $total_tax = 0;
          }
          ?>

          <tr class=" grand_total_modal_quotation" style="width: 50%;">
            <td align="right" style="padding:8px;">{{ trans('message.Grand Total') }} (<?php echo getCurrencySymbols(); ?>) :</td>
            <td align="right" style="padding:8px; width: 20%; font-size: 17px;"><b><?php $grd_total = $total_amt + $total_tax;
                                                                                    echo number_format($grd_total, 2); ?></b></td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>

  <!-- <div class="modal-footer">
   <div class="col-md-12 col-sm-12 col-xs-12" >
            <h4 class="text-danger" style="text-align: center;">
            <b>{{ trans('message.Any kind of Tax not included inside quotation') }}</b>
            </h4>
        </div>
    </div> -->
</body>

</html>