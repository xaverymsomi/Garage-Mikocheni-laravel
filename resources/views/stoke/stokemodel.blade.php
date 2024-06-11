<script>
  function printdiv(el) {

    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();

    $('body').html(restorepage);
    window.location.reload();
  }
</script>

<div id="stockprint">
  <!-- <table width="100%" border="0">
    <tbody>
      <tr>
        <td align="right">
          <div class="col-xl-12 col-md-12 col-sm-12">
            <label class="fw-bold"><?php $nowdate = date('Y-m-d'); ?>{{ trans('message.Date') }} : </label>
            <label class=""> <?php echo date(getDateFormat(), strtotime($nowdate)); ?> </label>
          </div>
        </td>
      </tr>
    </tbody>
  </table> -->
  <table border="0">
    <tbody>
      <tr>
        <td width="50%">
          <!-- <h4 class="text-center">{{ $logo->system_name }}</h4> -->
          <img src="..//public/general_setting/<?php echo $logo->logo_image; ?>" class="system_logo_img">
        </td>
        <td width="20%">
          <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
            <label class="fw-bold">{{ trans('message.Product Code') }} : </label>
            <label class=""> <?php echo $product->product_no; ?> </label>
          </div>
          <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
            <label class="fw-bold">{{ trans('message.Manufacturer Name') }} : </label>
            <label class=""> <?php echo getProductName($product->product_type_id); ?> </label>
          </div>
          <div class="col-xl-12 col-md-12 col-sm-12">
            <label class="fw-bold">{{ trans('message.Product Name') }} : </label>
            <label class=""> <?php echo $product->name; ?> </label>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <br />
  </hr>
  <table width="100%" border="0">
    <tbody>
      <tr>
        <td align="left">
          <h4 class="text-center mb-3">{{ trans('message.PURCHASE DETAILS') }}</h4>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="table-responsive">
    <table class="table table-bordered table-responsive" border="1" style="border-collapse:collapse;">
      <thead>
        <tr>
          <th class="text-center fw-bold">{{ trans('message.Purchase Date') }}</th>
          <th class="text-center fw-bold">{{ trans('message.Supplier Name') }}</th>
          <th class="text-center fw-bold">{{ trans('message.Quantity') }}</th>
        </tr>
      </thead>
      <tbody>

        <?php $total = 0;
        // if(!empty($stockdata))
        if (count($stockdata) !== 0) {

          foreach ($stockdata as $stockdatas) { ?>
            <tr>
              <td class="text-center"><?php echo date(getDateFormat(), strtotime($stockdatas->date)); ?></td>
              <td class="text-center"><?php echo getSupplierName($stockdatas->supplier_id); ?></td>
              <td class="text-center"><?php echo $stockdatas->qty; ?></td>
              <?php $total += $stockdatas->qty; ?>
            </tr>
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
  <!-- <table class="table" style="border:1px solid #ddd" width="100%">
    <tbody>
      <tr>
        <td colspan="2" class="text-right" align="right">
          <div class="col-xl-6 col-md-6 col-sm-12 me-50">
            <label class="fw-bold">{{ trans('message.Total Stock:') }}&nbsp;&nbsp;&nbsp; </label>
            <label class=""> <?php echo $total; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
          </div>

        </td>
      </tr>
    </tbody>
  </table> -->
  <table class="table" style="border:1px solid #ddd" width="100%">
    <tbody>
      <tr>
        <td colspan="2" class="text-right" align="right">
          <div class="col-xl-6 col-md-6 col-sm-12 me-50">
            <label class="fw-bold"> {{ trans('message.Sales Stock:') }}&nbsp;&nbsp;&nbsp; </label>
            <label class=""> <?php echo $celltotal; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
          </div>
          <!-- {{ trans('message.Sales Stock:') }} &nbsp; &nbsp; <?php echo $celltotal; ?></td> -->
      </tr>
    </tbody>
  </table>
  <table class="table" style="border:1px solid #ddd" width="100%">
    <tbody>
      <tr>
        <td colspan="2" class="text-right" align="right">
          <div class="col-xl-6 col-md-6 col-sm-12 me-50">
            <label class="fw-bold"> {{ trans('message.Service Stock') }}:&nbsp;&nbsp;&nbsp; </label>
            <label class=""> <?php echo $product_service_stocks_total; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
          </div>
          <!-- {{ trans('message.Service Stock') }}: &nbsp; &nbsp; <?php echo $product_service_stocks_total; ?></td> -->
      </tr>
    </tbody>
  </table>
  <table class="table" style="border:1px solid #ddd" width="100%">
    <tbody>
      <tr> <?php $Currentstock = $total - $sale_service_stock; ?>
        <td colspan="2" class="text-right" align="right">
          <div class="col-xl-6 col-md-6 col-sm-12 me-50"> 
            <label class="fw-bold"> {{ trans('message.Current Stock:') }}&nbsp;&nbsp;&nbsp; </label>
            <label class="">{{ getStockCurrent($p_id) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
          </div>
          <!-- {{ trans('message.Current Stock:') }} &nbsp; &nbsp; <?php echo $Currentstock; ?></td> -->
      </tr>
    </tbody>
  </table>
</div>
<div class=" col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 modal-footer">

  <img src="{{ URL::asset('public/product/Print.png') }} " onclick="printdiv('stockprint')" type="button" class="stock_print_img mx-0" id="">
  <a href="{!! url('/stoke/list') !!}" class="prints"><input type="submit" class="btn btn-secondary stoke" data-bs-dismiss="modal" value={{ trans('message.Close') }}></a>
  {{-- <button type="button"
      class="btn btn-secondary "
      data-bs-dismiss="modal">{{ trans('message.Close') }}</button> --}}
</div>