<div id="stockprint"
  style="margin-left:10px;">

  <div class="table-responsive">
    <table align="center">
      <tbody>
        <tr>
          <td align="center">
            <h4>{{ ucfirst(getProduct($id)) }} - {{ getProductName(getproducttyid($id)) }}</h4>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="table-responsive">
  <table class="table table-bordered adddatatable">
    <thead>
      <tr>
        <th class="text-center">{{ trans('message.Date') }}</th>
        <th class="text-center">{{ trans('message.Type') }}</th>
        <th class="text-center">{{ trans('message.Reference Details') }}</th>
        <th class="text-center">{{ trans('message.Employee') }}</th>
        <th class="text-center">{{ trans('message.Quantity') }}</th>
      </tr>
    </thead>
    <tbody>

      <?php  $total=0;
			      $total1=0;
			if(!empty($totalstock))
			{
				
			 foreach($totalstock as $totalstocks)
			 { ?>
      <tr>

        <td class="text-center"> {{ date(getDateFormat(), strtotime($totalstocks->date)) }}</td>
        <td class="text-center"><?php if (!empty($totalstocks->purchase_no)) {
    echo trans('message.Purchase');
} else {
    echo trans('message.Sales');
} ?> </td>
        <?php if(!empty($totalstocks->purchase_no)){ ?>
        <td class="text-center">
          <a href="{!! url('/purchase/list/pview/' . $totalstocks->id) !!}"> {{ $totalstocks->purchase_no }}
          </a>
        </td>
        <td class="text-center"> {{ getSupplierName($totalstocks->supplier_id) }} </td>
        <td class="text-center"> + {{ $totalstocks->qty }} </td>
        <?php $total += $totalstocks->qty; ?>
        <?php }else{ ?>
        <td class="text-center">
          {{ getCustomerName($totalstocks->customer_id) }}
        </td>
        <td class="text-center"> {{ getAssignedName($totalstocks->salesmanname) }}</td>
        <td class="text-center"> - {{ $totalstocks->quantity }}</td>
        <?php $total1 += $totalstocks->quantity; ?>
        <?php } ?>
      </tr>
      <?php } } ?>
      <tr>
        <td colspan="4"
          class="text-right"
          align="right"><b>{{ trans('message.Total Stock:') }}</b></td>
        <?php $totalstock = $total - $total1; ?>
        <td class="text-center">{{ $totalstock }}</td>
      </tr>
    </tbody>
  </table>
</div>
<div class="modal-footer p-0">
  <button type="button"
    class="btn btn-outline-secondary btn-sm mx-0"
    data-bs-dismiss="modal">{{ trans('message.Close') }}</button>
</div>
