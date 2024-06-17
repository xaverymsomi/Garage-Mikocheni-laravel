<script language="javascript">
  function PrintElem(el) {

    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);

  }
</script>
<script src="{{ URL::asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>

</head>

<body>
  <div id="sales_print">
    <style>
      b,
      strong {
        font-weight: 500;
      }

      th {
        font-weight: 500;
      }
    </style>
     <div class="row">
        <div class="modal-header p-2">
            <h3><?php echo $logo->system_name; ?></h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
    </div>
    <table width="100%" border="0">
      <!-- <tbody>
        <tr>
          <td align="left">
            <?php $nowdate = date('Y-m-d'); ?>
            <strong>{{ trans('message.Date') }} : </strong><?php echo date(getDateFormat(), strtotime($nowdate)); ?>
          </td>
        </tr>
      </tbody> -->
    </table>
    <div class="row">
      <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
        <!-- <h3><?php echo $logo->system_name; ?></h3> -->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 printimg position-relative">
          <!-- <img src="../../public/vehicle/service.png" style="width: 243px; height: 90px;"> -->
          <img src="../../public/general_setting/<?php echo $logo->logo_image; ?>" class="system_logo_img">
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 mt-1 ms-0">
          <p class="mb-0">
          <img src="{{ URL::asset('public/img/icons/Vector (15).png') }}"  class="m-2">
            <?php 
                echo ' ' . $logo->email;
                echo '<br>&nbsp;&nbsp;<i class="fa fa-phone m-1" aria-hidden="true" class="mb-0"></i>&nbsp;&nbsp;&nbsp;' . $logo->phone_number;
            ?>
            <div class="col-12 d-flex align-items-start m-2">
            <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}" class="m-1">
              <div class="col system_address mx-2">
                <?php
                echo ' ' . $logo->address . ' ';
                echo ' ' . getCityName($logo->city_id);
                echo ', ' . getStateName($logo->state_id);
                echo ', ' . getCountryName($logo->country_id);
              
                ?>
             </div>
          </div>
          </p>
         
        </div>
      </div>
      <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 table-responsive">
        <table class="table" width="100%" style="border-collapse:collapse;">

          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
              <p class="fw-bold mb-0">Name:</p>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <p class="cname mb-0"> <?php echo getCustomerName($tbl_services->customer_id); ?> </p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
              <p class="fw-bold mb-0">Address:</p>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <p class="cname mb-0"> 
                <?php echo $customer->address;
                  echo ' ,';
                  echo getCityName("$customer->city_id"); ?><?php echo ','; ?><?php echo getStateName("$customer->state_id,");
                  echo ' ,';
                  echo getCountryName($customer->country_id); ?> 
              </p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
              <p class="fw-bold mb-0">Contact:</p>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <p class="cname mb-0"><?php echo "$customer->mobile_no"; ?></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
              <p class="fw-bold mb-0">Email:</p>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <p class="cname mb-0"><?php echo $customer->email; ?></p>
            </div>
          </div>

        </table>
      </div>
      <hr />
    
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

          <table class="table adddatatable free_service" width="100%" border="0" style="border-collapse:collapse;">
            <thead>
              <tr>
                <th class="cname text-left">{{ trans('message.Jobcard Number') }}</th>
                <th class="cname text-left">{{ trans('message.Coupon Number') }}</th>
                <th class="cname text-left">{{ trans('message.Vehicle Name') }}</th>
                <th class="cname text-left">{{ trans('message.Regi. No.') }}</th>
                <th class="cname text-left">{{ trans('message.In Date') }}</th>
                <th class="cname text-left">{{ trans('message.Out Date') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="cname text-left fw-bold"><?php echo "$tbl_services->job_no"; ?></td>
                <td class="cname text-left fw-bold"><?php if (!empty($job->coupan_no)) {
                                                echo $job->coupan_no;
                                              } else {
                                                echo 'Paid Service';
                                              } ?></td>
                <td class="cname text-left fw-bold"><?php 
                if (!empty($job)) {
                  echo getVehicleName(getVehicleName($job->vehicle_id));
                }
                ?></td>
                <td class="cname text-left fw-bold"><?php if (!empty($s_date)) {
                                                echo $s_date->registration_no;
                                              } else {
                                                echo $vehical->registration_no;
                                              } ?> </td>
                <td class="cname text-left fw-bold"><?php if (!empty($job)) {
                                                echo date(getDateFormat(), strtotime($job->in_date));
                                              } ?> </td>
                <td class="cname text-left fw-bold"><?php if (!empty($job)) {
                                                echo date(getDateFormat(), strtotime($job->out_date));
                                              } ?> </td>
              </tr>
            </tbody>
          </table>
          <table class="table adddatatable paid_service" width="100%" border="0" style="border-collapse:collapse;">
            <thead>
              <tr>

                <th class="cname text-left">{{ trans('message.Assigned To') }}</th>
                <th class="cname text-left">{{ trans('message.Repair Category') }}</th>
                <th class="cname text-left">{{ trans('message.Service Type') }}</th>
                <th class="cname text-left" style="width: 265px;">{{ trans('message.Details') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="cname text-left fw-bold"><?php echo getAssignedName($tbl_services->assign_to); ?> </td>
                <td class="cname text-left fw-bold"><?php echo $tbl_services->service_category; ?> </td>
                <td class="cname text-left fw-bold"><?php echo $tbl_services->service_type; ?> </td>
                <td class="cname text-left fw-bold" style="width: 265px;"><?php echo $tbl_services->detail; ?> </td>
              </tr>
            </tbody>
          </table>
          <hr>

          <?php
              $total1 = 0;
              $i = 1;
              if (!empty($service_pro)) {
                foreach ($service_pro as $service_pros) { ?>
          <table class="table table-bordered" width="100%" border="0" style="border-collapse:collapse;">
            <tr class="printimg">
              <td class="cname fw-bold">{{ trans('message.Service Charges') }}</td>
            </tr>
          </table>
          <table class="table table-bordered adddatatable" width="100%" border="1" style="border-collapse:collapse;">
            <thead>
              <tr>
                <th class="text-left">#</th>
                <th class="text-left">{{ trans('message.Category') }}</th>
                <th class="text-left">{{ trans('message.Observation Point') }}</th>
                <th class="text-left">{{ trans('message.Product Name') }}</th>
                <th class="text-left">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                <th class="text-left">{{ trans('message.Quantity') }} </th>
                <th class="text-left">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>) </th>
              </tr>
            </thead>
            <tbody>
             
                  <tr>
                    <td class="text-left cname fw-bold"><?php echo $i++; ?></td>
                    <td class="text-left cname fw-bold"> <?php echo $service_pros->category; ?></td>
                    <td class="text-left cname fw-bold"> <?php echo $service_pros->obs_point; ?></td>
                    <td class="text-left cname fw-bold"> <?php echo getProduct($service_pros->product_id); ?></td>
                    <td class="text-left cname fw-bold"> <?php echo number_format($service_pros->price, 2); ?></td>
                    <td class="text-left cname fw-bold"><?php echo $service_pros->quantity; ?></td>
                    <td class="text-left cname fw-bold"><?php echo number_format($service_pros->total_price, 2); ?></td>
                    <?php $total1 += $service_pros->total_price; ?>
                  </tr>

                <?php }
              } else {
                ?>
                <!-- <tr>
                  <td class="cname text-center" colspan="7">
                    {{ trans('message.No data available in table.') }}
                  </td>
                </tr> -->
              
            </tbody>
          </table>
          <?php }
          ?>

          <?php
              $total2 = 0;
              $i = 1;
              if (!empty($service_pro2)) {
                foreach ($service_pro2 as $service_pros) { 
          ?>
          <table class="table table-bordered" width="100%" border="0" style="border-collapse:collapse;">
            <tr class="printimg">
              <td class="cname fw-bold">{{ trans('message.Other Service Charges') }}</td>
            </tr>
          </table>

          <table class="table table-bordered adddatatable" width="100%" border="1" style="border-collapse:collapse;">
            <thead>
              <tr>
                <th class="text-left">#</th>
                <th class="text-left">{{ trans('message.Charge for') }}</th>
                <th class="text-left">{{ trans('message.Product Name') }}</th>
                <th class="text-left">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                <th class="text-left">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>) </th>
              </tr>
            </thead>
            <tbody>
              
                  <tr>
                    <td class="text-left cname fw-bold"><?php echo $i++; ?></td>
                    <td class="text-left cname fw-bold">{{ trans('message.Other Charges') }}</td>
                    <td class="text-left cname fw-bold"><?php echo $service_pros->comment; ?></td>
                    <td class="text-left cname fw-bold"><?php echo number_format((float) $service_pros->total_price, 2); ?></td>
                    <td class="text-left cname fw-bold"><?php echo number_format((float) $service_pros->total_price, 2); ?></td>
                    <?php $total2 += $service_pros->total_price; ?>
                  </tr>
                <?php }
              } else {
                ?>
                <!-- <tr>
                  <td class="cname text-center" colspan="5">
                    {{ trans('message.No data available in table.') }}
                  </td>
                </tr> -->
              
            </tbody>
          </table>
          <?php
              }
          ?>

          <table class="table table-bordered" width="100%" style="border-collapse:collapse;">
            <tr>
              <td class="text-end cname" style="width: 75%;">{{ trans('message.Fix Service Charge') }}</td>
              <td class="text-left cname fw-bold gst"><?php $fix = $tbl_services->charge;
                                            if (!empty($fix)) {
                                              echo number_format($fix, 2);
                                            } else {
                                              echo 'Free Service';
                                            } ?></td>
            </tr>
            <tr>
              <td class="text-end cname">{{ trans('message.Total Service Amount') }} (<?php echo getCurrencySymbols(); ?>) :</td>
              <td class="text-left cname fw-bold gst"><?php $total_amt = $total1 + $total2 + $fix;
                                                echo number_format($total_amt, 2); ?></td>
            </tr>

            <?php if ($discount !== null) {
            ?>
              <tr>
                <td class="text-end cname"><b>{{ trans('message.Discount') }} (<?php echo $dis = $service_tax->discount . '%'; ?>):</b></td>
                <td class="text-left cname fw-bold gst"><?php $dis = $service_tax->discount;
                                                  $discount = ($total_amt * $dis) / 100;
                                                  echo number_format($discount, 2); ?></td>
              </tr>
            <?php
            } ?>

            <tr>
              <td class="text-end cname">{{ trans('message.Total') }} (<?php echo getCurrencySymbols(); ?>) :</td>
              <td class="text-left cname fw-bold gst"><?php $discount == null  ? $after_dis_total = $total_amt : $after_dis_total = $total_amt - $discount;
                                                echo number_format($after_dis_total, 2); ?></td>
            </tr>

            <?php
            if (!empty($service_taxes)) {
              $all_taxes = 0;
              $total_tax = 0;
              foreach ($service_taxes as $ser_tax) {
                $taxes_to_count = preg_replace("/[^0-9,.]/", "", $ser_tax);

                $all_taxes = ($after_dis_total * $taxes_to_count) / 100;

                $total_tax +=  $all_taxes;

            ?>
                <tr>
                  <td class="text-end cname"><?php echo $ser_tax; ?> :</td>
                  <td class="text-left cname fw-bold gst"><?php $all_taxes;
                                                                  echo number_format($all_taxes, 2); ?></td>
                </tr>
            <?php
              }
              $final_grand_total = $after_dis_total + $total_tax;
            } else {
              $final_grand_total = $after_dis_total;
            }
            ?>

            <!-- <tr>
              <td class="text-end cname">{{ trans('message.Grand Total') }} (<?php echo getCurrencySymbols(); ?>) :</td>
              <td class="text-left cname fw-bold gst"><?php $final_grand_total;
                                                echo number_format($final_grand_total, 2); ?></td>
            </tr> -->

            <tr> 
              <td class="text-right cname" colspan="2">
                <div class="row col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 grand_total_modal_quotation pt-2">
                  <div class="row col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 text-end pt-1">
                    {{ trans('message.Grand Total') }}( <?php echo getCurrencySymbols(); ?> ) :
                    </div>
                    <div class="row col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                      <label class="total_amount pt-1"><?php $final_grand_total;
                      echo number_format($final_grand_total, 2); ?></label>
                    </div>
                  </div>
                </td>
            </tr>

          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary printbtn btn-sm" id="" onclick="PrintElem('sales_print')">{{ trans('message.Print') }} </button>
    <button type="button" class="btn btn-outline-secondary prints btn-sm" data-bs-dismiss="modal">{{ trans('message.Close') }}</button>
  </div> -->

  
  <div class="row modalfooterline">
        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 modal-footer mpPrintPdfCloseButtonForSmallDevices">
            <button type="button" class="btn printbtn" id="" onclick="PrintElem('sales_print')"
                value="{{ trans('message.Print') }}"><img src="{{ URL('public/img/icons/Print (1).png') }}" class="pdfButton"></button>

            <a href="" class="prints tagAforCloseBtn"><button type="button" class="btn btn-outline-secondary closeButton mx-0" data-bs-dismiss="modal">Close</button></a>
        </div>
    </div>