<thead>
  <tr>
    <th>{{ trans('message.Category') }}</th>
    <th>{{ trans('message.Observation Point') }}</th>
    <th>{{ trans('message.Select Product') }}</th>
    <th>{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
    <th>{{ trans('message.Quantity') }}</th>
    <th>{{ trans('message.Total Price') }}(<?php echo getCurrencySymbols(); ?>)</th>
    <th>{{ trans('message.Chargeable') }}</th>
    <th>{{ trans('message.Action') }}</th>
  </tr>
</thead>

<tbody>
  <?php $i = 1; ?>
  <?php foreach ($data as $datas) { ?>
  <tr id="<?php echo 'row_id_delete_' . $i; ?>">
    <td>
      <input type="text"
        name="product2[category][]"
        class="form-control"
        value="<?php echo $datas->checkout_subpoints; ?>">
      <input type="hidden"
        name="pro_id_delete"
        id="del_pro_<?php echo $i; ?>"
        value="<?php echo $datas->id; ?>">
    </td>

    <td>
      <input type="text"
        name="product2[sub_points][]"
        class="form-control"
        value="<?php echo $datas->checkout_point; ?>">
    </td>

    <td>
      <select name="product2[product_id][]"
        class="form-control product_ids"
        url=" <?php echo url('/jobcard/getprice'); ?>"
        required=""
        row_did=<?php echo $i; ?>
        id="<?php echo 'product1s_' . $i; ?>">
        <option value="0">{{ trans('message.Select Product') }}</option>

        <?php  foreach($product as $products) { 
								if($products->id == $datas->product_id)
								{
									$is_select = "selected";
								}
								else
								{
									$is_select = "";
								}
								?>
        <option value="<?php echo $products->id; ?>"
          <?php echo $is_select; ?>><?php echo $products->name; ?></option>
        <?php } ?>
      </select>
    </td>


    <td>
      <input type="text"
        name="product2[price][]"
        value="<?php if (!empty($data)) {
            echo $datas->price;
        } ?>"
        value="<?php echo $products->price; ?>"
        class="form-control rate"
        id="<?php echo 'product1_' . $i; ?>"
        readonly="true">
    </td>

    <td>
      <input type="text"
        name="product2[qty][]"
        value="<?php if (!empty($data)) {
            echo $datas->quantity;
        } ?>"
        class="form-control qtyt qnt_<?php echo $i; ?>"
        row_id1="<?php echo $i; ?>"
        url="<?php echo url('/jobcard/gettotalprice'); ?>"
        id="<?php echo 'qty_' . $i; ?>"
        required>
    </td>

    <td>
      <input type="text"
        name="product2[total][]"
        value="<?php if (!empty($data)) {
            echo $datas->total_price;
        } ?>"
        value="0"
        class="form-control total1"
        id="<?php echo 'total1_' . $i; ?>"
        readonly="true" />
    </td>

    <td>


      {{ trans('message.Yes:') }} <input type="radio"
        name="yesno_[]<?php echo $i; ?>"
        class="yes_no"
        value="1"
        <?php if ($datas->chargeable == 1) {
            echo 'checked';
        } ?>
        style=" height:13px; width:20px; margin-right:5px;">

      {{ trans('message.No:') }} <input type="radio"
        name="yesno_[]<?php echo $i; ?>"
        class="yes_no"
        value="0"
        <?php if ($datas->chargeable == 0) {
            echo 'checked';
        } ?>
        style="height:13px; width:20px;">


    </td>

    <td class="text-center">
      <i class="fa fa-trash fa-2x delete"
        style="cursor: pointer;"
        data_id_trash="<?php echo $i; ?>"
        delete_data_url=" <?php echo url('/jobcard/delete_on_reprocess'); ?>"
        service_id="<?php echo $s_id; ?>"></i>
      <input type="hidden"
        name="obs_id[]"
        class="form-control"
        value="<?php echo $datas->id; ?>">
    </td>


  </tr>
  <?php $i++; ?>
  <?php } ?>
</tbody>
