<html dir="{{ getLangCode() === "ar" ? "rtl" : ""}}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  {{-- <style>
    * {
      font-family: DejaVu Sans, sans-serif;
    }

  </style> --}}

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

  .grand_total_modal_invoice {
    background: #DC3733;
    color: #FFFFFF;
    margin-left: 55%;
    margin-bottom: 0px;
  }

  .invoice_details {
    margin-top: 5px;
    line-height: 25px;
    font-size: 14px;
  }

  .system_addr {
    line-height: 25px;
    font-size: 14px;
  }

  .mail_img {
    width: 12px;
  }

  .user_img {
    width: 14px;
    height: 12px;
  }

  .addr_img {
    width: 10px;
  }

  .phoneimg {
    width: 14px;
    height: 12px;
    /* margin-bottom: 2px; */
    margin-right: 1px;
  }

  .invoicepdf {
    line-height: 25px;
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
</style>

<body>
  <div class="row " id="invoice_print">
    <table width="100%" border="0" style="margin:0px 8px 0px 8px;">
      <tr>
        <td colspan="3" align="left">
          <h3 style="font-size:18px;"><?php echo $logo->system_name; ?></h3>
        </td>
      </tr>
    </table>
    <hr />
    <br><br><br><br>
    <div id="imggrapish">
      <table class="table table-bordered" width="100%" border="0" style="border-collapse:collapse;">
        <tbody>
          <tr class="invoice_details">
            <td width="15%" style="vertical-align:top;float:left; width:15%;" align="left">
              <span style="float:left; width:100%;">
                <img src="{{ base_path() }}/public/general_setting/<?php echo $logo->logo_image; ?>" width="230px" height="70px">
              </span>
            </td>

            <td align="top" style="valign:top;float:left; width:30%; font-size: 14px;" border="0" id="adddatatable1">
              <span style="float:right;">
                <b>{{ trans('message.Bill Number :') }}</b><?php echo $sales->bill_no; ?><br>
                <b>{{ trans('message.Invoice No. :')}}</b> {{ $invioce->invoice_number }}<br>
                <b>{{ trans('message.Date :') }}</b><?php echo date(getDateFormat(), strtotime($invioce->date)); ?><br>
                <b>{{ trans('message.Status :') }}</b><?php if ($invioce->payment_status == 0) {
                                                        echo '<span style="color: rgb(255, 0, 0);">' .  trans('message.Unpaid') . '</span>';
                                                      } elseif ($invioce->payment_status == 1) {
                                                        echo '<span style="color: rgb(255, 165, 0);">' .  trans('message.Partially paid') . '</span>';
                                                      } elseif ($invioce->payment_status == 2) {
                                                        echo '<span style="color: rgb(0, 128, 0);">' .  trans('message.Full Paid') . '</span>';
                                                      } else {
                                                        echo '<span style="color: rgb(255, 0, 0);">' .  trans('message.Unpaid') . '</span>';
                                                      } ?><br>
                <b>{{ trans('message.Sale Amount :') }} (<?php echo getCurrencySymbols(); ?>)</b> <?php echo number_format($invioce->grand_total, 2); ?>

              </span>
            </td>
          </tr>
          <br> <br> <br>
          <tr class="system_addr">
            <td width="50%" style="vertical-align:top;float:left;" align="left">
              <span style="float:left;">
                <img src="{{ URL::asset('public/img/icons/phoneimg1 (15).png') }}" class="mail_img">
                <?php
                echo ' ' . $logo->email;
                ?>
                <br>
                <img src="{{ URL::asset('public/img/icons/phoneimg1.png') }}" class="phoneimg">
                <?php
                echo ' ' . $logo->phone_number;
                ?>
                <br>
                <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}" class="addr_img">
                <?php
                $taxNumber = $taxName = null;
                if (!empty($taxes)) {
                  foreach ($taxes as $tax) {

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
                  echo '<br> ' .  $taxName  . ':- ' . $taxNumber;
                }
                ?>
              </span>
            </td>
          </tr>
        </tbody>
      </table>
      <hr />
      <table class="table" width="100%" border="0" style="border-collapse:collapse;">
        <tbody class=" invoicepdf">
          <tr>
            <td width="60%" align="left">
              <p style="font-size:20px;">{{ trans('message.Payment To,') }} </p>
            </td>
            <td align="left" width="30%">
              <p style="font-size:20px;">{{ trans('message.Bill To,') }} </p>
            </td>
          </tr>
          <tr>
            <td valign="top" width="60%" align="left">
              <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}" class="addr_img"> <?php echo getCustomerAddress($sales->customer_id); ?><br /><?php echo getCustomerCity($sales->customer_id) != null ? getCustomerCity("$sales->customer_id") . ', ' : ''; ?><?php echo getCustomerState("$sales->customer_id,");
                                                                                                                                                                                                                                                                            echo ', ';
                                                                                                                                                                                                                                                                            echo getCustomerCountry($sales->customer_id); ?>
            </td>
            <td valign="top" width="30%" align="left">
              <b><img src="{{ URL::asset('public/img/icons/user_img.png') }}" class="user_img"> </b> <?php echo getCustomerName($sales->customer_id); ?><br>
              <b><img src="{{ URL::asset('public/img/icons/phoneimg1.png') }}" class="phoneimg"> </b> <?php echo getCustomerMobile($sales->customer_id); ?> <br>
              <b><img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class=" mail_img"> </b> <?php echo getCustomerEmail($sales->customer_id); ?>
              <br>
              <?php if (getCustomerTaxid($sales->customer_id) !== null) { ?>
                <b>{{ trans('message.Tax Id') }} : </b><?php echo getCustomerTaxid($sales->customer_id); ?><br>
              <?php } ?>
            </td>
          </tr>
        </tbody>
      </table>
      <hr />

      <!-- For Custom Field of Customer Module-->
      @if (!empty($tbl_custom_fields_customers))

      <div class="table-rersponsive">
        <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
          <thead>
            <tr class="printimg" style="color:#333;">
              <th align="left" style="padding:8px;" colspan="4">
                {{ trans('message.Customer Other Details') }}
              </th>
            </tr>
          </thead>
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
            <th align="left" style="padding:8px;">
              {{ $tbl_custom_fields_customer->label }} :
            </th>
            <td align="left" style="padding:8px;">
              {{ $radio_selected_value }}
            </td>
          </tr>
          @else
          <tr>
            <th align="left" style="padding:8px;">
              {{ $tbl_custom_fields_customer->label }} :
            </th>
            <td align="left" style="padding:8px;">
              {{ trans('message.Data not available') }}
            </td>
          </tr>
          @endif
          @else
          @if ($datavalue != null)
          <tr>
            <td align="left" style="padding:8px;">
              {{ $tbl_custom_fields_customer->label }} :
              </th>
            <td align="left" style="padding:8px;">
              {{ $datavalue }}
            </td>
          </tr>
          @else
          <tr>
            <td align="left" style="padding:8px;">
              {{ $tbl_custom_fields_customer->label }} :
              </th>
            <td align="left" style="padding:8px;">
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
      <br />
      <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
        <thead>
          <tr class="printimg" style="color:#333;">
            <th align="left" style="padding:8px;" colspan="4">
              {{ trans('message.Vehicle Details') }}
            </th>
          </tr>
          <tr>
            <th align="left" style="padding:8px;">{{ trans('message.Model') }}</th>
            <th align="left" style="padding:8px;">{{ trans('message.Type') }} </th>
            <th align="left" style="padding:8px;">{{ trans('message.Color') }} </th>
            <th align="left" style="padding:8px;">{{ trans('message.Chasis No') }} </th>

          </tr>
        </thead>
        <tbody>

          <tr>
            <td align="left" style="padding:8px;"><?php echo $vehicale->modelname; ?></td>
            <td align="left" style="padding:8px;"><?php echo getVehicleType($vehicale->vehicletype_id); ?></td>
            <td align="left" style="padding:8px;"><?php echo getVehicleColor($sales->color_id); ?></td>
            <td align="left" style="padding:8px;"><?php echo $vehicale->chassisno; ?></td>

          </tr>
        </tbody>
      </table>

      <!-- For Custom Field -->
      @if (!empty($tbl_custom_fields_sales))
      <br />
      <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
        <tr class="printimg" style="color:#333;">
          <th align="left" style="padding:8px; font-size:14px;" colspan="2">
            {{ trans('message.Other Information') }}
          </th>
        </tr>

        @foreach ($tbl_custom_fields_sales as $tbl_custom_fields_sale)
        <?php
        $tbl_custom = $tbl_custom_fields_sale->id;
        $userid = $sales->id;

        $datavalue = getCustomDataSales($tbl_custom, $userid);
        ?>

        @if ($tbl_custom_fields_sale->type == 'radio')
        @if ($datavalue != '')
        <?php
        $radio_selected_value = getRadioSelectedValue($tbl_custom_fields_sale->id, $datavalue);
        ?>
        <tr>
          <th align="left" style="padding:8px;">
            {{ $tbl_custom_fields_sale->label }} :
          </th>
          <td align="left" style="padding:8px;">
            {{ $radio_selected_value }}
          </td>
        </tr>
        @else
        <tr>
          <th align="left" style="padding:8px;">
            {{ $tbl_custom_fields_sale->label }} :
          </th>
          <td align="left" style="padding:8px;">{{ trans('message.Data not available') }}</td>
        </tr>
        @endif
        @else
        @if ($datavalue != '')
        <tr>
          <th align="left" style="padding:8px;">
            {{ $tbl_custom_fields_sale->label }} :
          </th>
          <td align="left" style="padding:8px;">{{ $datavalue }}</td>
        </tr>
        @else
        <tr>
          <th align="left" style="padding:8px;">
            {{ $tbl_custom_fields_sale->label }} :
          </th>
          <td align="left" style="padding:8px;">{{ trans('message.Data not available') }}</td>
        </tr>
        @endif
        @endif
        @endforeach
      </table>
      @endif
      <!-- For Custom Field End -->


      <!-- For Custom Field of Invoice Table-->
      @if (!empty($tbl_custom_fields_invoice))
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
        $userid = $invioce->id;

        $datavalue = getCustomDataInvoice($tbl_custom, $userid);
        ?>

        @if ($datavalue != null)
        <tr>
          <th align="left" style="padding:8px;">
            {{ $tbl_custom_fields_invoices->label }} :
          </th>
          <td align="left" style="padding:8px;">{{ $datavalue }}</td>
        </tr>
        @else
        <tr>
          <th align="left" style="padding:8px;">
            {{ $tbl_custom_fields_invoices->label }} :
          </th>
          <td align="left" style="padding:8px;">{{ trans('message.Data not available') }}</td>
        </tr>
        @endif
        @endforeach
      </table>
      @endif
      <!-- For Custom Field of Invoice Table End -->
      <br />
      <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
        <thead>
          <tr class="printimg">
            <th align="right" style="padding:8px;">{{ trans('message.Description') }}</th>
            <th align="right" style="padding:8px; width: 20%;">{{ trans('message.Amount') }} (<?php echo getCurrencySymbols(); ?>)</th>
          </tr>

        </thead>

        <tbody>
          <tr>
            <td align="right" style="padding:8px;"><?php echo $vehicale->modelname;
                                                    echo ' :'; ?></td>
            <td align="right" style="padding:8px; font-size: 17px;"><b><?php $total_price = $sales->total_price;
                                                                        echo number_format($total_price, 2); ?></b></td>
          </tr>

          <?php
          if (!empty($rto)) { ?>
            <tr>
              <td align="right" style="padding:8px;">{{ trans('message.RTO / Registration / C.R. Temp Tax') }} :</td>
              <td align="right" style="padding:8px;  font-size: 17px;"><b><?php $rto_reg = $rto->registration_tax;
                                                                          echo number_format($rto_reg, 2); ?></b></td>
            </tr>
            <tr>
              <td align="right" style="padding:8px;">{{ trans('message.Number Plate Charges') }} :</td>
              <td align="right" style="padding:8px;  font-size: 17px;"><b><?php $rto_plate = $rto->number_plate_charge;
                                                                          echo number_format($rto_plate, 2); ?></b></td>
            </tr>
            <tr>
              <td align="right" style="padding:8px;">{{ trans('message.Muncipal Road Tax') }} :</td>
              <td align="right" style="padding:8px;  font-size: 17px;"><b><?php $rto_road = $rto->muncipal_road_tax;
                                                                          echo number_format($rto_road, 2); ?></b></td>
            </tr>
          <?php } ?>

          <tr>
            <?php if (!empty($rto)) {
              $rto_charges = $rto_reg + $rto_plate + $rto_road;
            } ?>
            <td align="right" style="padding:8px;">{{ trans('message.Total Amount') }} :</td>
            <?php if (!empty($rto)) { ?>
              <td align="right" style="padding:8px;  font-size: 17px;"><b><?php $total_amt = $total_price + $rto_charges;
                                                                          echo number_format($total_amt, 2); ?></b></td>
            <?php
            } else { ?>
              <td align="right" style="padding:8px;  font-size: 17px;"><b><?php $total_amt = $total_price;
                                                                          echo number_format($total_amt, 2); ?></b></td>
            <?php } ?>
          </tr>
          <tr>
            <td align="right" style="padding:8px;">{{ trans('message.Discount') }} (<?php echo $invioce->discount . '%'; ?>) : </td>
            <td align="right" style="padding:8px;  font-size: 17px;"><b><?php $discount = ($total_amt * $invioce->discount) / 100;
                                                                        echo number_format($discount, 2); ?></b></td>
          </tr>
          <tr>
            <td align="right" style="padding:8px;">{{ trans('message.Total') }} :</td>
            <td align="right" style="padding:8px;  font-size: 17px;"><b><?php $after_dis_total = $total_amt - $discount;
                                                                        echo number_format($after_dis_total, 2); ?></b></td>
          </tr>
          <?php

          if (!empty($taxes)) {
            $total_tax = 0;
            $taxes_amount = 0;
            $taxName = null;
            foreach ($taxes as $tax) {
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
                <td align="right" style="padding:8px;"><?php echo $taxName; ?> (%) :</td>
                <td align="right" style="padding:8px;  font-size: 17px;"><b><?php echo number_format($taxes_amount, 2); ?> </b></td>
              </tr>
          <?php  }
            $final_grand_total = $after_dis_total + $total_tax;
          } else {
            $final_grand_total = $after_dis_total;
          }
          ?>
          <?php
          $paid_amount = $invioce->paid_amount;
          $Adjustmentamount = $final_grand_total - $paid_amount; ?>
          <tr>
            <td align="right" style="padding:8px;">
              {{ trans('message.Adjustment Amount') }}({{trans('message.Paid Amount')}}) :
            </td>
            <td align="right" style="padding:8px;  font-size: 17px;"><b><?php $paid_amount;
                                                                        echo number_format($paid_amount, 2); ?></b></td>
          </tr>

          <tr>
            <td align="right" style="padding:8px;">
              {{ trans('message.Due Amount') }} :
            </td>
            <td align="right" style="padding:8px;  font-size: 17px;"><b><?php $Adjustmentamount;
                                                                        echo number_format($Adjustmentamount, 2); ?></b></td>
          </tr>

          <tr class="grand_total_modal_invoice">
            <td align="right" style="padding:8px;"><b>{{ trans('message.Grand Total') }} :</b></td>
            <td align="right" style="padding:8px;  font-size: 17px;"><b><?php $final_grand_total;
                                                                        echo number_format($final_grand_total, 2); ?></b></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>