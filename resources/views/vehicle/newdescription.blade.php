<!--- Description new add -->


<tr id="row_id_<?php echo $ids; ?>">
  <td>
    <textarea name="description[]"
      class="form-control"
      id="tax_<?php echo $ids; ?>" maxlength="100"></textarea>
  </td>
  <td class="text-center">
    <span class="delete_description"
      style="cursor: pointer;"
      data-id="<?php echo $ids; ?>"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></span>
  </td>
</tr>
