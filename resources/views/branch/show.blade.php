@extends('layouts.app')
@section('content')
<style>
    .right_side .table_row,
    .member_right .table_row {
        border-bottom: 1px solid #dedede;
        float: left;
        width: 100%;
        padding: 1px 0px 4px 2px;
    }

    .table_row .table_td {
        padding: 8px 8px !important;
    }

    .report_title {
        float: left;
        font-size: 20px;
        width: 100%;
        border-bottom: 2px solid #E6E9ED;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup"><a href="{{ URL::previous() }}"><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></a> {{ $branchData->branch_name }}</span>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
    </div>
    <div class="view_page_header_bg">
        <div class="row">
            <div class="col-xl-10 col-md-9 col-sm-10">
                <div class="user_profile_header_left">
                    <img class="user_view_profile_image" src="{{ URL::asset('public/img/branch/' . $branchData->branch_image) }}">
                    <div class="row">
                        <div class="view_top1">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                                <label class="nav_text h5 user-name fh5">
                                    {{ $branchData->branch_name }}&nbsp;
                                </label>
                                @can('branch_edit')
                                <div class="view_user_edit_btn d-inline">
                                    <a href="{!! url('/branch/edit/' . $branchData->id) !!}">
                                        <img src="{{ URL::asset('public/img/dashboard/Edit.png') }}">
                                    </a>
                                </div>
                                @endcan
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12 nav_text mt-2">
                                <div class="d-lg-inline">
                                    <i class=" fa fa-phone"></i> {{ $branchData->contact_number }}
                                </div>
                                <div class="d-lg-inline">
                                    <i class=" fa fa-envelope"></i> {{ $branchData->branch_email }}
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12 heading_view mt-3" style="width: 90%;">
                                <i class="fa-solid fa-location-dot"></i>
                                <lable class="">
                                    {{ $branchData->branch_address }}
                                    <!-- , <?php echo getCityName($branchData->city_id) != null ? getCityName($branchData->city_id) . ',' : ''; ?>{{ getStateName($branchData->state_id) }}, {{ getCountryName($branchData->country_id) }}. -->
                                </lable>
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
    @if (session('message'))
    <div class="row massage">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="checkbox checkbox-success checkbox-circle mb-2 alert alert-success alert-dismissible fade show">
                <input id="checkbox-10" type="checkbox" checked="">
                <label for="checkbox-10 colo_success" style="margin-left: 20px;font-weight: 600;"> {{ session('message') }} </label>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 1rem 0.75rem;"></button>
            </div>
        </div>
    </div>
    @endif
    <section id="" class="">

        <div class="panel-body padding_0">
            <div class="row mt-4">
                <div class="col-xl-12 col-md-12 col-sm-12">

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="guardian_div">
                        <div class="row">
                            <h2><label class="text-dark fw-bold"> {{ trans('message.More Info') }} </label></h2>

                            @if ($tbl_custom_fields->count() !== 0)
                            @foreach ($tbl_custom_fields as $tbl_custom_field)
                            <?php
                            $tbl_custom = $tbl_custom_field->id;
                            $userid = $branchData->id;

                            $datavalue = getCustomData($tbl_custom, $userid);
                            ?>
                            @if ($tbl_custom_field->type == 'radio')
                            @if ($datavalue != '')
                            <?php
                            $radio_selected_value = getRadioSelectedValue($tbl_custom_field->id, $datavalue);
                            ?>
                            <div class="col-xl-3 col-md-3 col-sm-12">
                                <label class="">{{ $tbl_custom_field->label }} : </label>
                                <label class="">
                                    {{ $radio_selected_value }}<br>
                                </label>
                            </div>

                            @endif
                            @else
                            @if ($datavalue != '')
                            <div class="col-xl-3 col-md-3 col-sm-12">
                                <label class="">{{ $tbl_custom_field->label }} : </label>
                                <label class="">
                                    {{ $datavalue }}<br>
                                </label>
                            </div>
                            @endif
                            @endif
                            @endforeach
                            @else
                            <p style="text-align: center;">{{ trans('message.Data not available') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="guardian_div mb-1">
                        <h2><label class="text-dark fw-bold"> {{ trans('Address Details') }} </label></h2>
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                                <label class=""> {{ trans('message.Country') }}: </label>
                                <label class="fw-bold">
                                    {{ getCountryName($branchData->country_id) }}
                                </label>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                                <label class=""> {{ trans('message.State') }}: </label>
                                <label class="text-dark fw-bold">
                                    {{ getStateName($branchData->state_id)  ?? trans('message.Not Added') }}
                                </label>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                                <label class=""> {{ trans('message.Town/City') }}: </label>
                                <label class="text-dark fw-bold">
                                    {{ getCityName($branchData->city_id)  ?? trans('message.Not Added') }}
                                </label>
                            </div>
                            <!-- <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                                <label class=""> {{ trans('message.Address') }}: </label>
                                <label class="text-dark fw-bold">{{ $branchData->branch_address }}</label>
                            </div> -->
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- END PANEL BODY DIV-->

    </section>
</div>
@endsection