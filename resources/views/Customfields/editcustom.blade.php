@extends('layouts.app')
@section('content')

<style>
  input[type=radio] {
    margin: 10px 0 0 !important;
    margin-top: 1px\9;
    width: 25px;
    line-height: normal;
  }
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('setting/custom/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                {{ trans('message.Edit Custom Field') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form id="customFieldEditForm" method="post" action="update/{{ $tbl_custom_fields->id }}" enctype="multipart/form-data" class="form-horizontal upperform">

              <div class="row mt-3 has-feedback row-mb-0">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="Country">{{ trans('message.Form Name') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <select class="form-control col-md-9 col-xs-12 select_form_name form-select" id="select_form_name" name="formname" disabled="">
                    <option value="">{{ trans('message.Select Form Name') }}</option>
                    <option value="supplier" <?php if ($tbl_custom_fields->form_name == 'suppliers') {
                                                echo 'selected';
                                              } ?>>{{ trans('message.Supplier') }}</option>
                    <option value="customer" <?php if ($tbl_custom_fields->form_name == 'customer') {
                                                echo 'selected';
                                              } ?>>{{ trans('message.Customer') }}</option>
                    <option value="employee" <?php if ($tbl_custom_fields->form_name == 'employee') {
                                                echo 'selected';
                                              } ?>>{{ trans('message.Employee') }}</option>

                    <option value="branch_admin" <?php if ($tbl_custom_fields->form_name == 'branch_admin') {
                                                    echo 'selected';
                                                  } ?>>{{ trans('message.Branch Admin') }}</option>

                    <option value="product" <?php if ($tbl_custom_fields->form_name == 'product') {
                                              echo 'selected';
                                            } ?>>{{ trans('message.Product') }}</option>
                    <option value="purchase" <?php if ($tbl_custom_fields->form_name == 'purchase') {
                                                echo 'selected';
                                              } ?>>{{ trans('message.Purchase') }}</option>
                    <option value="vehicle" <?php if ($tbl_custom_fields->form_name == 'vehicle') {
                                              echo 'selected';
                                            } ?>>{{ trans('message.Vehicle') }}</option>
                    <option value="vehicletype" <?php if ($tbl_custom_fields->form_name == 'vehicletype') {
                                                  echo 'selected';
                                                } ?>>{{ trans('message.Vehicle Type') }}</option>
                    <option value="vehiclebrand" <?php if ($tbl_custom_fields->form_name == 'vehiclebrand') {
                                                    echo 'selected';
                                                  } ?>>{{ trans('message.Vehicle Brand') }}</option>
                    <option value="color" <?php if ($tbl_custom_fields->form_name == 'color') {
                                            echo 'selected';
                                          } ?>>{{ trans('message.Color') }}</option>
                    <option value="service" <?php if ($tbl_custom_fields->form_name == 'service') {
                                              echo 'selected';
                                            } ?>>{{ trans('message.Service') }}</option>
                    <option value="invoice" <?php if ($tbl_custom_fields->form_name == 'invoice') {
                                              echo 'selected';
                                            } ?>>{{ trans('message.Invoice') }}</option>
                    <option value="income" <?php if ($tbl_custom_fields->form_name == 'income') {
                                              echo 'selected';
                                            } ?>>{{ trans('message.Income') }}</option>
                    <option value="expense" <?php if ($tbl_custom_fields->form_name == 'expense') {
                                              echo 'selected';
                                            } ?>>{{ trans('message.Expense') }}</option>
                    <option value="sales" <?php if ($tbl_custom_fields->form_name == 'sales') {
                                            echo 'selected';
                                          } ?>>{{ trans('message.Sales') }}</option>
                    <option value="salepart" <?php if ($tbl_custom_fields->form_name == 'salepart') {
                                                echo 'selected';
                                              } ?>>{{ trans('message.Sale Part') }}</option>
                    <option value="rto" <?php if ($tbl_custom_fields->form_name == 'RTO') {
                                          echo 'selected';
                                        } ?>>{{ trans('message.RTO') }}</option>

                    <option value="supportstaff" <?php if ($tbl_custom_fields->form_name == 'supportstaff') {
                                                    echo 'selected';
                                                  } ?>>{{ trans('message.Support Staff') }}</option>
                    <option value="accountant" <?php if ($tbl_custom_fields->form_name == 'accountant') {
                                                  echo 'selected';
                                                } ?>>{{ trans('message.Accountant') }}</option>
                  </select>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <div class="row row-mb-0 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end">{{ trans('message.Label') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="text" name="labelname" class="form-control" placeholder="{{ trans('message.Enter Label Name') }}" required maxlength="20" value="{{ $tbl_custom_fields->label }}">
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <div class="row row-mb-0 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="Country">{{ trans('message.Type') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <select class="form-control col-md-9 col-xs-12 fieldTypename form-select" name="typename" disabled="">
                    <option value="">{{ trans('message.Select Type') }}
                    <option value="textbox" <?php if ($tbl_custom_fields->type == 'textbox') {
                                              echo 'selected';
                                            } ?>>{{ trans('message.TextBox') }}</option>

                    <option value="date" <?php if ($tbl_custom_fields->type == 'date') {
                                            echo 'selected';
                                          } ?>>{{ trans('message.Date') }}</option>
                    <option value="textarea" <?php if ($tbl_custom_fields->type == 'textarea') {
                                                echo 'selected';
                                              } ?>>{{ trans('message.Textarea') }} </option>
                    <option value="radio" <?php if ($tbl_custom_fields->type == 'radio') {
                                            echo 'selected';
                                          } ?>>{{ trans('message.Radio') }}</option>
                    <option value="checkbox" <?php if ($tbl_custom_fields->type == 'checkbox') {
                                                echo 'selected';
                                              } ?>>{{ trans('message.Checkbox') }} </option>
                  </select>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"> </div>
              </div>

              <!-- If Selected radio then show this Add radio label part -->
              <div class="row mt-3 radio_add_part_div">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="radio_add_part">{{ trans('message.Radio Field Label') }} <label class="color-danger">*</label></label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="" name="radios_add" class="form-control r_label r_label_inputbox" placeholder="{{ trans('message.Enter radio label name') }}">
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">
                  <button type="button" class="btn btn-outline-secondary add_more_radio" custom_field_id_btn="{{ $tbl_custom_fields->id }}">{{ trans('+') }}</button>
                </div>
              </div>

              <div class="row mt-3 radio_add_display_part_div" style="">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2" for="radio_add_part"></label>
                <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5" id="radio_label">
                  @if (!empty($radio_labels_data))
                  @foreach ($radio_labels_data as $key => $radio_label)
                  <div class="radio_label radio_label_{{ $key }}">
                    <i class="fa fa-trash delete_r_label text-danger" aria-hidden="true" radio_label_name="{{ $radio_label }}" row_id="{{ $key }}" custom_field_id="{{ $tbl_custom_fields->id }}" style="padding-left: 10px;"></i>
                    <input type="hidden" value="{{ $radio_label }}" id="" class="input_radio_label_{{ $key }}" name="r_label[]">
                    <label>{{ $radio_label }}</label>
                  </div>
                  @endforeach
                  @endif
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <!-- If Select radio then show this -->


              <!-- If Selected checkbox then show this Add checkbox label part -->
              <div class="row mt-3 checkbox_add_part_div">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="checkbox_add_part">{{ trans('message.Checkbox Field Label') }} <label class="color-danger">*</label></label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="" name="checkbox_add" class="form-control c_label c_label_inputbox" placeholder="{{ trans('message.Enter checkbox label name') }}">
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">
                  <button type="button" class="btn btn-outline-secondary add_more_checkbox" custom_field_id_btn="{{ $tbl_custom_fields->id }}">{{ trans('+') }}</button>
                </div>
              </div>

              <div class="row mt-3 checkbox_add_display_part_div" style="">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2" for="checkbox_add_part"></label>
                <div class="col-md-5 col-sm-5 col-xs-12" id="checkbox_label">
                  @if (!empty($checkbox_labels_data))
                  @foreach ($checkbox_labels_data as $key => $checkbox_label)
                  <div class="checkbox_label checkbox_label_{{ $key }}">
                    <i class="fa fa-trash delete_c_label text-danger" aria-hidden="true" checkbox_label_name="{{ $checkbox_label }}" row_id="{{ $key }}" custom_field_id="{{ $tbl_custom_fields->id }}" style="padding-left: 10px;"></i>
                    <input type="hidden" value="{{ $checkbox_label }}" id="" class="input_checkbox_label_{{ $key }}" name="c_label[]">
                    <label>{{ $checkbox_label }}</label>
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>
              <!-- If Select radio then show this -->

              <div class="row row-mb-0 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end">{{ trans('message.Required') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                  <input type="radio" name="required" value="yes" <?php if ($tbl_custom_fields->required == 'yes') {
                                                                    echo 'checked';
                                                                  } ?>>{{ trans('message.Yes') }}
                  <input type="radio" name="required" value="no" <?php if ($tbl_custom_fields->required == 'no') {
                                                                    echo 'checked';
                                                                  } ?>> {{ trans('message.No') }}
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <div class="row mt-3 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end">{{ trans('message.Always visible') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                  <input type="radio" name="visable" value="yes" <?php if ($tbl_custom_fields->always_visable == 'yes') {
                                                                    echo 'checked';
                                                                  } ?>>{{ trans('message.Yes') }}
                  <input type="radio" name="visable" value="no" <?php if ($tbl_custom_fields->always_visable == 'no') {
                                                                  echo 'checked';
                                                                } ?>> {{ trans('message.No') }}
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                  <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                </div> -->
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-2 mx-0">
                  <button type="submit" class="btn btn-success updateButton">{{ trans('message.UPDATE') }}</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->


<!-- Scripts starting -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
  $(document).ready(function() {
    var msg35 = "{{ trans('message.OK') }}";
    /*If field selected type is not radio or checkbox then don't display this */
    $('body').on('change', '.fieldTypename', function() {
      var valueIs = $(this).val();
      if (valueIs == 'radio') {
        $('.radio_add_part_div').css({
          "display": ""
        });
        $('.radio_add_display_part_div').css({
          "display": ""
        });

        $('.checkbox_add_part_div').css({
          "display": "none"
        });
        $('.checkbox_add_display_part_div').css({
          "display": "none"
        });
      } else if (valueIs == 'checkbox') {
        $('.checkbox_add_part_div').css({
          "display": ""
        });
        $('.checkbox_add_display_part_div').css({
          "display": ""
        });

        $('.radio_add_part_div').css({
          "display": "none"
        });
        $('.radio_add_display_part_div').css({
          "display": "none"
        });
      } else {
        $('.radio_add_part_div').css({
          "display": "none"
        });
        $('.radio_add_display_part_div').css({
          "display": "none"
        });
        $('.checkbox_add_part_div').css({
          "display": "none"
        });
        $('.checkbox_add_display_part_div').css({
          "display": "none"
        });
      }
    });



    /************** For Add radio labels /***************/
    $('body').on('click', '.add_more_radio', function() {
      var text = $('.r_label').val();
      var custom_field_id = $(this).attr('custom_field_id_btn');
      //var rowid = $(this).attr('row_id');
      var url = '{{ url('custom_field/add_radio_label_data') }}';

      var msg1 = "{{ trans('message.Duplicate data are not allowed') }}";
      var msg2 = "{{ trans('message.Enter radio label name') }}";

      if (text != '') {
        var valueString = $('input[name="r_label[]"]').map(function() {
          return this.value;
        }).get();

        var len = valueString.length;

        if (len >= 2) {
          var flag = 0;
          for (i = 0; i < len; i++) {
            if (valueString[i] == text) {
              swal({
                title: msg1,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });
              $('.r_label').val('');
              flag = 1;
            }
          }

          if (flag == 0) {
            $('#radio_label').append('<div class="radio_label radio_label_' + len +
              '" id="demo" ><i class="fa fa-trash delete_r_label text-danger" aria-hidden="true" style="padding-left: 10px;"></i>  <input type="hidden" value="' +
              text + '"  name="r_label[]" class="radioLabelArray"><label>' + text + '</label></div>');
            $('.r_label').val('');
            $('.duplicate_radio').remove();
          }
        } else {
          if (valueString == text) {
            swal({
              title: msg1,
              cancelButtonColor: '#C1C1C1',
              buttons: {
                cancel: msg35,
              },
              dangerMode: true,
            });
            $('.r_label').val('');
          } else {
            $('#radio_label').append('<div class="radio_label radio_label_' + len +
              '" id="demo" ><i class="fa fa-trash delete_r_label text-danger" aria-hidden="true" style="padding-left: 10px;"></i>  <input type="hidden" value="' +
              text + '"  name="r_label[]" class="radioLabelArray"><label>' + text + '</label></div>');
            $('.r_label').val('');
            $('.duplicate_radio').remove();
          }
        }

      } else {
        swal({
          title: msg2,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });
      }
    });

    /*********** For delete radio labels *************/
    $('body').on('click', '.delete_r_label', function() {
      $(this).parents('.radio_label').remove();
    });

    /************** For Add checkbox labels /***************/
    $('body').on('click', '.add_more_checkbox', function() {
      var text = $('.c_label').val();
      var custom_field_id = $(this).attr('custom_field_id_btn');
      //var rowid = $(this).attr('row_id');
      var url = '{{ url('custom_field/add_checkbox_label_data') }}';

      var msg3 = "{{ trans('message.Duplicate data are not allowed') }}";
      var msg4 = "{{ trans('message.Enter radio label name') }}";

      if (text != '') {
        var valueString = $('input[name="c_label[]"]').map(function() {
          return this.value;
        }).get();

        var len = valueString.length;

        if (len >= 2) {
          var flag = 0;
          for (i = 0; i < len; i++) {
            if (valueString[i] == text) {
              swal({
                title: msg3,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });
              $('.c_label').val('');
              flag = 1;
            }
          }

          if (flag == 0) {
            $('#checkbox_label').append(
              '<div class="label_checkbox" id="demo" ><i class="fa fa-trash delete_c_label text-danger" aria-hidden="true" style="padding-left: 10px;"></i>  <input type="hidden" value="' +
              text + '"  name="c_label[]" class="checkboxLabelArray"><label>' + text + '</label></div>');
            $('.c_label').val('');
            $('.duplicate_checkbox').remove();
          }
        } else {
          if (valueString == text) {
            swal({
              title: msg3,
              cancelButtonColor: '#C1C1C1',
              buttons: {
                cancel: msg35,
              },
              dangerMode: true,
            });
            $('.c_label').val('');
          } else {
            $('#checkbox_label').append(
              '<div class="label_checkbox" id="demo" ><i class="fa fa-trash delete_c_label text-danger" aria-hidden="true" style="padding-left: 10px;"></i>  <input type="hidden" value="' +
              text + '"  name="c_label[]" class="checkboxLabelArray"><label>' + text + '</label></div>');
            $('.c_label').val('');
            $('.duplicate_checkbox').remove();
          }
        }

      } else {
        swal({
          title: msg4,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg35,
          },
          dangerMode: true,
        });
      }
    });


    /*********** For delete checkbox labels *************/
    $('body').on('click', '.delete_c_label', function() {
      $(this).parents('.checkbox_label').remove();
    });

    /*Check page load time which one is selected(radio or checkbox)*/
    var selectTepyIs = $('select[name=typename]').val();

    if (selectTepyIs == "radio") {
      $('.radio_add_part_div').css({
        "display": ""
      });
      $('.radio_add_display_part_div').css({
        "display": ""
      });

      $('.checkbox_add_part_div').css({
        "display": "none"
      });
      $('.checkbox_add_display_part_div').css({
        "display": "none"
      });

      $('.fieldTypename').attr("disabled", "true");

    } else if (selectTepyIs == "checkbox") {

      $('.checkbox_add_part_div').css({
        "display": ""
      });
      $('.checkbox_add_display_part_div').css({
        "display": ""
      });

      $('.radio_add_part_div').css({
        "display": "none"
      });
      $('.radio_add_display_part_div').css({
        "display": "none"
      });

      $('.fieldTypename').attr("disabled", "true");
    } else {
      $('.radio_add_part_div').css({
        "display": "none"
      });
      $('.radio_add_display_part_div').css({
        "display": "none"
      });
      $('.checkbox_add_part_div').css({
        "display": "none"
      });
      $('.checkbox_add_display_part_div').css({
        "display": "none"
      });
      $('.fieldTypename').attr("disabled", "true");
    }


    /*Submit time check if radio or checkbox selected then label value should not empty*/
    $('body').on('click', '.updateButton', function(e) {

      var c_len = $("#checkbox_label > div").length;
      var r_len = $("#radio_label > div").length;
      var selectTepyIs = $('select[name=typename]').val();

      var msg5 = "{{ trans('message.Please enter radio label name on textbox after click on Add button.') }}";
      var msg6 = "{{ trans('message.Please enter checkbox label name on textbox after click on Add button.') }}";

      if (selectTepyIs == "radio") {
        if (r_len <= 0) {
          swal({
            title: msg5,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
          e.preventDefault();
        }
      } else if (selectTepyIs == "checkbox") {
        if (c_len <= 0) {
          swal({
            title: msg6,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
          e.preventDefault();
        }
      }
    });


    /*radion label add time check for special symbols*/
    $('body').on('keyup', '.r_label_inputbox', function() {

      var inputText = $(this).val();

      var msg7 = "{{ trans('message.At first position only alphabets are allowed.') }}";
      var msg8 = "{{ trans('message.Special symbols are not allowed.') }}";

      if (!inputText.replace(/\s/g, '').length) {
        $(this).val("");
      } else if (!inputText.match(
          /^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F][a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s\.\-\_]*$/
        )) {
        if (inputText.match(/^[0-9]*$/)) {
          $(this).val("");
          swal({
            title: msg7,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        } else {
          $(this).val("");
          swal({
            title: msg8,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        }
      }
    });


    /*checkbox label add time check for special symbols*/
    $('body').on('keyup', '.c_label_inputbox', function() {

      var inputText = $(this).val();

      var msg9 = "{{ trans('message.At first position only alphabets are allowed.') }}";
      var msg10 = "{{ trans('message.Special symbols are not allowed.') }}";

      if (!inputText.replace(/\s/g, '').length) {
        $(this).val("");
      } else if (!inputText.match(
          /^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F][a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s\.\-\_]*$/
        )) {
        if (inputText.match(/^[0-9]*$/)) {
          $(this).val("");
          swal({
            title: msg9,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        } else {
          $(this).val("");
          swal({
            title: msg10,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        }
      }
    });


    /*If any white space then make empty value of these all field*/
    $('body').on('keyup', '.labelname', function() {

      var labelname = $(this).val();

      if (!labelname.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });

  });
</script>

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreCustomFieldAddEditFormRequest', '#customFieldEditForm') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection