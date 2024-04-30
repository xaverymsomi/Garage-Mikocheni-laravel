<script language="javascript">
  function printdiv(el) {
    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
  }
</script>
<style>
  .grand_total_freeservice {
    float: right;
  }
</style>

<div id="div_print">

  {{-- <table width="100%"
    border="0">
    <tbody>
      <tr>
        <td align="left">
          <?php $nowdate = date('Y-m-d'); ?>
          {{ trans('message.Date') }} :<?php echo date(getDateFormat(), strtotime($nowdate)); ?> </td>
  </tr>
  </tbody>
  </table> --}}
  <table border="0" class="adddatatable mt-2">
    <tbody>
      <tr>
        <td width="60%">
          <!-- <span style="float:left;"> -->
          <!-- <h4>{{ $logo->system_name }}</h4> -->
          <img src="..//public/general_setting/<?php echo $logo->logo_image; ?>" class="system_logo_img mt-3">


          <!-- </span> -->
        </td>
        <td width="30%" class="small-font">
          <div class="col-xl-12 col-md-12 col-sm-12 mt-4 mb-3">
            <label class="fw-bold">{{ trans('message.Purchase Number :') }} </label>
            <label class=""> <?php echo $purchas->purchase_no; ?> </label>
          </div>
          <div class="col-xl-12 col-md-12 col-sm-12 mt-2 mb-3">
            <label class="fw-bold">{{ trans('message.Date :') }} </label>
            <label class=""> <?php echo date(getDateFormat(), strtotime($purchas->date)); ?> </label>
          </div>
          <div class="col-xl-12 col-md-12 col-sm-12 mt-2 mb-3">
            <label class="fw-bold">{{ trans('message.Name :') }} </label>
            <label class=""><?php echo getSupplierName($purchas->supplier_id); ?></label>
          </div>
          <div class="col-xl-12 col-md-12 col-sm-12 mt-2">
            <label class="fw-bold">{{ trans('message.Email :') }} </label>
            <label class=""><?php echo $purchas->email; ?></label>
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  </hr>
  <table width="100%" border="0" class="adddatatable mt-0">
    <thead>
      <tr>
        <td align="left" width="55%" style="float:left;">
          <h5 class="fw-bold">{{ trans('message.Other information') }}</h5>
        </td>
        <!-- <td align="left"
          style=""
          width="30%">
          <h5 class="fw-bold">{{ trans('message.Supplier Detail') }}</h5>
        </td> -->
      </tr>

    </thead>
    <tbody>
      <tr>

        <td valign="top" align="left" width="27%">
          <div class="col-xl-6 col-md-6 col-sm-12">
            <label class="fw-bold">{{ trans('message.Billing Address:') }}</label>
          </div>
          <div class="col-xl-6 col-md-6 col-sm-12">
            <label class=""> <?php echo $purchas->address; ?> </label>
          </div>
          <!-- {{ trans('message.Billing Address:') }} <?php echo $purchas->address; ?><br> </td> -->
      </tr>
    </tbody>
  </table>
  </hr><br>
  <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>


  <div class="table-responsive">
    <table class="table table-bordered adddatatable" width="100%" border="1" style="border-collapse:collapse;">
      <thead>
        <tr>
          <th class="text-center fw-bold">{{ trans('message.Category') }}</th>
          <th class="text-center fw-bold">{{ trans('message.Product Number') }}</th>
          <th class="text-center fw-bold">{{ trans('message.Manufacturer Name') }}</th>
          <th class="text-center fw-bold">{{ trans('message.Product Name') }}</th>
          <th class="text-center fw-bold">{{ trans('message.Qty') }}</th>
          <th class="text-center fw-bold">
            {{ trans('message.Price') }}(<?php echo getCurrencySymbols(); ?>)
          </th>
            <th class="text-center fw-bold">
            {{ trans('VAT') }}(<?php echo getCurrencySymbols(); ?>)
          </th>
          <th class="text-center fw-bold">
            {{ trans('message.Total Amount') }}(<?php echo getCurrencySymbols(); ?>)
          </th>
        </tr>
      </thead>
      <tbody>

        <?php
        $total = 0;
        // if(!empty($purchasdetails))
        if (count($purchasdetails) !== 0) {
          foreach ($purchasdetails as $purchasdetail) { ?>
            <tr>
              <td class="text-center">
                <?php
                $categor = getCategory($purchasdetail->category); ?>
                {{ trans('message.' . $categor); }}
              </td>
              <td class="text-center">
                <?php echo getProductcode($purchasdetail->product_id); ?>
              </td>
              <td class="text-center">
                <?php echo getProductName(getproducttyid($purchasdetail->product_id)); ?>
              </td>
              <td class="text-center">
                <?php echo getProduct($purchasdetail->product_id); ?>
              </td>
              <td class="text-center"><?php echo $purchasdetail->qty; ?></td>
              <td class="text-center"><?php echo number_format($purchasdetail->price); ?></td>
              <td class="text-center"><?php $total = $purchasdetail->price *  $purchasdetail->qty; 
              $vat = $total * $purchasdetail->vat; echo number_format($vat); ?></td>
              <td class="text-center"><?php echo number_format($purchasdetail->total_amount); ?></td>

            </tr>
            <?php $total += $purchasdetail->total_amount; ?>
          <?php }
        } else {
          ?>
          <tr>
            <td class="text-center" colspan="7">{{ trans('message.No data available in table.') }}</td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>


  <!-- For Custom Field -->
  @if (!$tbl_custom_fields->isEmpty())
  <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
    <!-- <tr class="printimg_purchase ">
        <td class="cname"
          colspan="2">{{ trans('message.OTHER INFORMATION') }}</td>
      </tr> -->

    @foreach ($tbl_custom_fields as $tbl_custom_field)
    <?php
    $tbl_custom = $tbl_custom_field->id;
    $userid = $purchas->id;

    $datavalue = getCustomDataPurchase($tbl_custom, $userid);
    ?>

    @if ($tbl_custom_field->type == 'radio')
    @if ($datavalue != '')
    <?php
    $radio_selected_value = getRadioSelectedValue($tbl_custom_field->id, $datavalue);
    ?>

    <tr>
      <th class="text-center">{{ $tbl_custom_field->label }} :</th>
      <td class="text-center cname">{{ $radio_selected_value }}</td>
    </tr>
    @else
    <tr>
      <th class="text-center">{{ $tbl_custom_field->label }} :</th>
      <td class="text-center cname">{{ trans('message.Data not available') }}</td>
    </tr>
    @endif
    @else
    @if ($datavalue != null)
    <tr>
      <th class="text-center">{{ $tbl_custom_field->label }} :</th>
      <td class="text-center cname">{{ $datavalue }}</td>
    </tr>
    @else
    <tr>
      <th class="text-center">{{ $tbl_custom_field->label }} :</th>
      <td class="text-center cname">{{ trans('message.Data not available') }}</td>
    </tr>
    @endif
    @endif
    @endforeach
  </table>
  @endif
  <!-- For Custom Field End -->

  <table class="table" width="100%">
    <tbody>
      <tr class="large-screen">
        <td class="text-right cname" colspan="2">
          <div class="row col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 grand_total_freeservice pt-2 me-0">
            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 text-end fullpaid_invoice_list pt-1">
              {{ trans('message.Grand Total') }}( <?php echo getCurrencySymbols(); ?> ):
            </div>
            <div class="row col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
              <label class="total_amount pt-1"> <?php echo number_format($total); ?> </label>
            </div>

          </div>
        </td>
      </tr>

      <tr class="small-screen">
        <td class="text-end cname text-light" width="81.5%">{{ trans('message.Grand Total') }} (<?php echo getCurrencySymbols(); ?>) :</td>
        <td class="text-right fw-bold cname gst text-light"><?php echo number_format($total); ?></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="modal-footer">
  <!-- <input type="submit" class="btn btn-default"  onClick="printdiv('div_print');" value=" Print "> -->

  <button type="button" class="btn btn-outline-model-secondary mx-0" data-bs-dismiss="modal">{{ trans('message.Close') }}</button>

</div>