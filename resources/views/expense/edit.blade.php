@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <nav>
            <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/expense/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                  {{ trans('message.Edit Expense') }}</span></a>
            </div>
            @include('dashboard.profile')
          </nav>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <form id="expenseEditForm" method="post" action="{{ URL::to('expense/update/' . $first_data->id) }}" enctype="multipart/form-data" class="form-horizontal upperform addExpenseForm">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
              <h4><b>{{ trans('message.Expenses Details') }}</b></h4>
              <hr style="margin-top:0px;">
              <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12"></p>
            </div>

            <div class="row mt-3 row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="main_label">{{ trans('message.Main Label') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="main_label" name="main_label" class="form-control mainLabel" placeholder="{{ trans('message.Enter Main Label') }}" value="{{ $first_data->main_label }}" maxlength="30" required />
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="status">{{ trans('message.Status') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select name="status" id="status" class="form-control form-select" required>
                    <option value="">Select Status</option>
                    <option value="1" <?php if ($first_data->status == 1) {
                                        echo 'Selected';
                                      } ?>>{{ trans('message.Full Paid') }}</option>
                    <option value="2" <?php if ($first_data->status == 2) {
                                        echo 'Selected';
                                      } ?>>{{ trans('message.UnPaid') }}</option>
                    <option value="0" <?php if ($first_data->status == 0) {
                                        echo 'Selected';
                                      } ?>>{{ trans('message.Partially paid') }}</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="date">{{ trans('message.Date') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date ">
                  {{-- <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span> --}}
                  <input type="text" id="outdate_gatepass" autocomplete="off" name="date" class="form-control expenseDate datepicker" placeholder="<?php echo getDateFormat(); ?>" value="{{ date(getDateFormat(), strtotime($first_data->date)) }}" onkeypress="return false;" required />
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control select_branch form-select" name="branch">
                    @foreach ($branchDatas as $branchData)
                    <option value="{{ $branchData->id }}" <?php if ($first_data->branch_id == $branchData->id) {
                                                            echo 'selected';
                                                          } ?>>{{ $branchData->branch_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row mt-3 row-mb-0">
              <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 text-left">
                <button type="button" id="add_new_entry" class="btn add_button" name="add_new_entry">{{ trans('message.Add More Fields') }}</button>
              </div>
            </div>

            <div class="">
              {{-- <div class=""> --}}
              @foreach ($sec_data as $sec_datas)
             
              <div class="row items">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="expense_entry">{{ trans('message.Expense Entry') }} (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label></label>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                        <input type="hidden" name="autoid[]" value="{{ $sec_datas->id }}" />
                    <input type="number" id="expense_entry" class="form-control text-input mx-1" value="{{ $sec_datas->expense_amount }}" name="expense_entry[]" maxlength="10" placeholder="Expense Amount" required>                        </div>
                </div>
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="expense_label">{{ trans('message.Expense Label') }}</label>
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="text" id="expense_label_account" class="form-control text-input mx-1" value="{{ $sec_datas->label_expense }}" name="expense_label[]" maxlength="30" placeholder="Expense Entry Label">
                    </div>
              </div>
              </div>
              @endforeach
              {{-- </div> --}}
            </div>


            <!-- Custom Filed data value -->
            @if (!$tbl_custom_fields->isEmpty())
            <div class="col-md-12 col-xs-12 col-sm-12 space">
              <h4><b>{{ trans('message.Custom Fields') }}</b></h4>
              <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
            </div>
            <?php
            $subDivCount = 0;
            ?>
            @foreach ($tbl_custom_fields as $myCounts => $tbl_custom_field)
            <?php
            if ($tbl_custom_field->required == 'yes') {
              $required = 'required';
              $red = '*';
            } else {
              $required = '';
              $red = '';
            }

            $tbl_custom = $tbl_custom_field->id;
            $userid = $first_data->id;
            $datavalue = getCustomDataIncome($tbl_custom, $userid);

            $subDivCount++;
            ?>
            @if ($myCounts % 2 == 0)
            <div class="row row-mb-0">
              @endif
              <div class="row form-group col-md-6  col-sm-6 col-xs-12 error_customfield_main_div_{{ $myCounts }}">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account-no">{{ $tbl_custom_field->label }} <label class="color-danger">{{ $red }}</label></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  @if ($tbl_custom_field->type == 'textarea')
                  <textarea name="custom[{{ $tbl_custom_field->id }}]" class="form-control textarea_{{ $tbl_custom_field->id }} textarea_simple_class common_simple_class common_value_is_{{ $myCounts }}" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="100" isRequire="{{ $required }}" type="textarea" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>{{ $datavalue }}</textarea>

                  <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                  @elseif($tbl_custom_field->type == 'radio')
                  <?php
                  $radioLabelArrayList = getRadiolabelsList($tbl_custom_field->id);
                  ?>
                  @if (!empty($radioLabelArrayList))
                  <div style="margin-top: 5px;">
                    @foreach ($radioLabelArrayList as $k => $val)
                    <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" value="{{ $k }}" <?php
                                                                                                                            //$formName = "product";
                                                                                                                            $getRadioValue = getRadioLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $first_data->id, $tbl_custom_field->id);

                                                                                                                            if ($k == $getRadioValue) {
                                                                                                                              echo 'checked';
                                                                                                                            } ?>>
                    {{ $val }} &nbsp;
                    @endforeach
                  </div>
                  @endif
                  @elseif($tbl_custom_field->type == 'checkbox')
                  <?php
                  $checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id);
                  ?>
                  @if (!empty($checkboxLabelArrayList))
                  <?php
                  $getCheckboxValue = getCheckboxLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $first_data->id, $tbl_custom_field->id);
                  ?>
                  <div class="required_checkbox_parent_div_{{ $tbl_custom_field->id }}" style="margin-top: 5px;">
                    @foreach ($checkboxLabelArrayList as $k => $val)
                    <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}" <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                if ($val == getCheckboxValForAllModule($tbl_custom_field->form_name, $first_data->id, $tbl_custom_field->id, $val)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                  echo 'checked';
                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>>
                    {{ $val }} &nbsp;
                    @endforeach
                    <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                  </div>
                  @endif
                  @elseif($tbl_custom_field->type == 'textbox')
                  <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" value="{{ $datavalue }}" maxlength="30" class="form-control textDate_{{ $tbl_custom_field->id }} textdate_simple_class common_value_is_{{ $myCounts }} common_simple_class" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>

                  <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display:none"></span>
                  @elseif($tbl_custom_field->type == 'date')
                  <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" value="{{ $datavalue }}" maxlength="30" class="form-control textDate_{{ $tbl_custom_field->id }} date_simple_class common_value_is_{{ $myCounts }} common_simple_class" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" onkeydown="return false" {{ $required }}>

                  <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display:none"></span>
                  @endif
                </div>
              </div>
              @endforeach
              <?php
              if ($subDivCount % 2 != 0) {
                echo '</div>';
              }
              ?>
              @endif

              <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                  <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                </div> -->
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                  <button type="submit" class="btn btn-success updateExpenseButton">{{ trans('message.UPDATE') }}</button>
                </div>
              </div>
          </form>
        </div>
      </div>

      <!-- Add More Field Button call from here to create new Textbox (Start) -->
      <div class="d-none copy">
        <div class="remove_fields">
          <div class="row row-mb-0">
            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
              <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="expense_entry">
                {{ trans('message.Expense Entry') }} (<?php echo getCurrencySymbols(); ?>)
                                <label class="color-danger">*</label>
                            </label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <input type="number" id="expense_entry" class="form-control text-input" value="" name="expense_entry[]" maxlength="10" placeholder="{{ trans('message.Expense Amount') }}" required>
                            </div>
                        </div>
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 " for="expense_label">{{ trans('message.Expense Label') }}</label>
                            <div class="col-md-7 col-lg-7 col-xl-7 col-xxl-7 col-sm-7 col-xs-7">
                                <input type="text" id="expense_label" class="form-control text-input " value="" name="expense_label[]" placeholder="{{ trans('message.Expense Entry Label') }}" maxlength="30">
                            </div>
                            <!-- <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 addmoredelete">
                                <button type="button" class="btn btn-success del deleteButton" style="margin-top:0;">
                                    {{ trans('message.Delete') }}
                                </button>
                            </div> -->
                            <div class="col-sm-1 col-xs-1 addmoredelete ps-0">
                                <a class="del"><i class="fa fa-trash fa-2x disabled mt-1 mx-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      <!-- Add More Field Button call from here to create new Textbox (End) -->
    </div>
  </div>
</div>
<!-- /page content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {

    /*JQuery for create extra textbox and extra textbox also remove*/
    $(".add_button").click(function() {
      var html = $(".copy").html();
      $(".items").after(html);
    });


    $("body").on("click", ".del", function() {
      $(this).parents('.remove_fields').remove();
    });


    /*datetimepicker*/
    $('.datepicker').datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
      todayBtn: true,
      autoclose: 1,
      minView: 2,
      endDate: new Date(),
      language: "{{ getLangCode() }}",
    });



    /*If select box have value then error msg and has error class remove*/
    $('body').on('change', '.expenseDate', function() {

      var dateValue = $(this).val();

      if (dateValue != null) {
        $('#outdate_gatepass-error').css({
          "display": "none"
        });
      }

      if (dateValue != null) {
        $(this).parent().parent().removeClass('has-error');
      }
    });



    $('body').on('keyup', '.mainLabel', function() {

      var mainLabelName = $(this).val();

      if (!mainLabelName.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });

    $('body').on('keyup', '.extraExtenseTextbox', function() {

      var extraexpenseVal = $(this).val();

      if (!extraexpenseVal.replace(/\s/g, '').length) {
        $(this).val(0);
      }
    });


    /*Custom Field manually validation*/
    var msg31 = "{{ trans('message.field is required') }}";
    var msg32 = "{{ trans('message.Only blank space not allowed') }}";
    var msg33 = "{{ trans('message.Special symbols are not allowed.') }}";
    var msg34 = "{{ trans('message.At first position only alphabets are allowed.') }}";

    /*Form submit time check validation for Custom Fields */
    $('body').on('click', '.updateExpenseButton', function(e) {
      $('#expenseEditForm input, #expenseEditForm select, #expenseEditForm textarea').each(

        function(index) {
          var input = $(this);

          if (input.attr('name') == "main_label" || input.attr('name') == "status" || input.attr('name') ==
            "date") {
            if (input.val() == "") {
              return true;
            } else {
              return true;
            }
          } else if (input.attr('isRequire') == 'required') {
            var rowid = (input.attr('rows_id'));
            var labelName = (input.attr('fieldnameis'));

            if (input.attr('type') == 'textbox' || input.attr('type') == 'textarea') {
              if (input.val() == '' || input.val() == null) {
                $('.common_value_is_' + rowid).val("");
                $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                e.preventDefault();
                return false;
              } else if (!input.val().replace(/\s/g, '').length) {
                $('.common_value_is_' + rowid).val("");
                $('#common_error_span_' + rowid).text(labelName + " : " + msg32);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                e.preventDefault();
                return false;
              } else if (!input.val().match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                $('.common_value_is_' + rowid).val("");
                $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                e.preventDefault();
                return false;
              }
            } else if (input.attr('type') == 'checkbox') {
              var ids = input.attr('custm_isd');
              if ($(".required_checkbox_" + ids).is(':checked')) {
                $('#common_error_span_' + rowid).css({
                  "display": "none"
                });
                $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                $('.required_checkbox_parent_div_' + ids).css({
                  "color": ""
                });
                $('.error_customfield_main_div_' + rowid).removeClass('has-error');
              } else {
                $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                $('.required_checkbox_' + ids).css({
                  "outline": "2px solid #a94442"
                });
                $('.required_checkbox_parent_div_' + ids).css({
                  "color": "#a94442"
                });
                e.preventDefault();
                return false;
              }
            } else if (input.attr('type') == 'date') {
              if (input.val() == '' || input.val() == null) {
                $('.common_value_is_' + rowid).val("");
                $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                e.preventDefault();
                return false;
              } else {
                $('#common_error_span_' + rowid).css({
                  "display": "none"
                });
                $('.error_customfield_main_div_' + rowid).removeClass('has-error');
              }
            }
          } else if (input.attr('isRequire') == "") {
            //Nothing to do
          }
        }
      );
    });


    /*Anykind of input time check for validation for Textbox, Date and Textarea*/
    $('body').on('keyup', '.common_simple_class', function() {

      var rowid = $(this).attr('rows_id');
      var valueIs = $('.common_value_is_' + rowid).val();
      var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
      var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
      var inputTypes = $('.common_value_is_' + rowid).attr('type');

      if (requireOrNot != "") {
        if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') {
          if (valueIs == "") {
            $('.common_value_is_' + rowid).val("");
            $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
            $('#common_error_span_' + rowid).css({
              "display": ""
            });
            $('.error_customfield_main_div_' + rowid).addClass('has-error');
          } else if (valueIs.match(/^\s+/)) {
            $('.common_value_is_' + rowid).val("");
            $('#common_error_span_' + rowid).text(labelName + " : " + msg34);
            $('#common_error_span_' + rowid).css({
              "display": ""
            });
            $('.error_customfield_main_div_' + rowid).addClass('has-error');
          } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
            $('.common_value_is_' + rowid).val("");
            $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
            $('#common_error_span_' + rowid).css({
              "display": ""
            });
            $('.error_customfield_main_div_' + rowid).addClass('has-error');
          } else {
            $('#common_error_span_' + rowid).css({
              "display": "none"
            });
            $('.error_customfield_main_div_' + rowid).removeClass('has-error');
          }
        } else if (inputTypes == 'date') {
          if (valueIs != "") {
            $('#common_error_span_' + rowid).css({
              "display": "none"
            });
            $('.error_customfield_main_div_' + rowid).removeClass('has-error');
          } else {
            $('.common_value_is_' + rowid).val("");
            $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
            $('#common_error_span_' + rowid).css({
              "display": ""
            });
            $('.error_customfield_main_div_' + rowid).addClass('has-error');
          }
        } else {
          //alert("Yes i am radio and checkbox");
        }
      } else {
        if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') {
          if (valueIs != "") {
            if (valueIs.match(/^\s+/)) {
              $('.common_value_is_' + rowid).val("");
              $('#common_error_span_' + rowid).text(labelName + " : " + msg34);
              $('#common_error_span_' + rowid).css({
                "display": ""
              });
              $('.error_customfield_main_div_' + rowid).addClass('has-error');
            } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
              $('.common_value_is_' + rowid).val("");
              $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
              $('#common_error_span_' + rowid).css({
                "display": ""
              });
              $('.error_customfield_main_div_' + rowid).addClass('has-error');
            } else {
              $('#common_error_span_' + rowid).css({
                "display": "none"
              });
              $('.error_customfield_main_div_' + rowid).removeClass('has-error');
            }
          } else {
            $('#common_error_span_' + rowid).css({
              "display": "none"
            });
            $('.error_customfield_main_div_' + rowid).removeClass('has-error');
          }
        }
      }
    });


    /*For required checkbox checked or not*/
    $('body').on('click', '.checkbox_simple_class', function() {

      var rowid = $(this).attr('rows_id');
      var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
      var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
      var inputTypes = $('.common_value_is_' + rowid).attr('type');
      var custId = $('.common_value_is_' + rowid).attr('custm_isd');

      if (requireOrNot != "") {
        if ($(".required_checkbox_" + custId).is(':checked')) {
          $('.required_checkbox_' + custId).css({
            "outline": ""
          });
          $('.required_checkbox_' + custId).css({
            "color": ""
          });
          $('#common_error_span_' + rowid).css({
            "display": "none"
          });
          $('.required_checkbox_parent_div_' + custId).css({
            "color": ""
          });
          $('.error_customfield_main_div_' + rowid).removeClass('has-error');
        } else {
          $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
          $('.required_checkbox_' + custId).css({
            "outline": "2px solid #a94442"
          });
          $('.required_checkbox_' + custId).css({
            "color": "#a94442"
          });
          $('#common_error_span_' + rowid).css({
            "display": ""
          });
          $('.required_checkbox_parent_div_' + custId).css({
            "color": "#a94442"
          });
          $('.error_customfield_main_div_' + rowid).addClass('has-error');
        }
      }
    });
    $('body').on('change', '.date_simple_class', function() {

      var rowid = $(this).attr('rows_id');
      var valueIs = $('.common_value_is_' + rowid).val();
      var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
      var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
      var inputTypes = $('.common_value_is_' + rowid).attr('type');
      var custId = $('.common_value_is_' + rowid).attr('custm_isd');

      if (requireOrNot != "") {
        if (valueIs != "") {
          $('#common_error_span_' + rowid).css({
            "display": "none"
          });
          $('.error_customfield_main_div_' + rowid).removeClass('has-error');
        } else {
          $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
          $('#common_error_span_' + rowid).css({
            "display": ""
          });
          $('.error_customfield_main_div_' + rowid).addClass('has-error');
        }
      }
    });
  });
</script>

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreExpenseAddEditFormRequest', '#expenseEditForm') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection