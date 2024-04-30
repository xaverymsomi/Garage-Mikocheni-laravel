<!--color add new-->

<tr id="color_id_<?php echo $idc; ?>">
  <td>
    <select name="color[]"
      class="form-control tax"
      id="tax_<?php echo $idc; ?>"
      required>
      <option value="0">{{ trans('message.Select Color') }}</option>
      <?php  foreach($color as $colors) 
			{ ?>
      <option value="<?php echo $colors->id; ?>" style="background-color:{{ $colors->color_code }}; color: #333333;"><?php echo $colors->color; ?></option>
      <?php  } ?>
    </select>
  </td>
  <td class="text-center">
    <span class="remove_color"
      style="cursor: pointer;"
      data-id="<?php echo $idc; ?>"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></span>
  </td>
</tr>
