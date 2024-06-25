@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
                        <a href="{!! url('/color/list') !!}" id=""><span class="titleup"><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}">
                                {{ trans('message.Add Color') }}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
        @include('success_message.message')
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form id="colorAdd-Form" method="post" action="{!! url('color/store') !!}" enctype="multipart/form-data" class="form-horizontal upperform colorAddForm">

                            <div class="row row-mb-0">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Color Name') }} <label class="text-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="text" id="color" name="color" class="form-control color" placeholder="{{ trans('message.Enter Color Name') }}" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('Select Color') }} <label class="text-danger"></label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="color" id="c_name" name="c_name" class="form-control model_input c_name" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Start Custom Field, (If register in Custom Field Module)  -->
                            @if (!empty($tbl_custom_fields))
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                                <h4><b>{{ trans('message.Custom Fields') }}</b></h4>
                                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid">
                                </p>
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
                            $subDivCount++;
                            ?>

                            @if ($myCounts % 2 == 0)
                            <div class="row row-mb-0">
                                @endif

                                <div class="row form-group col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 error_customfield_main_div_{{ $myCounts }}">

                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="account-no">{{ $tbl_custom_field->label }} <label class="color-danger">{{ $red }}</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        @if ($tbl_custom_field->type == 'textarea')
                                        <textarea name="custom[{{ $tbl_custom_field->id }}]" class="form-control textarea_{{ $tbl_custom_field->id }} textarea_simple_class common_simple_class common_value_is_{{ $myCounts }}" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="100" isRequire="{{ $required }}" type="textarea" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}></textarea>

                                        <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                                        @elseif($tbl_custom_field->type == 'radio')
                                        <?php
                                        $radioLabelArrayList = getRadiolabelsList($tbl_custom_field->id);
                                        ?>
                                        @if (!empty($radioLabelArrayList))
                                        <div style="margin-top: 5px;">
                                            @foreach ($radioLabelArrayList as $k => $val)
                                            <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" value="{{ $k }}" <?php if ($k == 0) {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?>>{{ $val }} &nbsp;
                                            @endforeach
                                        </div>
                                        @endif
                                        @elseif($tbl_custom_field->type == 'checkbox')
                                        <?php
                                        $checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id);
                                        $cnt = 0;
                                        ?>

                                        @if (!empty($checkboxLabelArrayList))
                                        <div class="required_checkbox_parent_div_{{ $tbl_custom_field->id }}" style="margin-top: 5px;">
                                            @foreach ($checkboxLabelArrayList as $k => $val)
                                            <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}"> {{ $val }}
                                            &nbsp;
                                            <?php $cnt++; ?>
                                            @endforeach
                                            <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                                        </div>
                                        <input type="hidden" name="checkboxCount" value="{{ $cnt }}">
                                        @endif
                                        @elseif($tbl_custom_field->type == 'textbox')
                                        <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" class="form-control textDate_{{ $tbl_custom_field->id }} textdate_simple_class common_value_is_{{ $myCounts }} common_simple_class" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="30" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>

                                        <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display:none"></span>
                                        @elseif($tbl_custom_field->type == 'date')
                                        <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" class="form-control textDate_{{ $tbl_custom_field->id }} date_simple_class common_value_is_{{ $myCounts }} common_simple_class" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="30" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }} onkeydown="return false">

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
                            <!-- End Custom Field -->


                            <div class="row">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                    <a class="btn btn-primary colorAddCancleButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                                </div> -->
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-2 mx-0">
                                    <button type="submit" class="btn btn-success colorname colorAddSubmitButton">{{ trans('message.SUBMIT') }}</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        /*If address have any white space then make empty address value*/
        $('body').on('keyup', '.color', function() {
            var colorValue = $(this).val();

            if (!colorValue.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });


        /*Custom Field manually validation*/
        var msg1 = "{{ trans('message.field is required') }}";
        var msg2 = "{{ trans('message.Only blank space not allowed') }}";
        var msg3 = "{{ trans('message.Special symbols are not allowed.') }}";
        var msg4 = "{{ trans('message.At first position only alphabets are allowed.') }}";

        /*Form submit time check validation for Custom Fields */
        $('body').on('click', '.colorAddSubmitButton', function(e) {
            $('#colorAdd-Form input, #colorAdd-Form select, #colorAdd-Form textarea').each(

                function(index) {
                    var input = $(this);

                    if (input.attr('name') == "color") {
                        if (input.val() == "") {
                            return false;
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
                                $('.error_customfield_main_div_' + ids).removeClass('has-error');
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
            if (!colorPickerChanged) {
                alert("Please select a color before submitting.");
                event.preventDefault();
            }
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
                    }
                    //else if(!valueIs.match(/^[a-zA-Z0-9][a-zA-Z0-9\s\.\@\-\_]*$/))
                    else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
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

<script>
    // Color name to HTML color value mapping
    const colorMap = {
        "red": "#ff0000",
        "blue": "#0000FF",
        "green": "#008000",
        "black": "#000000",
        "brown": "#A52A2A",
        "grey": "#808080",
        "pink": "#FFC0CB",
        "purple": "#800080",
        "yellow": "#FFFF00",
    };
    let colorPickerChanged = false;
    function removeSpecialSymbols(str) {
        return str.replace(/[^a-zA-Z0-9]/g, '');
    }

    // Get references to the color input and text input
    const colorInput = document.getElementById("c_name");
    const textInput = document.getElementById("color");

    // Add an event listener to the color input to update the text input
    colorInput.addEventListener("input", function () {
        const cleanedColorCode = removeSpecialSymbols(colorInput.value);
        textInput.value = `custom${cleanedColorCode}`;
        colorPickerChanged = true;
    });
</script>

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\ColorAddEditFormRequest', '#colorAdd-Form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection