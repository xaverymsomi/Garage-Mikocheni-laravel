@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('setting/custom/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                                {{ trans('message.Add Custom Field') }}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>

            <div class="x_content">
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form id="customFieldAddForm" method="post" action="{{ url('setting/custom/store') }}" enctype="multipart/form-data" class="form-horizontal upperform customAddForm">

                                <div class="row mt-0 has-feedback row-mb-0">
                                    <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="Country">{{ trans('message.Form Name') }} <label class="color-danger">*</label>
                                    </label>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                        <select class="form-control col-md-9 col-xs-12 form-select" id="select_form_name" name="formname" required>
                                            <option value="">{{ trans('message.Select Form Name') }}
                                            <option value="customer">{{ trans('message.Customer') }}</option>
                                            <option value="employee">{{ trans('message.Employee') }}</option>
                                            <option value="supportstaff">{{ trans('message.Support Staff') }}</option>
                                            <option value="accountant">{{ trans('message.Accountant') }}</option>
                                            <option value="suppliers">{{ trans('message.Supplier') }}</option>
                                            <option value="branch_admin">{{ trans('message.Branch Admin') }}</option>
                                            <option value="product">{{ trans('message.Product') }}</option>
                                            <option value="purchase">{{ trans('message.Purchase') }}</option>
                                            <option value="vehicle">{{ trans('message.Vehicle') }}</option>
                                            <option value="vehicletype">{{ trans('message.Vehicle Type') }}</option>
                                            <option value="vehiclebrand">{{ trans('message.Vehicle Brand') }}</option>
                                            <option value="color">{{ trans('message.Color') }}</option>
                                            <option value="service">{{ trans('message.Service') }}</option>
                                            <option value="invoice">{{ trans('message.Invoice') }}</option>
                                            <option value="income">{{ trans('message.Income') }}</option>
                                            <option value="expense">{{ trans('message.Expense') }}</option>
                                            <option value="sales">{{ trans('message.Sales') }}</option>
                                            <option value="salepart">{{ trans('message.Sale Part') }}</option>
                                            <option value="RTO">{{ trans('message.RTO') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
                                </div>

                                <div class="row has-feedback row-mb-0">
                                    <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end">{{ trans('message.Label') }}
                                        <label class="color-danger">*</label>
                                    </label>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                        <input type="text" name="labelname" class="form-control labelname" placeholder="{{ trans('message.Enter Label Name') }}" required value="" maxlength="50">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
                                </div>

                                <div class="row has-feedback row-mb-0">
                                    <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="Country">{{ trans('message.Type') }} <label class="color-danger">*</label>
                                    </label>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                        <select class="form-control col-md-9 col-xs-12 selectType selectTypeIs form-select" name="typename" required>
                                            <option value="">{{ trans('message.Select Type') }}
                                            <option value="textbox">{{ trans('message.TextBox') }}</option>
                                            <option value="date">{{ trans('message.Date') }}</option>
                                            <option value="textarea">{{ trans('message.Textarea') }} </option>
                                            <option value="radio">{{ trans('message.Radio') }}</option>
                                            <option value="checkbox">{{ trans('message.Checkbox') }} </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
                                </div>

                                <!-- If Selected radio then show this Add radio label part -->
                                <div class="row radio_add_part_div row-mb-0" style="display: none;">
                                    <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="radio_add_part">{{ trans('message.Radio Field Label') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                        <input type="" name="radios_add" class="form-control btn-sm r_label r_label_inputbox" placeholder="{{ trans('message.Enter radio label name') }}" maxlength="25">
                                    </div>
                                    <div class="col-md3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 add_more_radio">
                                        <button type="button" class="btn btn-outline-secondary btn-sm">{{ trans('message.Add') }}</button>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-sm-6 col-xs-12 form-group radio_label_view_part_div row-mb-0" style="display: none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="radio_add_part"></label>
                                    <div class="col-md-5 col-sm-5 col-xs-12" id="radio_label">
                                        <div class="radio_label">
                                            <input type="hidden" value="" name="r_label[]" class="radioLabelArray duplicate_radio" style="">
                                        </div>
                                    </div>
                                </div>
                                <!-- If Select radio then show this -->

                                <!-- If Selected checkbox then show this Add checkbox label part -->
                                <div class="row checkbox_add_part_div row-mb-0" style="display: none;">
                                    <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-start" for="checkbox_add_part">{{ trans('message.Checkbox Field Label') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                        <input type="" name="checkboxs_add" class="form-control c_label c_label_inputbox" placeholder="{{ trans('message.Enter checkbox label name') }}" maxlength="25">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">
                                        <button type="button" class="btn btn-outline-secondary btn-sm add_more_checkbox">{{ trans('message.Add') }}</button>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-sm-6 col-xs-12 form-group checkbox_label_view_part_div row-mb-0" style="display: none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="checkbox_add_part"></label>
                                    <div class="col-md-5 col-sm-5 col-xs-12" id="checkbox_label">
                                        <div class="checkbox_label">
                                            <input type="hidden" value="" name="c_label[]" class="checkboxLabelArray duplicate_checkbox" style="">
                                        </div>
                                    </div>
                                </div>
                                <!-- If Select checkbox then show this -->

                                <div class="row has-feedback row-mb-0">
                                    <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end">{{ trans('message.Required') }}
                                        <label class="color-danger">*</label>
                                    </label>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 required pt-1">
                                        <input type="radio" name="required" value="yes">{{ trans('message.Yes') }}
                                        <input type="radio" name="required" checked value="no">
                                        {{ trans('message.No') }}
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">
                                    </div>

                                    <div class="row mt-3 has-feedback">
                                        <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end">{{ trans('message.Always visible') }}
                                            <label class="color-danger">*</label>
                                        </label>
                                        <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 visible mx-1 pt-1">
                                            <input type="radio" name="visable" checked value="yes">{{ trans('message.Yes') }}
                                            <input type="radio" name="visable" value="no">
                                            {{ trans('message.No') }}
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
                                    </div>

                                    <!-- <div class="row">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                            <a class="btn supplierCancleButton" href="{{ URL::previous() }}">{{ trans('CANCEL') }}</a>
                                        </div>
                                    </div>
                                
                                    </div>
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">                         
                                        <button type="submit" class="btn supplierSubmitButton">{{ trans('SUBMIT') }}</button> 
                                    </div>
                                    </div> -->

                                    <div class="">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                            <a class="btn btn-primary customAddCancelButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                                        </div> -->
                                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-2 mx-0">
                                            <button type="submit" class="btn btn-success customAddSubmitButton">{{ trans('message.SUBMIT') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
        var msg35 = "{{ trans('message.OK') }}";
        $(document).ready(function() {

            $('body').on('change', '.selectType', function() {
                var valueIs = $(this).val();

                if (valueIs == 'radio') {
                    $('.radio_add_part_div').css({
                        "display": ""
                    });
                    $('.radio_label_view_part_div').css({
                        "display": ""
                    });

                    $('.checkbox_add_part_div').css({
                        "display": "none"
                    });
                    $('.checkbox_label_view_part_div').css({
                        "display": "none"
                    });
                } else if (valueIs == 'checkbox') {
                    $('.checkbox_add_part_div').css({
                        "display": ""
                    });
                    $('.checkbox_label_view_part_div').css({
                        "display": ""
                    });

                    $('.radio_add_part_div').css({
                        "display": "none"
                    });
                    $('.radio_label_view_part_div').css({
                        "display": "none"
                    });
                } else {
                    $('.radio_add_part_div').css({
                        "display": "none"
                    });
                    $('.radio_label_view_part_div').css({
                        "display": "none"
                    });
                    $('.checkbox_add_part_div').css({
                        "display": "none"
                    });
                    $('.checkbox_label_view_part_div').css({
                        "display": "none"
                    });
                }
            });


            /*For add radio label*/
            $('body').on('click', '.add_more_radio', function() {

                var text = $('.r_label').val();
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
                            $('.radio_label').append(
                                '<div class="row col-md-8 label_radio checkpointtext text-start" id="demo" ><div class="mx-1"><i class="fa fa-trash delete_r_label text-danger" aria-hidden="true"></i>  <input type="hidden" value="' +
                                text + '"  name="r_label[]" class="radioLabelArray"><label>' + text +
                                '</label></div></div>');
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
                            $('.radio_label').append(
                                '<div class="col-md-8 label_radio checkpointtext text-start mx-5" id="demo" ><div class=""><i class="fa fa-trash delete_r_label text-danger" aria-hidden="true"></i>  <input type="hidden" value="' +
                                text + '"  name="r_label[]" class="radioLabelArray"><label>' + text +
                                '</label></div></div>');
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


            /*For Delete radio label*/
            $('body').on('click', '.delete_r_label', function() {
                $(this).parents('.label_radio').remove();
            });


            /*For add checkbox labels and delete it*/
            $('body').on('click', '.add_more_checkbox', function() {
                var text = $('.c_label').val();

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
                            $('.checkbox_label').append(
                                '<div class="col-md-12 label_checkbox checkpointtext text-start mx-5" id="demo" ><div class=""><i class="fa fa-trash delete_c_label text-danger" aria-hidden="true"></i>  <input type="hidden" value="' +
                                text + '"  name="c_label[]" class="checkboxLabelArray"><label>' + text +
                                '</label></div></div>');
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
                            $('.checkbox_label').append(
                                '<div class="col-md-12 label_checkbox checkpointtext text-start mx-5" id="demo" ><div class=""><i class="fa fa-trash delete_c_label text-danger" aria-hidden="true"></i>  <input type="hidden" value="' +
                                text + '"  name="c_label[]" class="checkboxLabelArray"><label>' + text +
                                '</label></div></div>');
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

            /*For Delete checkbox label*/
            $('body').on('click', '.delete_c_label', function() {
                $(this).parents('.label_checkbox').remove();
            });


            /*Submit time check if radio or checkbox selected then label value should not empty*/
            $('body').on('click', '.customAddSubmitButton', function(e) {

                var selectTepyIs = $('select[name=typename]').val();
                var selectFormNameIs = $('select[name=formname]').val();
                var labelNameIs = $('.labelname').val();
                var radioLabelVal = $('.radioLabelArray').val();
                var checkboxLabelVal = $('.checkboxLabelArray').val();

                var options = $('.selectTypeIs :selected').val();


                var msg5 =
                    "{{ trans('message.Please enter radio label name on textbox after click on Add button.') }}";
                var msg6 =
                    "{{ trans('message.Please enter checkbox label name on textbox after click on Add button.') }}";

                if (options == "radio") {
                    if (selectFormNameIs != "" && labelNameIs != "") {
                        if (radioLabelVal == "" || radioLabelVal == null) {
                            swal({
                                title: msg5,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg35,
                                },
                                dangerMode: true,
                            });
                            $('.duplicate_checkbox').remove();
                            e.preventDefault();
                        } else {
                            $('.duplicate_radio').remove();
                        }
                    }
                } else if (options == "checkbox") {
                    if (selectFormNameIs != "" && labelNameIs != "") {
                        if (checkboxLabelVal == "" || checkboxLabelVal == null) {
                            swal({
                                title: msg6,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg35,
                                },
                                dangerMode: true,
                            });
                            $('.duplicate_radio').remove();
                            e.preventDefault();
                        } else {
                            $('.duplicate_radio').remove();
                        }
                    }
                } else {
                    if (options != "") {
                        $('.duplicate_checkbox').remove();
                        $('.duplicate_radio').remove();
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreCustomFieldAddEditFormRequest', '#customFieldAddForm') !!}
    <script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    @endsection