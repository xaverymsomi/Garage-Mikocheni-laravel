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
      <table width="100%" border="0" class="table table-bordered adddatatable mx-0">
                            <thead>
                                <tr>
                                    <th colspan="14" class="text-center">APPRAISAL SHEET</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">INSURER:</td>

                                    <td colspan="4">{{ $tbl_services->insurer_name }}</td>
                                    <td colspan="2">REF NO.</td>
                                    <td colspan="5">{{ getQuotationNumber($tbl_services->job_no) }}</td>

                                </tr>
                                <tr>
                                    <td colspan="2">CLAIMANT</td>
                                    <td colspan="4">{{ getCustomerName($tbl_services->customer_id) }}</td>
                                    
                                    <td colspan="2">BROKER</td>

                                    <td colspan="5">{{ $tbl_services->broker_name }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">CLAIM NO.</td>
                                    <td colspan="4">{{ $tbl_services->claim_no }}</td>

                                    <td colspan="2">DATE</td>
                                    <td colspan="2"><?php echo date(getDateFormat(), strtotime($tbl_services->service_date))?></td>
                                    
                                </tr>
                            </tbody>
                        </table>

      <hr />
    
        <table border="0" width="100%" style="border-collapse:collapse;" class="table table-bordered table-responsive adddatatable quotationDetail mb-0" width="100%">
                                <span class="border-0">
                                    <thead>
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
                                            
                                            <td colspan="2">
                                              {{ getColorName($Vehicle_inf->color) }}
                                            </td>
                                            <td colspan="2">{{ $Vehicle_inf->engineno }}</td>
                                        </tr>
                                    </tbody>
                                </span>
                            </table>
      <hr />
      <br />
      <?php
      $i = 1;
                    $total12 = 0;
                ?>
                <table class="table itemtable" width="100%" border="1" style="border-collapse:collapse; border-top: #FFFFFF; ">
        <tbody>

          <tr>
            <th>SN</th>
                            <th>DESCRIPTION OF PARTS &amp; REPLACEMENT</th>
                            
                            <th>QTY</th>
                            <th>HOURS</th>
                            <th>{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                            <th>{{ trans('message.Total Price') }}
                                (<?php echo getCurrencySymbols(); ?>)
                            </th>
                        </tr>
          <?php
          
                            foreach ($all_data3 as $ser_proc2) {
                        ?><tr>
                          <td align="text-left" style="padding:8px;"><?php echo $i++; ?></td>
                          <td align="text-left" style="padding:8px;"><?php echo getProduct($ser_proc2->product_id); ?></td>
                                    
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
                                        $total12 += $ser_proc2->total_price;
                                    } ?>
                                </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php
      $total1 = 0;
      $i = 1;
      ?>
    

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
              {{ trans('TOTAL APPRAISAL') }} (<?php echo getCurrencySymbols(); ?>)
            </td>
            <td align="right" style="padding:8px;  width: 20%; font-size: 17px;"><b><?php $fix = $tbl_services->charge;
                                                                                    if (!empty($fix)) {
                                                                                      echo number_format($fix, 2);
                                                                                    } else {
                                                                                      echo 'Free Service';
                                                                                    } ?></b></td>
          </tr>

          <tr>
            <td align="right" style="padding:8px;" width: "85%">{{ trans('Total  Amount') }} (<?php echo getCurrencySymbols(); ?>) :</td>
            <td align="right" style="padding:8px; width: 20%; font-size: 17px;"><b><?php $total_amt = $total1 + $total3 + $total4 + $fix;
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