@extends('layouts.app')
@section('content')

<style>
    .box_color {
        width: 40px;
        height: 20px;
        float: left;
        margin: 0px 5px 3px 0px;
    }

    .table>tbody>tr>td {
        padding: 10px 8px !important;
    }

    .right_side .table_row,
    .table_row {
        border-bottom: 1px solid #dedede;
        float: left;
        width: 100%;
        padding: 1px 0px 4px 2px;

    }

    .member_right {
        border: 1px solid #dedede;
        /* margin-left: 9px; */
    }

    .table_row .table_td {
        padding: 8px 8px !important;

    }

    .report_title {
        float: left;
        font-size: 20px;
        margin-bottom: 10px;
        padding-top: 10px;
        width: 100%;
    }

    .b-detail__head-title {
        border-left: 4px solid #2A3F54;
        padding-left: 15px;
        text-transform: capitalize;

    }

    .b-detail__head-price {
        width: 100%;
        float: right;
        text-align: center;
    }

    .b-detail__head-price-num {
        padding: 4px 34px;
        font: 700 23px 'PT Sans', sans-serif;

    }

    .thumb img {
        border-radius: 0px;
    }


    .item .thumb {
        width: 23%;
        cursor: pointer;
        /* float: left; */
        /* border: 1px solid; */
        margin: 3px;

    }

    .item .thumb img {
        width: 70px;
        height: 70px;
    }

    .item img {
        width: 435px;

    }

    .carousel-inner-1 {
        margin-top: 16px;
    }

    .carousel-inner>.item>a>img,
    .carousel-inner>.item>img,
    .img-responsive,
    .thumbnail a>img,
    .thumbnail>img {
        height: 268px;
        width: 268px;
    }

    .shiptitleright {
        float: right;
    }

    ul.bar_tabs>li.active {
        background: #fff !important;
    }

    img.up_arrow {
        margin-left: 35px;
    }

    img.down_arrow {
        margin-left: 33px;
    }

    div#carousel {
        margin-left: 45px;
        margin-top: -289px;
    }

    @media (max-width: 540px) {
        .view_top1 {
            margin-top: -6rem !important;
            margin-left: 47% !important;
        }

        /* .col-md-12 {
            margin-top: -99px;
            margin-top: 3rem!important;
        } */
    }

    @media (width: 540px) {
        .view_top1 {
            margin-top: 1rem !important;
            margin-left: 5% !important;
        }
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="">
            <div class="page-title">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup"><a href="{{ URL::previous() }}"><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}" class="me-2"></a>{{
                                $vehical->modelname }}</span>
                        </div>
                        @include('dashboard.profile')
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                <div class="view_page_header_bg">
                    <div class="row">
                        <div class="col-xl-10 col-md-9 col-sm-10">
                            <div class="user_profile_header_left">
                                <?php $vehicleimage = getVehicleImage($vehical->id); ?>
                                <img class="user_view_profile_image" src="{{ URL::asset('public/vehicle/' . $vehicleimage) }}">
                                <div class="row">
                                    <div class="view_top1">
                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                            <label class="nav_text h5">
                                                {{ $vehical->modelname }}&nbsp;
                                            </label>
                                            @can('vehicle_edit')
                                            <div class="view_user_edit_btn d-inline">
                                                <a href="{!! url('/vehicle/list/edit/' . $vehical->id) !!}">
                                                    <img src="{{ URL::asset('public/img/dashboard/Edit.png') }}">
                                                </a>
                                            </div>
                                            @endcan
                                        </div>
                                        <div class="col-xl-12 col-md-12 col-sm-12 nav_text mt-2">
                                            <img src="{{ URL::asset('public/vehicle/4344326 1.png') }}"></img>&nbsp;{{ getVehicleType($vehical->vehicletype_id) }}&nbsp;&nbsp;&nbsp;
                                            <img src="{{ URL::asset('public/vehicle/Vector (11).png') }}" class="small_img"></img>&nbsp;
                                            <span class="txt_color">
                                                @if (!empty($vehical->dom))
                                                {{ date(getDateFormat(), strtotime($vehical->dom)) }}
                                                @else
                                                {{ trans('message.Not Added') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                        <div class="view_top1">
                                            <div class="row">
                                                <div class="col-md-12 heading_view">
                                                    <img src="{{ URL::asset('public/vehicle/Vector (12).png') }}" class="small_img"></img>&nbsp;
                                                    <lable class="">
                                                        {{ $vehical->odometerreading }} km
                                                    </lable>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-2">
                            <div class="group_thumbs">
                                <img src="{{ URL::asset('public/img/dashboard/Design.png') }}" height="93px" width="134px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--page conten -->
            <div class="panel-body padding_0">
                <div class="row mt-4">
                    <div class="col-xl-11 col-md-11 col-sm-11 pt-3 table-responsive">
                        <ul class="nav nav-tabs">
                            @can('vehicle_view')
                            <li class="nav-item">
                                <a href="{!! url('vehicle/list/view/' . $vehical->id) !!}" class="nav-link nav-link-not-active fw-bold">
                                    {{ trans('message.BASIC DETAILS') }}</a>
                            </li>
                            @endcan
                            @can('vehicle_view')
                            <li class="nav-item">
                                <a href="{!! url('vehicle/list/view/description/' . $vehical->id) !!}" class="nav-link nav-link-not-active fw-bold">
                                    {{ trans('message.DESCRIPTION') }}</a>
                            </li>
                            @endcan
                            @can('service_view')
                            <li class="nav-item">
                                <a href="{!! url('vehicle/list/view/maintainance/' . $vehical->id) !!}" class="nav-link nav-link-not-active fw-bold">
                                    {{ trans('message.MAINTAINANCE HISTORY') }}</a>
                            </li>
                            @endcan
                            @can('service_view')
                            <li class="nav-item">
                                <a href="{!! url('vehicle/list/view/MOT/' . $vehical->id) !!}" class="nav-link active fw-bold">
                                    {{ trans('message.MOT TEST DETAILS') }}</a>
                            </li>
                            @endcan
                        </ul>

                    </div>
                    @canany(['service_add'])
                    <div class="ms-lg-auto col-xl-1 col-md-1 col-sm-1 text-end">
                        <div class="dropdown_toggle">
                            <img src="{{ URL::asset('public/img/icons/plus Button.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonAction" data-bs-toggle="dropdown" aria-expanded="false">
                            <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonAction">
                                @can('service_add')
                                <li><a class="dropdown-item" href="{!! url('/service/add') !!}?c_id={{ $vehical->customer_id }}&v_id={{ $vehical->id }}" style="padding-left: 10px;"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('message.MAINTAINANCE HISTORY') }}</a></li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                    @endcanany
                </div>
                <div class="x_panel">
                    <div class="row margin_top_15px">
                        <div class="table-responsive">
                            @if ($mot_test_status_yes_or_no == 1)
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><b>{{ trans('message.Vehicle Id') }}</b>
                                        </th>
                                        <th><b>{{ trans('message.Service Id') }}</b>
                                        </th>
                                        <th><b>{{ trans('message.MOT Test Status') }}</b>
                                        </th>
                                        <th><b>{{ trans('message.MOT Test Number') }}</b>
                                        </th>
                                        <th><b>{{ trans('message.Date') }}</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ $get_vehicle_mot_test_reports_data->vehicle_id }}
                                        </td>
                                        <td>
                                            {{ $get_vehicle_mot_test_reports_data->service_id }}
                                        </td>
                                        <td style="text-transform: uppercase;">
                                            {{ $get_vehicle_mot_test_reports_data->test_status }}
                                        </td>
                                        <td>
                                            {{ $get_vehicle_mot_test_reports_data->mot_test_number }}
                                        </td>
                                        <td>
                                            {{ $get_vehicle_mot_test_reports_data->date }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            @if ($get_vehicle_mot_test_reports_data->test_status == 'fail')
                            <br>
                            <div class="col-md-12">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <td><b>{{ trans('message.Code') }}</b>
                                            </td>
                                            <td><b>{{ trans('message.Point') }}</b>
                                            </td>
                                            <td><b>{{ trans('message.Answer') }}</b>
                                            </td>
                                        </tr>
                                    </thead>
                                    @foreach ($answers_question_id_array as $key => $ques_answer_id)
                                    @if ($answers_question_id_array[$key] == 'x' || $answers_question_id_array[$key] ==
                                    'r')
                                    <tbody>
                                        <tr>
                                            <td> {{ $key }}
                                            </td>

                                            @foreach ($get_inspection_points_library_data as $insp_point_linrary)
                                            @if ($insp_point_linrary->id == $key)
                                            <td>{{ $insp_point_linrary->point }}
                                            </td>
                                            @endif
                                            @endforeach

                                            <td style="text-transform: uppercase;">
                                                {{ $ques_answer_id }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endif
                                    @endforeach
                                </table>
                            </div>
                            @endif
                            @else
                            <p style="text-align: center;"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- end  slider -->
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@endsection