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
    font-size: 14px;
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

  .phoneimg {
    width: 14px;
    height: 12px;
    /* margin-bottom: 2px; */
    margin-right: 1px;
  }

  .grand_total_modal_quotation {
    background: #DC3733;
    color: #FFFFFF;
    margin-left: 55%;
    margin-bottom: 0px;
  }

  .printimg {
    border-top-color: #FFFFFF;
  }

  .invoice_detail {
    line-height: 25px;
    font-size: 14px;
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

  .payment_details {
    line-height: 25px;
  }

  .system_addr_details {
    line-height: 25px;
    font-size: 14px;
  }

  .invoice_print {
    font-size: 14px;
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
    </table>
    <div id="imggrapish" class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" width="100%" border="0" style="border-collapse:collapse;">
        <thead></thead>
        <tfoot></tfoot>
        <tbody>
          <tr>
            <td colspan="3" align="left">
              <h3 style="font-size:18px;"><?php echo $logo->system_name; ?></h3>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <hr />
    <table>
      <tbody>
        <tr>
          <td style="vertical-align:top; float:left; width:15%;" align="left">
            <span style="float:left; width:100%; ">
              <img src="{{ base_path() }}/public/general_setting/<?php echo $logo->logo_image; ?>" width="230px" height="70px">
            </span>
          </td>
          <td style="width: 40%; vertical-align:top;" class="invoice_detail">
            <span style="float:right;">
              <b>{{ trans('message.Bill Number :') }}</b><?php echo $salespart->bill_no; ?>
              <br>
              <b>{{ trans('message.Invoice Number :') }}</b><?php echo $invioce->invoice_number ?>
              <br>
              <b>{{ trans('message.Date :') }}</b><?php echo date(getDateFormat(), strtotime($invioce->date)); ?>
              <br>
              <b>{{ trans('message.Status :') }}</b><?php if ($invioce->payment_status == 0) {
                                                      echo '<span style="color: rgb(255, 0, 0);">' .  trans('message.Unpaid') . '</span>';
                                                    } elseif ($invioce->payment_status == 1) {
                                                      echo '<span style="color: rgb(255, 165, 0);">' .  trans('message.Partially paid') . '</span>';
                                                    } elseif ($invioce->payment_status == 2) {
                                                      echo '<span style="color: rgb(0, 128, 0);">' .  trans('message.Full Paid') . '</span>';
                                                    } else {
                                                      echo '<span style="color: rgb(255, 0, 0);">' .  trans('message.Unpaid') . '</span>';
                                                    } ?>
              <br>
              <b>{{ trans('message.Sale Amount :') }} (<?php echo getCurrencySymbols(); ?>) </b> <?php echo number_format($invioce->grand_total, 2); ?>
            </span>
          </td>
        </tr>
        <tr>
          <td width="55%" style="vertical-align:center;float:left;">
            <span style="float:left;" class="system_addr_details">
              <img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class="mail_img">
              <?php
              echo ' ' . $logo->email;
              ?>
              <br>
              <img src="{{ URL::asset('public/img/icons/phoneimg1.png') }}" class="phoneimg">
              <?php
              echo ' ' . $logo->phone_number;
              ?>
              <br>
              <div class="col-12 d-flex align-items-start " style="margin: 2px;">
                <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}" class="addr_img">
                <?php
                //echo $logo->address ? ', <br>' : '';

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

                echo $logo->address . ' ';
                echo ' ' . getCityName($logo->city_id);
                echo ', ' . getStateName($logo->state_id);
                echo ', ' . getCountryName($logo->country_id);

                if ($taxName !== null && $taxNumber !== null) {
                  echo '<br> ' .  $taxName  . ': ' . $taxNumber;
                }
                ?>
            </span>
          </td>
        </tr>
      </tbody>
    </table>

    <hr />
    <table class="table table-bordered payment_details" width="100%" border="0" style="border-collapse:collapse; margin-top:0%;">
      <tbody>
        <tr>
          <td width="55%" align="left">
            <p style="font-size:20px;">{{ trans('message.Payment To,') }} </p>
          </td>
          <td valign="left" width="23%">
            <p style="font-size:20px;">{{ trans('message.Bill To,') }} </p>
          </td>
        </tr>
        <tr>
          <td valign="top" style="font-size: 14px;" width="55%" align="left">
            <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}" class="addr_img"> <?php echo getCustomerAddress($salespart->customer_id);
                                                                                              echo ',<br> '; ?><?php echo getCustomerCity($salespart->customer_id) != null ? getCustomerCity("$salespart->customer_id") . ', ' : ''; ?><?php echo getCustomerState("$salespart->customer_id,");
                                                                                                                                                                                                                                        echo ', ';
                                                                                                                                                                                                                                        echo getCustomerCountry($salespart->customer_id); ?>
          </td>
          <td align="top" style="font-size: 14px;" width="23%" align="left">
            <b><img src="{{ URL::asset('public/img/icons/user_img.png') }}" class="user_img"></b> <?php echo getCustomerName($salespart->customer_id); ?><br>
            <b><img src="{{ URL::asset('public/img/icons/phoneimg1.png') }}" class="phoneimg"></b> <?php echo getCustomerMobile($salespart->customer_id); ?> <br>
            <b><img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class=" mail_img"></b> <?php echo getCustomerEmail($salespart->customer_id); ?>
            <?php if (getCustomerTaxid($salespart->customer_id) !== null) { ?>
              <b>{{ trans('message.Tax Id') }} : </b><?php echo getCustomerTaxid($salespart->customer_id); ?><br>
            <?php } ?>
          </td>
        </tr>
      </tbody>
    </table>
    <hr />

    <!-- For Custom Field Customer Module (User table) -->
    @if (!empty($tbl_custom_fields_customers))
    @php $showTableHeading = false; @endphp
    @foreach ($tbl_custom_fields_customers as $tbl_custom_fields_customer)
    @php
    $tbl_custom = $tbl_custom_fields_customer->id;
    $userid = $salespart->customer_id;

    $datavalue = getCustomData($tbl_custom, $userid);
    @endphp

    @if ($tbl_custom_fields_customer->type == 'radio' && $datavalue != '')
    @php $showTableHeading = true; @endphp
    @elseif ($datavalue != null)
    @php $showTableHeading = true; @endphp
    @endif
    @endforeach

    @if ($showTableHeading)
    <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">

      <tr class="printimg" style="color:#333;">
        <th align="left" style="padding:8px; font-size:14px;" colspan="2">
          {{ trans('message.Customer Other Details') }}
        </th>
      </tr>

      @foreach ($tbl_custom_fields_customers as $tbl_custom_fields_customer)
      <?php
      $tbl_custom = $tbl_custom_fields_customer->id;
      $userid = $salespart->customer_id;

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
      @if ($datavalue != '')
      <tr>
        <th align="left" style="padding:8px;">
          {{ $tbl_custom_fields_customer->label }} :
        </th>
        <th align="left" style="padding:8px;">
          {{ $datavalue }}
          </td>
      </tr>
      @else
      <tr>
        <th align="left" style="padding:8px; width: 7%">
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
    @endif
    @endif
    <!-- For Custom Field End Customer Module (User table) -->
    <br>
    <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
      <thead>
        <tr class="printimg" style="color:#333;">
          <th align="left" style="padding:8px; font-size:14px;" colspan="5">
            {{ trans('message.Part Details') }}
          </th>
        </tr>

        <tr>
          <th align="left" style="padding:8px;">{{ trans('message.Manufacturer Name') }} </th>
          <th align="left" style="padding:8px;">{{ trans('message.Product Name') }}</th>
          <th align="left" style="padding:8px;">{{ trans('message.Quantity') }}</th>
          <th align="left" style="padding:8px;">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
          <th align="left" style="padding:8px;">{{ trans('message.Amount') }} (<?php echo getCurrencySymbols(); ?>)</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($saless as $d)
        <tr>
          <td align="left" style="padding:8px;">{{ getManufacturer($d->product_type_id) }}</td>
          <td align="left" style="padding:8px;">{{ getPart($d->product_id)->name }}</td>
          <td align="left" style="padding:8px;">{{ $d->quantity }}</td>
          <td align="left" style="padding:8px;">{{ $d->price }}</td>
          <td align="left" style="padding:8px;">{{ $d->total_price }}</td>
        </tr>
        @endforeach

      </tbody>
    </table>
    <br />

    <!-- For Custom Field -->
    @if (!empty($tbl_custom_fields_salepart))
    @php $showTableHeading = false; @endphp
    @foreach ($tbl_custom_fields_salepart as $tbl_custom_fields_saleparts)
    @php
    $tbl_custom = $tbl_custom_fields_saleparts->id;
    $userid = $salespart->id;

    $datavalue = getCustomDataSalepart($tbl_custom, $userid);
    @endphp

    @if ($tbl_custom_fields_saleparts->type == 'radio' && $datavalue != '')
    @php $showTableHeading = true; @endphp
    @elseif ($datavalue != null)
    @php $showTableHeading = true; @endphp
    @endif
    @endforeach

    @if ($showTableHeading)
    <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">

      <tr class="printimg" style="color:#333;">
        <th align="left" style="padding:8px; font-size:14px;" colspan="2">
          {{ trans('message.Other Information') }}
        </th>
      </tr>

      @foreach ($tbl_custom_fields_salepart as $tbl_custom_fields_saleparts)
      <?php
      $tbl_custom = $tbl_custom_fields_saleparts->id;
      $userid = $salespart->id;

      $datavalue = getCustomDataSalepart($tbl_custom, $userid);
      ?>

      @if ($tbl_custom_fields_saleparts->type == 'radio')
      @if ($datavalue != '')
      <?php
      $radio_selected_value = getRadioSelectedValue($tbl_custom_fields_saleparts->id, $datavalue);
      ?>
      <tr>
        <th align="left" style="padding:8px;">
          {{ $tbl_custom_fields_saleparts->label }} :
        </th>
        <td align="left" style="padding:8px;">
          {{ $radio_selected_value }}
        </td>
      </tr>
      @else
      <tr>
        <th align="left" style="padding:8px;">
          {{ $tbl_custom_fields_saleparts->label }} :
        </th>
        <td align="left" style="padding:8px;">
          {{ trans('message.Data not available') }}
        </td>
      </tr>
      @endif
      @else
      @if ($datavalue != '')
      <tr>
        <th align="left" style="padding:8px;">
          {{ $tbl_custom_fields_saleparts->label }} :
        </th>
        <td align="left" style="padding:8px;">
          {{ $datavalue }}
        </td>
      </tr>
      @else
      <tr>
        <th align="left" style="padding:8px;">
          {{ $tbl_custom_fields_saleparts->label }} :
        </th>
        <td align="leftleft" style="padding:8px;">
          {{ trans('message.Data not available') }}
        </td>
      </tr>
      @endif
      @endif
      @endforeach
    </table>
    <br />
    @endif
    @endif
    <!-- For Custom Field End -->

    <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
      <thead>
        <tr class="printimg">
          <th align="right" style="padding:8px; width: 85%;">{{ trans('message.Description') }}</th>
          <th align="right" style="padding:8px;">{{ trans('message.Amount') }} (<?php echo getCurrencySymbols(); ?>)</th>
        </tr>

      </thead>

      <tbody>

        <tr>
          <td align="right" style="padding:8px;">
            {{ trans('message.Total Amount') }} (<?php echo getCurrencySymbols(); ?>):
          </td>

          <td align="right" style="padding:8px; font-size: 17px;">
            <b><?php $total_amt = $salesps->total_price;
                echo number_format($salesps->total_price, 2); ?></b>
          </td>
        </tr>
        <tr>
          <td align="right" style="padding:8px;">{{ trans('message.Discount') }} (<?php echo $invioce->discount . '%'; ?>) : </td>
          <td align="right" style="padding:8px; font-size: 17px;"><b><?php $discount = ($total_amt * $invioce->discount) / 100;
                                                                      echo number_format($discount, 2); ?></b></td>
        </tr>
        <tr>
          <td align="right" style="padding:8px;">{{ trans('message.Total') }} (<?php echo getCurrencySymbols(); ?>):</td>
          <td align="right" style="padding:8px; font-size: 17px;"> <b><?php $after_dis_total = $total_amt - $discount;
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
              <td align="right" style="padding:8px; font-size: 17px;"> <b><?php echo number_format($taxes_amount, 2); ?> </b></td>
            </tr>
        <?php  }
          $final_grand_total = $after_dis_total + $total_tax;
        } else {
          $final_grand_total = $after_dis_total;
        }
        ?>

        <?php
        $paid_amount = $invioce->paid_amount;
        $Adjustmentamount = $final_grand_total - $paid_amount;
        ?>
        <tr>
          <td align="right" style="padding:8px;">{{ trans('message.Adjustment Amount')}}({{trans('message.Paid Amount')}}) (<?php echo getCurrencySymbols(); ?>) :</td>
          <td align="right" style="padding:8px;"><b><?php $paid_amount;
                                                    echo number_format($paid_amount, 2); ?></b></td>
        </tr>
        <tr>
          <td align="right" style="padding:8px;">{{ trans('message.Due Amount') }} ({{ getCurrencySymbols() }}) :</td>
          <td align="right" style="padding:8px;"><b><?php $Adjustmentamount;
                                                    echo number_format($Adjustmentamount, 2); ?></b></td>
        </tr>
        <tr class="grand_total_modal_quotation">
          <td align="right" style="padding:8px;">{{ trans('message.Grand Total') }} (<?php echo getCurrencySymbols(); ?>) :</td>
          <td align="right" style="padding:8px; font-size: 17px;"><b><?php $final_grand_total;
                                                                      echo number_format($final_grand_total, 2); ?></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  </div>
</body>

</html>