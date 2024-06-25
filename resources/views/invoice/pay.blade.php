@extends('layouts.app')
@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
                        <a href="{{ URL::previous() }}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                                {{ trans('message.Pay Payment') }}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <div class="x_panel mb-0">
                <div class="x_content">
                    <form id="invoicePayPaymentForm" method="post" action="update/{{ $tbl_invoices->id }}" enctype="multipart/form-data" name="Form" class="form-horizontal upperform payForm">
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                            <h4><b>{{ trans('message.PAYMENT INFORMATION') }}</b></h4>
                            <hr style="margin-top:0px;">
                            <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12"></p>
                        </div>
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Invoice Number') }}
                                    <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="" class="form-control" value="{{ $tbl_invoices->invoice_number }}" readonly>
                                </div>
                            </div>
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Payment Number') }} <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="paymentno" class="form-control" value="{{ $code }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="Date">{{ trans('message.Payment Date') }} <label class="color-danger">*</label></label>

                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date ">
                                    <input type="text" name="Date" id="date_of_birth" autocomplete="off" class="form-control invoiceDate datepicker" placeholder="<?php echo getDatepicker(); ?>" value="{{ old('date', date('Y-m-d')) }}" onkeypress="return false;" required>
                                </div>
                            </div>
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" style="padding: 8px;" for="cus_name">{{ trans('message.Paid Amount') }}
                                    (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="receiveamount" class="form-control paidamount" id="amountreceived" required>
                                </div>
                            </div>
                           
                        </div>
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Payment Type') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select name="Payment_type" class="form-control form-select" required>
                                        <option value="">{{ trans('message.Select Payment Type') }}</option>
                                        @if (!empty($tbl_payments))
                                        @foreach ($tbl_payments as $tbl_paymentss)
                                        <option value="{{ $tbl_paymentss->id }}">{{ $tbl_paymentss->payment }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 color-danger">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Due Amount') }} (<?php echo getCurrencySymbols(); ?>) </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="Invoice_Number" id="dueamount" class="form-control" value="{{ number_format($dueamount,2) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Note') }}</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea name="note" class="form-control" maxlength="100"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.Cancel') }}</a>
                            </div> -->
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                <button type="submit" class="btn btn-success submit submitButton">{{ trans('message.Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        /*Datetimepicker*/
        $('.datepicker').datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            startDate: new Date(),
            language: "{{ getLangCode() }}",
        });


        /* For checking Amount Received is Less than or Equal to Due Amount */
        $('body').on('keyup', '#amountreceived', function() {
            // Function to remove commas and parse the number
            function parseNumber(value) {
                return parseFloat(value.replace(/,/g, ''));
            }

            var dueamount = parseNumber($('#dueamount').val());
            var amountreceived = parseNumber($(this).val());

            var msg1 = "{{ trans('message.Pay Amount') }}";
            var msg2 = "{{ trans('message.Please enter an amount less than Amount Due') }}";
            var msg3 = "{{ trans('message.OK') }}";

            if (isNaN(amountreceived) || amountreceived <= dueamount) {
                // Amount received is valid or not a number, no action needed
            } else {
                swal({
                    title: msg1,
                    text: msg2,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg3,
                    },
                    dangerMode: true,
                });

                $('#amountreceived').val('');
                return false;
            }
        });


        /*If select box have value then error msg and has error class remove*/
        $('body').on('change', '.invoiceDate', function() {

            var dateValue = $(this).val();

            if (dateValue != null) {
                $('#date_of_birth-error').css({
                    "display": "none"
                });
            }

            if (dateValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });
    });
</script>

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StorePayPaymentFormRequest', '#invoicePayPaymentForm') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection