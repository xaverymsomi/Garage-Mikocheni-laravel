<tr id="row_id_<?php echo $ids; ?>">
  <td>
    <select class="form-control select_producttype"
      name="product[Manufacturer_id][]"
      m_url="{!! url('/purchase/producttype/name') !!}"
      man_sel_url="{!! url('purchase/getfirstproductdata') !!}"
      row_did="<?php echo $ids; ?>"
      data-id="<?php echo $ids; ?>"
      row_id="<?php echo $ids; ?>"
      style="width:100%;"
      required>
      <option value="">{{ trans('message.Select Manufacturer') }}</option>
      @if (!empty($Select_product))
        @foreach ($Select_product as $Select_products)
          <option value="{{ $Select_products->product_type_id }}">{{ $Select_products->type }}</option>
        @endforeach
      @endif
    </select>
  </td>
  <td>
    <input type="hidden"
      value=""
      name="product[tr_id][]" />
    <select name="product[product_id][]"
      class="form-control  productid select_productname_<?php echo $ids; ?>"
      row_did="<?php echo $ids; ?>"
      url="<?php echo url('purchase/add/getproduct'); ?>"
      data-id="<?php echo $ids; ?>"
      style="width:100%;"
      required="required">
      <option value="">{{ trans('message.Select Product') }}</option>
      <?php  foreach($product as $products) { ?>
      <option value="<?php echo $products->id; ?>"><?php echo $products->name; ?></option> <?php } ?>
    </select>
  </td>
  <td>
    <input type="number"
      name="product[qty][]"
      row_id="<?php echo $ids; ?>"
      class="quantity form-control qty qty_<?php echo $ids; ?>"
      id="qty_<?php echo $ids; ?>"
      value="1" 
      maxlength="8">
    <!-- <span class="qty_<?php echo $ids; ?>">{{ $first_product->product_no??"" }}</span> -->
  </td>

   <td>
    
    <select name="product[vat][]"
      class="form-control  vat vat_<?php echo $ids; ?>"
      row_id="<?php echo $ids; ?>"
      id ="vat_<?php echo $ids; ?>"
      style="width:100%;"
      required="required">
      <option value="0">{{ trans('No TAX') }}</option>
      <option value="0.18">{{ trans('18%') }}</option>
    </select>
  </td>

  <td>
    <!-- <input type="text" name="product[price][]" class="product form-control prices price_<?php echo $ids; ?>"  value="" id="price_<?php echo $ids; ?>" style="width:100%;" readonly="true"> -->
    <input type="text"
      name="product[price][]"
      class="product form-control prices price_<?php echo $ids; ?>"
     id="price_<?php echo $ids; ?>"
      row_id="<?php echo $ids; ?>"
      style="width:100%;"
      onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
  </td>
  <td>
    <input type="text"
      name="product[total_price][]"
      class="product form-control total_price total_price_<?php echo $ids; ?>"
      style="width:100%;"
      id="total_price_<?php echo $ids; ?>"
      readonly="true">
  </td>

  <td align="center">
    <span class="product_delete tax_<?php echo $ids; ?>"
      data-id="<?php echo $ids; ?>"
      id="tax_<?php echo $ids; ?>"><i class="fa-solid fa-trash-can fa-2x"></i></span>
    <input type="hidden"
      value={{ $ids }}
      name="row_number"
      class="row_number">
  </td>
</tr>