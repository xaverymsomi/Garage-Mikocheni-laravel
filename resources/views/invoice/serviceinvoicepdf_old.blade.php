<html dir="{{ getLangCode() === 'ar' ? 'rtl' : '' }}">

<head>
  <meta http-equiv="Content-Type"
    content="text/html; charset=utf-8" />
  <style type="text/css">
    @if (getLangCode() === 'hi')body,
    p,
    td,
    div,
    th {
      font-family: freeserif;
    }

  @elseif (getLangCode() === 'gu') body,
    p,
    td,
    div,
    th {
      font-family: freeserif;
    }

  @elseif (getLangCode() === 'ja') body,
    p,
    td,
    div,
    th {
      font-family: freeserif;
    }

  @elseif (getLangCode() === 'zhcn') body,
    p,
    td,
    div,
    th {
      font-family: DejaVu Sans, freeserif; // not working
    }

  @elseif (getLangCode() === 'th') body,
    p,
    td,
    div,
    th,
    strong {
      font-family: bitstreamcyberbit, freeserif, garuda, norasi, quivira;
    }

  @elseif (getLangCode() === 'mr') body,
    p,
    td,
    div,
    th {
      font-family: freeserif;
    }

  @elseif (getLangCode() === 'ta') body,
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
    font-size: 12px;
  }

  #imggrapish {
    margin-top: -50px;
    margin-left: 25px;
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
  <div class="row "
    id="invoice_print">
    <table width="100%"
      border="0"
      style="margin:0px 8px 0px 8px;">
      <tr>
        <td align="center"
          style="font-size:18px;">INVOICE # {{ $tbl_invoices->invoice_number }}</td>
      </tr>
    </table>

    <div id="imggrapish"
      class="col-md-12 col-sm-12 col-xs-12">
      <table width="100%"
        border="0">
        <thead></thead>
        <tfoot></tfoot>
        <tbody>
          <tr>
            <td align="right">
              <?php $nowdate = date('Y-m-d'); ?>
              <strong>{{ trans('message.Date') }} : </strong><?php echo date(getDateFormat(), strtotime($nowdate)); ?>
            </td>
          </tr>
        </tbody>
      </table>
      <br />

      <table width="100%"
        border="0">
        <thead></thead>
        <tfoot></tfoot>
        <tbody>
          <tr>
            <td colspan="3"
              align="center">
              <h3 style="font-size:18px;"><?php echo $logo->system_name; ?></h3>
            </td>
          </tr>
          <tr>
            <td width="15%"
              style="vertical-align:top;float:left; width:15%;"
              align="left">
              <span style="float:left; width:100%;">
                <img src="{{ base_path() }}/public/general_setting/<?php echo $logo->logo_image; ?>"
                  width="230px"
                  height="70px">
              </span>
            </td>
            <td width="30%"
              style="vertical-align:top;float:left;">
              <span style="float:left;">
                <?php
                
                $taxNumber = $taxName = null;
                
                if (!empty($service_tax->tax_name)) {
                    $serviceTaxName = $service_tax->tax_name;
                    if (substr_count($serviceTaxName, ' ') > 1) {
                        $taxNumberArray = explode(' ', $serviceTaxName);
                        $taxNumber = $taxNumberArray[2];
                        $taxName = $taxNumberArray[0];
                    }
                }
                
                //echo $logo->address ? ', <br>' : '';
                echo $logo->address . ' ';
                echo '<br>' . getCityName($logo->city_id);
                echo ', ' . getStateName($logo->state_id);
                echo ', ' . getCountryName($logo->country_id);
                echo '<br>' . $logo->email;
                echo '<br>' . $logo->phone_number;
                if ($taxName !== null && $taxNumber !== null) {
                    echo '<br> ' . $taxName . ':- ' . $taxNumber;
                }
                
                ?>
              </span>
            </td>
            <td valign="top"
              style="valign:top;float:left; width:50%;"
              width="50%">
              <b>{{ trans('message.Name:') }}</b> <?php echo getCustomerName($tbl_invoices->customer_id);
              echo '<hr/>'; ?>
              <b>{{ trans('message.Address:') }}</b> <?php echo $customer->address;
              echo ', ';
              echo getCityName("$customer->city_id") != null ? getCityName("$customer->city_id") . ', ' : ''; ?><?php echo getStateName("$customer->state_id,");
              echo ', ';
              echo getCountryName($customer->country_id);
              echo '<hr/>'; ?>
              <b>{{ trans('message.Contact:') }}</b> <?php echo "$customer->mobile_no";
              echo '<hr/>'; ?>
              <b>{{ trans('message.Email :') }}</b> <?php echo $customer->email;
              echo '<hr/>'; ?>
              <b>{{ trans('message.Date') }} :</b> <?php echo date(getDateFormat(), strtotime($tbl_invoices->date));
              echo '<hr/>'; ?>
            </td>
          </tr>
        </tbody>
      </table>

      <br />
      <hr />
      <table class="table table-bordered"
        border="1"
        width="100%"
        style="border-collapse:collapse;">
        <thead></thead>
        <tfoot></tfoot>
        <tbody class="itemtable">
          <tr>
            <th align="center"
              style="padding:8px;">{{ trans('message.Jobcard Number') }}</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Coupon Number') }}</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Vehicle Name') }}</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Number Plate') }}</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.In Date') }}</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Out Date') }}</th>
          </tr>

          <tr>
            <td align="center"
              style="padding:8px;"><?php echo "$tbl_invoices->job_no"; ?></td>
            <td align="center"
              style="padding:8px;"><?php if (!empty($job->coupan_no)) {
                  echo $job->coupan_no;
              } else {
                  echo trans('message.Paid Service');
              } ?></td>
            <td align="center"
              style="padding:8px;"><?php if (!empty($job->vehicle_id)) {
                                    echo getVehicleName($job->vehicle_id);
                                } ?></td>
            <td align="center"
              style="padding:8px;"><?php if (!empty($job->vehicle_id)) {
                                    echo getVehicleNumberPlate($job->vehicle_id);
                                } ?></td>
            <td align="center"
              style="padding:8px;"><?php if (!empty($job)) {
                  echo date(getDateFormat(), strtotime($job->in_date));
              } ?> </td>
            <td align="center"
              style="padding:8px;"><?php if (!empty($job)) {
                  echo date(getDateFormat(), strtotime($job->out_date));
              } ?> </td>
          </tr>
          <tr>
            <th align="center"
              style="padding:8px;">{{ trans('message.Assigned To') }}</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Repair Category') }}</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Service Type') }}</th>
            <th align="center"
              style="padding:8px;"
              colspan="3">{{ trans('message.Details') }}</th>
          </tr>
          <tr>
            <td align="center"
              style="padding:8px;"><?php echo getAssignedName($tbl_invoices->assign_to); ?> </td>
            <td align="center"
              style="padding:8px;"><?php echo $tbl_invoices->service_category; ?> </td>
            <td align="center"
              /* style="padding:8px;"><?php echo $tbl_invoices->service_type; ?> </td> */
            <td align="center"
              style="padding:8px;"
              colspan="3"><?php echo $tbl_invoices->detail; ?> </td>
          </tr>
        </tbody>
      </table>


      <!-- Custom Field Of Customer Module (User table)-->
      @if (!empty($tbl_custom_fields_customers))
        <br />
        <table class="table table-bordered itemtable"
          width="100%"
          border="1"
          style="border-collapse:collapse;">
          <tr class="printimg"
            style="background-color:#4E5E6A; color:#fff; border-right: 0px;border-left: 0px;">
            <th align="center"
              style="padding:8px; font-size:14px; border-right: 0px;border-left: 0px;"
              colspan="2">
              {{ trans('message.CUSTOMER OTHER DETAILS') }}
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
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_customer->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ $radio_selected_value }}</td>
                </tr>
              @else
                <tr>
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_customer->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ trans('message.Data not available') }}</td>
                </tr>
              @endif
            @else
              @if ($datavalue != null)
                <tr>
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_customer->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ $datavalue }}</td>
                </tr>
              @else
                <tr>
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_customer->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ trans('message.Data not available') }}</td>
                </tr>
              @endif
            @endif
          @endforeach
        </table>
      @endif
      <!-- Custom Field Invoice Customer Module (User table)-->


      <br />
      <table class="table table-bordered itemtable"
        width="100%"
        border="1"
        style="border-collapse:collapse;">
        <thead></thead>
        <tfoot></tfoot>
        <tbody>
          <tr class="printimg"
            style=" color:#333; border-right: 0px;border-left: 0px;">
            <th align="center"
              style="padding:8px; font-size:14px; border-right: 0px;border-left: 0px;"
              colspan="7">{{ trans('message.SERVICE CHARGES') }}</th>
          </tr>
          <tr>
            <th align="center"
              style="padding:8px;">#</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Category') }}</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Observation Point') }}</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Product Name') }}</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Price') }} (<?php echo getCurrencyCode(); ?>)</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Quantity') }} </th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Total Price') }} (<?php echo getCurrencyCode(); ?>) </th>
          </tr>
          <?php 
					   		$total1=0;
					   		$i = 1 ;
					   		foreach($service_pro as $service_pros)
					   	{ ?>
          <tr>
            <td align="center"
              style="padding:8px;"><?php echo $i++; ?></td>
            <td align="center"
              style="padding:8px;"> <?php echo $service_pros->category; ?></td>
            <td align="center"
              style="padding:8px;"> <?php echo $service_pros->obs_point; ?></td>
            <td align="center"
              style="padding:8px;"> <?php echo getProduct($service_pros->product_id); ?></td>
            <td align="center"
              style="padding:8px;"> <?php echo number_format($service_pros->price, 2); ?></td>
            <td align="center"
              style="padding:8px;"><?php echo $service_pros->quantity; ?></td>
            <td align="right"
              style="padding:8px;"><?php echo number_format($service_pros->total_price, 2); ?></td>
            <?php $total1 += $service_pros->total_price; ?>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <br />
      <table class="table table-bordered itemtable"
        width="100%"
        border="1"
        style="border-collapse:collapse;">
        <tbody>
          <tr style="color:#333; border-right: 0px;border-left: 0px;">
            <th align="center"
              style="font-size:14px;padding:8px;border-left: 0px; border-right: 0px;"
              colspan="7">{{ trans('message.OTHER SERVICE CHARGES') }}</th>
          </tr>
          <tr>
            <th align="center"
              style="padding:8px;">#</th>
            <th align="center"
              style="padding:8px;"
              colspan="2">{{ trans('message.Charge for') }}</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Product Name') }}</th>
            <th align="center"
              style="padding:8px;"
              colspan="2">{{ trans('message.Price') }} (<?php echo getCurrencyCode(); ?>)</th>
            <th align="center"
              style="padding:8px;">{{ trans('message.Total Price') }} (<?php echo getCurrencyCode(); ?>) </th>
          </tr>
          <?php 
						   $total2=0;
						   $i = 1 ;
						   foreach($service_pro2 as $service_pros)
						   { ?>
          <tr>
            <td align="center"
              style="padding:8px;"><?php echo $i++; ?></td>
            <td align="center"
              style="padding:8px;"
              colspan="2">{{ trans('message.Other Charges') }}</td>
            <td align="center"
              style="padding:8px;"><?php echo $service_pros->comment; ?></td>
            <td align="center"
              style="padding:8px;"
              colspan="2"><?php echo number_format((float) $service_pros->total_price, 2); ?></td>
            <td align="right"
              style="padding:8px;"><?php echo number_format((float) $service_pros->total_price, 2); ?></td>
            <?php $total2 += $service_pros->total_price; ?>
          </tr>
          <?php } ?>

          <tr>
            <td align="center"
              style="padding:8px;"
              colspan="6"><b>{{ trans('message.Fix Service Charge') }}<b></td>
            <td align="right"
              style="padding:8px;"><?php $fix = $tbl_invoices->charge;
              if (!empty($fix)) {
                  echo number_format($fix, 2);
              } else {
                  echo 'Free Service';
              } ?></td>
          </tr>
        </tbody>
      </table>


      <!-- MOT Testing Part Invoice -->
      <?php  
	                  	$mot_status = $tbl_invoices->mot_status;
	                  	$total3=0;
	                           
	                  	if ($mot_status == 1) 
	                  	{                  
	               ?>
      <br />
      <table class="table table-bordered itemtable"
        width="100%"
        border="1"
        style="border-collapse:collapse;">
        <tr style="color:#333; border-right: 0px;border-left: 0px;">
          <th align="center"
            style="font-size:14px;padding:8px;border-left: 0px; border-right: 0px;"
            colspan="7">{{ trans('message.MOT TEST SERVICE CHARGE') }}</th>
        </tr>
        <tr>
          <th align="center"
            style="padding:8px;">#</th>
          <th align="center"
            style="padding:8px;"
            colspan="2">{{ trans('message.MOT Charge Detail') }}</th>
          <th align="center"
            style="padding:8px;">{{ trans('message.MOT Test') }}</th>
          <th align="center"
            style="padding:8px;"
            colspan="2">{{ trans('message.Price') }} (<?php echo getCurrencyCode(); ?>)</th>
          <th align="center"
            style="padding:8px;">{{ trans('message.Total Price') }} (<?php echo getCurrencyCode(); ?>)</th>
        </tr>
        <?php $total3 = 0; ?>
        <tr>
          <td align="center"
            style="padding:8px;">1</td>
          <td align="center"
            style="padding:8px;"
            colspan="2">{{ trans('message.MOT Testing Charges') }}</td>
          <td align="center"
            style="padding:8px;">{{ trans('message.Completed') }}</td>
          <td align="center"
            style="padding:8px;"
            colspan="2"><?php echo number_format((float) 0, 2); ?></td>
          <td align="right"
            style="padding:8px;"><?php echo number_format((float) 0, 2); ?></td>
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
                           
                  	if ($washbay_data != null)
                  	{
               ?>
      <br />
      <table class="table table-bordered itemtable"
        width="100%"
        border="1"
        style="border-collapse:collapse;">
        <tr style="color:#333; border-right: 0px;border-left: 0px;">
          <th align="center"
            style="font-size:14px;padding:8px;border-left: 0px; border-right: 0px;"
            colspan="7">{{ trans('message.WASH BAY SERVICE CHARGE') }}</th>
        </tr>
        <tr>
          <th align="center"
            style="padding:8px;">#</th>
          <th align="center"
            style="padding:8px;"
            colspan="4">{{ trans('message.Charge for') }}</th>
          <th align="center"
            style="padding:8px;">{{ trans('message.Price') }} (<?php echo getCurrencyCode(); ?>)</th>
          <th align="center"
            style="padding:8px;">{{ trans('message.Total Price') }} (<?php echo getCurrencyCode(); ?>) </th>
        </tr>

        <tr>
          <td align="center"
            style="padding:8px;">1</td>
          <td align="center"
            style="padding:8px;"
            colspan="4">{{ trans('message.Wash Bay Service') }}</td>
          <td align="center"
            style="padding:8px;"><?php echo number_format((float) $washbay_data->price, 2); ?></td>
          <td align="right"
            style="padding:8px;"><?php echo number_format((float) $washbay_data->price, 2); ?></td>
          <?php $total4 += $washbay_data->price; ?>
        </tr>
      </table>
      <?php
					}
				?>
      <!-- Washbay Service Charge Details End -->


      <!-- Custom Field Of Invoice Module-->
      @if (!empty($tbl_custom_fields_invoice))
        <br />
        <table class="table table-bordered itemtable"
          width="100%"
          border="1"
          style="border-collapse:collapse;">
          <tr class="printimg"
            style="color:#333; border-right: 0px;border-left: 0px;">
            <th align="center"
              style="padding:8px; font-size:14px; border-right: 0px;border-left: 0px;"
              colspan="2">
              {{ trans('message.OTHER INFORMATION OF INVOICE') }}
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
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_invoices->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ $radio_selected_value }}</td>
                </tr>
              @else
                <tr>
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_invoices->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ trans('message.Data not available') }}</td>
                </tr>
              @endif
            @else
              @if ($datavalue != null)
                <tr>
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_invoices->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ $datavalue }}</td>
                </tr>
              @else
                <tr>
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_invoices->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ trans('message.Data not available') }}</td>
                </tr>
              @endif
            @endif
          @endforeach
        </table>
        <br />
      @endif
      <!-- Custom Field Invoice Module End -->

      <!-- For Custom Field Of Service Module-->
      @if (!empty($tbl_custom_fields_service))
        <br />
        <table class="table table-bordered itemtable"
          width="100%"
          border="1"
          style="border-collapse:collapse;">
          <tr class="printimg"
            style=" color:#333; border-right: 0px;border-left: 0px;">
            <th align="center"
              style="padding:8px; font-size:14px; border-right: 0px;border-left: 0px;"
              colspan="2">
              {{ trans('message.OTHER INFORMATION OF SERVICE') }}
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
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_services->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ $radio_selected_value }}</td>
                </tr>
              @else
                <tr>
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_services->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ trans('message.Data not available') }}</td>
                </tr>
              @endif
            @else
              @if ($datavalue != null)
                <tr>
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_services->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ $datavalue }}</td>
                </tr>
              @else
                <tr>
                  <th align="center"
                    style="padding:8px;">
                    {{ $tbl_custom_fields_services->label }} :
                  </th>
                  <td align="center"
                    style="padding:8px;">{{ trans('message.Data not available') }}</td>
                </tr>
              @endif
            @endif
          @endforeach
        </table>
      @endif
      <!-- For Custom Field Service Module End -->

      <br />
      <table class="table table-bordered itemtable"
        width="100%"
        border="1"
        style="border-collapse:collapse;">
        <thead></thead>
        <tfoot></tfoot>
        <tbody>
          <tr>
            <td align="right"
              style="padding:8px;"
              width="80%">{{ trans('message.Total Service Amount') }} (<?php echo getCurrencyCode(); ?>) :</td>
            <td align="right"
              style="padding:8px;"><b><?php $total_amt = $total1 + $total2 + $total3 + $total4 + $fix;
              echo number_format($total_amt, 2); ?></b></td>
          </tr>
          <tr>
            <td align="right"
              style="padding:8px;"
              width="80%">{{ trans('message.Discount') }} (<?php echo $dis = $tbl_invoices->discount . '%'; ?>) :</td>
            <td align="right"
              style="padding:8px;"><b><?php $dis = $tbl_invoices->discount;
              $discount = ($total_amt * $dis) / 100;
              echo number_format($discount, 2); ?></b></td>
          </tr>
          <tr>
            <td align="right"
              style="padding:8px;"
              width="80%">{{ trans('message.Total') }} (<?php echo getCurrencyCode(); ?>) :</td>
            <td align="right"
              style="padding:8px;"><b><?php $after_dis_total = $total_amt - $discount;
              echo number_format($after_dis_total, 2); ?></b></td>
          </tr>
          <?php 
						   	$all_taxes = 0;
						   	$total_tax = 0;
                 $taxName = NULL;
						   	if(!empty($service_taxes))
						   	{
								foreach($service_taxes as $ser_tax)
								{ 
									// $taxes_to_count = preg_replace("/[^0-9,.]/", "", $ser_tax);
									// $taxes_to_count = preg_replace("/[^0-9,.]/", "", $ser_tax);
                  $taxes_to_count = explode(" ", $ser_tax);
							
									/* $all_taxes = ($after_dis_total*$taxes_to_count[1])/100;   */
								
									$total_tax +=  $all_taxes;			
                  
                  if (substr_count($ser_tax, ' ') > 1) {
                    $taxNumberArray = explode(" ", $ser_tax);
                  
                    $taxName = $taxNumberArray[0] ." ". $taxNumberArray[1];
                  } else {
                    $taxName = $ser_tax;
                  }
						?>
          <tr>
            <td align="right"
              style="padding:8px;"
              width="80%"><b><?php echo $taxName; ?> (%) :</b></td>
            <td align="right"
              style="padding:8px;"><b><?php $all_taxes;
              echo number_format($all_taxes, 2); ?></b></td>
          </tr>
          <?php 
						   	}
						   		$final_grand_total = $after_dis_total+$total_tax;
						   	}
						   	else
						   	{
						   		$final_grand_total = $after_dis_total;
						   	}
						?>
          <tr>
            <td align="right"
              style="padding:8px;"
              width="80%">{{ trans('message.Grand Total') }} (<?php echo getCurrencyCode(); ?>) :</td>
            <td align="right"
              style="padding:8px;"><b><?php $final_grand_total;
              echo number_format($final_grand_total, 2); ?></b></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
