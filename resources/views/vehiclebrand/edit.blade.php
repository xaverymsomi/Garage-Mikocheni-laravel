@extends('layouts.app')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a> 
          <a href="{!! url('/vehiclebrand/list') !!}" id=""><span class="titleup"><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}">
                {{ trans('message.Edit Vehicle Brand') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
    <div class="clearfix"></div>
    @include('success_message.message')
    <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
        <div class="x_content">
          <div class="x_panel">
            <form id="vehicleBrandEdit-Form" action="update/{{ $vehicalbrands->id }}" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">

              <div class="row row-mb-0">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 text-center" for="first-name">{{ trans('message.Vehicle Types') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <select name="vehicaltypes" class="form-control col-md-7 col-xs-12 form-select">
                    <option value="">{{ trans('message.Select Vehicle Type') }}</option>
                    @if (!empty($vehicaltypes))
                    @foreach ($vehicaltypes as $vehicaltypess)
                    <option value="{{ $vehicaltypess->id }}" <?php if ($vehicaltypess->id == $vehicalbrands->vehicle_id) {
                                                                echo 'selected';
                                                              } ?>> {{ $vehicaltypess->vehicle_type }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>

              <div class="row row-mb-0">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 text-center" for="first-name">{{ trans('message.Vehicle Brand') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="text" required="required" name="vehicalbrand" value="{{ $vehicalbrands->vehicle_brand }}" class="form-control  vehicalbrand" maxlength="30">
                </div>
              </div>

              <!-- Custom Filed data value -->
              @if (!empty($tbl_custom_fields))
              <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                <h4><b>{{ trans('message.Custom Fields') }}</b></h4>
                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
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
              $userid = $vehicalbrands->id;
              $datavalue = getCustomDataVehicleBrand($tbl_custom, $userid);

              $subDivCount++;
              ?>
              @if ($myCounts % 2 == 0)
              <div class="row row-mb-0">
                @endif

                <div class="row form-group col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 error_customfield_main_div_{{ $myCounts }}">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="account-no">{{ $tbl_custom_field->label }} <label class="color-danger">{{ $red }}</label></label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
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
                                                                                                                              $getRadioValue = getRadioLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $vehicalbrands->id, $tbl_custom_field->id);

                                                                                                                              if ($k == $getRadioValue) {
                                                                                                                                echo 'checked';
                                                                                                                              } ?>> {{ $val }} &nbsp;
                      @endforeach
                    </div>
                    @endif
                    @elseif($tbl_custom_field->type == 'checkbox')
                    <?php
                    $checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id);
                    ?>
                    @if (!empty($checkboxLabelArrayList))
                    <?php
                    $getCheckboxValue = getCheckboxLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $vehicalbrands->id, $tbl_custom_field->id);
                    ?>
                    <div class="required_checkbox_parent_div_{{ $tbl_custom_field->id }}" style="margin-top: 5px;">
                      @foreach ($checkboxLabelArrayList as $k => $val)
                      <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}" <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                  if ($val == getCheckboxValForAllModule($tbl_custom_field->form_name, $vehicalbrands->id, $tbl_custom_field->id, $val)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                                                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                                                                                                                                                                                                                                                  ?>> {{ $val }} &nbsp;
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
                @if ($myCounts % 2 != 0)
              </div>
              @endif
              @endforeach
              <?php
              if ($subDivCount % 2 != 0) {
                echo '</div>';
              }
              ?>
              @endif
              <!-- Custom Filed data value End-->

              <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                  <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                </div> -->
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-2 mx-0">
                  <button type="submit" class="btn btn-success updateVehicleBrandButton">{{ trans('message.UPDATE') }}</button>
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
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<script>
  $(document).ready(function() {
    /*If address have any white space then make empty address value*/
    $('body').on('keyup', '.vehicalbrand', function() {

      var vehicalbrandValue = $(this).val();

      if (!vehicalbrandValue.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });


    /*Custom Field manually validation*/
    var msg1 = "{{ trans('message.field is required') }}";
    var msg2 = "{{ trans('message.Only blank space not allowed') }}";
    var msg3 = "{{ trans('message.Special symbols are not allowed.') }}";
    var msg4 = "{{ trans('message.At first position only alphabets are allowed.') }}";

    /*Form submit time check validation for Custom Fields */
    $('body').on('click', '.updateVehicleBrandButton', function(e) {
      $('#vehicleBrandEdit-Form input, #vehicleBrandEdit-Form select, #vehicleBrandEdit-Form textarea').each(

        function(index) {
          var input = $(this);

          if (input.attr('name') == "vehicaltypes" || input.attr('name') == "vehicalbrand") {
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
                $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                e.preventDefault();
                return false;
              } else if (!input.val().replace(/\s/g, '').length) {
                $('.common_value_is_' + rowid).val("");
                $('#common_error_span_' + rowid).text(labelName + " : " + msg2);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                e.preventDefault();
                return false;
              } else if (!input.val().match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                $('.common_value_is_' + rowid).val("");
                $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
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
                $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
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
                $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
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
            $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
            $('#common_error_span_' + rowid).css({
              "display": ""
            });
            $('.error_customfield_main_div_' + rowid).addClass('has-error');
          } else if (valueIs.match(/^\s+/)) {
            $('.common_value_is_' + rowid).val("");
            $('#common_error_span_' + rowid).text(labelName + " : " + msg4);
            $('#common_error_span_' + rowid).css({
              "display": ""
            });
            $('.error_customfield_main_div_' + rowid).addClass('has-error');
          } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
            $('.common_value_is_' + rowid).val("");
            $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
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
            $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
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
              $('#common_error_span_' + rowid).text(labelName + " : " + msg4);
              $('#common_error_span_' + rowid).css({
                "display": ""
              });
              $('.error_customfield_main_div_' + rowid).addClass('has-error');
            } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
              $('.common_value_is_' + rowid).val("");
              $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
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
          $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
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
          $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
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
{!! JsValidator::formRequest('App\Http\Requests\VehicleBrandAddEditFormRequest', '#vehicleBrandEdit-Form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection