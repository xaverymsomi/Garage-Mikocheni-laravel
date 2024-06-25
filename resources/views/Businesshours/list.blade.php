@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{{ URL::previous() }}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                                {{ trans('message.Business Hours') }}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>


        </div>
        @include('success_message.message')


        <div class="x_content table-responsive">
            <ul class="nav nav-tabs">
                @can('generalsetting_view')
                <li class="nav-item">
                    <a href="{!! url('setting/general_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span> <i class="">&nbsp;</i><b>{{ trans('message.GENERAL SETTINGS') }}</b></a>
                </li>
                @endcan
                @can('timezone_view')
                <li class="nav-item">
                    <a href="{!! url('setting/timezone/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.OTHER SETTINGS') }}</b></a>
                </li>
                @endcan
                @can('accessrights_view')
                <li class="nav-item">
                    <a href="{!! url('setting/accessrights/show') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.ACCESS RIGHTS') }}</b></a>
                </li>
                @endcan
                @can('businesshours_view')
                <li class="nav-item">
                    <a href="{!! url('setting/hours/list') !!}" class="nav-link active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.BUSINESS HOURS') }}</b></a>
                </li>
                @endcan
                @can('stripesetting_view')
                <li class="nav-item">
                    <a href="{!! url('setting/stripe/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.STRIPE SETTINGS') }}</b></a>
                </li>
                @endcan
                @can('branchsetting_view')
                <li class="nav-item">
                    <a href="{!! url('branch_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.BRANCH SETTING') }}</b></a>
                </li>
                @endcan
                <li class="nav-item">
                @can('email_view')
                    <a href="{!! url('setting/email_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.EMAIL SETTING') }}</b></a>
                @endcan
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <h4><b>{{ trans('BUSINESS HOURS') }}</b></h4>
                            <p class="col-md-12 col-sm-12 col-xs-12 ln_solid businesshours"></p>
                        </div>
                                @if (getValue() == 'rtl')
                                <div class="">
                                @else
                                <div class="table-responsive">
                                @endif                            
                                <table class="table businesshourtable">
                                <thead>
                                    <tr>
                                        <th scope="col"><b>{{ trans('message.Day') }}</b></th>
                                        <th scope="col"><b>{{ trans('message.Open') }}</b></th>
                                        <th scope="col"><b>{{ trans('message.Close') }}</b></th>
                                        @can('businesshours_delete')
                                        <th scope="col" class="text-center"><b>{{ trans('message.Action') }}</b></th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($tbl_hours))
                                    @foreach ($tbl_hours as $tbl_hourss)
                                    <tr>
                                        <input type="hidden" value="{{ $tbl_hourss->day }}">
                                        <input type="hidden" value="{{ $tbl_hourss->from }}">
                                        <input type="hidden" value="{{ $tbl_hourss->to }}">
                                        <td class="col-md-2 col-sm-3 col-xs-3 day_margin">
                                            {{ getDayName($tbl_hourss->day) }}
                                        </td>
                                        @if ($tbl_hourss->from == $tbl_hourss->to)
                                        <td class="col-md-4 col-sm-6 col-xs-6 day_off text-center" colspan="2">------
                                            {{ trans('message.Day off') }} ------
                                        </td>
                                        @else
                                        <td class="col-md-2 col-sm-3 col-xs-3 tbl_hourss">
                                            {{ getOpenHours($tbl_hourss->from) }}
                                        </td>
                                        <td class="col-md-2 col-sm-3 col-xs-3 tbl_hourss">
                                            {{ getCloseHours($tbl_hourss->to) }}
                                        </td>
                                        @endif
                                        @can('businesshours_delete')
                                        <td class="col-md-1 col-sm-3 col-xs-2 text-center delete_hours remv_padding" deletehours="{{ $tbl_hourss->id }}" url="{!! url('/setting/deletehours/' . $tbl_hourss->id) !!}">
                                            <i class="fa fa-trash fa-2x"></i>
                                        </td>
                                        @endcan
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <hr />

                        @can('businesshours_add')
                        <form method="post" action="{{ url('setting/hours/store') }}" enctype="multipart/form-data" class="form-horizontal upperform">
                            <div class="row">
                                <label class="control-label mt-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 checkpointtext text-end">{{ trans('message.Business Hours') }}
                                    <label class="color-danger">*</label></label>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">
                                    <select class="form-control day mt-3 form-select" name="day">
                                        <option value="1">{{ trans('message.Monday') }}</option>
                                        <option value="2">{{ trans('message.Tuesday') }}</option>
                                        <option value="3">{{ trans('message.Wednesday') }}</option>
                                        <option value="4">{{ trans('message.Thursday') }}</option>
                                        <option value="5">{{ trans('message.Friday') }}</option>
                                        <option value="6">{{ trans('message.Saturday') }}</option>
                                        <option value="7">{{ trans('message.Sunday') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">
                                    <select class="form-control mt-3 form-select" name="start">
                                        <option value="0">12:00 {{ trans('message.AM') }}</option>
                                        <option value="1">1:00 {{ trans('message.AM') }}</option>
                                        <option value="2">2:00 {{ trans('message.AM') }}</option>
                                        <option value="3">3:00 {{ trans('message.AM') }}</option>
                                        <option value="4">4:00 {{ trans('message.AM') }}</option>
                                        <option value="5">5:00 {{ trans('message.AM') }}</option>
                                        <option value="6">6:00 {{ trans('message.AM') }}</option>
                                        <option value="7">7:00 {{ trans('message.AM') }}</option>
                                        <option value="8">8:00 {{ trans('message.AM') }}</option>
                                        <option value="9">9:00 {{ trans('message.AM') }}</option>
                                        <option value="10">10:00 {{ trans('message.AM') }}</option>
                                        <option value="11">11:00 {{ trans('message.AM') }}</option>
                                        <option value="12">12:00 {{ trans('message.PM') }}</option>
                                        <option value="13">1:00 {{ trans('message.PM') }}</option>
                                        <option value="14">2:00 {{ trans('message.PM') }}</option>
                                        <option value="15">3:00 {{ trans('message.PM') }}</option>
                                        <option value="16">4:00 {{ trans('message.PM') }}</option>
                                        <option value="17">5:00 {{ trans('message.PM') }}</option>
                                        <option value="18">6:00 {{ trans('message.PM') }}</option>
                                        <option value="19">7:00 {{ trans('message.PM') }}</option>
                                        <option value="20">8:00 {{ trans('message.PM') }}</option>
                                        <option value="21">9:00 {{ trans('message.PM') }}</option>
                                        <option value="22">10:00 {{ trans('message.PM') }}</option>
                                        <option value="23">11:00 {{ trans('message.PM') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">
                                    <select class="form-control to business_hours mt-3 form-select" name="to">
                                        <option value="0">12:00 {{ trans('message.AM') }}</option>
                                        <option value="1">1:00 {{ trans('message.AM') }}</option>
                                        <option value="2">2:00 {{ trans('message.AM') }}</option>
                                        <option value="3">3:00 {{ trans('message.AM') }}</option>
                                        <option value="4">4:00 {{ trans('message.AM') }}</option>
                                        <option value="5">5:00 {{ trans('message.AM') }}</option>
                                        <option value="6">6:00 {{ trans('message.AM') }}</option>
                                        <option value="7">7:00 {{ trans('message.AM') }}</option>
                                        <option value="8">8:00 {{ trans('message.AM') }}</option>
                                        <option value="9">9:00 {{ trans('message.AM') }}</option>
                                        <option value="10">10:00 {{ trans('message.AM') }}</option>
                                        <option value="11">11:00 {{ trans('message.AM') }}</option>
                                        <option value="12">12:00 {{ trans('message.PM') }}</option>
                                        <option value="13">1:00 {{ trans('message.PM') }}</option>
                                        <option value="14">2:00 {{ trans('message.PM') }}</option>
                                        <option value="15">3:00 {{ trans('message.PM') }}</option>
                                        <option value="16">4:00 {{ trans('message.PM') }}</option>
                                        <option value="17">5:00 {{ trans('message.PM') }}</option>
                                        <option value="18">6:00 {{ trans('message.PM') }}</option>
                                        <option value="19">7:00 {{ trans('message.PM') }}</option>
                                        <option value="20">8:00 {{ trans('message.PM') }}</option>
                                        <option value="21">9:00 {{ trans('message.PM') }}</option>
                                        <option value="22">10:00 {{ trans('message.PM') }}</option>
                                        <option value="23">11:00 {{ trans('message.PM') }}</option>

                                    </select>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 mt-3">
                                    <input type="submit" class="btn btn-success mx-5" value="{{ trans('message.Submit') }}" />
                                </div>
                            </div>
                        </form>
                        @endcan

                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                            <h4><b>{{ trans('BUSINESS HOLIDAY') }}</b></h4>
                            <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                        </div>
                        <div class="table-responsive">
                            <table class="table businesshourtable">
                                <thead>
                                    <tr>
                                        <th scope="col"><b>{{ trans('message.Date') }}</b></th>
                                        <th scope="col"><b>{{ trans('message.Title') }}</b></th>
                                        <th scope="col"><b>{{ trans('message.Description') }}</b></th>
                                        @can('businesshours_delete')
                                        <th scope="col"><b>{{ trans('message.Action') }}</b></th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($tbl_holidays))
                                    @foreach ($tbl_holidays as $tbl_holidayss)
                                    <tr class="col-md-12 col-sm-12 data_holiday" style="padding:5px;" id="hours_data">
                                        <input type="hidden" value="{{ $tbl_holidayss->title }}">
                                        <input type="hidden" value="{{ $tbl_holidayss->date }}">
                                        <input type="hidden" value="{{ $tbl_holidayss->description }}">
                                        <td class="col-md-2 col-sm-3">
                                            {{ date(getDateFormat(), strtotime($tbl_holidayss->date)) }}
                                        </td>
                                        <td class="col-md-2 col-sm-3">{{ $tbl_holidayss->title }}</td>
                                        <td class="col-md-2 col-sm-3">{{ $tbl_holidayss->description }}</td>

                                        @can('businesshours_delete')
                                        <td class="col-md-1 col-sm-3 col-xs-12 delete_holiday" holidayurl="{!! url('/setting/deleteholiday/' . $tbl_holidayss->id) !!}"><i class="fa fa-trash fa-2x"></i>
                                        </td>
                                        @endcan
                                    </tr>
                                    @endforeach
                                    @else
                                    {{ trans('message.No data available in table.') }}</td>
                                    <tr>
                                        <td class="cname text-center" colspan="4">
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @can('businesshours_add')
                        <form id="business_hours_edit_form" method="post" action="{{ url('setting/holiday/store') }}" enctype="multipart/form-data" class="form-horizontal upperform">

                            <div class="row mt-3 {{ $errors->has('adddate') ? ' has-error' : 'Date inst' }} row-mb-0">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 checkpointtext text-end" for="Country">{{ trans('message.Date') }} <label class="color-danger">*</label></label>
                                <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5 date">
                                    <input type="text" name="adddate" class="form-control adddate businessDate datepicker" id="bus_date" autocomplete="off" placeholder="<?php echo getDatepicker(); ?>" onkeypress="return false;" required>
                                    @if ($errors->has('adddate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adddate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
                            </div>

                            <div class="row businessTitleMainDiv row-mb-0">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 checkpointtext text-end" for="Country">{{ trans('message.Title') }} <label class="color-danger">*</label></label>
                                <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                                    <input type="text" name="addtitle" class="form-control" placeholder="{{ trans('message.Enter Title') }}" maxlength="100" required />
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
                            </div>

                            <div class="row businessDescriptionMainDiv row-mb-0">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 checkpointtext text-end" for="Country">{{ trans('message.Description') }}</label>
                                <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                                    <textarea name="adddescription" class="form-control adddescription" rows="2" maxlength="300" placeholder="{{ trans('message.Enter Holiday Description') }} "></textarea>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
                            </div>

                        <div class="row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group ">
                                <a class="btn btn-primary BusinesshoursCancel" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                            </div> -->
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group ">
                                <button type="submit" class="btn btn-success BusinesshoursSubmit">{{ trans('message.SUBMIT') }}</button>
                            </div>
                        </div>
                    </form>

                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>


<script>
    $(document).ready(function() {
        /*datetimepicker*/
        $(".datepicker").datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            maxDate: new Date(),
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            startDate: new Date(),
            language: "{{ getLangCode() }}",
        });


        /*Delete hours*/
        $('body').on('click', '.delete_hours', function() {

            var url = $(this).attr('url');

            var msg1 = "{{ trans('message.Are You Sure?') }}";
            var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
            var msg3 = "{{ trans('message.Cancel') }}";
            var msg4 = "{{ trans('message.Yes, delete!') }}";

            swal({
                title: msg1,
                text: msg2,
                icon: 'warning',
                cancelButtonColor: '#C1C1C1',
                buttons: [msg3, msg4],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = url;
                }
            });
        });


        /*delete holiday*/
        $('body').on('click', '.delete_holiday', function() {

            var url = $(this).attr('holidayurl');

            var msg1 = "{{ trans('message.Are You Sure?') }}";
            var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
            var msg3 = "{{ trans('message.warning') }}";
            var msg4 = "{{ trans('message.Cancel') }}";
            var msg5 = "{{ trans('message.Yes, delete!') }}";

            swal({
                title: msg1,
                text: msg2,
                // type 
                icon: 'warning',
                cancelButtonColor: '#C1C1C1',
                buttons: [msg4, msg5],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = url;
                }
            });
        });



        /*If select box have value then error msg and has error class remove*/
        $('body').on('change', '.businessDate', function() {

            var dateValue = $(this).val();

            if (dateValue != null) {
                $('#bus_date-error').css({
                    "display": "none"
                });
            }

            if (dateValue != null) {
                $(this).parent().parent().parent().removeClass('has-error');
            }
        });
    });
</script>

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreBusinessHoursEditFormRequest', '#business_hours_edit_form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection