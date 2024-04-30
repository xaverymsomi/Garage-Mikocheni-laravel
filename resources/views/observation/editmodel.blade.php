@can('observationlibrary_edit')
  <?php foreach ($sub_data as $sub_datas) { ?>
  <div class="items">

    <div class="row form-group  form_group_error">
      <!-- <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
        {{ trans('message.Check Point') }}<label class="color-danger">&nbsp;&nbsp;*</label></label> -->

      <input type="hidden"
        name="check_point_id"
        class="check_point_id"
        value="<?php echo $id; ?>" />
      <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
        <input id="sub_ch"
          placeholder="{{ trans('message.Enter Checkpoint Name') }}"
          name="checkpoint[]"
          type="text"
          maxlength="30"
          class="form-control chekpoint_sub model_input"
          value="<?php echo $sub_datas->checkout_point; ?>" />
        
        <span id="checkpoints_edit_error"
          class="help-block error-help-block color-danger"
          style="display: none">{{ trans('message.Start should be alphabets only after supports alphanumeric, space, dot, @, _, and - are allowed.') }}</span>

        <span id="checkpoints_edit_error1"
          class="help-block error-help-block color-danger"
          style="display: none">{{ trans('message.field is required') }}</span>

      </div>
      <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
        <button class="btn btn-success submit_edit checkpoint_update input_submit">{{ trans('message.UPDATE') }}</button>
      </div>
    </div>
  </div>
  <?php } ?>
@endcan
